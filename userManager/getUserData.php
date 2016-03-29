<?php
require_once '../dbInterface.php';
$result = $db->query('select * from user where id='.$_SESSION['uid'])->fetch_assoc();
unset($result['password']);
echo json_encode($result);
?>