<?php
// $palyer = ['harden', 'james', '077'];
// $palyer = serialize($palyer);
// file_put_contents('./palyer.txt', $palyer);

//a:3:{i:0;s:6:"harden";i:1;s:5:"james";i:2;s:3:"077";}

$str_palyer = file_get_contents('./palyer.txt');
echo $str_palyer.'<br>';
$palyer = unserialize($str_palyer);
var_dump($palyer);

