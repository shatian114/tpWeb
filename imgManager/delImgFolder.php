<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['imgFolderId'])){
	$imgFolderIdArr = explode('_', $_POST['imgFolderId']);
	if($_SESSION['uid'] != $imgFolderIdArr[0]){
		echo '2';
	}else{
		//用户表里的相册数减1
		$db->query('update user set imgFolderNum=imgFolderNum-1 where id='.$_SESSION['uid']);
		//将本id从用户表的相册id字符串里去掉
		$imgFolderIdStr = ($db->query('select imgFolderIdStr from user where id='.$_SESSION['uid'])->fetch())['imgFolderIdStr'];
		$imgFolderIdStrArr = explode(',', $imgFolderIdStr);
		$key = array_search($imgFolderIdArr[1], $imgFolderIdStrArr);
		unset($imgFolderIdStrArr[$key]);
		$imgFolderIdStr = implode(',', $imgFolderIdStrArr);
		$db->query('update user set imgFolderIdStr="'.$imgFolderIdStr.'" where id='.$_SESSION['uid']);
		//删除相册信息表里的记录
		$db->query('delete from imgFolderInfo where id="'.$_POST['imgFolderId'].'"');
		//删除本相册的所有图片
		$db->query('delete from imgInfo where id like"'.$_POST['imgFolderId'].'%"');
		echo '1';
	}
}else{
	echo '0';
}
?>