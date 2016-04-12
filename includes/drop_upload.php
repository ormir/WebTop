<?php

$str =file_get_contents('php://input');
// echo "File :".$str;
$filename = md5(time()).'.jpg';
$path = '../upload/'.$filename;
file_put_contents($path,$str);
echo $path;

?>