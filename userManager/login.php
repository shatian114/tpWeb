<?php
require_once '../dbInterface.php';
if(isset($_POST['loginType']) && isset($_POST['password']) && isset($_POST['loginStr'])){
	//查找用户名是否存在，存在再对比密码
	switch($_POST['loginType']){
		case 'identity':
			$result = $db->query('select * from user where identityNum="'.$_POST['loginStr'].'"');
			break;
		case 'mobilePhone':
			$result = $db->query('select * from user where mobilePhone="'.$_POST['loginStr'].'"');
			break;
		default:
			$result = $db->query('select * from user where name="'.$_POST['loginStr'].'"');
			break;
	}
	if($result->rowCount() > 0){
		$result = $result->fetch();
		$password = $result['password'];
		if($password === sha1($_POST['password'])){
			$_SESSION['name'] = $result['name'];
			$_SESSION['uid'] = $result['id'];
			echo '1';
		}else{
			echo '2';
		}
	}else{
		echo '3';
	}
}else{
	echo '0';
}
?>