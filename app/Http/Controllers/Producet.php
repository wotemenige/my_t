<?php

namespace App\Http\Controllers;

class Producet extends Factory
{
    public static function createPc()
    {
        // TODO: Implement createPc() method.
        return new Mac();
    }

    public static function createTv()
    {
        // TODO: Implement createTv() method.
        return new Huashuo();
    }
}

