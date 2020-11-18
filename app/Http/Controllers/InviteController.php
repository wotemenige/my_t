<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\InterService;
use App\Models\User;
use Liaosp\Express\Express;


class InviteController extends Controller
{

    //用户邀请
    public function user_invite(Request $request)
    {
       $inter = new InterService();
       for ($i=11;$i<1000;$i++) {
           $code = $inter->enCode($i);
           echo $code.'<br />';
           $id = $inter->deCode($code);
           echo $id.'<br />';
       }
    }

    //测试绑定单例
    public function user_two_invite(Request $request)
    {
        $max_num = 200000;

        $codes = [];
        for ($i = 1; $i <= $max_num; $i++)
            $codes[] =  app('invite_code')->enCode($i);

        $i = 1;
        foreach ($codes as $code){
            $userId = app('invite_code')->deCode($code); // 邀请码获取用户id

            if( $userId != $i)
                dd("555邀请码解密错误".$i);
            $i++;
        }

        $unique_count =  count(array_unique($codes));
        dd($unique_count);  // 不重复的总数
    }

    //用户第三个
    public function user_three_invite(Request $request)
    {
        $obj = new Express();
//        $a = $obj->number('75355662900611'); //默认百度快递，其他快递貌似没啥用了
//
//        $obj->setExpress('kuaidi100');
//        $d = $obj->number('75355662900611');
        $obj->setExpress('kuaidi100');
        $obj->setExpress('ickd');
        $d = $obj->number('71291609210123');
        dd($d);
    }
}
