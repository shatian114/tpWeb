<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['fractionNum'])){
	//添加积分增加信息到积分信息表
	$db->query('insert into fraction'.$_SESSION['uid'].'(fractionDate, fractionTime, info) values(curdate(), curtime(), "'.$_POST['info'].'")');
	//加分到数据表里的积分字段
	$result = $db->query('update user set fraction=fraction+'.$_POST['fractionNum'].' where id='.$_SESSION['uid']);
	echo $result ? '1' : '2';
}else{
	echo '0';
}
?>