<?php

namespace App\Service;

class InterService
{
    protected $key,$num;

    public function __construct()
    {
        $this->key = 'abc';
        //defghjkmnpqrstuvwxyz123456789
        // 注意这个key里面不能出现数字0  否则当 求模=0 会重复的
        // 多少进制
        $this->num = strlen($this->key);
    }

    public function enCode(int $user_id):string
    {

        $code = ''; // 邀请码
        while ($user_id > 0) { // 转进制
            $mod = $user_id % $this->num; // 求模-------2
            $user_id = ($user_id - $mod) / $this->num; //求商
            $code = $this->key[$mod] . $code;
        }

        $code = str_pad($code, 4, '0', STR_PAD_LEFT); // 不足用0补充
        return $code;
    }

    //解出用户id
    public function deCode(string $code) :int
    {
        if (strrpos($code, '0') !== false) {
            $code = substr($code, strrpos($code, '0') + 1);
        }

        $len = strlen($code);
        $code = strrev($code);
        $user_id = 0;

        for ($i = 0; $i < $len; $i++) {
            $user_id += strpos($this->key, $code[$i]) * pow($this->num, $i);
        }

        return $user_id;
    }
}
