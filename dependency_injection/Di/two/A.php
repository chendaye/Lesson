<?php
namespace Di\two;


class A
{
    public function doSomething()
    {
        $b = Factory::getB();
        $b->doSomething();
        echo 'A';
    }
}