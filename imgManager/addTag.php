<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['addId']) && isset($_POST['tag'])){
	$postTagArr = explode(' ', $_POST['tag']);
	$postTagNum = count($postTagArr);
	//根据要添加tag的类型判断需要插入的表名和字段名

	$tableName = substr_count($_POST['addId'], '_')==2?'imgInfo':'imgFolderInfo';

	$tagArr = explode(' ', ($db->query('select tag from '.$tableName.' where id="'.$_POST['addId'].'"')->fetch_assoc())['tag']);
	$tagNum = count($tagArr);
	if($tagNum + $postTagNum > 8){
		echo '2';
		exit();
	}
	$tagStr = implode(' ', $tagArr).' '.implode(' ', $postTagArr);
	$db->query('update '.$tableName.' set tag="'.$tagStr.'"');
	echo '1';
}else{
	echo '0';
}
?>