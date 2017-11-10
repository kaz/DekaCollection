<?php
	if(isset($_GET["add"])){
		$id = escapeshellarg(trim(trim($_GET["add"]), "@"));
		header("X-Result: " . exec("java -jar deka.jar {$id}"));
		header("Location: /");
		exit;
	}

	$db = new PDO("sqlite:deka.db");

	$account = [[], [], [], [], []];
	foreach($db->query("SELECT * FROM Account")->fetchAll(PDO::FETCH_ASSOC) as $deka){
		$deka["Bio"] = mb_convert_encoding($deka["Bio"], "UTF-8", "auto");
		$deka["Name"] = mb_convert_encoding($deka["Name"], "UTF-8", "auto");
		$account[preg_match("/^deka\d+$/i", $deka["ID"]) ? strlen($deka["ID"]) - 5 : 4][] = $deka;
	}

	$colors = [
		"amber-blue",
		"amber-cyan",
		"amber-deep_orange",
		"amber-deep_purple",
		"amber-green",
		"amber-indigo",
		"amber-light_blue",
		"amber-light_green",
		"amber-lime",
		"amber-orange",
		"amber-pink",
		"amber-purple",
		"amber-red",
		"amber-teal",
		"amber-yellow",
		"blue_grey-amber",
		"blue_grey-blue",
		"blue_grey-cyan",
		"blue_grey-deep_orange",
		"blue_grey-deep_purple",
		"blue_grey-green",
		"blue_grey-indigo",
		"blue_grey-light_blue",
		"blue_grey-light_green",
		"blue_grey-lime",
		"blue_grey-orange",
		"blue_grey-pink",
		"blue_grey-purple",
		"blue_grey-red",
		"blue_grey-teal",
		"blue_grey-yellow",
		"blue-amber",
		"blue-cyan",
		"blue-deep_orange",
		"blue-deep_purple",
		"blue-green",
		"blue-indigo",
		"blue-light_blue",
		"blue-light_green",
		"blue-lime",
		"blue-orange",
		"blue-pink",
		"blue-purple",
		"blue-red",
		"blue-teal",
		"blue-yellow",
		"brown-amber",
		"brown-blue",
		"brown-cyan",
		"brown-deep_orange",
		"brown-deep_purple",
		"brown-green",
		"brown-indigo",
		"brown-light_blue",
		"brown-light_green",
		"brown-lime",
		"brown-orange",
		"brown-pink",
		"brown-purple",
		"brown-red",
		"brown-teal",
		"brown-yellow",
		"cyan-amber",
		"cyan-blue",
		"cyan-deep_orange",
		"cyan-deep_purple",
		"cyan-green",
		"cyan-indigo",
		"cyan-light_blue",
		"cyan-light_green",
		"cyan-lime",
		"cyan-orange",
		"cyan-pink",
		"cyan-purple",
		"cyan-red",
		"cyan-teal",
		"cyan-yellow",
		"deep_orange-amber",
		"deep_orange-blue",
		"deep_orange-cyan",
		"deep_orange-deep_purple",
		"deep_orange-green",
		"deep_orange-indigo",
		"deep_orange-light_blue",
		"deep_orange-light_green",
		"deep_orange-lime",
		"deep_orange-orange",
		"deep_orange-pink",
		"deep_orange-purple",
		"deep_orange-red",
		"deep_orange-teal",
		"deep_orange-yellow",
		"deep_purple-amber",
		"deep_purple-blue",
		"deep_purple-cyan",
		"deep_purple-deep_orange",
		"deep_purple-green",
		"deep_purple-indigo",
		"deep_purple-light_blue",
		"deep_purple-light_green",
		"deep_purple-lime",
		"deep_purple-orange",
		"deep_purple-pink",
		"deep_purple-purple",
		"deep_purple-red",
		"deep_purple-teal",
		"deep_purple-yellow",
		"green-amber",
		"green-blue",
		"green-cyan",
		"green-deep_orange",
		"green-deep_purple",
		"green-indigo",
		"green-light_blue",
		"green-light_green",
		"green-lime",
		"green-orange",
		"green-pink",
		"green-purple",
		"green-red",
		"green-teal",
		"green-yellow",
		"grey-amber",
		"grey-blue",
		"grey-cyan",
		"grey-deep_orange",
		"grey-deep_purple",
		"grey-green",
		"grey-indigo",
		"grey-light_blue",
		"grey-light_green",
		"grey-lime",
		"grey-orange",
		"grey-pink",
		"grey-purple",
		"grey-red",
		"grey-teal",
		"grey-yellow",
		"indigo-amber",
		"indigo-blue",
		"indigo-cyan",
		"indigo-deep_orange",
		"indigo-deep_purple",
		"indigo-green",
		"indigo-light_blue",
		"indigo-light_green",
		"indigo-lime",
		"indigo-orange",
		"indigo-pink",
		"indigo-purple",
		"indigo-red",
		"indigo-teal",
		"indigo-yellow",
		"light_blue-amber",
		"light_blue-blue",
		"light_blue-cyan",
		"light_blue-deep_orange",
		"light_blue-deep_purple",
		"light_blue-green",
		"light_blue-indigo",
		"light_blue-light_green",
		"light_blue-lime",
		"light_blue-orange",
		"light_blue-pink",
		"light_blue-purple",
		"light_blue-red",
		"light_blue-teal",
		"light_blue-yellow",
		"light_green-amber",
		"light_green-blue",
		"light_green-cyan",
		"light_green-deep_orange",
		"light_green-deep_purple",
		"light_green-green",
		"light_green-indigo",
		"light_green-light_blue",
		"light_green-lime",
		"light_green-orange",
		"light_green-pink",
		"light_green-purple",
		"light_green-red",
		"light_green-teal",
		"light_green-yellow",
		"lime-amber",
		"lime-blue",
		"lime-cyan",
		"lime-deep_orange",
		"lime-deep_purple",
		"lime-green",
		"lime-indigo",
		"lime-light_blue",
		"lime-light_green",
		"lime-orange",
		"lime-pink",
		"lime-purple",
		"lime-red",
		"lime-teal",
		"lime-yellow",
		"orange-amber",
		"orange-blue",
		"orange-cyan",
		"orange-deep_orange",
		"orange-deep_purple",
		"orange-green",
		"orange-indigo",
		"orange-light_blue",
		"orange-light_green",
		"orange-lime",
		"orange-pink",
		"orange-purple",
		"orange-red",
		"orange-teal",
		"orange-yellow",
		"pink-amber",
		"pink-blue",
		"pink-cyan",
		"pink-deep_orange",
		"pink-deep_purple",
		"pink-green",
		"pink-indigo",
		"pink-light_blue",
		"pink-light_green",
		"pink-lime",
		"pink-orange",
		"pink-purple",
		"pink-red",
		"pink-teal",
		"pink-yellow",
		"purple-amber",
		"purple-blue",
		"purple-cyan",
		"purple-deep_orange",
		"purple-deep_purple",
		"purple-green",
		"purple-indigo",
		"purple-light_blue",
		"purple-light_green",
		"purple-lime",
		"purple-orange",
		"purple-pink",
		"purple-red",
		"purple-teal",
		"purple-yellow",
		"red-amber",
		"red-blue",
		"red-cyan",
		"red-deep_orange",
		"red-deep_purple",
		"red-green",
		"red-indigo",
		"red-light_blue",
		"red-light_green",
		"red-lime",
		"red-orange",
		"red-pink",
		"red-purple",
		"red-teal",
		"red-yellow",
		"teal-amber",
		"teal-blue",
		"teal-cyan",
		"teal-deep_orange",
		"teal-deep_purple",
		"teal-green",
		"teal-indigo",
		"teal-light_blue",
		"teal-light_green",
		"teal-lime",
		"teal-orange",
		"teal-pink",
		"teal-purple",
		"teal-red",
		"teal-yellow",
		"yellow-amber",
		"yellow-blue",
		"yellow-cyan",
		"yellow-deep_orange",
		"yellow-deep_purple",
		"yellow-green",
		"yellow-indigo",
		"yellow-light_blue",
		"yellow-light_green",
		"yellow-lime",
		"yellow-orange",
		"yellow-pink",
		"yellow-purple",
		"yellow-red",
		"yellow-teal",
	];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>dekaこれくしょん</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.3.0/material.<?= $colors[array_rand($colors)] ?>.min.css">
	<style>
		.mdl-layout__tab-bar-button {
			height: 64px;
		}
		.mdl-layout__tab-bar-container {
			height: 64px;
		}
		.mdl-layout__tab-bar {
			width: 100%;
		}
		.mdl-layout__tab-bar .mdl-layout__tab {
			height: 64px;
			line-height: 64px;
		}
		.mdl-layout__content {
			padding: 40px 40px 0 80px;
		}
		.mdl-card {
			width: 200px;
		}
		.mdl-card__title {
			height: 200px;
			background-size: cover;
			background-position: center;
			color: #FFFFFF;
			text-shadow: 2px 2px 4px #000000;
			cursor: pointer;
		}
		.mdl-card__title-text {
			padding: 0 5px 5px 0;
		}
		.right {
			float: right;
		}
		#cardTemplate {
			display: none;
		}
	</style>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.3.0/material.min.js"></script>
	<script>
		window.addEventListener("load", function(){
			var account = <?= json_encode($account) ?>;
			var tweets = document.querySelectorAll("template");

			var nowProcessing = false;
			var generate = function(digit, start, end, title, clear){
				if(nowProcessing) return;

				var main = document.querySelector("main");
				var spinner = main.querySelector("div");
				var section = main.querySelector("section");

				nowProcessing = true;
				spinner.style.display = "block";
				main.querySelector("h2").textContent = title;
				if(clear){
					section.innerHTML = "";
				}

				generateFragments(document.querySelector("#cardTemplate"), section, digit, start, end, 128, function(){
					nowProcessing = false;
					spinner.style.display = "none";
				});
			};
			var generateFragments = function(original, section, digit, start, end, progress, onFinished){
				var curTarget = progress = progress + start <= end ? progress + start : end;
				for(var i=start; i<=curTarget; i++){
					var entry = account[digit][i];
					var el = original.cloneNode();

					el.removeAttribute("id");
					el.innerHTML = original.innerHTML;
					el.querySelector(".mdl-card__title").addEventListener("click", function(){
						window.open("https://twitter.com/" + this);
					}.bind(entry.ID));
					el.querySelector(".mdl-button").addEventListener("click", function(){
						window.open(makeIntentURL(this));
					}.bind(entry.ID));

					el.querySelector(".template-id").textContent = "@" + entry.ID;
					if(entry.Icon == -1){
						el.querySelector(".template-name").textContent = "【凍結されてる】";
						el.querySelector(".mdl-card__actions").style.display = "none";
						continue;
					}else if(entry.Icon == 0){
						el.querySelector(".template-name").textContent = "【空いてる】";
						el.querySelector(".mdl-card__actions").style.display = "none";
						continue;
					}else{
						el.querySelector(".template-icon").style.backgroundImage = "url('https://twitter.com/" + entry.ID + "/profile_image?size=original')";
						el.querySelector(".template-name").textContent = entry.Name;
						el.querySelector(".template-bio").textContent = entry.Bio;
					}
					section.appendChild(el);
				}

				if(curTarget == end){
					onFinished();
				}else{
					setTimeout(generateFragments, 256, original, section, digit, curTarget, end, progress, onFinished);
				}
			};

			var makeIntentURL = function(id){
				var text = tweets[parseInt(tweets.length * Math.random())].innerHTML.trim();
				return "https://twitter.com/intent/tweet?text=" + encodeURIComponent(text.replace(/{{@}}/g, "@" + id).trim().substr(0, 140));
			};

			var links = document.querySelectorAll("a");
			var binds = [function(){
				generate(0, 0, 9, "", true);
				generate(1, 0, 99, "", false);
				generate(2, 0, 999, "0 - 999", false);
			}];
			for(var i=0; i<10; i++){
				binds.push((function(i){
					return function(){
						if(!i) generate(4, 0, account[4].length - 1, "", true);
						generate(3, 1000*i, 1000*i + 999, i + "000 - " + i + "999", i);
					};
				})(i));
			}
			binds.forEach(function(entry, i){
				links[i].addEventListener("click", entry);
			});

			for(var i in account){
				account[i].sort(function(a, b){
					var aDeka = /^deka\d+$/i.test(a.ID);
					var bDeka = /^deka\d+$/i.test(b.ID);
					if(aDeka && !bDeka) return -1;
					if(!aDeka && bDeka) return 1;
					return a.ID.toLowerCase() > b.ID.toLowerCase() ? 1 : -1;
				});
			}
			binds[1]();

			document.querySelector("button").addEventListener("click", function(){
				location.href = "/?add=" + encodeURIComponent(prompt("IDを入力してください"));
			});

			document.querySelector("#kusoripu").textContent = tweets.length;
		});
	</script>

    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="dekaこれくしょん">
    <meta name="twitter:url" content="http://deka.narusejun.com/">
    <meta name="twitter:image" content="https://twitter.com/deka0106/profile_image?size=original">
    <meta name="twitter:creator" content="@deka0106">
