<?php
namespace Di\two;
class B
{
    public function doSomething()
    {
        $c = Factory::getC();
        $c->doSomething();
        echo 'A';
    }
}