<?php
//删除图片或相册的tag，需上传图片或相册的id，需要删除的tag
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['delId']) && isset($_POST['tagType']) && isset($_POST['tag'])){
	$result = $db->query('select tag,tagLikeNumStr,tagUidStr from '.$_POST['tagType'].' where id="'.$_POST['delId'].'" and tag like "% '.$_POST['tag'].' %"');
	if($result->num_rows > 0){
		$result = $result->fetch_assoc();
		$tagArr = explode(' ', trim($result['tag']));
		$tagLikeNumArr = explode(' ', trim($result['tagLikeNumStr']));
		$tagUidArr = explode(' ', trim($result['tagUidStr']));
		$tagIndex = array_search($_POST['tag'], $tagArr);
		unset($tagArr[$tagIndex]);
		unset($tagLikeNumArr[$tagIndex]);
		unset($tagUidArr[$tagIndex]);
		$tag = ' '.implode(' ', $tagArr).' ';
		$tagLikeNumStr = implode(' ', $tagLikeNumArr);
		$tagUidStr = implode(' ', $tagUidArr);
		$db->query('update '.$_POST['tagType'].' set tag="'.$tag.'", tagLikeNumStr="'.$tagLikeNumStr.'", tagUidStr="'.$tagUidStr.'" where id="'.$_POST['delId'].'"');
		echo '1';
	}else{
		echo '2';
	}
}else{
	echo '0';
}
?>