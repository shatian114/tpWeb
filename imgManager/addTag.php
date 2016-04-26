<?php
//给图片或相册添加tag，需要上传相册或图片的类型，添加的id，tag字符串
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['addId']) && isset($_POST['tag']) && isset($_POST['tagType'])){
	//查出需要添加的图片或相册的tag
	$result = $db->query('select tag,tagLikeNumStr,tagUidStr from '.$_POST['tagType'].' where id="'.$_POST['addId'].'"')->fetch_assoc();
	$tagArr = explode(' ', trim($result['tag']));
	$tagNum = count($tagArr);
	if($tagNum == 8){
		//本图片或相册的tag数已达到上限8
		echo '2';
	}else{
		if(array_search($_POST['tag'], $tagArr) !== false){
			//说明本相册或图片的已经有这个tag了
			echo '3';
		}else{
			array_push($tagArr, $_POST['tag']);
			$tagStr = ' '.implode(' ', $tagArr).' ';
			$tagLikeNumStr = $result['tagLikeNumStr'].' 0';
			$tagUidStr = $result['tagUidStr'].' ,';
			$db->query('update '.$_POST['tagType'].' set tag="'.$tagStr.'", tagLikeNumStr="'.trim($tagLikeNumStr).'", tagUidStr="'.$tagUidStr.'" where id="'.$_POST['addId'].'"');
			echo '1';
		}
	}
}else{
	echo '0';
}
?>