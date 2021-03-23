<?php

class productsA{

}

class productsB{

}

class productFactory{
    public function getproduct($num){
        switch ($num) {
            case 1:
                return new productsA;
            case 2:
                return new productsB;
            default:
                return null;
        }
    }
}

$factory = new productFactory();
$pro1 = $factory->getproduct(1);
$pro2 = $factory->getproduct(2);
var_dump($pro1, $pro2);