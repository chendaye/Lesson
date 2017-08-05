<?php
namespace traits;
class A
{
    use B;

    public function walk()
    {
        echo 'wolk';
    }

    public function eat(){
        echo 'class';
    }
}
