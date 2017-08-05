<?php
/**
 * PHP的类无法同时从两个基类继承属性或方法。php的Traits和Go语言的组合功能类似，
 * 通过在类中使用use关键字声明要组合的Trait名称，而具体某个Trait的声明使用trait关键词，Trait不能直接实例化
 */
$A = new \traits\A();

// A  继承了 B的属性和方法
echo $A->parameters;
$A->run();
$A->walk();

//如果Trait、基类和本类中都存在某个同名的属性或者方法，最终会保留哪一个
$A->eat();