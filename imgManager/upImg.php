<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['imgFolderId']) && isset($_POST['imgJson'])){
	//获取相册里的图片数
	$result = $db->query('select imgNum from imgFolderInfo where id="'.$_POST['imgFolderId'].'"')->fetch_assoc();
	$imgNum = $result['imgNum'];
	//将图片的信息存入相应的表
	$insertSql = 'insert into imgInfo(id, url, tag, title, explanation, titlePage, width, height, imgDate, imgTime, software, tool, remark) values("'.$_POST['imgFolderId'].'_'.$imgNum.'", "'.$_POST['imgJson']['0']['imgUrl'].'", "'.$_POST['imgJson']['0']['imgTag'].'", "'.$_POST['imgJson']['0']['imgTitle'].'", "'.$_POST['imgJson']['0']['imgExplanation'].'", "'.$_POST['imgJson']['0']['imgTitlePage'].'", "'.$_POST['imgJson']['0']['imgWidth'].'", "'.$_POST['imgJson']['0']['imgHeight'].'", curdate(), curtime(),"'.$_POST['imgJson']['0']['software'].'", "'.$_POST['imgJson']['0']['tool'].'", "'.$_POST['imgJson']['0']['remark'].'")';
	$imgNum++;
	$postImgNum = count($_POST['imgJson']);
	for($i=1; $i<$postImgNum; $i++){
		$iStr = $i.'';
		$insertSql .= ', ("'.$_POST['imgFolderId'].'_'.$imgNum.'", "'.$_POST['imgJson'][$iStr]['imgUrl'].'", "'.$_POST['imgJson'][$iStr]['imgTag'].'", "'.$_POST['imgJson'][$iStr]['imgTitle'].'", "'.$_POST['imgJson'][$iStr]['imgExplanation'].'", "'.$_POST['imgJson'][$iStr]['imgTitlePage'].'", "'.$_POST['imgJson'][$iStr]['imgWidth'].'", "'.$_POST['imgJson'][$iStr]['imgHeight'].'", curdate(), curtime(), "'.$_POST['imgJson'][$iStr]['software'].'", "'.$_POST['imgJson'][$iStr]['tool'].'", "'.$_POST['imgJson'][$iStr]['remark'].'")';
		$imgNum++;
	}
	$db->query($insertSql);
	//将图片数量插入相册信息表
	$db->query('update imgFolderInfo set imgNum='.$imgNum.' where id="'.$_POST['imgFolderId'].'"');
	echo '1';
}else{
	echo '0';
}
?>