<?php
require_once '../dbInterface.php';
if(isset($_POST['reportId']) && isset($_POST['reportInfo']) && isset($_SESSION['uid'])){
	//查找图片的举报者的字段，是否有5个，或者有本人的id，或者上次的举报是否被处理
	$result = $db->query('select * from imgInfo where id="'.$_POST['reportId'].'"');
	if($result->rowCount() > 0){
		$result = $result->fetch();
		if($result['reportInfo'] !== ''){
			//本图片的举报信息还在，未处理
			echo '3';
		}elseif(substr_count($result['reportUid'], ' ') == 5){
			//本图片被举报5次，不能举报
			echo '4';
		}elseif(strpos($result['reportUid'], $_SESSION['uid']) != false){
			//已举报过本图片，不能举报
			echo '5';
		}else{
			$db->query('update imgInfo set reportUid="'.$result['reportUid'].' '.$_SESSION['uid'].'", reportInfo="'.$_POST['reportInfo'].'"');
			echo '1';
		}
	}else{
		//本id不存在
		echo '2';
	}
}else{
	echo '0';
}
?>