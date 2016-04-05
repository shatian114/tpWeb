<?php
require_once '../dbInterface.php';
if(isset($_POST['id']) && isset($_POST['operateType'])){
	switch($_POST['operateType']){
		case 'detele':
			$db->query('delete from user where id='.$_POST['id']);
			break;
		case 'forbid':
			$db->query('update user set forbid="1" where id='.$_POST['id']);
			break;
	}
	echo '1';
}else{
	echo '0';
}
?>