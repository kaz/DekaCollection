package com.narusejun.deka;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.concurrent.atomic.AtomicInteger;
import java.util.regex.Pattern;

public class Headquarters {
	public static void main(String[] args) throws Exception {
		Class.forName("org.sqlite.JDBC");
		
		Connection conn = DriverManager.getConnection("jdbc:sqlite:deka.db");
		Statement stmt = conn.createStatement();
		
		conn.setAutoCommit(false);
		stmt.execute("CREATE TABLE IF NOT EXISTS Account (ID TEXT, Icon TEXT, Name TEXT, Bio TEXT, Featured INTEGER, PRIMARY KEY(ID, Featured))");
		
		Pattern pat = Pattern.compile("profile-picture.+?href=\"(.*?)\".+?title=\"(.*?)\".+?Card-screennameLink.+?href=\"/(.+?)\".+?Card-bio.+?>(.*?)</p>", Pattern.DOTALL);
		AtomicInteger counter = new AtomicInteger(0);
		
		int featured = 0;
		ArrayList<String> ids = new ArrayList<>();
		if(args.length > 0){
			featured = 1;
			for(String id : args){
				ids.add(id);
			}
		}else{
			for(int i=1; i<=4; i++){
				for(int j=0; j<Math.pow(10, i); j++){
					ids.add(String.format("deka%0" + i + "d", j));
				}
			}
			ResultSet rs = stmt.executeQuery("SELECT ID FROM Account WHERE ID NOT LIKE 'deka%'");
			while(rs.next()){
				ids.add(rs.getString(1));
			}
		}
		
		String sql = "INSERT OR REPLACE INTO Account VALUES (?, ?, ?, ?, '" + featured + "')";
		for(String id : ids){
			counter.incrementAndGet();
			new Thread(new Worker(conn, pat, sql, counter, id)).start();
			while(counter.get() > 256){
				Thread.sleep(256);
			}
		}
		while(counter.get() > 0){
			Thread.sleep(256);
		}
		
		stmt.close();
		conn.commit();
		conn.close();
	}
}
