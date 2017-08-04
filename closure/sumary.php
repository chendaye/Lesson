<?php
<<<EOT
__invoke魔幻方法

这个魔幻方法被调用的时机是: 当一个对象当做函数调用的时候， 
如果对象定义了__invoke魔幻方法则这个函数会被调用， 这和C++中的操作符重载有些类似， 例如可以像下面这样使用:

<?php
class Callme {
    public function __invoke($phone_num) {
        echo "Hello: $phone_num";
    }
}

$call = new Callme();
$call(13810688888); // "Hello: 13810688888


匿名函数的实现

前面介绍了将对象作为函数调用的方法， 聪明的你可能想到在PHP实现匿名函数的方法了， PHP中的匿名函数就的确是通过这种方式实现的。我们先来验证一下:

<?php
$func = function() {
    echo "Hello, anonymous function";
}

echo gettype($func);    // object
echo get_class($func);  // Closure
原来匿名函数也只是一个普通的类而已

闭包函数也可以作为变量的值来使用。PHP 会自动把此种表达式转换成内置类 Closure 的对象实例。
把一个 closure 对象赋值给一个变量的方式与普通变量赋值的语法是一样的，最后也要加上分号


匿名函数（Anonymous functions），也叫闭包函数（closures），
允许 临时创建一个没有指定名称的函数。最经常用作回调函数（callback）参数的值。
Example #1 匿名函数示例，用作回调函数参数的值。

变量的作用域无非就是两种：全局变量和局部变量。

出于种种原因，我们有时候需要得到函数内的局部变量。

在上面的代码中，匿名函数f2就被包括在函数f1内部，这时f1内部的所有局部变量，
对f2都是选择可见的（关键词：use）。但是反过来就不行，f2内部的局部变量，对f1就是不可见的。
既然f2可以读取f1中的局部变量，那么只要把f2作为返回值，我们不就可以在f1外部读取它的内部变量了吗！
阮一峰老师从Javascriptd语言考虑，对闭包的理解的是：闭包就是能够读取其他函数内部变量的函数

最大用处有两个，一个是前面提到的可以读取函数内部的变量，另一个就是让这些变量的值始终保持在内存中

function f1() {
        $n = 2;
        $f2 = function () use($n) {
            return $n;
        };
        return  $f2;
}
var_dump($n);
//null
$f = f1();
var_dump($f());
EOT;
