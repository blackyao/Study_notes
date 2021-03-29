<?php
error_reporting(0);

function add($x,$y)
{
    $total=$x+$y;
    return $total;
}

$a = $_REQUEST['a'];
$b = $_REQUEST['b'];

if(isset($a) && isset($b)){
    echo "$a + $b = " . add($a,$b);
}else{
    echo "www.sqlsec.com";
}
// phpinfo();
?>