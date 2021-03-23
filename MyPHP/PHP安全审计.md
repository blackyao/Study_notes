# PHP代码审计

[一周速成笔记](https://github.com/Ming-Lian/Memo/blob/master/%E5%AD%A6%E4%B9%A0%E7%AC%94%E8%AE%B0%EF%BC%9APHP%E4%B8%80%E5%91%A8%E9%80%9F%E6%88%90.md#content)

## 基础知识

### 魔术变量

魔术方法/魔术变量都是随着不同环境可变的，跟变魔术一样

PHP 向它运行的任何脚本提供了大量的预定义常量。

不过很多常量都是由不同的扩展库定义的，只有在加载了这些扩展库时才会出现，或者动态加载后，或者在编译时已经包括进去了。

有八个魔术常量它们的值随着它们在代码中的位置改变而改变。

| 变量          | 解释                                                         |
| ------------- | ------------------------------------------------------------ |
| __LINE__      | 文件中的当前行号                                             |
| __FILE__      | 文件的完整路径和文件名。如果用在被包含文件中，则返回被包含的文件名 |
| __DIR__       | 文件所在的目录。如果用在被包括文件中，则返回被包括的文件所在的目录 |
| __FUNCTION__  | 函数名称                                                     |
| __CLASS__     | 类的名称，本常量返回该类被定义时的名字（区分大小写）         |
| __TRAIT__     | Trait 的名字                                                 |
| __METHOD__    | 类的方法名，返回该方法被定义时的名字（区分大小写）           |
| __NAMESPACE__ | 当前命名空间的名称（区分大小写）。此常量是在编译时定义的     |

### 超级全局变量

PHP中预定义了几个超级全局变量（superglobals） ，这意味着它们在一个脚本的全部作用域中都可用

- **$GLOBALS**

$GLOBALS 是一个包含了全部变量的全局组合数组。变量的名字就是数组的键。

```
<?php 
$x = 75; 
$y = 25;
 
function addition() 
{ 
    $GLOBALS['z'] = $GLOBALS['x'] + $GLOBALS['y']; 
}
 
addition(); 
echo $z; 
?>
```

- **$_SERVER**

$_SERVER 是一个包含了诸如**头信息(header)、路径(path)、以及脚本位置(script locations)**等等信息的数组。这个数组中的项目由 Web 服务器创建。不能保证每个服务器都提供全部项目；服务器可能会忽略一些，或者提供一些没有在这里列举出来的项目。

| 元素/代码                       | 描述                                                         |
| ------------------------------- | ------------------------------------------------------------ |
| $_SERVER['PHP_SELF']            | 当前执行脚本的文件名，与 document root 有关。例如，在地址为 http://example.com/test.php/foo.bar 的脚本中使用 $_SERVER['PHP_SELF'] 将得到 /test.php/foo.bar。**FILE** 常量包含当前(例如包含)文件的完整路径和文件名。 从 PHP 4.3.0 版本开始，如果 PHP 以命令行模式运行，这个变量将包含脚本名。之前的版本该变量不可用。 |
| $_SERVER['GATEWAY_INTERFACE']   | 服务器使用的 CGI 规范的版本；例如，"CGI/1.1"。               |
| $_SERVER['SERVER_ADDR']         | 当前运行脚本所在的服务器的 IP 地址。                         |
| $_SERVER['SERVER_NAME']         | 当前运行脚本所在的服务器的主机名。如果脚本运行于虚拟主机中，该名称是由那个虚拟主机所设置的值决定。(如: [www.runoob.com](http://www.runoob.com/)) |
| $_SERVER['SERVER_SOFTWARE']     | 服务器标识字符串，在响应请求时的头信息中给出。 (如：Apache/2.2.24) |
| $_SERVER['SERVER_PROTOCOL']     | 请求页面时通信协议的名称和版本。例如，"HTTP/1.0"。           |
| $_SERVER['REQUEST_METHOD']      | 访问页面使用的请求方法；例如，"GET", "HEAD"，"POST"，"PUT"。 |
| $_SERVER['REQUEST_TIME']        | 请求开始时的时间戳。从 PHP 5.1.0 起可用。 (如：1377687496)   |
| $_SERVER['QUERY_STRING']        | query string（查询字符串），如果有的话，通过它进行页面访问。 |
| $_SERVER['HTTP_ACCEPT']         | 当前请求头中 Accept: 项的内容，如果存在的话。                |
| $_SERVER['HTTP_ACCEPT_CHARSET'] | 当前请求头中 Accept-Charset: 项的内容，如果存在的话。例如："iso-8859-1,*,utf-8"。 |
| $_SERVER['HTTP_HOST']           | 当前请求头中 Host: 项的内容，如果存在的话。                  |
| $_SERVER['HTTP_REFERER']        | 引导用户代理到当前页的前一页的地址（如果存在）。由 user agent 设置决定。并不是所有的用户代理都会设置该项，有的还提供了修改 HTTP_REFERER 的功能。简言之，该值并不可信。) |
| $_SERVER['HTTPS']               | 如果脚本是通过 HTTPS 协议被访问，则被设为一个非空的值。      |
| $_SERVER['REMOTE_ADDR']         | 浏览当前页面的用户的 IP 地址。                               |
| $_SERVER['REMOTE_HOST']         | 浏览当前页面的用户的主机名。DNS 反向解析不依赖于用户的 REMOTE_ADDR。 |
| $_SERVER['REMOTE_PORT']         | 用户机器上连接到 Web 服务器所使用的端口号。                  |
| $_SERVER['SCRIPT_FILENAME']     | 当前执行脚本的绝对路径。                                     |
| $_SERVER['SERVER_ADMIN']        | 该值指明了 Apache 服务器配置文件中的 SERVER_ADMIN 参数。如果脚本运行在一个虚拟主机上，则该值是那个虚拟主机的值。(如：[someone@runoob.com](mailto:someone@runoob.com)) |
| $_SERVER['SERVER_PORT']         | Web 服务器使用的端口。默认值为 "80"。如果使用 SSL 安全连接，则这个值为用户设置的 HTTP 端口。 |
| $_SERVER['SERVER_SIGNATURE']    | 包含了服务器版本和虚拟主机名的字符串。                       |
| $_SERVER['PATH_TRANSLATED']     | 当前脚本所在文件系统（非文档根目录）的基本路径。这是在服务器进行虚拟到真实路径的映像后的结果。 |
| $_SERVER['SCRIPT_NAME']         | 包含当前脚本的路径。这在页面需要指向自己时非常有用。**FILE** 常量包含当前脚本(例如包含文件)的完整路径和文件名。 |
| $_SERVER['SCRIPT_URI']          | URI 用来指定要访问的页面。例如 "/index.html"。               |

- **$_REQUEST**

PHP $_REQUEST 用于收集HTML表单提交的数据。

```
<html>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
Name: <input type="text" name="fname">
<input type="submit">
</form>

<?php
$name = $_REQUEST['fname'];
echo $name;
?>

</body>
</html>
```

当用户通过点击 "Submit" 按钮提交表单数据时, 表单数据将发送至``标签中 action 属性中指定的脚本文件。 `$_SERVER['PHP_SELF']`说明指定的脚本文件为当前脚本文件。

想了解更多关于html中的表单知识，请点 [这里](http://www.w3school.com.cn/html/html_forms.asp)

- **$_POST**

$_POST 被广泛应用于收集表单数据，在HTML form标签的指定该属性："method="post"。

```
<html>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
Name: <input type="text" name="fname">
<input type="submit"》
</form>

<?php
$name = $_POST['fname'];
echo $name;
?>

</body>
</html>
```

- **$_GET**

$_GET 同样被广泛应用于收集表单数据，在HTML form标签的指定该属性："method="get"。

$_GET 也可以收集URL中发送的数据。

> \1. 在web服务器的对应目录下创建`get_test.php`文件
>
> ```
> <html>
> <body>
> 
> <?php
> echo "Study " . $_GET['subject'] . " at " . $_GET['web'];
> ?>
> 
> </body>
> </html>
> ```
>
> \2. 用URL向`get_test.php`文件发送的数据。
>
> 在浏览器地址栏输入`ip:port/learningPHP/your_dir/get_test.php?subject=PHP&web=runoob.com`
>
> 得到输出：`Study PHP at runoob.com`

### 字符串/数组操作函数

```
strlen( )：返回字符串的长度（字符数）

strpos( )：用于在字符串内查找一个字符或一段指定的文本

sort() - 对数组进行升序排列
rsort() - 对数组进行降序排列
asort() - 根据关联数组的值，对数组进行升序排列
ksort() - 根据关联数组的键，对数组进行升序排列
arsort() - 根据关联数组的值，对数组进行降序排列
krsort() - 根据关联数组的键，对数组进行降序排列
```

### 命名空间

PHP 命名空间可以解决以下两类问题：

- 用户编写的代码与PHP内部的类/函数/常量或第三方类/函数/常量之间的名字冲突。
- 为很长的标识符名称(通常是为了缓解第一类问题而定义的)创建一个别名（或简短）的名称，提高源代码的可读性。

命名空间通过关键字namespace 来声明，**命名空间必须是程序脚本的第一条语句**

```
<?php  
// 定义代码在 'MyProject' 命名空间中  
namespace MyProject;  
 
// ... 代码 ...  
```

可以在同一个文件中定义不同的命名空间代码

```
<?php
namespace MyProject {
    const CONNECT_OK = 1;
    class Connection { /* ... */ }
    function connect() { /* ... */  }
}

namespace AnotherProject {
    const CONNECT_OK = 1;
    class Connection { /* ... */ }
    function connect() { /* ... */  }
}
?>
```

将**全局的非命名空间**中的代码与**命名空间**中的代码组合在一起，只能使用大括号形式的语法。全局代码必须用一个不带名称的 namespace 语句加上大括号括起来

```php
<?php
namespace MyProject {

const CONNECT_OK = 1;
class Connection { /* ... */ }
function connect() { /* ... */  }
}

namespace { // 全局代码
session_start();
$a = MyProject\connect();
echo MyProject\Connection::start();
}
?>
```

在声明命名空间之前唯一合法的代码是用于定义源文件编码方式的 declare 语句。所有非 PHP 代码包括空白符都不能出现在命名空间的声明之前。

```php
<?php
declare(encoding='UTF-8'); //定义多个命名空间和不包含在命名空间中的代码
namespace MyProject {

const CONNECT_OK = 1;
class Connection { /* ... */ }
function connect() { /* ... */  }
}

namespace { // 全局代码
session_start();
$a = MyProject\connect();
echo MyProject\Connection::start();
}
?>
```



#### 子命名空间



与目录和文件的关系很象，PHP 命名空间也允许指定层次化的命名空间的名称。因此，命名空间的名字可以使用分层次的方式定义：

```
<?php
namespace MyProject\Sub\Level;  //声明分层次的单个命名空间

const CONNECT_OK = 1;
class Connection { /* ... */ }
function Connect() { /* ... */  }

?>
```

上面的例子创建了常量 MyProject\Sub\Level\CONNECT_OK，类 MyProject\Sub\Level\Connection 和函数 MyProject\Sub\Level\Connect。



#### 命名空间使用 



PHP 命名空间中的类名可以通过三种方式引用

- 非限定名称，或不包含前缀的类名称

例如 $a=new foo(); 或 foo::staticmethod();。如果当前命名空间是 currentnamespace，foo 将被解析为 currentnamespace\foo。如果使用 foo 的代码是全局的，不包含在任何命名空间中的代码，则 foo 会被解析为foo。

- 限定名称,或包含前缀的名称

例如 $a = new subnamespace\foo(); 或 subnamespace\foo::staticmethod();。如果当前的命名空间是 currentnamespace，则 foo 会被解析为 currentnamespace\subnamespace\foo。如果使用 foo 的代码是全局的，不包含在任何命名空间中的代码，foo 会被解析为subnamespace\foo。

- 完全限定名称，或包含了全局前缀操作符的名称

例如， $a = new \currentnamespace\foo(); 或 \currentnamespace\foo::staticmethod();。在这种情况下，foo 总是被解析为代码中的文字名(literal name)currentnamespace\foo。

### 面向对象

三大特性

* 封装：有选择性地提供数据，通过访问修饰符（private/protected/public）来实现
* 继承：extends关键字
  * PHP不允许多重继承，(继承多个父亲)
  * 私有属性可以继承但不能被重写
* 多态：多种形态，分为**方法重写和方法重载**
  * 方法重写：子类重写了父类的同名的方法
  * 方法重载：同个类中不同参数类型或数量的同名方法

1. **对象是由属性和方法组成的**
2. **类是所有对象的相同属性和方法的集合**
3. **在开发的时候先写类，通过类创建对象，通过对象调用方法和属性**
4. **一个类可以创建多个对象**

```php
class Student {

}
// 实例化对象
$stu1 = new Student(); //括号可以省略，类名大小写不敏感
$stu2 = new Student;
$stu3 = $stu2; //对象传递的是地址
var_dump($stu1, $stu2, $stu3); 
//object(Student)#1 (0) { } object(Student)#2 (0) { } object(Student)#2 (0) { }
var_dump($stu1 == $stu2);
var_dump($stu1 === $stu2);
var_dump($stu3 === $stu2); //全等
//bool(true) bool(false) bool(true)
```

#### 访问控制修饰符

> - public（公有）：公有的类成员可以在任何地方被访问。
> - protected（受保护）：受保护的类成员则可以被其自身以及其子类和父类访问（继承链）。
> - private（私有）：私有的类成员则只能被其定义所在的类访问。

一般情况下，属性都是私有的，通过对象的公有方法来赋值或取值

#### 类和对象的内存中的分布

```php
class Student {
    public $name;
    public $sex;
    public function show()
    {
        echo "OOP!";
    }
}

$stu1 = new Student();
$stu2 = new Student;
$stu2->show();
```

1. **对象本质是一个复杂的变量**
2. **类的本质是一个自定义的复杂数据类型**
3. **栈小堆大，栈速度快堆慢**
4. **实例化的过程就是分配内存空间的过程**
5. **对象保存在堆区，将堆区的地址保存在栈区**，==方法依然在代码区==

![img](https://gitee.com/f4ke/MarkDownImg/raw/master/static/20210303164432.png)



#### 构造方法与析构方法

* 构造方法：主要用来在创建对象时初始化对象，即为对象成员变量赋初始值
* 析构方法：当对象结束其生命周期时，系统自动执行析构函数。

```php
class Student {
    public $name;
    public $sex;
    // 构造方法
    public function __construct($name)
    {
        $this->name = $name;  //$this代表对当前对象的引用
        echo "{$name}出生了！<br>";
    }
    // 析构方法
    public function __destruct()
    {
        echo "{$this->name}去世了.-.";
    }
}
// 对象实例化
$stu1 = new Student("wan");
// 运行
//wan出生了！
//wan去世了.-.
```

#### 继承中的构造函数

```php
class Person {
    public function __construct()
    {
        echo "这是父类.<br>";   
    }
}

class Student extends Person {
    public function __construct()
    {
        echo "这是子类.<br>";   
        Person::__construct(); // 掉用父类的构造函数
        parent::__construct(); // parent关键字代指父类类名，降低耦合性
    }
}
// 对象实例化
$stu1 = new Student();
// 输出
这是子类.
这是父类.
这是父类.
```

实际应用：

```php
class Person{
    protected $age;
    public function __construct($age)
    {
        $this->age = $age;  
    }
}

class Student extends Person{
    public $name;
    public $sex;
    public function __construct($name, $sex, $age)
    {
        $this->name = $name;
        $this->sex = $sex;
        parent::__construct($age);  //调用父类的构造函数
    }

    public function getInfo()
    {
        echo "姓名：{$this->name}<br>";
        echo "性别：{$this->sex}<br>";
        echo "年龄：{$this->age}";
    }
}
// 对象实例化
$stu1 = new Student('yao', 'man' ,88);
$stu1->getInfo();
```

#### 方法修饰符

多个修饰符之间没有先后顺序

* ==static==：静态（内存中仅一份），两个作用
  * 表示静态
  * static代表当前对象所属的类

```php
static::属性/方法名  //static代表当前对象所属的类
$this->属性/方法名   //$this代表当前对象
self::属性/方法名    //self总是表示当前类的类名
```

* ==final==：最后的
  * final修饰的方法不能被重写
  * final修饰的类不能被继承

* ==abstract== 作用：**定义命名规范 / 阻止实例化**
  * 抽象类不允许实例化
  * 若要继承抽象类，必须重写抽象父类中的所有抽象方法
  * 抽象方法必须重写

```php
abstract class Person {
    public abstract function setInfo();
    public function getInfo()
    {
        echo "抽象方法<br>";
    }
}

class Student extends Person {
    public function setInfo()
    {
        echo "重写父类抽象方法<br>";
    }
}

//实例化
$stu = new Student;
$stu->setInfo();
$stu->getInfo();
```

#### 类常量

```php
class Student {
    public const SSS='lll';
}
// 访问类常量
echo Student::SSS;
```

#### 接口

* 接口是一种特殊的抽象类，接口中全都是抽象方法
* 接口允许多重实现
* 类可以继承的同时实现接口

```php
// 定义接口
interface Person{
    const NAME = "f4ke";
    function fun();  // 抽象方法
}

// 接口实现
class Student implements Person {
    public function fun(){

    }
}

// 访问接口常量
echo Person::NAME;
```

#### 异常处理

```php
try:监测代码块
catch:捕获异常
throw:抛出异常
finally:无论有无异常均执行，可省略
Exception:所有异常的基类
Exception {

/* 属性 */

protected string $message;

protected int $code;

protected string $file;

protected int $line;

/* 方法 */

public __construct([ string $message = ""[, int $code = 0[, Throwable $previous = NULL]]] )

final public getMessage( void) : string

final public getPrevious( void) : Throwable

final public getCode( void) : int

final public getFile( void) : string

final public getLine( void) : int

final public getTrace( void) : array

final public getTraceAsString( void) : string

public __toString( void) : string

final private __clone( void) : void
}
```

```php
try {
    //code...
} catch (\Throwable $th) {
    //throw $th;
}
finally{
    
}
```

例子：

```php+HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

if(isset($_POST['button'])){
    $age = $_POST['age'];
    try {
        if($age == '')
            throw new Exception('年龄不能为空');
        if(!(is_numeric($age)))
            throw new Exception('年龄只能是数字');
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
    finally{
        echo "都输出";
    }
}

?>

<form action="" method="post">
    年龄：<input type="text" name="age"> <br />
    <input type="submit" name="button" value="提交">
</form>
</body>
</html>
```

#### 自动加载类

当缺少类的时候自动调用`__autoload()`函数，并且将缺少的类名作为参数传递给`__autoload()`

```php
__autoload — 尝试加载未定义的类  // 7.2以后废弃

spl_autoload_register()   // 5.1版本新增
```

手动加载类

```php
// Nba.php
<?php
abstract class Nba {
    protected $player;
    final public function setPlayer($player){
        $this->player = $player;
    }
    public abstract function getplayer();
}

// Nets.php
<?php
class Nets extends Nba {
    protected $player;
    public function getPlayer()
    {
        echo $this->player."<br>";
    }
}

// Rocket.php
<?php
class Rocket extends Nba {
    protected $player;
    public function getPlayer()
    {
        echo $this->player."<br>";
    }
}

// test.php
<?php
require './Nba.php';  //手动加载类
require './Nets.php';
require './Rocket.php';

$nets = new Nets;
$nets->setPlayer("harden");
$rocket = new Rocket;
$rocket->setPlayer("house");
$nets->getPlayer();
$rocket->getPlayer();

// 结果
harden
house
```

自动加载类

```php
<?php
// require './nba.php';  //手动加载类
// require './nets.php';
// require './rocket.php';

// 自动加载类
function __autoload($class_name) {
    // require './'.$class_name.'.php';
    require "./{$class_name}.php";
}

$nets = new Nets;
$nets->setPlayer("harden");
$rocket = new Rocket;
$rocket->setPlayer("house");
$nets->getPlayer();
$rocket->getPlayer();
```

注册加载类

```php
// 注册加载类
/// 方法一：
// // 加载类函数
function loadClass($class_name) {
    require "./{$class_name}.php";
}
// // 注册加载类函数
spl_autoload_register('loadClass');
/// 方法二：
//// 闭包在PHP5.3才引进
spl_autoload_register(function($class_name){
    require "./{$class_name}.php";
});
```

#### 创建对象的方式

>* 实例化
>* 克隆
>  * clone
>  * __clone()

```php
class Student{
    public function __clone()
    {
        echo "正在克隆对象";
    }
}

$stu1 = new Student;
$stu2 = clone $stu1;  // 执行clone指令时自动调用__clone()方法
var_dump($stu1, $stu2);
```

## 设计模式

### 单例模式

特征：一个类只能有一个对象

>三私一公：
>
>* **私有静态单例属性 标识此单例的在内存中唯一存在**
>* **私有构造方法阻止类的实例化**
>* **私有的__clone()来阻止在类的外部clone对象**
>* **公有静态方法来实现这个实例**

```php
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
```

![image-20210323171029944](https://gitee.com/f4ke/MarkDownImg/raw/master/static/20210323171038.png)

### 工厂模式

特征：传递不同的参数，获取不同的对象

```php
<?php

class productsA{

}

class productsB{

}

class productFactory{
    public function getproduct($num){
        switch ($num) {
            case 1:
                return new productsA;
            case 2:
                return new productsB;
            default:
                return null;
        }
    }
}

$factory = new productFactory();
$pro1 = $factory->getproduct(1);
$pro2 = $factory->getproduct(2);
var_dump($pro1, $pro2);
```

![image-20210323173647727](https://gitee.com/f4ke/MarkDownImg/raw/master/static/20210323173648.png)

### 策略模式

特征：传递不同的参数执行不同的策略（方法）

## php序列化

主观理解：**序列化是为了方便对象的传递，节省资源，把对象序列化为一个字符串进行存储，需要用到的时候再反序列化为对象，序列化和反序列化的过程中会自带很多魔术方法，当某个魔术方法被用户输入可控时，就有可能存在反序列化漏洞**

### 常见魔术方法

```php
__construct()         //创建对象时触发
__destruct()          //对象被销毁时触发
__wakeup()			//使用unserialize时触发，醒来
__sleep()			//使用serialize时触发，睡去
__toString()		//把类当作字符串使用时触发
__call()              //在对象上下文中调用不可访问的方法时触发
__callStatic()        //在静态上下文中调用不可访问的方法时触发
__get()               //用于从不可访问的属性读取数据
__set()               //用于将数据写入不可访问的属性
__isset()             //在不可访问的属性上调用isset()或empty()触发
__unset()             //在不可访问的属性上使用unset()时触发
__invoke()            //当脚本尝试将对象调用为函数时触发
```



测试魔术方法触发顺序

```php
<?php

class Test {
    public $name = "f4ke";
    public $passwd = "123456";

    function __construct()
    {
        echo "function __construct is running!"."<br />";
    }

    function __sleep()
    {
        echo "function __sleep is running!"."<br />";
        return array();
    }

    function __wakeup()
    {
        echo "function __wakeup is running!"."<br />";
    }

    function __destruct()
    {
        echo "function __destruct is running!"."<br />";
    }
}

$obj = new Test();
$str = serialize($obj);
$obj2 = unserialize($str);
//print_r($str);
```

![image-20200427151231763](https://i.loli.net/2020/04/28/mRv317Jqls652Zj.png)



## php文件操作

[文件包含漏洞与php伪协议](https://www.smi1e.top/%E6%96%87%E4%BB%B6%E5%8C%85%E5%90%AB%E6%BC%8F%E6%B4%9E%E4%B8%8Ephp%E4%BC%AA%E5%8D%8F%E8%AE%AE/)



## php表单操作

php版本特性？

php7.2中有哪些安全特性？



## php数据库操作

php代码审计 常见CMS?



## MVC框架



## 代码审计

### trim -> 去除首位空白符

```php
trim( string $str[, string $character_mask = " \t\n\r\0\x0B"] ) : string
```

此函数返回字符串 `str` 去除首尾空白字符后的结果。如果不指定第二个参数，**trim()** 将去除这些字符：       

- " " (ASCII *32*       (*0x20*))，普通空格符。           
- "\t" (ASCII *9*       (*0x09*))，制表符。           
- "\n" (ASCII *10*       (*0x0A*))，换行符。           
- "\r" (ASCII *13*       (*0x0D*))，回车符。           
- "\0" (ASCII *0*       (*0x00*))，空字节符。           
- "\x0B" (ASCII *11*       (*0x0B*))，垂直制表符。

### extract -> 变量覆盖

```php
extract( array &$array[, int $flags = EXTR_OVERWRITE[, string $prefix = NULL]] ) : int
```

本函数用来将变量从数组中导入到当前的符号表中。   (数组转化为变量)

检查每个键名看是否可以作为一个合法的变量名，同时也检查和符号表中已有的变量名的冲突。

### md5/sha1

```php
$test1 = 'QNKCDZO';
$test2 = '240610708';
$test = 's878926199a';
$test3 = 's155964671a';
$test4 = 's214587387a';
$test5 ='s214587387a';
echo md5($test);
//0e545993274517709034328855841020

sha1('aaroZmOk')  
sha1('aaK1STfY')
sha1('aaO8zKZF')
sha1('aa3OFF9m')
   
本质：NULL==FALSE==0
```

# AdaptCMS 4.0

[Yii 框架](http://www.yiiframework.com/)

laaval

thinkphp

