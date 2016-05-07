<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid'])){
	$result = $db->query('select checkInSum from user where id='.$_SESSION['uid'])->fetch();
	echo $result['checkInSum'];
}else{
	echo '0';
}
?>