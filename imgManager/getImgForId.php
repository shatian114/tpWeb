<?php
require_once '../dbInterface.php';
if(isset($_POST['imgId'])){
	$result = $db->query('select * from imgInfo where id="'.$_POST['imgId'].'"');
	if($result->num_rows > 0){
		$result = $result->fetch_assoc();
		echo json_encode(array('imgInfo'=>$result));
		//查找本图片是否被本用户看过
		$mem = memcache_connect('127.0.0.1', 11211);
		$memKey = $_SERVER['REMOTE_ADDR'].date('Ymd');
		//如果不存在，则将图片的id存到redis，并将本id的pv值加1
		$imgIdStr = memcache_get($mem, $memKey);
		if($imgIdStr===false){
			$nowTime = strtotime(date('Y-m-d h:i:sa'));
			$endTime = strtotime(date('Y-m-d').' 23:59:59');
			memcache_add($mem, $memKey, $_POST['imgId'], false, $endTime - $nowTime + 2);
			$db->query('update imgInfo set pvNum='.($result['pvNum']+1).' where id="'.$result['id'].'"');
		}elseif(strstr($imgIdStr, $_POST['imgId']) === false){
			$imgIdStr .= ' '.$_POST['imgId'];
			memcache_set($mem, $memKey, $imgIdStr, false);
			$db->query('update imgInfo set pvNum='.($result['pvNum']+1).' where id="'.$result['id'].'"');
		}
	}else{
		echo 2;
	}
}else{
	echo '0';
}
?>