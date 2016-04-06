<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['imgId']) && isset($_POST['operateType'])){
	if($_POST['operateType'] == '0'){
		//本次举报为误举报，删除举报信息
		$db->query('update imgInfo set reportInfo="" where id="'.$_POST['imgId'].'"');
	}else{
		$db->query('update imgInfo set forbid="1" where id="'.$_POST['imgId'].'"');
	}
	echo '1';
}else{
	echo '0';
}
?>