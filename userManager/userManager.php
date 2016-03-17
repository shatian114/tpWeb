<?php
session_start();
require_once '../dbInterface.php';

switch($_POST['type']){
	//注册
	case 'regist':
		//查找用户名是否存在，不存在才可以注册
		$result = $db->query('select * from user where name="'.$_POST['name'].'"');
		if($result->num_rows > 0){
			echo 'exists';
		}else{
			//插入用户信息到数据库
			$db->query('insert into user (name, password) values("'.$_POST['name'].'", "'.$_POST['password'].'")');
			//创建用户相关表
			$result = $db->query('select id from user where name="'.$_POST['name'].'"');
			$result = $result->fetch_assoc();
			$uid = $result['id'];
			$db->query('create table gx'.$uid.'(uid bigint, gx char(1))');
			echo '注册成功!';
		}
		break;
	//登陆
	case 'login':
		//查找用户名是否存在，存在再对比密码
		$result = $db->query('select * from user where name="'.$_POST['Name'].'"');
		if($result->num_rows > 0){
			$password = $result->fetch_assoc()['password'];
			if($password === $_POST['password']){
				$_SESSION['name'] = $_POST['name'];
				echo 'ok';
			}else{
				echo 'passwordError';
			}
		}else{
			echo 'notExists';
		}
		break;
	case 'logout':
		unset($_SESSION['name']);
		echo 'logoutOk';
	case 'attention':
		//查找被关注的用户的id
		$result = $db->query('select id from user where name="'.$_POST['name'].'"')->fetch_assoc();
		$bId = $result['id'];
		//查找本用户的id
		$result = $db->query('select id from user where name="'.$_SESSION['name'].'"')->fetch_assoc();
		$id = $result['id'];
		//在被关注的用户的关系表里查找是否有本用户，有的话则设置互为好友
		//h:好友，f:粉丝，g:关注的人
		$result = $db->query('select * from gx'.$bId.' where uid="'.$id.'"');
		if($result->rows_num > 0){
			$db->query('insert into gx'.$id.' (uid, gx) values('.$bId.', "h")');
			$db->query('insert into gx'.$bId.' (uid, gx) values('.$id.', "h")');
			//关注成功，已互为好友
			echo 'hyOk';
		}else{
			$db->query('insert into gx'.$id.' (uid, gx) values('.$bId.', "g")');
			$db->query('insert into gx'.$bId.' (uid, gx) values('.$id.', "f")');
			//关注成功，已成为其粉丝
			echo 'gzOk';
		}
		break;
	default:
		break;
}

$userDb = null;
?>