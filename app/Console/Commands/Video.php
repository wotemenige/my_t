<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Video as VModel;
use App\Service\UploadFile;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;

class Video extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Video_commend';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '视频合成';

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
//        $a = Redis::del('a');
//        return '';

        $a = Redis::setnx('a','1');

        if (!$a) {
//            $a = Redis::del('a');
            return '';
        }

        while(true) {

            $data = VModel::where('status',0)->first();

            if (!$data) {
                sleep(2);

                continue;
            }

            shell_exec('rm -rf '.public_path().'/hua_test_one/* '  .public_path().'/hua_test/*');

            $filter = [];
            $r = [];
            $daa = VModel::where('id',$data->id)->update(['status'=>1]);
            //图片位置---并且获取到图片的后缀名;
            $file_handle = fopen(public_path('hua.txt'),'r');

            while (!feof($file_handle)) {
                $line = fgets($file_handle);

                $filter[] = str_replace(PHP_EOL, '', $line);
            }

            fclose($file_handle);

            $t = [];
            //现将第一个图片变成所需要的大小--
            for ($i=1;$i<22;$i++) {
                $time = time().rand(999,10000).rand(111,222);
                $cmd=shell_exec('ffmpeg -i '.public_path($data->img_ur). ' -vf scale=100:100 '. public_path().'/hua_test/'.$time.'.png');
                $tss = time().rand(999,10000).rand(333,444);
                //并且将图片饭翻转
                $cmd=shell_exec('ffmpeg -i '.public_path('hua_test/'.$time.'.png'). ' -vf hflip -y '. public_path().'/hua_test/'.$tss.'.png');
                $t[] = 'hua_test/'.$tss.'.png';
            }


            $i = 7;

            //以及变模糊；然后再和第二个图片相结合;
            foreach ($t as $tt) {
                //变模糊
                $time = time().rand(999,10000).rand(111,222);
                $cmd=shell_exec('ffmpeg -i '.public_path($tt). ' -vf boxblur='.$i.' '.public_path().'/hua_test/'.$time.'.png');

                $i -=0.5;

                if ($i < 0.5) {
                    $i = 0;
                }
                $r[] = 'hua_test/'.$time.'.png';
            }

            //和第二个图片的
            foreach ($filter as $k=>$f) {
                $k = $k+1;


                if ($k > 5) {
                    $t = $k;
                    if ($k > 20) {$t =20;}
                    Log::info('kkkkk------------'.$k);
                    $x = 110 - $k-14;
                    $y = 200;
                    $cmd=shell_exec('ffmpeg -i '.public_path('hua/'.$f).' -i '.public_path($r[$t-6]).' -filter_complex overlay='.$x.':'.$y.' '.public_path().'/hua_test_one/'.$k.'.png');
                    continue;
                }

                $cmd=shell_exec('ffmpeg -i '.public_path('hua/'.$f). ' '.public_path().'/hua_test_one/'.$k.'.png');
            }

            $a = time();
            $cmd=shell_exec('ffmpeg -r 10 -f  image2 -i '.public_path().'/hua_test_one/%d.png -pix_fmt yuv420p  -t 3 '. public_path().'/video/'.$a.'.mp4');

            //上传到cdn上面去;
            $path = UploadFile::uploadToOss(public_path().'/video/'.$a.'.mp4');

            if (!$path) {
                $ta = VModel::where('id',$data->id)->update(['status'=>3]);
            }


            $ta = VModel::where('id',$data->id)->update(['status'=>2,'video_url'=>$path]);

            shell_exec('rm -rf '.public_path().'/hua_test_one/* '  .public_path().'/hua_test/*');

            sleep(2);

        }
    }
}































