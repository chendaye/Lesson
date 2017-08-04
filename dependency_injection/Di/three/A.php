<?php
namespace Di\three;


class A
{
    private $b;

    public function doSomething()
    {
        $this->b->doSomething();
        echo 'A';
    }

    public function setB(B $b)
    {
        $this->b = $b;
    }
}