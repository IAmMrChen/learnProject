<?php
namespace App\Infrastructure\Tools;

use App\Infrastructure\Utility\Code\CommonCode;
use Illuminate\Support\Facades\Cache;

class Tools{

    /**
     * 当前时间 >= (当前期数*每期时间*60 + 今天开始时间) 才可以获取到开奖结果
     * @return bool  true-可以获取  false-不可以获取
     */
    public static function checkCanGetResult()
    {

        $date = date('Y-m-d', time());
        $currentPeriod = Cache::get(CommonCode::CURRENT_PERIOD);// 当前期数
        $periodTime = Cache::get(CommonCode::EVERY_PERIOD_STR); // 每期时长

        if (time() > ($currentPeriod * $periodTime * 60 + strtotime($date))) {
            return true;
        }

        return false;
    }
}
