<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid'])){
	$fansList = array();
	//查找在粉丝位置的id
	$result = $db->query('select fId from userRelation where relation="0" and gId='.$_SESSION['uid']);
	$fansNum = $result->rowCount();
	for($i=0; $i<$fansNum; $i++){
		$row = $result->fetch();
		$nameCol = $db->query('select name from user where id='.$row['fId'])->fetch_assoc();
		$fansList[$i] = $nameCol['name'];
	}
	echo json_encode(array('fansNum'=>$fansNum, 'fansList'=>$fansList));
}else{
	echo '0';
}
?>