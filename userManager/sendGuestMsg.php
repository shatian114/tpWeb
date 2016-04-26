<?php
//给用户发送访客信息，访客为登陆用户，信息类型为4
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['uid'])){
	$db->query('insert into msg'.$_POST['uid'].'(msgType, msgContent, fromUid, msgDate, msgTime) values("4", "",'.$_SESSION['uid'].', curdate(), curtime())');
	echo '1';
}else{
	echo '0';
}
?>