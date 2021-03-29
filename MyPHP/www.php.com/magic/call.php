<?php
class Student {
    private $name;
    public function __call($name, $arguments)
    {
        echo "{$name}方法不存在<br>";
        echo "__call方法正在被执行<br>";
    }

    public static function __callStatic($name, $arguments)
    {
        echo "{$name}方法不存在<br>";
        echo "__callStatic方法正在被执行<br>";
    }
}

$stu = new Student;
$stu->show();  // 调用无法访问的方法时触发__call()
$stu::show();  // 调用无法访问的静态方法时触发__callStatic()