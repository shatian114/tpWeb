<?php
//取消对相册或图片的点赞，需要上传tag的类型，tag，以及图片或相册的id、
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['imgId']) && isset($_POST['tag']) && isset($_POST['tagType'])){
	//查找是否有本图片，并且本图是否有本tag
	$result = $db->query('select tag,tagLikeNumStr,tagUidStr from '.$_POST['tagType'].' where id="'.$_POST['imgId'].'" and tag like "% '.$_POST['tag'].' "');
	if($result->num_rows>0){
		$result = $result->fetch_assoc();
		//查找tag在数组里的索引
		$tagIndex = array_search($_POST['tag'], explode(' ', trim($result['tag'])));
		$tagLikeNumArr = explode(' ', $result['tagLikeNumStr']);
		$tagUidStrArr = explode(' ', trim($result['tagUidStr']));
		if($tagLikeNumArr[$tagIndex]>0 && strpos($tagUidStrArr[$tagIndex], ','.$_SESSION['uid'].',')!==false){
			//如果赞数大于0并且赞的id的字符串里有本用户的id
			//赞数减1
			$tagLikeNumArr[$tagIndex]--;
			$tagLikeNumStr = implode(' ', $tagLikeNumArr);
			//点赞的人的uid的字符串里删除本人的id
			$tagUidStrArr[$tagIndex] = str_replace(','.$_SESSION['uid'], '', $tagUidStrArr[$tagIndex]);
			$tagUidStr = implode(' ', $tagUidStrArr);
			$db->query('update imgInfo set tagLikeNumStr="'.$tagLikeNumStr.'", tagUidStr="'.$tagUidStr.'" where id="'.$_POST['imgId'].'"');
			echo '1';
		}else{
			echo '3';
		}
	}else{
		echo '2';
	}
}else{
	echo '0';
}
?>