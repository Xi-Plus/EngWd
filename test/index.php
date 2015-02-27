<!DOCTYPE html>
<?php
include_once("../func/sql.php");
include_once("../func/url.php");
include_once("../func/checklogin.php");
include_once("../func/consolelog.php");
?>
<head>
<meta charset="UTF-8">
<title>test-EngWd</title>
<?php
include_once("../res/meta.php");
meta();
?>
</head>
<body Marginwidth="-1" Marginheight="-1" Topmargin="0" Leftmargin="0">
<?php
include_once("../res/header.php");
?>
<center>
<h2>
<?php
	$count=mfa(SELECT(array("COUNT(*) AS `COUNT`"),"engwd_wordlist"))["COUNT"];
	$word=mfa(SELECT("*","engwd_wordlist",null,null,array(rand(0,$count-1),1)));
	$text=file_get_contents("http://dict.dreye.com/dj/index.php?dw=".$word["word"]);
	$text=explode("<br><br>",$text);
	if(count($text)<=3)header("Location: ./");
	$rand=rand(1,count($text)-3);
	$text2=explode("<br>",$text[$rand]);
	$eng=preg_replace("/<.*?>/","",$text2[0]); 
	preg_match("/".substr($word["word"],0,strlen($word["word"])-1)."[a-zA-Z]*/",$eng,$match);
	$ans=$match[0];
	$eng=str_replace($word["word"],$word["word"][0]."___".$word["word"][strlen($word["word"])-1],$eng);
	echo $eng."<br>";
	$twn=preg_replace("/<.*?>/","",$text2[1]);
	$twn=str_replace("&nbsp;","",$twn);
	$text=file_get_contents("https://tw.dictionary.yahoo.com/dictionary?p=".$word["word"]);
	preg_match('/<p class="explanation">(\S*?)<\/p>/',$text,$match);
	$twn2=$match[1];
	consolelog($match);
?>
<script>
function showtwn(){
	twn1.style.display="none";
	twn2.style.display="";
}
</script>
<div id="twn1" onClick="showtwn();">顯示例句中文翻譯</div>
<div id="twn2" style="display:none"><?php echo $twn; ?></div>
<br>
<script>
var ans="<?php echo $ans; ?>";
function show(){
	var ya=answerinput.value;
	ya=ya.replace(/[^a-zA-Z]/g,"");
	if(ya=="")return 0;
	youranswer.innerHTML="Your Answer: "+ya;
	if(ya==ans){
		correct.style.display="";
		wrong.style.display="none";
		correctanswer.style.display="none";
	}
	else {
		correct.style.display="none";
		wrong.style.display="";
		correctanswer.style.display="";
	}
	word.style.display="";
}
</script>
<input id="answerinput" name="answerinput" type="text" onload="this.focus();this.select();"><input type="button" value="送出" onclick="show();">
<hr>
<div id="youranswer" style="background-color:#0FF; width:100%;">Your Answer:</div>
<div id="correct" style=" display:none; background-color:#0F0; width:100%; height:30px">Correct</div>
<div id="wrong" style=" display:none; background-color: #F00; width:100%; height:30px">Wrong</div>
<div id="correctanswer" style=" display:none; background-color:#0F0; width:100%; height:30px">Correct Answer: <?php echo $ans; ?></div>
<div id="word" style=" display:none; width:100%;"><?php echo $word["word"]." : ".$twn2; ?></div>
</h2>
(遠東 第<?php echo $word["book"]; ?>冊 第<?php echo $word["lesson"]; ?>課 第<?php echo $word["number"]; ?>個單字)
<hr>
例句來源：<a href="http://dict.dreye.com/dj/" target="_blank">http://dict.dreye.com/dj/</a><br>
單字解釋來源：<a href="http://tw.dictionary.search.yahoo.com/" target="_blank">http://tw.dictionary.search.yahoo.com/</a>
<hr>
Develop by <a href="https://www.facebook.com/profile.php?id=100005870494945" target="_blank">Xiplus</a>.
</center>
</body>
</html>