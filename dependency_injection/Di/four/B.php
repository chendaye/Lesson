<?php
namespace Di\four;
class B
{
    protected $c;

    /**
     * 构造函数依赖注入
     * B constructor.
     * @param C $c
     */
    public function __construct(C $c)
    {
        $this->c = $c;
    }

    public function doSomething()
    {
        $this->c->doSomething();
        echo 'B';
    }
}