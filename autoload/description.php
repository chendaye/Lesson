<?php
<<<EOT
composer 并不是一款专注于系统级别 php 管理的包管理系统，而是基于项目的一个库管理系统
laravel 就是直接扔进了 composer。
因为 psr-4 这个规范真是不能再爽更多。

composer 核心 文件。
 vendor/composer/autoload_real.php
 
 php5之后的版本
 试图使用尚未定义的类时会自动调用__autoload函数，
 所以我们可以通过编写__autoload函数来让php自动加载类，而不必写一个长长的包含文件列表。
 function __autoload($class)   
{   
    $file = $class . '.php';   
    if (is_file($file)) {   
    require_once($file);   
    }   
}   

默认调用  __autoload  通过spl_autoload_register 注册自己的加载函数
假如我们不想自动加载的时候调用__autoload，而是调用我们自己的函数（或者类方法），
我们可以使用spl_autoload_register来注册我们自己的autoload函数。它的函数原型如下：
bool spl_autoload_register ( [callback $autoload_function] )

 spl_autoload_register(array('ComposerAutoloaderInit4f8f2b703dbd195f61c6fba25613cd38', 'loadClassLoader'), true, true);


Composer 自动加载的类型

psr-4   项目代码用 psr-4 自动加载
最简单来讲就是可以把 prs-4 的 namespace 直接想想成 文件结构
{
  "name": "acme/util",
  "auto" : {
    "psr-4": {
      "Acme\\Util\\": "src/"
    }
  }
}
vendor/
  acme/
    util/
      composer.json
      src/
        ClassName.php
可以看到将 Acme\Util 指向了 src 之后 psr-4 就会默认所有的 src 下面的 class 都已经有了 Acme\Util 的 基本 namespace，
namespace Acme\Util;
class ClassName {}



classmap  development 相关用 classmap 自动加载
最最简单的 autoload 模式
"classmap": ["src/"]
vendor/composer/autoload_classmap.php
composer 会读取这个文件夹中所有的文件 然后再 vendor/composer/autoload_classmap.php 中怒
将所有的 class 的 namespace + classname 生成成一个 key => value 的 php 数组
composer dump-autoload -o 做的事儿。不然的话compoesr 会动态读取 psr-4 和 prs-0 的内容


files   helper(公共函数) 用 files 自动加载
有一些全局的 helper function 的存在
{
  "files": [
    "path/to/file.php"
  ]
}



psr-0    psr-0 已经被抛弃了  标准已经过时
文档结构是这样的
vendor/
  acme/
    util/
      composer.json
      src/
        Acme/
          Util/
            ClassName.php
ClassName.php 中是这样的
class Acme_Util_ClassName{}


ComposerAutoloaderInit64c47026c93126586e44d036738c0862   这个类是全局
作为模块化大行其道的今天，全局的类总是有那么点奇怪。为了不让这个 autoload 的 helper 污染全局，
composer 的仁兄们还是绞尽脑汁怒弄了这么一个奇怪的 hash。这直接就逼迫广大二笔程序员们不要跟这个撞衫。

主要只有这么一个方法 getLoader

一、找 Composer\ClassLoader 如果不存在就是生成一个实例放在
 ComposerAutoloaderInit64c47026c93126586e44d036738c0862 中

二、然后将 composer cli 生成的各种 autoload_psr4, autoload_classmap, autoload_namespaces(psr-0) 
全都注册到 Composer\ClassLoader 中。

三、直接 require 所有在 autoload_files 中的文件


总是要 composer dump-autoload
因为 database 文件夹使用 classmap 来做加载的。
所以只有在打了 composer dumpautoload 之后 composer 才会更新 autoload_classmap 的内容
怎样可以避免一直打 composer dump-autoload ?#

可以怒用 psr-4 注册一个文件夹这样增减文件就不用再管了。
Composer\ClassLoader 会自动检查 composer.json 中注册的 psr-4 入口然后根据 psr-4 去自动查找文件。

生产环境为什么要 composer dump-atoload -o
可以看到 psr-4 或者 psr-0 的自动加载都是一件很累人的事儿。基本是个 O(n2) 的复杂度。
另外有一大堆 is_file 之类的 IO 操作所以性能堪忧。

所以给出的解决方案就是空间换时间。

Compsoer\ClassLoader 会优先查看 autoload_classmap 中所有生成的注册类。
如果在classmap 中没有发现再 fallback 到 psr-4 然后 psr-0

所以当打了 composer dump-autoload -o 之后，
composer 就会提前加载需要的类并提前返回。这样大大减少了 IO 和深层次的 loop。

require-dev (root-only)
这个列表是为开发或测试等目的，额外列出的依赖。“root 包”的 require-dev 默认是会被安装的。
然而 install 或 update 支持使用 --no-dev 参数来跳过 require-dev 字段中列出的包


一个脚本，在 Composer 中，可以是一个 PHP 回调（定义为静态方法）或任何命令行可执行的命令。
脚本对于在
 
 Composer 运行过程中，执行一个资源包的自定义代码或包专用命令是非常有用的。

**注意：**只有在根包的 composer.json 中定义的脚本才会被执行。
即便根包的外部依赖定义了其自身的脚本，Composer 也不会去执行这些额外的脚本

 "config": {
        "preferred-install": "dist",
        "sort-packages": true,
        "optimize-autoloader": true
    }
    
    
    optimize 命令把常用加载的类合并到一个文件里，通过减少文件的加载，来提高运行效率：

php artisan optimize --force

php artisan optimize  生成 autoload_classmap.php  文件夹 和命名空间的映射  不用动态解析 psr-4
EOT;
