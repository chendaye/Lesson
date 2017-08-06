<?php
namespace traits;
class A extends C
{
    use B;

    public function walk()
    {
        echo 'wolk';
    }

    public function eat(){
        echo 'class';
    }

    public function sleep()
    {
        echo 'A';
    }
}
