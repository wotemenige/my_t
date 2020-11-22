<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WechatUser extends Model
{
    use HasFactory;

    protected $table = 'wechat_users';
    protected $guarded = ['id'];
    static private $INSTANCE = null;
//
//    protected function serializeDate(\DateTimeInterface $date)
//    {
//        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
//    }

    /**
     * 单例模式
     * 单例模式
     * Created by PhpStorm.
     * User: Liuqingji
     * Date: 2020/11/22
     * Time: 12:34 AM
     */
    public static function instance()
    {
        if (!self::$INSTANCE instanceof self) {
            self::$INSTANCE = new self();
        }

        return self::$INSTANCE;
    }

    /**
     * 用户信息
     * Created by PhpStorm.
     * User: Liuqingji
     * Date: 2020/11/22
     * Time: 12:27 PM
     */
    public function user_info($openid)
    {
        $user_data = self::where('openid',$openid)->orderby('created_at','desc')->first();
        return $user_data;
    }

    /**
     * 存储用户信息
     * Created by PhpStorm.
     * User: Liuqingji
     * Date: 2020/11/22
     * Time: 1:03 PM
     */
    public function save_luck($openid,$num,$status,$book_name)
    {
        self::create([
            'openid'=>$openid,
            'luck_num'=>$num,
            'status'=>$status,
            'book_name'=>$book_name,
            'address'=>'',
            'phone'=>0,
            'order_id'=>'',
        ]);
    }

    /**
     * 是否已经中过奖了
     * Created by PhpStorm.
     * User: Liuqingji
     * Date: 2020/11/22
     * Time: 1:21 PM
     */
    public function has_luck($openid='',$start_time,$end_time)
    {
//        dd($start_time,$end_time);
        //
        //            ->
        return self::whereBetween('created_at',[$start_time,$end_time])->where(function($q) use($openid){
                if (!empty($openid)) {
                    return $q->where('openid',$openid);
                }
            })
            ->where('status',1)->first();
    }

    /**
     * 存入中奖用户的信息
     * Created by PhpStorm.
     * User: Liuqingji
     * Date: 2020/11/22
     * Time: 1:55 PM
     */
    public function save_user_address($request,$start_time,$end_time)
    {
        $openid  = $request->input('openid');
        $address = $request->input('address');
        $phone = $request->input('phone');
        self::where('openid',$openid)->where('status',1)->whereBetween('created_at',[$start_time,$end_time])
            ->update([
                'address'=>$address,
                'phone'=>$phone
            ]);
    }

    /**
     * 用户提交几率
     * Created by PhpStorm.
     * User: Liuqingji
     * Date: 2020/11/22
     * Time: 2:45 PM
     */
    public function user_record($openid)
    {
        $datas = self::where('openid',$openid)->get();
        return $datas;
    }
}
