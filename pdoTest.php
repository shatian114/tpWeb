<?php
$db = new PDO('mysql:host=localhost;dbname=imgDb', 'peng', '456123');
$result = $db->query('select * from imgInfo');
echo $result->rowCount();
$row = $result->fetch();
//var_dump($row);
echo "<br />";
//$row = $result->fetch();
echo $row['id'];