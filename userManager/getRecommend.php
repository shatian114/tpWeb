<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid'])){
	$result = $db->query('select * from user where recommend="1"');
	$recommendNum = $result->rowCount();
	$recommendArr = array();
	for($i=0; $i<$recommendNum; $i++){
		$recommendArr[$i] = $result->fetch();
	}
	echo json_encode(array('recommendNum'=>$recommendNum, 'recommendArr'=>$recommendArr));
}else{
	echo '0';
}
?>