<?php

namespace App\Http\Sheng;

abstract class Builder
{
    protected $car;
    abstract public function buildPartA();
    abstract public function buildPartB();
    abstract public function buildPartC();
    abstract public function getResult();
}
