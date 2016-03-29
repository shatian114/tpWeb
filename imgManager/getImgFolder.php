<?php
require_once '../dbInterface.php';
if(isset($_POST['userId'])){
	$result = $db->query('select * from imgFolderInfo where id like "'.$_POST['userId'].'%"');
	$imgFolderNum = $result->num_rows;
	$imgFolderArr = array();
	for($i=0; $i<$imgFolderNum; $i++){
		$imgFolderArr[$i] = $result->fetch_assoc();
	}
	echo json_encode(array('imgFolderNum'=>$imgFolderNum, 'imgFolderArr'=>$imgFolderArr));
}else{
	echo '0';
}
?>