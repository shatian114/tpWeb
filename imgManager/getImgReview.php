<?php
//根据图片的id获取图片的评论
require_once '../dbInterface.php';
if(isset($_POST['imgId'])){
	$result = $db->query('select * from review'.$_POST['imgId']);
	$reviewNum = $result->rowCount();
	$reviewArr = array();
	if($reviewNum > 0){
		for($i=0; $i<$reviewNum; $i++){
			$reviewArr[$i] = $result->fetch();
		}
		echo json_encode(array('reviewNum'=>$reviewNum, 'reviewArr'=>$reviewArr));
	}else{
		echo '2';
	}
}else{
	echo '0';
}
?>