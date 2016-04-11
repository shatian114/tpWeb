<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['name'])){
	//查找被关注的用户的id
	$result = $db->query('select id from user where name="'.$_POST['name'].'"')->fetch_assoc();
	$bId = $result['id'];
	//给被取消关注的人发送信息，内容为2，说明是被取消关注了，
	$db->query('insert into msg'.$bId.'(msgType, msgContent, fromUid, msgDate, msgTime) values("2", "2", '.$_SESSION['uid'].', curdate(), curtime())');
	//如果不是好友，只是粉丝，则删除记录
	$result = $db->query('select * from userRelation where fId='.$_SESSION['uid'].' and gId='.$bId.' and relation="0"');
	if($result->num_rows > 0){
		$db->query('delete from userRelation where fId='.$_SESSION['uid'].' and gId='.$bId);
		echo '1';
		exit();
	}
	//如果是好友，则设置为关注
	$result = $db->query('select * from userRelation where fId='.$_SESSION['uid'].' and gId='.$bId.' and relation="1"');
	if($result->num_rows > 0){
		$db->query('delete from userRelation where fId='.$_SESSION['uid'].' and gId='.$bId);
		$db->query('insert into userRelation (fId, gId, relation) values('.$bId.', '.$_SESSION['uid'].', "0")');
		echo '2';
		exit();
	}
	$result = $db->query('select * from userRelation where fId='.$bId.' and gId='.$_SESSION['uid']);
	if($result->num_rows > 0){
		$db->query('delete from userRelation where fId='.$bId.' and gId='.$_SESSION['uid']);
		$db->query('insert into userRelation (fId, gId, relation) values('.$bId.', '.$_SESSION['uid'].', "0")');
		echo '2';
	}
}else{
	echo '0';
}
?>