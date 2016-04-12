<?php
/*$mem = memcache_connect('localhost', 11211);
memcache_add($mem, 'name', 'peng', false, 0);
var_dump(memcache_get($mem, 'name'));*/
$imgFolderIdStr = '1,2,3';
$imgFolderIdArr = array(1,2,3);
$imgFolderIdStr .= ','.($imgFolderIdArr[count($imgFolderIdArr)-1]+1);
echo $imgFolderIdStr;
?>