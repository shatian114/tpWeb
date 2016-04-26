<?php
require_once '../dbInterface.php';
if(isset($_POST['searchType']) && isset($_POST['searchStr'])){
	switch($_POST['searchType']){
		case 'uid':
			$result = $db->query('select * from user where id='.$_POST['searchStr']);
			break;
		case 'nickName':
			$result = $db->query('select * from user where nickName="'.$_POST['searchStr'].'"');
			break;
		case 'realName':
			$result = $db->query('select * from user where realName="'.$_POST['searchStr'].'"');
			break;
		case 'remarkName':
			$result = $db->query('select * from user where remarkName="'.$_POST['searchStr'].'"');
			break;
		case 'mobilePhone':
			$result = $db->query('select * from user where mobilePhone="'.$_POST['searchStr'].'"');
			break;
		case 'identityNum':
			$result = $db->query('select * from user where identityNum="'.$_POST['searchStr'].'"');
			break;
		case 'alipay':
			$result = $db->query('select * from user where alipay="'.$_POST['searchStr'].'"');
			break;
		default:
			$result = $db->query('select * from user where name="'.$_POST['searchStr'].'"');
			break;
	}
	if($result->num_rows > 0){
		$result = $result->fetch_assoc();
		unset($result['password']);
		//echo json_encode($result);
		echo 'uid:'.$_SESSION['uid'];
	}else{
		echo '2';
	}
}else{
	echo '0';
}
?>