<link href="../res/css.css" rel="stylesheet" type="text/css">
<?php
function meta($array=null){
	$meta["title"]="EngWd";
	$meta["type"]="website";
	$meta["description"]="英文單字測驗及列表。";
	$meta["url"]="http://".url();
	//$meta["image"]="http://pc2.tfcis.org/xiplus/edams/res/icon.png";
	if($array!=null){
		foreach($array as $temp){
			$meta[$temp[0]]=$temp[1];
		}
	}
	?>
	<meta property="og:title" content="<?php echo $meta["title"];?>"/>
	<meta property="og:type" content="<?php echo $meta["type"];?>"/>
	<meta property="og:description" content="<?php echo $meta["description"];?>"/>
	<meta property="og:url" content="<?php echo $meta["url"];?>"/>
	<meta property="og:image" content="<?php echo $meta["image"];?>"/>
<?php
}
?>