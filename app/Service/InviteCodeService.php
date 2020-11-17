<?php

namespace App\Services;


// 邀请码服务
class InviteCodeService
{
    protected $key,$num;

    public function __construct()
    {
        // 注意这个key里面不能出现数字0  否则当 求模=0 会重复的
        $this->key = 'abcdefghjkmnpqrstuvwxyz123456789';
        //多少进制的
        $this->num = strlen($this->key);

    }
}
