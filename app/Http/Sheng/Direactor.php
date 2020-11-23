<?php

namespace App\Http\Sheng;

class Direactor
{
    public $myBuilder;

    public function startBuild()
    {
        $this->myBuilder->buildPartA();
        $this->myBuilder->buildPartB();
        $this->myBuilder->buildPartC();
        return $this->myBuilder->getResult();
    }

    public function setBuild(Builder $builder)
    {
        $this->myBuilder = $builder;
    }
}
