<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Test-t';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'zheshitest';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

//          $redis=Redis::connection('publisher');//创建新的实例
        $a = Redis::setex('aaaaaaaaaaa',15,'哈哈哈');
//        var_dump($a);die;
//        ini_set('default_socket_timeout', -1);  //不超时
       while(true) {
           $redis=Redis::connection('publisher');//创建新的实例
           $redis->psubscribe(['__keyevent@*__:expired'], function ($message, $channel) {
               var_dump($message,$channel);die;
//               echo $channel.PHP_EOL;//订阅的频道
//               echo $message.PHP_EOL;//过期的key
//               echo '---'.PHP_EOL;
           });
//           $a = mt_rand(10,20);
//           if ($a > 15) {
//               sleep(1);
//           }
       }
    }
}
