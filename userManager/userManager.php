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
			$result = $result->fetch_assoc();
			$password = $result['password'];
			if($password === $_POST['password']){
				$_SESSION['name'] = $_POST['name'];
				$_SESSION['uid'] = $result['id'];
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
		//查看是否为粉丝，是的话设置为好友，不是则设置为粉丝
		$result = $db->query('select * from userRelation where fId="'.$bId.'" and gId="'.$_SESSION['uid'].'"');
		if($result->num_rows > 0){
			echo 'is hy';
			$db->query('update userRelation set relation="1" where fId="'.$bId.'" and gId="'.$_SESSION['uid'].'"');
		}else{
			echo 'not is hy';
			$db->query('insert into userRelation (fId, gId, relation) values('.$_SESSION['uid'].', '.$bId.', "0")');
		}
		break;
	case 'noAttention':
		//查找被关注的用户的id
		$result = $db->query('select id from user where name="'.$_POST['name'].'"')->fetch_assoc();
		$bId = $result['id'];
		//如果不是好友，只是粉丝，则删除记录
		$result = $db->query('select * from userRelation where fId='.$_SESSION['uid'].' and gId='.$bId.' and relation="0"');
		if($result->num_rows > 0){
			echo 'not is hy';
			$db->query('delete from userRelation where fId='.$_SESSION['uid'].' and gId='.$bId);
			break;
		}
		//如果是好友，则设置为关注
		$result = $db->query('select * from userRelation where fId='.$_SESSION['uid'].' and gId='.$bId);
		if($result->num_rows > 0){
			echo 'is hy1';
			$db->query('delete from userRelation where fId='.$_SESSION['uid'].' and gId='.$bId);
		}
		$result = $db->query('select * from userRelation where fId='.$bId.' and gId='.$_SESSION['uid']);
		if($result->num_rows > 0){
			echo 'is hy';
			$db->query('delete from userRelation where fId='.$bId.' and gId='.$_SESSION['uid']);
		}
		$db->query('insert into userRelation (fId, gId, relation) values('.$bId.', '.$_SESSION['uid'].', "0")');
		break;
	case 'checkIn':
		//查找昨天是否签到
		$continuousNum = 1;
		$result = $db->query('select continuousNum from checkIn'.$_SESSION['uid'].' where CheckInDate=date_add(curdate(), interval -1 day)');
		if($result){
			echo 'continuousNum';
			$result = $result->fetch_assoc();
			$continuousNum = $result['continuousNum'] + 1;
		}
		//如果今天的签到表不存在，则创建
		$db->query('create table if not exists checkIn_'.date("Ymd").'(id int unsigned primary key auto_increment, continuousNum int unsigned, uId int unsigned, checkInDate date, checkInTime time)');
		//在今天的签到表里插入签到数据
		$db->query('insert into checkIn_'.date("Ymd").' (uId, continuousNum, checkInDate, checkInTime) values('.$_SESSION['uid'].','.$continuousNum.', curdate(), curtime())');
		$db->query('insert into checkIn'.$_SESSION['uid'].' (checkInDate, checkInTime, continuousNum) values(curdate(), curtime(), '.$continuousNum.')');
		break;
	case 'friend':
		$friendList = array();
		//查找在粉丝位置的好友
		$result = $db->query('select fId from userRelation where relation="1" and gId='.$_SESSION['uid']);
		$fNum = $result->num_rows;
		for($i=0; $i<$fNum; $i++){
			$row = $result->fetch_assoc();
			$nameCol = $db->query('select name from user where id='.$row['fId'])->fetch_assoc();
			$friendList[$i] = $nameCol['name'];
		}
		//查找在关注位置的好友
		$result = $db->query('select gId from userRelation where relation="1" and fId='.$_SESSION['uid']);
		$gNum = $result->num_rows;
		for($i=0; $i<$gNum; $i++){
			$row = $result->fetch_assoc();
			$nameCol = $db->query('select name from user where id='.$row['gId'])->fetch_assoc();
			$friendList[$i+$fNum] = $nameCol['name'];
		}
		echo json_encode(array('friendNum'=>($fNum+$gNum), 'friendList'=>$friendList));
		break;
	case 'fans':
		$fansList = array();
		//查找在粉丝位置的id
		$result = $db->query('select fId from userRelation where relation="0" and gId='.$_SESSION['uid']);
		$fansNum = $result->num_rows;
		for($i=0; $i<$fansNum; $i++){
			$row = $result->fetch_assoc();
			$nameCol = $db->query('select name from user where id='.$row['fId'])->fetch_assoc();
			$fansList[$i] = $nameCol['name'];
		}
		echo json_encode(array('fansNum'=>$fansNum, 'fansList'=>$fansList));
		break;
	case 'gz':
		$gzList = array();
		//查找在关注位置的id
		$result = $db->query('select gId from userRelation where relation="0" and fId='.$_SESSION['uid']);
		$gzNum = $result->num_rows;
		for($i=0; $i<$gzNum; $i++){
			$row = $result->fetch_assoc();
			$nameCol = $db->query('select name from user where id='.$row['gId'])->fetch_assoc();
			$gzList[$i] = $nameCol['name'];
		}
		echo json_encode(array('gzNum'=>$gzNum, 'gzList'=>$gzList));
		break;
	default:
		break;
}

$userDb = null;
?>