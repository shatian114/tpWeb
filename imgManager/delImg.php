<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['imgId'])){
	$imgIdArr = explode('_', $_POST['imgId']);
	$imgFolderId = $imgIdArr[0].'_'.$imgIdArr[1];
	if($_SESSION['uid'] != $imgIdArr[0]){
		echo '2';
	}else{
		//相册表里的图片数减1
		$db->query('update imgFolderInfo set imgNum=imgNum-1 where id="'.$imgFolderId.'"');
		//从相册信息表里的图片id字符串里删除图片的id
		$imgIdStr = ($db->query('select imgIdStr from imgFolderInfo where id="'.$imgFolderId.'"')->fetch_assoc())['imgIdStr'];
		$imgIdStrArr = explode(',', $imgIdStr);
		unset($imgIdStrArr[array_search($imgIdArr[2], $imgIdStrArr)]);
		$imgIdStr = implode(',', $imgIdStrArr);
		$db->query('update imgFolderInfo set imgIdStr="'.$imgIdStr.'" where id="'.$imgFolderId.'"');
		//从图片表里删除图片
		$db->query('delete from imgInfo where id="'.$_POST['imgId'].'"');
		echo '1';
	}
}else{
	echo '0';
}
?>