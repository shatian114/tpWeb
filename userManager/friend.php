<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid'])){
	$friendList = array();
	//查找在粉丝位置的好友
	$result = $db->query('select fId from userRelation where relation="1" and gId='.$_SESSION['uid']);
	$fNum = $result->num_rows;
	for($i=0; $i<$fNum; $i++){
		$row = $result->fetch_assoc();
		$nameCol = $db->query('select name from user where id='.$row['fId'])->fetch_assoc();
		$friendList[$i] = $nameCol['name'];
	}
	//查找在关注位置的好友
	$result = $db->query('select gId from userRelation where relation="1" and fId='.$_SESSION['uid']);
	$gNum = $result->num_rows;
	for($i=0; $i<$gNum; $i++){
		$row = $result->fetch_assoc();
		$nameCol = $db->query('select name from user where id='.$row['gId'])->fetch_assoc();
		$friendList[$i+$fNum] = $nameCol['name'];
	}
	echo json_encode(array('friendNum'=>($fNum+$gNum), 'friend'=>$friendList));
}else{
	echo '0';
}
?>