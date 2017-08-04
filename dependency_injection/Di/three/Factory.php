<?php
namespace Di\three;

class Factory
{
    public static function getC()
    {
        return new C();
    }

    public static function getB()
    {
        $b = new B();
        $b->setC(new C());
        return $b;
    }

    public static function getA()
    {
        $a = new A();
        $a->setB(self::getB());
        return $a;
    }
}