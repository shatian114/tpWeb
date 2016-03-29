<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['id'])){
	//如果不存在用户的收藏表，则先创建
	$db->query('create table if not exists collect'.$_SESSION['uid'].'(id varchar(255) primary key not null, collectDate date, collectTime time)');
	$db->query('insert into collect'.$_SESSION['uid'].'(id, collectDate, collectTime) values("'.$_POST['id'].'", curdate(), curtime())');
	echo '1';
}else{
	echo '0';
}
?>