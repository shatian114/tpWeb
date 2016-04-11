<?php
require_once '../dbInterface.php';
if(isset($_POST['name']) && isset($_POST['password'])){
	//查找用户名是否存在，不存在才可以注册
	$result = $db->query('select * from user where name="'.$_POST['name'].'"');
	if($result->num_rows > 0){
		echo '2';
	}else{
		//插入用户信息到数据库
		$db->query('insert into user (name, password) values("'.$_POST['name'].'", "'.sha1($_POST['password']).'")');
		//创建用户相关表
		$result = $db->query('select id from user where name="'.$_POST['name'].'"');
		$result = $result->fetch_assoc();
		$uid = $result['id'];
		//创建签到表
		$db->query('create table checkIn'.$uid.'(checkInDate date, checkInTime time, continuousNum int unsigned)');
		//创建积分信息表
		$db->query('create table fraction'.$uid.'(fractionDate date, fractionTime time, info text)');
		//创建消息表
		$db->query('create table msg'.$uid.'(id bigint unsigned auto_increment primary key, msgType char(1), msgContent text, fromUid bigint unsigned, msgDate date, msgTime time, msgRead char(1) not null default "0")');
		echo '1';
	}
}else{
	echo '0';
}
?>