<?php
require_once '../dbInterface.php';
if(isset($_SESSION['uid']) && isset($_POST['remarkName']) && isset($_POST['headerImgUrl']) && isset($_POST['sex']) && isset($_POST['address']) && isset($_POST['identityNum']) && isset($_POST['mobilePhone']) && isset($_POST['bornDate']) && isset($_POST['alipay'])){
	$result = $db->query('update user set remarkName="'.$_POST['remarkName'].'", sex="'.$_POST['sex'].'", address="'.$_POST['address'].'", identityNum="'.$_POST['identityNum'].'", mobilePhone="'.$_POST['mobilePhone'].'", bornDate="'.$_POST['bornDate'].'", headerImgUrl="'.$_POST['headerImgUrl'].'", alipay="'.$_POST['alipay'].'", realName="'.$_POST['realName'].'", nickName="'.$_POST['nickName'].'" where id='.$_SESSION['uid']);
	echo $result ? '1' : '2';
}else{
	echo '0';
}
?>