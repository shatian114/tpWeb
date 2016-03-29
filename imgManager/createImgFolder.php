<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['imgFolderName']) && isset($_POST['imgFolderTag']) && isset($_POST['imgFolderExplanation'])){
	//查找相册个数，来设置相册id
	$result = $db->query('select imgFolderNum from user where id='.$_SESSION['uid'])->fetch_assoc();
	$imgFolderNum = $result['imgFolderNum'];
	$db->query('update user set imgFolderNum='.($imgFolderNum+1));
	//将相册的信息插入到信息表
	$db->query('insert into imgFolderInfo(id, name, tag, explanation, createDate, createTime) values("'.$_SESSION['uid'].'_'.$imgFolderNum.'", "'.$_POST['imgFolderName'].'", "'.$_POST['imgFolderTag'].'", "'.$_POST['imgFolderExplanation'].'", curdate(), curtime())');
	echo '1';
}else{
	echo '0';
}
?>