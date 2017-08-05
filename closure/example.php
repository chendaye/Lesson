<?php
//闭包是什么 举个栗子
//还可以传入参数
$fun = function ($a){
    echo $a;
};
$fun(666);
//实际上闭包就是 一个类的实例 Closure
echo gettype($fun);
echo get_class($fun);

//函数内部执行匿名函数  可以把匿名函数返回
function fun1($a = ''){
    $closure = function ($b){
        echo $b;
    };
   // $closure($a);
    return $closure;
}

fun1(777);
$closure = fun1();
$closure(999);

//也可以把闭包作为参数传递

function fun2($closure){
    $closure();
}

fun2(function (){
    echo 8888;
});


//use 关键字 调用所在代码块的上下文变量，而需要通过使用use关键字
function fun3(){
    $a = 1;
    $closure = function ($b) use($a){
        echo $b + $a;
    };

    $closure(2);
}
fun3();

//要完全引用变量，而不是复制，在变量前加一个 & 符号
function fun4(){
    $a = 1;
    $closure = function ()use(&$a){
        $a++;
    };
    $closure();
    echo $a;
}

fun4();