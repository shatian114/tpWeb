<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['fractionNum'])){
	$result = $db->query('select fraction from user where id='.$_SESSION['uid'])->fetch_assoc();
	$fraction = $result['fraction'];
	if($fraction < $_POST['fractionNum']){
		echo '2';
		exit();
	}
	//添加减增加信息到积分信息表
	$db->query('insert into fraction'.$_SESSION['uid'].'(fractionDate, fractionTime, info) values(curdate(), curtime(), "'.$_POST['info'].'")');
	//加分到数据表里的积分字段
	$result = $db->query('update user set fraction=fraction-'.$_POST['fractionNum'].' where id='.$_SESSION['uid']);
	if($result){
		echo '1';
	}
}else{
	echo '0';
}
?>