<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\WechatUser;
use App\Service\RedisService;
use Illuminate\Validation\ValidationException;
use Liaosp\Express\Express;
use App\Service\UploadFile;
use App\Models\Video;
use Session;


class WechatController extends Controller
{
    protected  $app;
    protected $file;

    public function __construct(Request $request)
    {
        $this->app = $this->get_official();
//        $this->file = $file;
    }

    public function get_access(Request $request)
    {
        $this->app->server->push(function ($message) {
            return "文学学习欢迎你";
        });

        $response = $this->app->server->serve();
        $response->send();
    }

    /**
     * 授权进来
     * Created by PhpStorm.
     * User: Liuqingji
     * Date: 2020/11/21
     * Time: 11:37 PM
     */
    public function book_list(Request $request)
    {
        return view('book.list');
    }

    /**
     * 授权回调
     *
     */
    public function  back_auth(Request $request)
    {
        $oauth = $this->app->oauth;
        $user = $oauth->user();
        Session(['wechat_users'=>$user->toArray()]);
        Session::save();

        $targetUrl = empty(Session('target_url_f')) ? '/' : Session('target_url_f');

        header('Location:'. $targetUrl); // 跳转到 user/profile
    }

    /**
     * 提交幸运数字
     * Created by PhpStorm.
     * User: Liuqingji
     * Date: 2020/11/22
     * Time: 12:08 PM
     */
    public function submit_luck_num(Request $request)
    {
//        WechatUser::where('id','>',1)->update(['openid'=>111]);
        //查看今天是否已经提交过了
        $openid = $request->input('openid');
        $user_model = WechatUser::instance();
        $user_data = $user_model->user_info($openid);


        $check_openid = RedisService::check_openid($openid);

        if (!$check_openid) {
            $message = '提交频率过快';
            $status = 0;
            return view('book.result',compact('message','status'));
        }


        if ($user_data && strtotime($user_data['created_at']) > strtotime(date('Y-m-d'))) {
            $message = '今天已经提交过啦';
            $status = 0;
            return view('book.result',compact('message','status'));
        }

        try{
            $this->validate($request,
                [
                    'num' => 'required|integer|between:1,30'
                ],
                [
                    'num.required' => '数字不可为空',
                    'num.integer'=>'请填写数字类型',
                    'num.between'=>'请填写1-30之间的数字',
                ]
            );
        }catch(ValidationException $e){
            $message = '请填写1-30之间的数字';
            $status = 0;
            return view('book.result',compact('message','status'));
        }

        $num = $request->input('num');

        //查看当前的书籍信息
        $book_model = Books::instance();
        $book_data = $book_model->current_data();


        if (!$book_data || strtotime($book_data['start_time']) > time() || time() > strtotime($book_data['end_time'])) {
            $message = '小编还没有设置奖品,请稍后';
            $status = 0;
            return view('book.result',compact('message','status'));
        }

        //查看是否已经中过奖了
        $has_luck = $user_model->has_luck('',$book_data['start_time'],$book_data['end_time']);


        if ($has_luck) {
            $user_model->save_luck($openid,$num,$status=0,$book_data['name']);
            $message = '已经有人中奖，下个星期再来奥';
            $status = 0;
            return view('book.result',compact('message','status'));
        }


        $status = 0;
        $message = '差一点点，没有中奖，明天继续奥：填不同的数字，便加大中奖概率奥';

        //是否相同--
        if ($book_data['luck_num'] == $num) {
            $status = 1;
            $message = '中奖啦';
        }

        //存入到数据库中;
        $user_model->save_luck($openid,$num,$status,$book_data['name']);
        $book_name = $book_data['name'];


        return view('book.result',compact('message','status','book_name'));

    }

    /**
     * 提交地址
     * Created by PhpStorm.
     * User: Liuqingji
     * Date: 2020/11/22
     * Time: 2:43 PM
     */
    public function book_result(Request $request)
    {
        $user_model = WechatUser::instance();
        $openid = $request->input('openid');
        //查看当前的书籍信息
        $book_model = Books::instance();
        $book_data = $book_model->current_data();
        $has_luck = $user_model->has_luck($openid,$book_data['start_time'],$book_data['end_time']);

        if (!$has_luck) {
            return '您没有中奖奥';
        }

        //存入用户信息
        $user_model->save_user_address($request,$book_data['start_time'],$book_data['end_time']);

        //发送邮件过来;

        return '<p style="font-size: 100px;color:red">您的地址已经保存，请等待书籍的到达</p>';
    }

    /**
     * 查看自己的提交记录
     * Created by PhpStorm.
     * User: Liuqingji
     * Date: 2020/11/22
     * Time: 2:43 PM
     */
    public function book_record(Request $request)
    {
        $user_model = WechatUser::instance();
        $openid = $request->input('openid');
        $user_data = $user_model->user_record($openid);
        return view('book.record',compact('user_data'));
    }

    /**
     * 获取订单信息
     * Created by PhpStorm.
     * User: Liuqingji
     * Date: 2020/11/22
     * Time: 6:20 PM
     */
    public function order_info(Request $request)
    {
        $order_id = $request->input('order_id');
        $datas = $this->order_info_by_id($order_id);

        if (!$datas) {
            return '<p style="font-size: 50px;color:red">暂时无物流信息</p>';
        }


        if (empty($datas['result']) || empty($datas['result']['context'])) {
            return '<p style="font-size: 50px;color:red">暂时无物流信息</p>';
        }

        $string = '';
        $string .= "<p style='font-size:30px;color:red'>最新消息:{$datas['result']['latest_progress']}</p><br/><br />";

        foreach ($datas['result']['context'] as $da) {
            $string .= "<span style='font-size:25px;'>".date('Y-m-d H:i:s',$da['time'])."</span>";
            $string .= "<span style='font-size:25px;'>:".$da['desc']."</span><br /><br />";
        }

        return $string;

    }

    /**
     * 获取订单id
     * Created by PhpStorm.
     * User: Liuqingji
     * Date: 2020/11/22
     * Time: 6:22 PM
     */
    protected function order_info_by_id($order_id)
    {
        $obj = new Express();
        $data = $obj->number($order_id); //默认百度快递，其他快递貌似没啥用了

        if (!$data || !isset($data['baidu']) || !isset($data['baidu']['status']))
        {
            return false;
        }

        return $data['baidu'];
    }

    /**
     * 视频列表
     * Created by PhpStorm.
     * User: Liuqingji
     * Date: 2020/11/27
     * Time: 12:02 AM
     */
    public function video_list(Request $request)
    {
        $openid = $request->input('openid');
        $v_model = Video::instance();
        $datas = $v_model->video_list($openid);
        return view('video.list',compact('datas'));
    }

    /**
     * 视频添加
     * Created by PhpStorm.
     * User: Liuqingji
     * Date: 2020/11/27
     * Time: 12:03 AM
     */
    public function video_add(Request $request)
    {
        return view('video.add');
    }

    /**
     * 上传图片
     * Created by PhpStorm.
     * User: Liuqingji
     * Date: 2020/11/26
     * Time: 10:54 PM
     */
    public function fileUpload(Request $request)
    {
        $v_model = Video::instance();
        $openid = $request->input('openid');
        //进行视频合成
        //没人10次
        $count = Video::upload_time($openid);

//        if ($count > 9) return ['status'=>0];

        $path = UploadFile::fileUpload($request,'file','png',0);

        if (!$path) {
            return ['status'=>0];
        }



        $v_model->video_add($openid,$path);
        return ['status'=>200];

    }
}
