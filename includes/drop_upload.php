<?php
$str =file_get_contents('php://input');
$filename = md5(time()).'.jpg';
file_put_contents('../upload/'.$filename,$str);
echo 'upload/'.$filename;;

?>