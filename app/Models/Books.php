<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $guarded = ['id'];
    static private $INSTANCE = null;

//    protected function serializeDate(DateTimeInterface $date)
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
     * 书籍现在的数据
     * Created by PhpStorm.
     * User: Liuqingji
     * Date: 2020/11/22
     * Time: 1:17 PM
     */
    public function current_data()
    {
        return self::orderby('created_at','desc')->first();
    }
}