</head>
<body class="mdl-color--grey-100 mdl-color-text--grey-700 mdl-base">
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
		<header class="mdl-layout__header mdl-layout__header--scroll mdl-color--primary">
			<div class="mdl-layout--large-screen-only mdl-layout__header-row"></div>
			<div class="mdl-layout__header-row"><h3>dekaこれくしょん</h3></div>
			<div class="mdl-layout--large-screen-only mdl-layout__header-row"></div>
			<div class="mdl-layout__tab-bar mdl-js-ripple-effect mdl-color--primary-dark">
				<a href="javascript:" class="mdl-layout__tab">0 - 999</a>
				<a href="javascript:" class="mdl-layout__tab is-active">0000 - 0999</a>
				<a href="javascript:" class="mdl-layout__tab">1000 - 1999</a>
				<a href="javascript:" class="mdl-layout__tab">2000 - 2999</a>
				<a href="javascript:" class="mdl-layout__tab">3000 - 3999</a>
				<a href="javascript:" class="mdl-layout__tab">4000 - 4999</a>
				<a href="javascript:" class="mdl-layout__tab">5000 - 5999</a>
				<a href="javascript:" class="mdl-layout__tab">6000 - 6999</a>
				<a href="javascript:" class="mdl-layout__tab">7000 - 7999</a>
				<a href="javascript:" class="mdl-layout__tab">8000 - 8999</a>
				<a href="javascript:" class="mdl-layout__tab">9000 - 9999</a>
			</div>
		</header>
		<main class="mdl-layout__content">
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
				追加する
			</button>
			<h2></h2>
			<div class="mdl-spinner mdl-js-spinner is-active"></div>
			<section class="mdl-grid"></section>
		</main>
		<footer class="demo-footer mdl-mini-footer">
			<div class="mdl-mini-footer--left-section">
				管理人: <a href="https://twitter.com/deka0106"><i>全強</i>の<b>Deka</b></a>
				[ ただいまクソリプ <strong id="kusoripu"></strong> 種類 ]
			</div>
		</footer>
	</div>
	<article id="cardTemplate" class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--top">
		<div class="mdl-card__title mdl-card--expand template-icon">
			<h2 class="mdl-card__title-text template-id"></h2>
		</div>
		<div class="mdl-card__supporting-text">
			<h5 class="template-name"></h5>
			<span class="template-bio"></span>
		</div>
		<div class="mdl-card__actions mdl-card--border">
			<button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
				クソリプを飛ばす
			</button>
		</div>
	</article>
