<?php

namespace App\Http\Sheng;

class Car
{
    protected $partA;
    protected $partB;
    protected $partC;

    public function setPartA($str)
    {
        $this->partA = $str;
    }

    public function setPartB($str)
    {
        $this->partB = $str;
    }

    public function setPartC($str)
    {
        $this->partC = $str;
    }

    public function show()
    {
        echo '这车是'.$this->partA;
    }
}
