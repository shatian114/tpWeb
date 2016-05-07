<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_SESSION['name'])){
	//查找被关注的用户的id
	$result = $db->query('select id from user where name="'.$_POST['name'].'"')->fetch();
	$bId = $result['id'];
	//查看是否为粉丝，是的话设置为好友，不是则设置为粉丝
	$result = $db->query('select * from userRelation where fId="'.$bId.'" and gId="'.$_SESSION['uid'].'"');
	if($result->rowCount() > 0){
		echo '1';
		$db->query('update userRelation set relation="1" where fId="'.$bId.'" and gId="'.$_SESSION['uid'].'"');
	}else{
		echo '2';
		$db->query('insert into userRelation (fId, gId, relation) values('.$_SESSION['uid'].', '.$bId.', "0")');
	}
	//给被关注的人发送信息，内容为1，说明是被关注了，
	$db->query('insert into msg'.$bId.'(msgType, msgContent, fromUid, msgDate, msgTime) values("2", "1", '.$_SESSION['uid'].', curdate(), curtime())');
}else{
	echo '0';
}
?>