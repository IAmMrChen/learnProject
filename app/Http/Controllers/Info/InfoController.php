<?php
namespace App\Http\Controllers\Info;

use App\Http\Controllers\Controller;
use App\Infrastructure\Utility\Code\CommonCode;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;

class InfoController extends Controller
{

    /**
     * 实现情况
     * 未完成部分：
     * 1. 用户端展示页面、管理员端修改展示页面(在同一页)
     * 2. 修改每次出结果时间间隔(需考虑时间间隔改短时候每天生成的结果就会不够、需要继续生成)
     * 3. 每期倒计时的时间需要存储在缓存中 避免刷新时间重置
     */


    /** 后台部分 start **/

    /**
     * 获取结果、此处是所有结果
     * @return mixed
     */
    public function info ()
    {

        $date = date('Y-m-d', time());
        $res = Cache::get($date);

        $result['data']['result'] = json_decode($res, true);
        $result['msg'] = 'ok';
        $result['code'] = 200;

        /** 这两句应该迁移到前台的获取每期结果的接口中 **/
        $currentPeriod = Cache::get(CommonCode::CURRENT_PERIOD); // 获取当天当前期数
        Cache::put(CommonCode::CURRENT_PERIOD, $currentPeriod, CommonCode::CURRENT_PERIOD_EXPIRE);  // 更新当天的当前期数

        return $result;
    }

    /**
     * 修改某一期对应的结果
     * @param Request $request
     */
    public function changeData(Request $request)
    {
        $currentPeriod = $request->input('current_period');
        $newResult = $request->input('new_result');

        $date = date('Y-m-d', time());
        $resultData = json_decode(Cache::get($date), true);
        $resultData[$currentPeriod - 1] = $newResult; // 更新对应期数结果
        $newExpireTime = CommonCode::EXPIRE_TIME - time() - strtotime($date); // 每天结果值的新的过期时间

        Cache::put($date, $resultData, $newExpireTime); // 重新存入缓存

        $result['data'] = $resultData;
        $result['msg'] = 'ok';
        $result['code'] = 200;

        return $result;
    }

    public function changeTime(Request $request)
    {
        $everyPeriodTime = $request->input('time');
        $oldTime = Cache::get(CommonCode::EVERY_PERIOD_STR);
        Cache::put(CommonCode::EVERY_PERIOD_STR, $everyPeriodTime, CommonCode::EVERY_EXPIRE);

        // 如果时间调小了，需要往缓存中添加结果
        if ($oldTime > $everyPeriodTime) {
            // 计算新的结果总数有多少个
            $totalCount = ceil(24*60/$everyPeriodTime);
        }
    }

    /** 后台部分 end **/
}