<template>
{{@}}
あ…！あのっ

す///す///

　／＼　　　　　／ﾉ
／／＼）　　　 ／／
＼＼ 　　　　 ／／
　＼(　՞ةڼ◔)／すき焼き
　　｜　 ｜
　　｜　 ｜
　　｜　 ｜
　 ／ ／＼ ＼
〈 〈　　＼＼
　 ＼ ＼　　＼＼　
　　 ＼)　　　＼）
</template>
<template>
( ^o^)☎┐＜{{@}} 垢消せｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗ ( ^o^)Г☎ チンッ
</template>
<template>
{{@}} FF外から失礼するゾ～（謝罪） このツイート面白スギィ！！！！！自分、RTいいっすか？ 淫夢知ってそうだから淫夢のリストにぶち込んでやるぜー いきなりリプしてすみません！許してください！なんでもしますから！(なんでもするとは言ってない
</template>
<template>
いないいない

∩(・＿・)∩おるでｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗ

そう言って{{@}}は微笑んだ。
それが僕が最後に見た彼の姿だった...。
</template>
<template>
(^o^)＜佐川急便でぇぇぇぇすww

三┏( ^o^)┛キチガイお届けにまいりましたーーwww

＜(^o^)＞┌┛’,;’;≡三ﾄﾞｶｧｯ{{@}}

┏┗(´ิq´ิ)┓┛ｷｪｪｪｪｪｪｨｲｲｲｲｲｲｲ

あざっしたーーwwwww
┗(^o^ )┓三
</template>
<template>
(´◔౪◔) 「もしもしお母さーん！」
母「なにー？」
( ◠‿◠ )「このマジキチなぁ～にぃ～？？」
　　　 ＿＿_
　　／L(՞ةڼ◔) ／＼
　／|￣￣￣￣|＼／
　　|　　　　|／
　　
母「あー{{@}}か。今度燃えるゴミに出すよ。」
</template>
<template>
おみくじ引いとこ
(＾ω＾)つ |￣ ￣|
　　　　　　￣￣￣
なに吉かな〜♪

(＾ω＾)つ {{@}}

(＾ω＾).....

＿＿
｜マ｜
｜ジ｜
｜吉｜
￣￣
( ☝՞ਊ ՞)☝ﾌｧｰｰｰｰｰｰｰｰｗｗｗｗｗｗｗｗｗｗｗｗｗｗ
</template>
<template>
{{@}}
ブルブルブルブルアイ！✌(՞ਊ՞✌三✌՞ਊ՞)✌アイ！✌(՞ਊ՞✌三✌՞ਊ՞)✌ブ・ル・ベ・リ・アイ！！✌(՞ਊ՞✌三✌՞ਊ՞)✌ブルブルブルブルアイ！✌(՞ਊ՞✌三✌՞ਊ՞)✌アイ！✌(՞ਊ՞✌三✌՞ਊ՞)✌ブ・ル・ベ・リ・アイ！！✌(՞ਊ՞✌三✌՞ਊ՞)✌
</template>
<template>
ニコ厨の真似しまーすｗｗ

※鳥肌注意※
　　うp主ネ申ｗｗ
　　　　　なぜ消したしｗｗ
　　　　　　　　　　　　　　↓ｗｗｗｗ
　　　ちょｗｗﾜﾛﾀｗｗ
　タグ理解ｗ
市場ｗｗ
　　{{@}} 垢消せｗｗ
　　　　　なぜ上がったしｗｗｗ
</template>
<template>
{{@}}
いけっイワーク！ ミ◓ ﾎﾟｩﾝ

( ◠‿◠ )しまった！ボール間違えた！

ミ◓┗(↑o↑)┛＜ ｴｩﾝｪｩｩｩｩｩﾝｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗ

＿人人人人人人人人＿
＞ｴｩﾝｪｩｩｩｩｩﾝｗｗｗ＜
￣^Y^Y^Y^Y^Y^Y^￣
</template>
<template>
{{@}}
ドドドドドドドドド
D　a　i　s　u　k　e
　( ﾉᾥ’ )
＼ ﾉ＼
　　＼　＼
　　／￣￣＼
お客様！！困ります！！店内でDaisukeダンスは困ります！！あーっ！！！困ります！！お客様...バァーン！
</template>
<template>
{{@}}
ヴァー
　　,　/~|ヽ 三　　　　　　三三(´･_･`)
　　 l匚|ll ||ｌ|　二　　　ヽ ﾉ)
　 　 ┃!､_|ﾉ　二　 　 　 ｣｣　
　 ┌┸┐　　　　
　　￣￣
</template>
<template>
ﾀｸｼｰ
（ﾟ｣ﾟ)ノ← {{@}}
ノ|ﾐ|
　」L
￣￣￣￣￣￣￣￣￣
　　　　 ＿/￣＼_
　　　　└○―○―┘=3

ｷﾞｬｰ
（ﾟ｣ﾟ)ノ 　ｱｲﾖｰ
ノ|ﾐ| ＿/￣＼_
　//└○―○―┘=3
￣￣￣￣￣￣￣￣ミ
</template>
<template>
僕は健全ツイッタラー
　　( ՞ਊ ՞)/← {{@}}
　 ＜ﾉ　ﾉ
　　 /　\
今日もパクツイしてたら
　∧_∧
　( ՞ਊ ՞)
　(つ/￣￣￣/
￣＼/＿＿＿/￣
マジレスがきた
　 ∧_∧
　(　∵ )
　(つ/￣￣￣/＜垢消せ
</template>
<template>
{{@}}
おおなんという糞じゃ
南無阿弥陀仏
　　南無阿弥陀仏

　 ／￣￣￣＼
　｜　　　　｜
　｜　　　　｜
　｜　 ^　 ^ ) ///ﾄ､
　(　 ＞ﾉ(＿)Y ////)|
　∧ヽi-=ニ=|｜　｜|
／＼＼＼ ￣ノ｜　ﾉノ
／　＼＼ ￣　/　/ |
</template>
<template>
┏　　　　　　　　　　　┓ 　　
　　　　✌︎(՞ةڼ◔)✌︎
┗　　　　　　　　　　　┛

∧_∧ {{@}} を撮るブォォ
(　　 )】
/　　/┘
</template>
<template>
{{@}}
　　　 fﾆヽ
　　　 |_||
　　　 |= |
　　　 |_ |
　　/⌒|~ |⌒i-、
　 /|　|　|　| ｜ |
　｜(　(　(　( ｜
　｜　　　　　 ｜
　 ＼　　　　　/
　　 ＼
</template>
<template>
【{{@}}がドキドキする男性の姿】

✔三_(⌒(_☝◠‿◠ )☝

✔淫夢三_(⌒(_☝◠‿◠ )☝

✔(╮╯╭)

✔じゃがいも(╮╯╭)

✔(☝╮╯╭)☝ﾎﾟﾃｨﾄｩ

✔ふぁぼる姿(☝╮╯╭)☝

✔財布から諭吉を取り出す姿
</template>
<template>
{{@}}
( ^o^)＜ﾃﾞｯﾃﾞｰｯﾃﾞﾃﾞ♪ﾃﾞｰｯﾃﾞｰｯﾃﾞﾃﾞ♪

（ ˘⊖˘）。o(ペプシマァァァァン？)

|PEPSI| ┗(☋｀ )┓三

( ◠‿◠ )☛ 悪いが私はコカ・コーラ派だ

▂▅▇█▓▒░(’ω’)░▒▓█▇▅▂ しゅわああああああああ
</template>
<template>
訳あって垢消します。これからリアルが多忙になるのでまともにツイッターをする時間がありません。フォロワーさんとも前のように絡める自信がなく、今自分がするべきことにしっかりと向き合いたいという理由で垢消しを決めました。最後になりますが、全部嘘です。{{@}}はゴミ
</template>
<template>
今日もパクツイするぞ
三 =͟͟͞͞ ( ՞ةڼ◔)←{{@}}
三 =͟͟͞͞(√ )√
三=͟͟͞͞／ ＞

.　　　 　Π
　　　　 | |
　*　 (二Ｘ二二O
　　　 　| |
　　 ∧_∧ | |
　　/⌒ヽ)| |
～（　　）
あれほど垢消せと言ったのに
</template>
<template>
{{@}}
シオンタウンのBGMの真似しまーすｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗ ﾃﾝ↓（◞‸◟）ﾃﾝ→（◞‸◟）ﾃﾝ↑（◞‸◟）ﾃﾝ↓ﾃﾝ↓（◞‸◟）ﾃﾝ→（◞‸◟）ﾃﾝ↑（◞‸◟）ﾃﾝ↓ﾃﾝ↓（◞‸◟）ﾃﾝ→（◞‸◟）ﾃﾝ↑（◞‸◟）ﾃﾝ↓
</template>
<template>
{{@}}
( ^o^)☎┐＜おまえまだIE9かよーｗｗｗｗｗｗｗｗｗだっせーｗｗｗｗｗｗｗｗｗｗｗ俺なんかIEEE 802.11だぜーｗｗｗｗｗｗｗｗｗｗｗお前の89.1233倍ーーｗｗｗｗｗｗｗしかもEが3倍ーーｗｗｗｗｗｗｗｗ ( ^o^)Г☎ チンッ
</template>
<template>
ああああああ！！顔が{{@}}に！
　　 ||￣￣￣￣￣.||
　　 ||　／／／／.||
　 　||
／⌒ヽ　 ／⌒ヽ ||
（　　　 ) (՞ةڼ◔) ||
.ﾉ　　　ﾉ　丶　　 ||
(　 　ﾉ￣￣￣￣￣ |
∪ ∪＿＿＿＿＿.|
</template>
<template>
ワ゛アアアアアアアアアアアアアアアアアアアアアアアｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗ
　, -―-､、
/:::::::::::彡⌒ミ
l:::::::::( ՞ةڼ◔) ← {{@}}
ヽ､:::フづとﾉ’
　 ‘～｜　 ｜
</template>
<template>
ぼく「オールマイティって何？」
{{@}}「すべて俺のお茶」

＿人人人人人人人人＿
＞ すべて俺のお茶 ＜
￣Y^Y^Y^Y^Y^Y^Y￣
</template>
<template>
A：(腹減ったな)「なぁ{{@}}、マック買ってきて」

数十分後

{{@}}：買ってきたぞ。168,800円な

A：は？？お前何買ってきたんだよｗｗｗまさか…

＿人人人人人人＿
＞MacBook Pro＜
￣Y^Y^Y^Y^Y^Y^￣
</template>
<template>
{{@}}
エジプトから来ました
　　　　　　／＼
　　　　　／┳┻＼
　　　　／━┻┳┻＼
　　　／┻┳━┻┳┻＼
　　／┳━┻┳━┻┳┻＼
　／━┻━━┻━━／⌒＼ ＼
　￣￣／　 ＿＿＿＿／⌒＼⊃
　　（　 ／
　　　＼＼
　　　　∪
</template>
<template>
キチガイかよ！wこいつww
　 ( ◠‿◠ )
＿(__つ/￣￣￣/＿
　　＼/　　　/
　　　 ￣￣￣

　 ( ◠‿◠ )・・・
＿(__つ/￣￣￣/＿
　　＼/　　　/
　　　 ￣￣￣

　( ◡⁀◡ ){{@}}かよ
＿(__つ/￣￣￣/＿
</template>
<template>
ﾍﾞﾙﾐｯﾃｨｽﾓﾀｲﾌｰﾝww
　　　　　　‐-､
　,　 ゛ 三 ミ　　　,,-, ｲﾋｰww
（ （ (((՞ةڼ◔) ))) ） )ﾉ
　ヾヽﾐ 三彡, ソ
／　）ﾐ台彡ノ
／ （ﾐ　彡゛
／　＼ゞ

あぁあれは{{@}}の家なのに
</template>
<template>
{{@}}
反発係数e＞1の寿司

　　　　 🍣
　　　 ／ 　　　　
. ⌒ヽ/
</template>
<template>
{{@}}「俺週一でジム通ってんだぁー♪」

友「どこのジム？」

{{@}}「ほら、あの公園にあるやつだよ！」

＿人人人人人人人＿
＞ ジャングルジム ＜
￣Y^Y^Y^Y^Y^Y^Y^￣
</template>
<template>
{{@}}「鬱だ･･･」

LINE「なんかあった？」

mixi「どうしたの？＞＜」

Facebook「大丈夫ー？話聞くよ？」

群馬「การล่าสัตว์ชายเย็น」

Twitter「垢消せ」

＿人人人＿
＞垢消せ＜
￣Y^Y^Y￣
</template>
<template>
{{@}}
俺はパンツなんて履かないぜ！
　　 ∧＿∧
　　( ◠‿◠ )　п
　 п`)　　⌒＼/(∃
　Е)//＼　　＼_/
　 ＼/　 ＼　　 丶
　　　　 ／╰U╯ﾉ
　　　 ／　／　／

履かない太陽wwwwwﾅｰﾅｰﾅｰﾅﾅﾅｰﾅﾅｰwwwwwﾅｰﾅｰﾅｰ
</template>
<template>
デスノート拾ったからなんか書いとこ
(*˘ω˘)φ♡
＿＿＿＿＿＿＿＿＿
＿＿＿＿＿＿＿＿＿
{{@}}
￣￣￣￣￣￣￣￣￣
￣￣￣￣￣￣￣￣￣
￣￣￣￣￣￣￣￣￣
</template>
<template>
{{@}} ええいああ君から
　　　／￣￣￣＼
　　/＿＿＿　 ∧
　　L｜ /＿＼｜｜
　 /_/　L。／｜｜
　/／　/ 。 　｜｜
/(￣＼)　。　｜｜
｜_二二＿　　 L/
｜ ￣￣　　　//
｜　　　　 ／/
L＿＿＿_／ ｜
＼＿＿＿_／｜
モアイ泣き
</template>
<template>
┏┛￣￣┗┓
┣┳┳┏┻┃
┃┃┃┗┳┛
┗┻┻┫┃
　　　┃┃
　　　┃┃
　　　┗┛
　　　(´･_･`)←{{@}}
￣￣￣￣￣￣
┏┛￣￣┗┓
┣┳┳┏┻┃
┃┃┃┗┳┛
┗┻┻┫┃
　　　┃┃
　　　|l,’;! 　
　　　;※,’; 三へ(´･_･`)」
￣￣￣￣￣￣￣"
</template>
<template>
{{@}}

「いけ！グラードン、じわれ！」

グラードン「……ハッハッハッｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗクッソじわるんだがｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗ」
</template>
<template>
{{@}}
＿人人人人人＿
＞そのネタツイ＜
￣Y^Y^Y^Y^￣
　 _n
　( ｜　 ハ_ハ
　 ＼＼ ( ‘-^　)
　　 ＼￣￣　 )
＿人人人人人人人人＿
＞さっきも見ました＜
￣Y^Y^Y^Y^Y^Y^Y￣
　ハ_ハ
（　^-’ )　　n
￣　　 ＼　(
</template>
<template>
警察｢これが亡くなられた({{@}})さんのTwitterです｣
親｢うっ……うっ…｣

『( ՞ةڼ◔)イヒーイヒヒヒヒwwwwwwwwwヌベヂョンヌゾジョンベルミッティスモゲロンボョwwwwwwww』
警察｢｣
親｢｣
</template>
<template>
{{@}}
(☝◔ ౪◔)☝本
( ☞◔ ౪◔)☞を
(☝◔ ౪◔)☝売
( ☞◔ ౪◔)☞る
(☝◔ ౪◔)☝な
( ☞◔ ౪◔)☞ら
(◔౪◔ 三 ◔౪◔)ブ・ッ・ク・オ
(☝◔ ౪◔)☝ﾌｳｯ
(☞ ՞ਊ ՞)☞ ﾊｧｲ !!!
</template>
<template>
┏┓　┏┓　 　
┃┃┏┛┗┓┏━━┓
┃┃┗┓┏┛┃┏┓┃
┃┃┏┛┗┓┗╋┛┃
┃┃┃・┏┛　┣┳┛
┗┛┗━┛　　┗┛
☟☟☟☟☟☟☟☟☟☟
{{@}} {{@}}
</template>
<template>
{{@}}
摩擦係数μ=0の寿司

＿＿＿＿＿＿🍣
</template>
<template>
{{@}}
歩きスマホ

┏━callme━┓
┃┏━━━┓┃
┗┃①②③┃┛
┏┛④⑤⑥┗┓
┃ ⑦⑧⑨　┃
┗┓　　　 |／⌒＼
　／　 ＿＿／⌒＼⊃
（　 ／
　＼＼
　　∪
</template>
<template>
{{@}}へ
　／⌒ヽ
（　＾ω＾）/￣/￣/
（ 二二つ /　と）
　| 　　/　 / 　/
　 | 　 ￣|￣￣

　 寝ろ
　／⌒ヽ
（＾ω＾） /￣/￣/
（ 二二つ /　と）
　| 　　/　 / 　/
　 | 　 ￣|￣￣
</template>
<template>
{{@}}
「しね」って言われて
不快になる人がいるけど
少しだけ待って。

『しね』はローマ字では
『SHINE』と書くの。
シャイン
これは英語で
『輝く』という意味なんだ。

だから、口では
悪く言ってるようで、
心の中では応援してるの。

なわけあるか死ね
</template>
<template>
(΄◞ิ౪◟ิ‵ )＜このTLに一人、基地外がおる。お前やろ

( ՞ਊ ՞）ﾁｶﾞｳｳｳｳｨｩｳｳｳｩ
( ՞ਊ ՞）ｵﾚｼﾞｬｱｱｱﾅｲｲｲｲ
( ՞ਊ ՞）ﾎｵｵｵｺｵｵｵｵｰｵｨｫ
( ՞ਊ ՞）{{@}}

＿人人人＿
＞ 多い ＜
￣Y^Y^Y￣
</template>
<template>
（´◔̯◔｀）

{{@}} が仲間になりたそうにこちらを見ている・・・

仲間にしますか？

　はい
→いいえ

（´◔̯◔｀）

＿人人人人人＿
＞ └(՞ةڼ◔)」 ＜
￣Y^Y^Y^Y^Y￣
</template>
<template>
{{@}}
あなたの病気はどこから？

私は元から！

　　 ∧,_,∧
　　( ՞ਊ ՞)　 ｎ__キエェェェェ
　η ＞　 ⌒＼/ ､_∃
(∃)/ ∧　　＼_/
　＼_/　＼　　丶

＿人人人人＿
＞キチガイ＜
￣Y^Y^Y^￣"
</template>
<template>
{{@}}
┗('o'≡'o')┛ウワアアアアアアアアアアアアア！！！！！！！！┗('o'≡'o')┛1日が終わる┗('o'≡'o')┛ウワアアアアアアアアアアアアア！！！！！！！！┗('o'≡'o')┛
</template>
<template>
{{@}}
على ما يبدو، سيامي ديسو.
فمن حسنا، حسنا من مكان الاجتماع، ولكن ذهبت إلى البريد على السينما أيون، والوقت من الآن كان حوالي .
</template>
<template>
{{@}}「あっ（消しゴムを落とす」

女「…はい（消しゴムを渡す」

{{@}}「ｱｯ…ｱ…」

女（ありがとうの1つも言えねーのかよこいつ）

{{@}}「ｱ…ｱｱ… アッアッ荒ッポゥｗｗｗｗ」 　　
／＼(´･_･`)／＼
((⊂／＼　　　／＼つ))
</template>
<template>
┏━━━━━━━━━━━┳━━┓
┃キチガイ　　　　　　　┃検索┃
┗━━━━━━━━━━━┻━━┛

もしかして:{{@}}
</template>
<template>
{{@}}
( ^o^)＜入学試験で受験票忘れたぞ！

( ˘⊖˘) 。o(まあSuicaならば問題ないだろ)

|試験会場| ┗(☋｀ )┓三Suicaならばｽｲ♪ｽｲ♪

( ◠‿◠ )☛不合格♪

▂▅▇█▓▒░(’ω’)░▒▓█▇▅▂ うわああああああ
</template>
<template>
＜(^o^)＞┌┛’,;’;≡三{{@}}をゴミ箱にｼｭｩｩｩｩｩｩｩｩｩｩｩｩｯｯ!!!!!!!!!!wwwwwwwwwwwwwwwww超!!ｴｷｻｲﾃｨﾝ!!!!!!!!!!!!!wwwwwwwwwwwwwww
</template>
<template>
{{@}}
三┏( ^p^)┛みんな聞いてくれ

({{@}})☚(⊙ ᗢ ☉)こいつ

(☝ ⊙ਊ⊙)☝クソリプしか来ないらしいぜ！

マジ？（◜◡‾（‾◡◝）マジ！

(☛(╮╯╭)☚)ジャガイモなんじゃねえの？

L( ＾ω＾ )┘クソリプ送りまくろうぜ
</template>
<template>
{{@}}
かれぴっぴ居たみたいですけど僕が寝取りました＾＾
(オタク特有の早口)(アディダスの財布)(教室で遊戯王)(修学旅行で女にイキ告)(P)(赤城みりあ推し)(ニキビだらけの顔)(1000円カット)(白ブリーフ) (ドラゴンのナップサック)(瞬足)(コーナーで差をつけろ)
</template>
<template>
{{@}}
	反発係数e=114514のお寿司 ／　＿＿∧＿＿
　　　　　　　　　　　　／　　うわぁ！！
　　　　　　　　　　　／
　　　　　　　　　　／
　　　　　　　　　／
　　　　　　　　／
　　　　　　　／
　　　　　　／
　　　　　／
　　　　／
　　　／ 　　　　
. ⌒ヽ/
</template>
<template>
{{@}}
たとえ火の@NASA ✋水の@NASA ✋草の@NASA ✋森の@NASA ✋ 土の@NASA ✋雲の@NASA ✋あの子 のスカートの@NASA ✋(キャー！) @NASA ✋@NASA ✋@NASA ✋@NASA ✋@NASA ✋@NASA ✋@NASA ✋@NASA✋
</template>
<template>
{{@}}
ｷﾞｬﾊｯﾊｯwww
キチガイって誰の事だよwwww
ｳｯﾋｫｫｫｫｫｧwwwwwwww
ｷﾞｬﾊｯﾊｯwwwｷﾞｬﾊｯﾊｯwwwwww
　　　　　∧＿∧ミ
　　　o/⌒( ՞ਊ ՞)つ
　　 と＿)＿つノ　☆
　　　　　　ﾊﾞﾝﾊﾞﾝ
＿人人人＿
＞　お前　＜
￣Y^Y^Y^￣
</template>
<template>
あっ！！！TVをつけたら名探偵インムがやっているゾ！！！！今回の犯人は {{@}}！！簡単すぎィ！！！1145148931919810秒でわかったゾ～～～！！！！(遅漏) 腕時計型麻酔銃発射！！ONONONONON！！！アカーーーーーーーン！！！(誤爆)
</template>
<template>
･･･！あのっ！///

っ･･･ {{@}} のことが！

だ///だ///

＿人人人人人人人＿
＞大宇宙ステージ＜
￣ＹＹＹＹＹＹＹ￣

ー
　　　ー
　ー
　　ー
ー
　　　ー
　ー
　　ー
ー
　　　ー
　ー
　　ー
ー
　　　ー
　ー
　　ー
ー
</template>
<template>
{{@}}
    ↓
バコォッ　(´･_･`)
|∧ 从ノ　(ミ＿（⌒＼ヽ
（,,(≡￣￣￣￣三＼⌒ノノ）
|(つWつ￣￣＼　⌒彡)　ノ
|＼つ-つ　　＼＿＿,ﾉノ
||　つ　　　/　／
||　　　　　/ノ　＿─(´⌒(
</template>
<template>
浮上なうw誰かいないかな〜？誰か〜氏〜w とりあえず{{@}}にふぁぼ送りましたw 誰かいないかな〜w おっ{{@}}さんはタグツイートしてるのか〜(空リプ) お腹空いたな〜誰か夜食でもどうですか？w さて、そろそろ離脱しま〜す！
</template>
<template>
{{@}} FF外から失礼されたゾ～（困惑） このリプ意味不すぎィ！！！！！自分、ブロックいいっすか？ 淫夢知ってそうだけどブロックリストにぶち込んでやるぜー いきなりリプしてすみませんじゃねえんだよ(半ギレ) ん？今なんでもするって言ったよね？
</template>
<template>
{{@}}
( ^o^)ボーナスくれ！

(　՞ةڼ◔)はい棒茄子ｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗ

( ^o^)………( ՞ ՞)

( ՞ ՞)ありがとナス！ｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗ
</template>
<template>
真実はいつも57個くらい！見た目はポンコツ！頭脳は崩壊
名探偵 {{@}}
　　　　　　　　 |＼
　　 ＿＿／￣￣￣＼/
　 ＜　　　　　　　＼
　 ／/　　　　　　　｜
　/イＶ⌒＼(ＶＶ⌒＼｜
　　ﾚ｜　　　　　　｜
　　 人　   ՞ةڼ◔　　 /
　　　 ＼
</template>
<template>
ファルコーン！パーンチ！！！！
　　　　　  ＿;∴
　　　  ∧＿＝￣`;
　　  ／￣ ＿≡:; {{@}}
　  ／　 ―ﾆ￣”’.
　/　　/)
  /　 _ ＼
｜　/＼　＼ 　
｜ /　 ヽ ｜
</template>
<template>
{{@}}
██████
　　　　　█
　　　　◢◤
　　　◢◤
　　◢◤

　　████
　　　　　█
　　　█◢◤
　　◢◤

　　　▌▌█
　　　　◢◤
　　　◢◤

　　█　　███
　　█　◢◤　█
　　█　█　◢◤
　　█　　◢◤
　　█　　█

　　█　　█
</template>
<template>
{{@}}
＿人人人人人＿
＞バイ成ィ☝︎＜
￣^Y^Y^Y^Y^￣
</template>
</body>
</html>
