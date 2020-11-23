<?php

namespace App\Http\Controllers;

abstract class Factory
{
    abstract public static function createPc();
    abstract public static function createTv();
}
