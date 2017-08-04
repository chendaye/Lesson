<?php
namespace Di\one;
class B
{
    public function doSomething()
    {
        $c = new C();
        $c->doSomething();
        echo 'B';
    }
}