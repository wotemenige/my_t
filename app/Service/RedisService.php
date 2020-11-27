<?php

namespace App\Service;

use Illuminate\Support\Facades\Redis;


class RedisService
{
    public static function check_openid($openid)
    {
        return Redis::set($openid,$openid,'ex',1,'nx');
    }
}
