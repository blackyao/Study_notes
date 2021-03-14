<?php
// require './nba.php';  //手动加载类
// require './nets.php';
// require './rocket.php';

// 自动加载类
// function __autoload($class_name) {
//     // require './'.$class_name.'.php';
//     require "./{$class_name}.php";
// }

// 注册加载类
/// 方法一：
// // 加载类函数
// function loadClass($class_name) {
//     require "./{$class_name}.php";
// }
// // // 注册加载类函数
// spl_autoload_register('loadClass');
/// 方法二：
//// 闭包在PHP5.3才引进
spl_autoload_register(function($class_name){
    require "./{$class_name}.php";
});

$nets = new Nets;
$nets->setPlayer("harden");
$rocket = new Rocket;
$rocket->setPlayer("house");
$nets->getPlayer();
$rocket->getPlayer();