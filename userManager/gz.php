<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid'])){
	$gzList = array();
	//查找在关注位置的id
	$result = $db->query('select gId from userRelation where relation="0" and fId='.$_SESSION['uid']);
	$gzNum = $result->num_rows;
	for($i=0; $i<$gzNum; $i++){
		$row = $result->fetch_assoc();
		$nameCol = $db->query('select name from user where id='.$row['gId'])->fetch_assoc();
		$gzList[$i] = $nameCol['name'];
	}
	echo json_encode(array('gzNum'=>$gzNum, 'gzList'=>$gzList));
}else{
	echo '0';
}
?>