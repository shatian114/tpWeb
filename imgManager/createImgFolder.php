<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['imgFolderName']) && isset($_POST['imgFolderTag']) && isset($_POST['imgFolderExplanation'])){
	//根据用户表里的相册字符串算出相册的id
	$imgFolderId = '';
	$imgFolderIdStr = ($db->query('select imgFolderIdStr from user where id='.$_SESSION['uid'])->fetch())['imgFolderIdStr'];
	if($imgFolderIdStr === ''){
		$imgFolderIdStr = '0';
		$imgFolderId= '0';
	}else{
		$imgFolderIdArr = explode(',', $imgFolderIdStr);
		$imgFolderId = $imgFolderIdArr[count($imgFolderIdArr)-1]+1;
		$imgFolderIdStr .= ','.$imgFolderId;
	}
	//查找相册个数，来设置相册id
	$result = $db->query('select imgFolderNum from user where id='.$_SESSION['uid'])->fetch();
	$imgFolderNum = $result['imgFolderNum'];
	$db->query('update user set imgFolderNum='.($imgFolderNum+1));
	//将相册的信息插入到信息表
	$db->query('insert into imgFolderInfo(id, name, tag, explanation, createDate, createTime) values("'.$_SESSION['uid'].'_'.$imgFolderId.'", "'.$_POST['imgFolderName'].'", "'.$_POST['imgFolderTag'].'", "'.$_POST['imgFolderExplanation'].'", curdate(), curtime())');
	//将相册的id插入到用户表里的相册id字符串里
	$db->query('update user set imgFolderIdStr="'.$imgFolderIdStr.'" where id='.$_SESSION['uid']);
	echo '1';
}else{
	echo '0';
}
?>