<?php

namespace App\Console\Commands;

use App\Infrastructure\Utility\Code\CommonCode;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class GenerateLotteryResult extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lottery:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate lottery result';

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
     * 生成一天的结果，存入缓存
     * @return mixed
     */
    public function handle()
    {
        file_put_contents(__DIR__."/".date('Y-m-d').'.log',"Log info".date('Y-m-d H:i:s')."\r\n",FILE_APPEND);
        $date = date('Y-m-d', time());    // 缓存键值 今天的日期
        $periodTimes = CommonCode::PERIOD_TIMES; // 次数
        $bit = CommonCode::BIT;                  // 结果总位数

        // 生成结果
        $result = [];
        for ($i = 0; $i < $periodTimes; $i++) {
            for ($j = 0; $j < count($bit); $j ++) {
                $result[$i][$bit[$j]] = random_int(0,9);
            }
        }

        $totalDay = Cache::get(CommonCode::TOTAL_DAY, 1); // 获取已经存储的总次数，不存在则为1

        /* 此处充当数据缓存 不使用数据库 */
        Cache::put($date, json_encode($result), CommonCode::EXPIRE_TIME); // 结果存入缓存5天过期
        Cache::put(CommonCode::TOTAL_DAY, $totalDay + 1, CommonCode::TOTAL_DAY_EXPIRE_DAY); // 次数统计存入缓存一年过期
        Cache::put(CommonCode::CURRENT_PERIOD, 1, CommonCode::CURRENT_PERIOD_EXPIRE); // 当前为第一次记录缓存 一天过期
    }
}
