<?php
require_once '../dbInterface.php';
if(isset($_POST['id'])){
	$db->query('update user set forbid="1" where id='.$_POST['id']);
	echo '1';
}else{
	echo '0';
}
?>