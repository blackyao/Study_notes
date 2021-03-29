<?php
// class Nets {
//     public $name;
//     protected $age;
//     private $country;
//     public function __construct($name, $age, $country)
//     {
//         $this->name = $name;
//         $this->age = $age;
//         $this->country = $country;
//     }
// }

// $harden = new Nets('harden', 31, 'USA');
// $str_harden = serialize($harden);
// // echo '<pre>';
// echo $str_harden;
// file_put_contents('./nets.txt', $str_harden);
// // O:4:"Nets":3:{s:4:"name";s:6:"harden";s:6:"*age";i:31;s:13:"Netscountry";s:3:"USA";}

$str_harden = file_get_contents('./nets.txt');
$harden = unserialize($str_harden);
echo '<pre>';
var_dump($harden);