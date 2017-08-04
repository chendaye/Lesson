<?php
/**
 * 这就叫依赖注入
 *
 * 依赖的创建和绑定移到 类的外面来
 * 程序更容易维护，降低程序代码的耦合度
 */
$a = new \Di\three\A();

$a->setB(\Di\three\Factory::getB());

$a->doSomething();

/**
 * 上面的方法比较麻烦 先要实例  再注入
 * 于是又想出 直接用工厂方法 返回一个注入好的 A 的实例
 */
$a = \Di\three\Factory::getA();
$a->doSomething();


/**
 * 传统的方法  要调用 A 的 doSomething 方法  从A 开始  实例化 B  然后实例化 C
 *
 * 引入依赖注入的思想后 变成
 * 先实例化 C  然后实例化B 把C 注入到 B   然后实例化 A 把 B注入到 A
 * 这就是所谓的 控制反转  这样你可以完全控制依赖关系，通过调整不同的注入对象，来控制程序的行为
 *
 * 比如 改变B 的 doSomething 方法 在注入A  A的行为就被改变了
 */