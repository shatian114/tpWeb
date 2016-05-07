<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid'])){
	//查找昨天是否签到
	$result = $db->query('select * from checkIn'.date('Ymd', strtotime('-1 day')).' where uId='.$_SESSION['uid']);
	if($result->rowCount() > 0){
		//将连续签到数加1
		$db->query('update user set checkInContinousSum = checkInContinousSum + 1');
	}else{
		//将连续签到数设为1
		$db->query('update user set checkInContinousSum = 0');
	}
	//将签到累计数加1
	$db->query('update user set checkInSum = checkInSum + 1');
	//如果今天的签到表不存在，则创建
	$db->query('create table if not exists checkIn'.date("Ymd").'(id int unsigned primary key auto_increment, uId int unsigned, checkInDate date, checkInTime time)');
	//在今天的签到表里插入签到数据
	$db->query('insert into checkIn'.date("Ymd").' (uId, checkInDate, checkInTime) values('.$_SESSION['uid'].', curdate(), curtime())');
	echo '1';
}else{
	echo '0';
}
?>