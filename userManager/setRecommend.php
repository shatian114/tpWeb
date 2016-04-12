<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['uid'])){
	$db->query('update user set recommend="1" where id='.$_POST['uid']);
	echo '1';
}else{
	echo '0';
}
?>