<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid'])){
	//查找昨天是否签到
	$continuousNum = 1;
	$result = $db->query('select continuousNum from checkIn'.$_SESSION['uid'].' where CheckInDate=date_add(curdate(), interval -1 day)');
	if($result){
		$result = $result->fetch_assoc();
		$continuousNum = $result['continuousNum'] + 1;
	}
	//如果今天的签到表不存在，则创建
	$db->query('create table if not exists checkIn_'.date("Ymd").'(id int unsigned primary key auto_increment, continuousNum int unsigned, uId int unsigned, checkInDate date, checkInTime time)');
	//在今天的签到表里插入签到数据
	$db->query('insert into checkIn_'.date("Ymd").' (uId, continuousNum, checkInDate, checkInTime) values('.$_SESSION['uid'].','.$continuousNum.', curdate(), curtime())');
	$db->query('insert into checkIn'.$_SESSION['uid'].' (checkInDate, checkInTime, continuousNum) values(curdate(), curtime(), '.$continuousNum.')');
	echo '1';
}else{
	echo '0';
}
?>