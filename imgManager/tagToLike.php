<?php
//给tag点赞,需要上传图片或相册的id，需要点赞的tag，图片或相册的类型
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['imgId']) && isset($_POST['tag']) && isset($_POST['tagType'])){
	$result = $db->query('select tag,tagUidStr,tagLikeNumStr from '.$_POST['tagType'].' where id="'.$_POST['imgId'].'" and tag like "%'.$_POST['tag'].'%"');
	if($result->num_rows > 0){
		$result = $result->fetch_assoc();
		$tagIndex = array_search($_POST['tag'], explode(' ', trim($result['tag'])));
		$tagLikeNumArr = explode(' ', trim($result['tagLikeNumStr']));
		if($tagLikeNumArr[$tagIndex] != 100){
			//查看本人是否给本tag点赞过
			if(strstr($result['tagUidStr'], ','.$_SESSION['uid'].',') !== false){
				//本人已点赞
				echo '4';
			}else{
				//给本tag的赞数加1
				$tagLikeNumArr[$tagIndex] += 1;
				$tagLikeNumStr = implode(' ', $tagLikeNumArr);
				//给本tag的点赞的用户id字符串后面加上本人的id
				$tagUidStr = $result['tagUidStr'].$_SESSION['uid'].',';
				//更新记录
				$db->query('update imgInfo set tagLikeNumStr="'.$tagLikeNumStr.'", tagUidStr="'.$tagUidStr.'" where id="'.$_POST['imgId'].'"');
				echo '1';
			}
		}else{
			//点赞熟已超100
			echo '3';
		}
	}else{
		//没有此图片或相册，或没有此tag
		echo '2';
	}
}else{
	echo '0';
}
?>