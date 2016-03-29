<?php
require_once '../dbInterface.php';
if(isset($_POST['name']) && isset($_POST['password'])){
	//查找用户名是否存在，存在再对比密码
	$result = $db->query('select * from user where name="'.$_POST['name'].'"');
	if($result->num_rows > 0){
		$result = $result->fetch_assoc();
		$password = $result['password'];
		if($password === sha1($_POST['password'])){
			$_SESSION['name'] = $_POST['name'];
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