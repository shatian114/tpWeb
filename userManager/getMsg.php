<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['msgType'])){
	$result = $db->query('select * from msg'.$_SESSION['uid'].' where msgType="'.$_POST['msgType'].'"');
	$msgNum = $result->rowCount();
	$msgArr = array();
	if($msgNum > 0){
		for($i=0; $i<$msgNum; $i++){
			$msgArr[$i] = $$result->fetch();
		}
	}
	echo json_encode(array('msgNum'=>$msgNum, 'msgArr'=>$msgArr));
}else{
	echo '0';
}
?>