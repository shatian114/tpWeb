<?php
require_once '../dbInterface.php';
if(isset($_POST['sameTag'])){
	$result = $db->query('select * from imgFolderInfo where tag like "% '.$_POST['sameTag'].' %"');
	$imgFolderNum = $result->rowCount();
	$imgFolderArr = array();
	for($i=0; $i<$imgFolderNum; $i++){
		$imgFolderArr[$i] = $result->fetch();
	}
	echo json_encode(array('imgFolderNum'=>$imgFolderNum, 'imgFolderArr'=>$imgFolderArr));
}else{
	echo '0';
}
?>