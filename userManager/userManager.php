<?php
require_once '../dbInterface.php';

switch($_POST['type']){
	case 'searchImg':
		$imgArr = array();
		$result = $db->query('select * from imgInfo where id like "'.$_SESSION['uid'].'_%"');
		$imgNum = $result->rowCount();
		for($i=0; $i<$imgNum; $i++){
			$imgArr[$imgNum - $i - 1] = $result->fetch();
		}
		echo json_encode($imgArr);
	case 'reportImg':
		//将图片禁止
		$db->query('update imgInfo set forbid="1" where id="'.$_POST['reportId'].'"');
		//将举报信息添加到举报表里
		$db->query('insert into reportTable(id, uid, argument, reportDate, reportTime) values("'.$_POST['reportId'].'", "'.$_SESSION['uid'].'", "'.$_POST['argument'].'", curdate(), curtime())');
		echo '0';
	default:
		break;
}

$userDb = null;
?>