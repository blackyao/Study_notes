<?php
//单例模式： 
//一个类只能有一个对象
class Student {
    // 私有静态单例属性 标识此单例的在内存中永远存在
    private static $instance;
    // 私有构造方法阻止类的实例化
    private function __construct()
    {
        
    }
    // 私有的__clone()来阻止在类的外部clone对象
    private function __clone()
    {
        
    }
    // 因为需要一个对象且不能被直接实例化获得，因此使用静态方法来实现这一个实例
    public static function getInstance() {
        // 判断$instance的值是否属于Student类的类型，不属于就进行实例化返回，否则直接返回
        if(!(self::$instance instanceof self))
            self::$instance = new self();
        return self::$instance;
    }

}

$stu1 = Student::getInstance();
$stu2 = Student::getInstance();
$stu3 = Student::getInstance();
var_dump($stu1, $stu2, $stu3);