<?php
<<<EOT
通过反射实现依赖注入

反射方法可以获得类的反射  类的反射可以获得累的所有信息
包括  类的方法 类的方法的参数  类的属性  名称等  还可以获取类的实例

// 获取类的反射
$reflector = new ReflectionClass($controller);
// 取类的构造函数
$constructor = $reflector->getConstructor();
// 取构造函数的参数
$parameters = $constructor->getParameters();
// 遍历参数
foreach ($parameters as $key => $parameter) {
    // 获取参数声明的类
    $injector = new ReflectionClass($parameter->getClass()->name);
    // 实例化参数声明类并填入参数列表
    $parameters[$key] = $injector->newInstance();
}
// 使用参数列表实例 controller 类
$instance = $reflector->newInstanceArgs($parameters);
// 执行
$instance->$action();

举个例子

把一个类的实例传入 反射类
获取类的构造方法 和 构造方法的参数
分析参数 获取参数对应类的实例
在获取反射类的实例
再调用反射类的方法


EOT;

