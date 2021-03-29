<?php
class Student {
    private $name;
    private $age;
    private $address;

    public function __toString()
    {
        return "__toString方法正在执行<br>";
    }

    public function __invoke()
    {
        echo "__invoke方法正在执行<br>";
    }
    public function __set($k, $v)
    {
        $this->$k = $v;
        echo "__set方法正在执行<br>";
    }

    public function __get($k){
        echo "__get方法正在执行<br>";
        return $this->$k.'<br>';
    }

    public function __isset($k)
    {
        echo "__isset方法正在执行<br>";
        return isset($this->$k);
    }

    public function __unset($k)
    {
        unset($this->$k);
        echo "__unset方法正在执行<br>";
    }

}

$stu = new Student;
echo $stu;              // 把对象当作字符串使用时触发 __toString()
$stu();                 // 把对象当作函数使用时触发 __invoke()
$stu->name = 'harden';  // 将数据写入无法访问的属性时触发 __set()
echo $stu->name;        // 访问无法访问的属性时触发 __get()
var_dump(isset($stu->name));    //在不可访问的属性上调用isset()时触发 __isset()
unset($stu->name);     // 在不可访问的属性上调用unset()时触发__unset()