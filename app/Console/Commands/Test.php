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

        $a = Redis::set('woteme',1,'ex',60,'nx');

        dd($a);
        $a = Redis::setex('aaaaaaaaaaa',3,'哈哈哈');
//        $a = Redis::setex('aaaaaaaa',5,'哈哈哈');
        $redis = new \Redis();
        $redis->connect('127.0.1.1',6379);
        $redis->setOption(\Redis::OPT_READ_TIMEOUT, -1);
        $redis->setex('aaaa',3,'哈哈');
        $pattern = '__keyevent@*__:expired';

        $redis->psubscribe([$pattern], function ($message, $channel, $chan, $msg)
        {
            dd($message, $channel, $chan, $msg);
        });

//        $redis = Redis::connection('publisher');//创建新的实例
//        $redis->psubscribe(['__keyevent@*__:expired'], function ($message, $channel) {
//            var_dump($message);
//        });

    }
}
