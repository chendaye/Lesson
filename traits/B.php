<?php
namespace traits;
trait B
{
    public $parameters = 'parameter';

    public function run()
    {
        echo 'run';
    }

    public function eat()
    {
        echo 'trait';
    }
}