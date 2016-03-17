<?php
$db = new mysqli('localhost', 'peng', '456123', 'imgDb');
if($db->connect_error){
	die($db->connect_errno);
}
?>