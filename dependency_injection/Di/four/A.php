<?php
namespace Di\four;
class A
{
    protected $b;

    /**
     * 构造函数依赖注入
     * A constructor.
     * @param B $b
     */
    public function __construct(B $b)
    {
        $this->b = $b;
    }

    public function doSomething()
    {
        $this->b->doSomething();
        echo 'A';
    }
}