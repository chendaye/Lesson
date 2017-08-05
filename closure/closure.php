<?php
//什么是闭包
$fun = function($var){
    echo $var;
};
$fun('long shen!');

echo gettype($fun);    // object
echo get_class($fun);  // Closure

//实现闭包
//例一
//在函数里定义一个匿名函数，并且调用它
function exp_one($v){
    $fun_one = function($var){
        echo $var;
    };
    $fun_one($v);
}
exp_one('在函数里定义一个匿名函数，并且调用它！');


//例二
//在函数中把匿名函数返回，并且调用它
function exp_two(){
    $fun = function($var){
        echo $var;
    };
    return $fun;	//返回匿名函数
}

$fun = exp_two();
$fun('返回匿名函数，并且调用它！');


//例三
//把匿名函数当做参数传递，并且调用它
$fun = function($var){	//定义匿名函数，相当于是变量
    echo $var;
};

function exp_three($fun, $parm){	//匿名函数作为参数，不妨把匿名函数看做是特殊的可以执行的变量
    $fun($parm);
}
exp_three($fun,'把匿名函数当做参数传递，并且调用它！');
exp_three(function($var){echo $var;}, '也可以直接将匿名函数进行传递。');



//例四
// 连接闭包和外界变量的关键字：USE
// 闭包可以保存所在代码块上下文的一些变量和值。PHP在默认情况下，匿名函数不能调用所在代码块的上下文变量，而需要通过使用use关键字。
function exp_four(){
    $rmb = '连接闭包和外界变量的关键字：USE';
    $us = '闭包可以保存所在代码块上下文的一些变量和值。
    PHP在默认情况下，匿名函数不能调用所在代码块的上下文变量，而需要通过使用use关键字。';
    $fun = function() use ($rmb,$us) {
        echo $rmb;
        echo $us;
    };
    $fun();
}
exp_four();


//例五
//不可以可以在匿名函数中改变上下文的变量，use所引用的是变量的一个副本，而非变量本身
function exp_five(){
    $a = 1;
    $fun = function() use ($a) {
        $a = $a + 1;
    };
    $fun();
    echo $a;
}
exp_five();	//结果是：1


//例六
//要完全引用变量，而不是复制，在变量前加一个 & 符号
function exp_six(){
    $a = 1;
    $fun = function() use (&$a) {
        $a = $a + 1;
    };
    $fun();
    echo $a;
}
exp_six();	//结果是：2


//例七
//这样匿名函数就可以引用上下文的变量了。
//如果将匿名函数返回给外界，匿名函数会保存use所引用的变量，而外界则不能得到这些变量，这样形成‘闭包'这个概念可能会更清晰一些。
function exp_sen(){
    $a = 0;
    $fun = function() use (&$a) {
        $a++;
        echo $a;
    };
    return $fun;
}
$fun = exp_sen();
$fun();	//输出：1
$fun();	//输出：2
$fun();	//输出：3
?>
