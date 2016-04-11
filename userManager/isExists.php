<?php
require_once '../dbInterface.php';
if(isset($_POST['searchType']) && isset($_POST['searchStr'])){
	$result = $db->query('select * from user where '.$_POST['searchType'].'="'.$_POST['searchStr'].'"');
	if($result->num_rows > 0){
		echo '1';
	}else{
		echo '2';
	}
}else{
	echo '0';
}
?>