<?php
namespace Di\three;
class B
{
    private $c;

    public function doSomething()
    {
        $this->c->doSomething();
        echo 'A';
    }

    public function setC(C $c)
    {
        $this->c = $c;
    }
}