<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['msgContent']) && isset($_POST['uid'])){
	$db->query('insert into msg'.$_POST['uid'].'(msgType, msgContent, fromUid, msgDate, msgTime) values("3", "'.$_POST['msgContent'].'", '.$_SESSION['uid'].', curdate(), curtime())');
	echo '1';
}else{
	echo '0';
}
?>