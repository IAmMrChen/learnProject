<?php
namespace App\Infrastructure\Utility\Code;

class CommonCode{
    const PERIOD_TIMES          = 144;                 // 默认一天的期数
    const PERIOD_TIMES_STR      = 'period_times';      // 默认一天的期数
    const EXPIRE_TIME           = 5 * 24 * 60 * 60;    // 5天 秒

    const TOTAL_DAY             = 'total_day';         // 存储总次数字符串
    const TOTAL_DAY_EXPIRE_DAY  = 365 * 24 * 60 * 60;  // 存储总次数的过期时间 秒

    const CURRENT_PERIOD        = 'current_period';    // 当前期数
    const CURRENT_PERIOD_EXPIRE = 86399;               // 每天的当前次数过期时间 秒

    const BEGIN_TIME            = 'first_begin_time';  // 开始时间
    const BEGIN_TIME_EXPIRE     = 86399;               // 开始时间过期时长

    const EVERY_PERIOD_STR      = 'every_period_str';  // 每次出结果时长
    const EVERY_PERIOD_TIME     = 10;                  // 默认每一次间隔时间
    const EVERY_EXPIRE          = 86399;               // 过期时间

    const BIT = ["个位", "十位", "百位", "千位", "万位"]; // 开奖总位数


}
