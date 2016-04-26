<?php
/*$mem = memcache_connect('localhost', 11211);
memcache_add($mem, 'name', 'peng', false, 0);
var_dump(memcache_get($mem, 'name'));*/
$tagArr = array('0'=>'asd', '1'=>'werw');
$json = json_encode(array('tagNum'=>'5', 'tagArr'=>$tagArr));
var_dump($json);
?>