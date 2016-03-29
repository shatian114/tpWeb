<?php
require_once '../dbInterface.php';
if(isset($_POST['sameTag'])){
	$result = $db->query('select * from imgInfo where tag like "%'.$_POST['sameTag'].'%"');
	$imgNum = $result->num_rows;
	$imgArr = array();
	for($i=0; $i<$imgNum; $i++){
		$imgArr[$i] = $result->fetch_assoc();
	}
	echo json_encode(array('imgNum'=>$imgNum, 'imgArr'=>$imgArr));
}else{
	echo '0';
}
?>