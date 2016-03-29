<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['password'])){
	$db->query('update user set password="'.sha1($_POST['password']).'" where id='.$_SESSION['uid']);
	echo '1';
}else{
	echo '0';
}
?>