<?php
/*$mem = memcache_connect('localhost', 11211);
memcache_add($mem, 'name', 'peng', false, 0);
var_dump(memcache_get($mem, 'name'));*/
$str = '1_0_0';
echo (explode('_', $str))[0];
?>