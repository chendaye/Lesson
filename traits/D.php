<?php
namespace traits;
class D
{
    use trait1,trait2{
        trait2::method1 insteadof trait2;
        trait1::method2 insteadof trait1;
        trait2::method3 as three;
    }

}