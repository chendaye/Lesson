<?php
namespace Di\two;

class Factory
{
    public static function getC()
    {
        return new C();
    }

    public static function getB()
    {
        return new B();
    }
}