<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid'])){
	$result = $db->query('select * from checkIn'.date('Ymd', strtotime('-1 day')).' where uId='.$_SESSION['uid']);
	if($result->rowCount > 0){
		$result = $db->query('select checkInContinousSum from user where id='.$_SESSION['uid'])->fetch();
		echo $result['checkInContinousSum'];
	}else{
		$result = $db->query('select * from checkIn'.date('Ymd').' where uId='.$_SESSION['uid']);
		echo $result->rowCount()>0 ? 1 : 0;
	}
}else{
	echo '0';
}
?>