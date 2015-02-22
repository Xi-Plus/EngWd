<!DOCTYPE html>
<?php
include_once("../func/sql.php");
include_once("../func/url.php");
include_once("../func/checklogin.php");
include_once("../func/consolelog.php");
?>
<head>
<meta charset="UTF-8">
<title>list-EngWd</title>
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
<h2>Word List</h2>
<table width="0" border="1" cellspacing="0" cellpadding="1">
	<tr>
		<td class="datatd">word</td>
		<td class="datatd">translate</td>
		<td class="datatd">book</td>
		<td class="datatd">lesson</td>
		<td class="datatd">number</td>
	</tr>
<?php
	$row=SELECT("*","engwd_wordlist",null,array(array("word")),"all");
	while($temp=mfa($row)){
?>
	<tr>
		<td class="datatd"><?php echo $temp["word"]; ?></td>
		<td class="datatd"><?php 
		$text=file_get_contents("https://tw.dictionary.yahoo.com/dictionary?p=".$temp["word"]);
		preg_match('/<p class="explanation">(\S*?)<\/p>/',$text,$match);
		echo $match[1];
		?></td>
		<td class="datatd"><?php echo $temp["book"]; ?></td>
		<td class="datatd"><?php echo $temp["lesson"]; ?></td>
		<td class="datatd"><?php echo $temp["number"]; ?></td>
	</tr>
<?php
	}
?>
</table>
<hr>
Develop by <a href="https://www.facebook.com/profile.php?id=100005870494945" target="_blank">Xiplus</a>.
</center>
</body>
</html>