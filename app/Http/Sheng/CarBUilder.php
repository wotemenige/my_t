<?php

namespace App\Http\Sheng;

class CarBUilder extends Builder
{
    public function __construct()
    {
        $this->car = new Car();
    }

    public function buildPartA()
    {
        // TODO: Implement buildPartA() method.
        $this->car->setPartA('发动机');
    }

    public function buildPartB()
    {
        // TODO: Implement buildPartB() method.
        $this->car->setPartB('轮子');
    }

    public function buildPartC()
    {
        // TODO: Implement buildPartC() method.
        $this->car->setPartC('其他零件');
    }

    public function getResult()
    {
        // TODO: Implement getResult() method.
        return $this->car;
    }
}
