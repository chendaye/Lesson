<?php
namespace Di\one;


class A
{
        public function doSomething()
        {
            $b = new B();
            $b->doSomething();
            echo 'A';
        }
}