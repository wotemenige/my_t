<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\InterService;
use App\Models\User;
use Liaosp\Express\Express;
use Illuminate\Support\Facades\Redis;
use App\Service\OSS;

class InviteController extends Controller
{

    //用户邀请
    public function user_invite(Request $request)
    {
        $id = 1;
        $data = User::where('id',$id)->first();
        $datas = User::get()->toArray();
        $datass = User::all();
        dd($data,$datas,$datass);
    }

    public function get_data()
    {
        $start = 0;
        $limit = 100;
        $datas = User::offset($start)->limit($limit)->get();

        while ($datas) {
            foreach ($datas as $data) {
                yield $data;

            }
            $take = ++$start * 100;
            $datas = User::offset($take)->limit($limit)->get()->toArray();
        }
    }

    public function get_test()
    {
        $start = 0;
        $limit = 100;
        $datas = User::offset($start)->limit($limit)->get();

        while ($datas) {
            foreach ($datas as $data) {
              var_dump($data);
              echo '<br />';

            }
            $take = ++$start * 100;
            $datas = User::offset($take)->limit($limit)->get()->toArray();
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
                dd("1313邀请码解密错误".$i);

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

    //用户第四个
    public function user_four_invite(Request $request)
    {
        $a = $request->input('a');
        $b = '11';
        if ($a == 'cat') {
            return new Cat();
        } elseif ($a == 'dog') {
            return new Dog();
        }
//        self::user_four_invite($a);
//        self::user_four_invite($b);
        //生成器模式--建造者模式
        //

    }
}
