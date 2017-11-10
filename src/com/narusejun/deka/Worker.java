package com.narusejun.deka;

import java.io.ByteArrayOutputStream;
import java.io.InputStream;
import java.net.URL;
import java.nio.charset.StandardCharsets;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.util.concurrent.atomic.AtomicInteger;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import javax.net.ssl.HttpsURLConnection;

public class Worker implements Runnable {
	private Connection conn;
	private Pattern pat;
	private String sql;
	private AtomicInteger counter;
	private String id;
	
	public Worker(Connection conn, Pattern pat, String sql, AtomicInteger counter, String id) throws Exception {
		this.conn = conn;
		this.pat = pat;
		this.sql = sql;
		this.counter = counter;
		this.id = id;
	}
	
	private byte[] getContent(String url) {
		try {
			HttpsURLConnection conn = (HttpsURLConnection) new URL(url).openConnection();
			conn.setInstanceFollowRedirects(true);
			conn.setRequestMethod("GET");
			conn.connect();
			
			InputStream in = conn.getResponseCode()==200 ? conn.getInputStream() : conn.getErrorStream();
			ByteArrayOutputStream out = new ByteArrayOutputStream();
			byte[] buf = new byte[2048];
			int readByte = 0;
			while((readByte = in.read(buf)) > 0){
				out.write(buf, 0, readByte);
			}
			
			in.close();
			conn.disconnect();
			
			return out.toByteArray();
		}catch(Exception e){
			System.out.println("[" + e.getMessage() + "] RETRY : " + id);
			return getContent(url);
		}
	}
	
	private String getPageTitle(String content) {
		for(String line : content.split("\n")){
			int start = line.indexOf("<title>");
			int end = line.indexOf("</title>");
			if(start > -1 && end > -1){
				return line.substring(start + 7, end);
			}
		}
		return "";
	}
	
	private void getInformation(PreparedStatement ps, int retry) throws Exception {
		try {
			String content = new String(getContent("https://twitter.com/" + id), StandardCharsets.UTF_8);
			String title = getPageTitle(content);
			
			if(title.matches(".+さん \\| Twitter.*")){
				System.out.println(id + " - Taken");
				ps.setString(1, id);
				Matcher m = pat.matcher(content);
				if(m.find()){
					ps.setString(1, m.group(3));
					ps.setString(2, m.group(1));
					ps.setString(3, m.group(2));
					ps.setString(4, m.group(4).replaceAll("<.+?>", ""));
				}else{
					System.out.println("WAO");
				}
			}else if(title.matches("Twitter / アカウント凍結")){
				System.out.println(id + " - Suspended");
				ps.setString(1, id);
				ps.setString(2, "-1");
				ps.setString(3, null);
				ps.setString(4, null);
			}else if(title.matches("Twitter / \\?")){
				System.out.println(id + " - Available");
				ps.setString(1, id);
				ps.setString(2, "0");
				ps.setString(3, null);
				ps.setString(4, null);
			}else{
				throw new Exception("Could not determine account status : " + id);
			}
			
			ps.execute();
			ps.close();
		} catch (Exception e) {
			if(++retry < 16){
				System.out.println("[" + e.getMessage() + "] RETRY : " + id);
				getInformation(ps, retry);
			}else{
				throw new Exception("!! Failed to get information !! : " + id);
			}
		}
	}
	@Override
	public void run() {
		try {
			getInformation(conn.prepareStatement(sql), 0);
		} catch (Exception e) {
			e.printStackTrace();
		}
		counter.decrementAndGet();
	}
}
