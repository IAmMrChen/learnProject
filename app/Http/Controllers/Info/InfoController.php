<?php
namespace App\Http\Controllers\Info;

use App\Http\Controllers\Controller;
use App\Infrastructure\Tools\Tools;
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
    public function getAdminInfo ()
    {

        $date = date('Y-m-d', time());
        $res = Cache::get($date);

        $result['data'] = json_decode($res, true);
        $result['msg'] = 'ok';
        $result['code'] = 200;

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
        $date = date('Y-m-d', time());
        $oldTime = Cache::get(CommonCode::EVERY_PERIOD_STR);
        $oldPeriodTime = Cache::get(CommonCode::PERIOD_TIMES_STR); // 旧的一天总期数
        $bit = CommonCode::BIT; // 位数 数组
        $oldData = json_decode(Cache::get($date), true);
        $newExpireTime = CommonCode::EXPIRE_TIME - time() - strtotime($date); // 新的过期时间

        // 如果时间调小了，需要往缓存中添加结果
        if ($oldTime > $everyPeriodTime) {
            // 计算新的结果总数有多少个
            $totalCount = ceil(24*60/$everyPeriodTime);

            // 生成需要新加的数据
            for ($i = 0; $i < ($totalCount - $oldPeriodTime); $i++) {
                for ($j = 0; $j < count($bit); $j ++) {
                    $result[$bit[$j]] = random_int(0,9);
                }
                array_push($oldData, $result);
            }
            Cache::put($date, $oldData, $newExpireTime);
        }

        Cache::put(CommonCode::EVERY_PERIOD_STR, $everyPeriodTime, CommonCode::EVERY_EXPIRE); // 新的每期时长存入缓存
    }

    /** 后台部分 end **/


    /** 前台部分 start **/

    public function index()
    {
        return view('index');
    }

    public function getWebInfo()
    {
        $result['data'] = [];
        $result['msg'] = 'ok';
        $result['code'] = 200;

        $canGet = Tools::checkCanGetResult();  // 验证是否到开奖时间
        if (!$canGet) {
            $result['msg'] = "开奖时间还未到";
            $result['code'] = 201;
            return $result;
        }

        $date = date('Y-m-d', time());
        $currentPeriod = Cache::get(CommonCode::CURRENT_PERIOD); // 当前期数
        $resultData = json_decode(Cache::get($date), true);    // 结果数组
        $result['data']['current_result'] = $resultData[$currentPeriod - 1]; // 取值当前期
        $result['data']['history'] = array_reverse(array_slice($resultData, 0, $currentPeriod-1)); // 取出历史值
        $result['data']['period_time'] = Cache::get(CommonCode::EVERY_PERIOD_STR); // 每期开奖时间间隔

        Cache::put(CommonCode::CURRENT_PERIOD, $currentPeriod + 1, CommonCode::CURRENT_PERIOD_EXPIRE); // 当前期数加1
        Cache::put(CommonCode::BEGIN_TIME, time(), CommonCode::BEGIN_TIME_EXPIRE); // 更新当前期的开始时间
    }

    /** 前台部分 end **/


    public function test()
    {
        Cache::put('2019-12', json_encode(['info' => time()]), 151515);
        return 'ok';
    }

    public function get()
    {
        return json_decode(Cache::get("2019-12-29"), true);
    }
}
