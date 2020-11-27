<?php

namespace App\Service;

use Storage;

class UploadFile
{

    /**
     * Created by PhpStorm.
     * User: Liuqingji
     * Date: 2020/11/26
     * Time: 10:44 PM
     * name  前端传过来的字段
     * type_ext 表示类型限制
     * $type  1表示上传到cnd 0表示不用
     */
    public static function fileUpload($request,$name,$type_ext=[],$type=0)
    {
        $fileCharater = $request->file($name);

        if ($fileCharater->isValid()) { //括号里面的是必须加的哦
            //如果括号里面的不加上的话，下面的方法也无法调用的

            //获取文件的扩展名
            $ext = $fileCharater->getClientOriginalExtension();

            if (empty($type_ext) && in_array($type_ext,$ext)) {
                return false;
            }

            //获取文件的绝对路径
            $path = $fileCharater->getRealPath();

            //定义文件名
            $filename = date('Y-m-d-h-i-s') .mt_rand(1000,9999).'.' . $ext;

            //存储文件。disk里面的public。总的来说，就是调用disk模块里的public配置
            $res = Storage::disk('public')->put($filename, file_get_contents($path));

            if ($res) {

                if ($type == 0) return ['path'=>'storage/'.$filename,'oss_url'=>''];

                $file = static::uploadToOss('storage/'.$filename);

                if (!$file) {
                    @unlink('storage/'.$filename);
                    return false;
                }

                return ['path'=>'storage/'.$filename,'oss_url'=>$file];

            }

            return false;
        }
    }

    /**
     * 上传文件
     * Created by PhpStorm.
     * User: Liuqingji
     * Date: 2020/11/26
     * Time: 10:38 PM
     * type 1 表示是否上传到cdn  0表示不上传
     * path 表示上传到cdn的路径
     */
    public static function uploadToOss($file)
    {

        $disk = Storage::disk('oss');
        $d = $disk->put($file, file_get_contents($file));

        if ($d) return 'https://tliu.oss-cn-beijing.aliyuncs.com/'.$file;

        return false;
    }
}