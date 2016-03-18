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
			//创建签到表
			$db->query('create table checkIn'.$uid.'(checkInDate date, checkInTime time, continuousNum int unsigned)');
			echo '注册成功!';
		}
		break;
	//登陆
	case 'login':
		//查找用户名是否存在，存在再对比密码
		$result = $db->query('select * from user where name="'.$_POST['name'].'"');
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
		break;
	case 'viewLogin':
		echo $_SESSION['name'];
		break;
	case 'attention':
		//查找被关注的用户的id
		$result = $db->query('select id from user where name="'.$_POST['name'].'"')->fetch_assoc();
		$bId = $result['id'];
		//查找本用户的id
		$result = $db->query('select id from user where name="'.$_SESSION['name'].'"')->fetch_assoc();
		$id = $result['id'];
		//查看是否为粉丝，是的话设置为好友，不是则设置为粉丝
		$result = $db->query('select * from userRelation where fId="'.$bId.'" and gId="'.$id.'"');
		if($result->num_rows > 0){
			echo 'is hy';
			$db->query('update userRelation set relation="1" where fId="'.$bId.'" and gId="'.$id.'"');
		}else{
			echo 'not is hy';
			$db->query('insert into userRelation (fId, gId, relation) values('.$id.', '.$bId.', "0")');
		}
		break;
	case 'noAttention':
		//查找被关注的用户的id
		$result = $db->query('select id from user where name="'.$_POST['name'].'"')->fetch_assoc();
		$bId = $result['id'];
		//查找本用户的id
		$result = $db->query('select id from user where name="'.$_SESSION['name'].'"')->fetch_assoc();
		$id = $result['id'];
		//如果不是好友，只是粉丝，则删除记录
		$result = $db->query('select * from userRelation where fId='.$id.' and gId='.$bId.' and relation="0"');
		if($result->num_rows > 0){
			echo 'not is hy';
			$db->query('delete from userRelation where fId='.$id.' and gId='.$bId);
			break;
		}
		//如果是好友，则设置为关注
		$result = $db->query('select * from userRelation where fId='.$id.' and gId='.$bId);
		if($result->num_rows > 0){
			echo 'is hy1';
			$db->query('delete from userRelation where fId='.$id.' and gId='.$bId);
		}
		$result = $db->query('select * from userRelation where fId='.$bId.' and gId='.$id);
		if($result->num_rows > 0){
			echo 'is hy';
			$db->query('delete from userRelation where fId='.$bId.' and gId='.$id);
		}
		$db->query('insert into userRelation (fId, gId, relation) values('.$bId.', '.$id.', "0")');
		break;
	case 'checkIn':
		//查找当前用户的id
		$result = $db->query('select * from user where name="'.$_SESSION['name'].'"')->fetch_assoc();
		$uId = $result['id'];
		//查找昨天是否签到
		$continuousNum = 1;
		$result = $db->query('select continuousNum from checkIn'.$uId.' where CheckInDate=date_add(curdate(), interval -1 day)');
		if($result){
			echo 'continuousNum';
			$result = $result->fetch_assoc();
			$continuousNum = $result['continuousNum'] + 1;
		}
		//如果今天的签到表不存在，则创建
		$db->query('create table if not exists checkIn_'.date("Ymd").'(id int unsigned primary key auto_increment, continuousNum int unsigned, uId int unsigned, checkInDate date, checkInTime time)');
		//在今天的签到表里插入签到数据
		$db->query('insert into checkIn_'.date("Ymd").' (uId, continuousNum, checkInDate, checkInTime) values('.$uId.','.$continuousNum.', curdate(), curtime())');
		$db->query('insert into checkIn'.$uId.' (checkInDate, checkInTime, continuousNum) values(curdate(), curtime(), '.$continuousNum.')');
		break;
	default:
		break;
}

$userDb = null;
?>