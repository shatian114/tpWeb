<?php
//获取相册里的全部图片
require_once '../dbInterface.php';
if(isset($_POST['imgFolderId'])){
	$result = $db->query('select * from imgInfo where id like "'.$_POST['imgFolderId'].'%"');
	if($result->num_rows > 0){
		$imgNum = $result->num_rows;
		$imgArr = array();
		for($i=0; $i<$imgNum; $i++){
			$imgArr[$i] = $result->fetch_assoc();
		}
		echo json_encode(array('imgNum'=>$imgNum, 'imgArr'=>$imgArr));
		//判断用户是否看过本相册，没看过则加pv
		$mem = memcache_connect('127.0.0.1', 11211);
		$memKey = $_SERVER['REMOTE_ADDR'].date('Ymd');
		$imgFolderIdStr = memcache_get($mem, $memKey);
		if($imgFolderIdStr === false){
			$nowTime = strtotime(date('Y-m-d h:i:sa'));
			$endTime = strtotime(date('Y-m-d').' 23:59:59');
			$result = $db->query('select pvNum from imgFolderInfo where id="'.$_POST['imgFolderId'].'"')->fetch_assoc();
			$imgFolderIdStr = $_POST['imgFolderId'];
			memcache_add($mem, $memKey, $imgFolderIdStr, false, $endTime - $nowTime + 2);
			$db->query('update imgFolderInfo set pvNum='.($result['pvNum']+1).' where id="'.$_POST['imgFolderId'].'"');
		}elseif(strstr($imgFolderIdStr, $_POST['imgFolderId']) === false){
			$result = $db->query('select pvNum from imgFolderInfo where id="'.$_POST['imgFolderId'].'"')->fetch_assoc();
			$imgFolderIdStr .= ' '.$_POST['imgFolderId'];
			memcache_set($mem, $memKey, $imgFolderIdStr, false, 0);
			$db->query('update imgFolderInfo set pvNum='.($result['pvNum']+1).' where id="'.$_POST['imgFolderId'].'"');
		}
	}else{
		echo '2';
	}
}else{
	echo '0';
}
?>