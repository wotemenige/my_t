<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $table = 'video';
    protected $guarded = ['id'];
    static private $INSTANCE = null;


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
     * Created by PhpStorm.
     * User: Liuqingji
     * Date: 2020/11/26
     * Time: 11:55 PM
     */
    public function video_list($openid)
    {
        $data = self::where('openid',$openid)->get()->toArray();
        return $data;
    }
}
