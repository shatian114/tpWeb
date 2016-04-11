<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['imgId']) && isset($_POST['replyId']) && isset($_POST['content'])){
	$db->query('create table if not exists review'.$_POST['imgId'].'(id bigint unsigned primary key auto_increment, content text, replyId bigint unsigned not null default 0, reviewDate date, reviewTime time, reviewUid bigint unsigned)');
	//将新评论插入到本图片的评论表中
	$db->query('insert into review'.$_POST['imgId'].' (replyId, content, reviewDate, reviewTime, reviewUid) values ('.$_POST['replyId'].', "'.$_POST['content'].'", curdate(), curtime(), '.$_SESSION['uid'].')');
	//给图片的所有者发送评论的信息，信息的内容为评论的id
	$reviewId = $db->query('select * from review'.$_POST['imgId'])->num_rows;
	$imgUid = (explode('_', $_POST['imgId']))[0];
	$db->query('insert into msg'.$imgUid.'(msgType, msgContent, fromUid, msgDate, msgTime) values("1", "'.$reviewId.'", '.$_SESSION['uid'].', curdate(), curtime())');
	echo '1';
}else{
	echo '0';
}
?>