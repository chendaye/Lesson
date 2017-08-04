<?php
/**
 * A B C 不直接耦合 但是 和工厂类耦合  如果工厂类改名字。。。
 * Class A
 * @package Di\two
 */
$a = new \Di\two\A();
$a->doSomething();