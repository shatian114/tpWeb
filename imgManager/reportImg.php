<?php
require_once '../dbInterface.php';
if(isset($_POST['reportId']) && isset($_POST['argument'])){
	//将图片禁止
		$db->query('update imgInfo set forbid="1" where id="'.$_POST['reportId'].'"');
		//将举报信息添加到举报表里
		$db->query('insert into reportTable(id, uid, argument, reportDate, reportTime) values("'.$_POST['reportId'].'", "'.$_SESSION['uid'].'", "'.$_POST['argument'].'", curdate(), curtime())');
		echo '1';
}else{
	echo '0';
}
?>