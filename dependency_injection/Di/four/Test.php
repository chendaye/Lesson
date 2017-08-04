<?php

/**
 * 依赖注入容器
 * 自动绑定（Autowiring）或 自动解析（Automatic Resolution）
 */
//$container = new \Di\four\Container();
$container = \Di\four\Container::instance();

//在容器中注册C  __set()
$container->C = \Di\four\C::class;

//在容器中注册B  __set()
$container->B = function ($container){
    //__get()
    return new \Di\four\C($container->C);
};

$container->B = \Di\four\B::class;

//在容器中注册 A
$container->A = function ($container){
    //__get()
    return new \Di\four\A($container->B);
};

$A = $container->A;

$A->doSomething();

