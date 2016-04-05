<?php
require_once '../dbInterface.php';
if(isset($_POST['imgId'])){
	$result = $db->query('select * from imgInfo where id="'.$_POST['imgId'].'"');
	if($result->num_rows > 0){
		$result = $result->fetch_assoc();
		echo json_encode(array('imgInfo'=>$result));
	}else{
		echo 2;
	}
}else{
	echo '0';
}
?>