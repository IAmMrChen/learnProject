<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>开奖结果</title>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <![endif]-->
{{--    <link rel="stylesheet" type="text/css" href="js/jquery.gritter/css/jquery.gritter.css" />--}}

</head>
<style>
    .contain{
        width: 1000px;
        margin: auto;
        /*background: red;*/
        height: 800px;
        margin-top: 30px;
    }
    .header{
        text-align: center;
        color: white;
        background: #0275c5;
        height: 50px;
        line-height: 2.5;
        font-size: 18px;
    }
    .body{
        border: 1px solid #b3d2e8;
        width: 998px;
        height: 700px;
    }
    .left-contain{
        border-right: 1px solid #b3d2e8;
        width: 40%;
        display: inline-block;
        vertical-align: top;
    }
    .left-header{
        height: 30px;
        border-bottom: 1px solid #b3d2e8;
        padding: 10px;
        text-align: center;
    }
    .left-footer{
        padding: 10px;
        height: 630px;
        overflow: scroll;
    }
    .left-footer>p{
        line-height: 0;
        margin-bottom: 25px;
        text-align: center;
    }
    .right-contain{
        display: inline-block;
        vertical-align: top;
        width: 59%;
    }
    ul.countdown {
        list-style: none;
        margin: 75px 0;
        padding: 0;
        display: block;
        text-align: center;
    }

    ul.countdown li {
        display: inline-block;
        width: 65px;
    }

    ul.countdown li span {
        font-size: 80px;
        font-weight: 300;
        line-height: 80px;
    }

    ul.countdown li.seperator {
        font-size: 80px;
        line-height: 70px;
        vertical-align: top;
    }

    ul.countdown li p {
        color: #a7abb1;
        font-size: 14px;
    }
    .font-size-18{
        font-size: 18px;
    }
    .right-header{
        text-align: center;
        margin-top: 15px;
    }
    .right-body{
        text-align: center;
    }

    ul.result {
        list-style: none;
        margin: 30px 0;
        padding: 0;
        display: block;
        text-align: center;
    }

    ul.result li {
        display: inline-block;
        width: 65px;
    }

    ul.result li span {
        font-size: 80px;
        font-weight: 300;
        line-height: 80px;
    }

    ul.result li.seperator {
        font-size: 80px;
        line-height: 70px;
        vertical-align: top;
    }

    ul.result li p {
        color: #a7abb1;
        font-size: 14px;
    }
    .footer{
        margin-top: 20px;
        text-align: center;
    }
    [v-cloak] {
        display: none;
    }
</style>
<body>

    <div id="contain" class="contain">
        <div id="logo-head">

        </div>

        <div id="head-nav" class="header">
            <span>今日期数</span>
        </div>

        <div id="body" class="body" v-cloak>
            <div class="left-contain">
                <div class="left-header">
                    <span class="font-size-18">历史期数</span>
                </div>
                <div class="left-footer">
                    <p>第一期: <span>10 15 25 35 45</span></p>
                    <p>第一期: <span>10 15 25 35 45</span></p>
                    <p>第一期: <span>10 15 25 35 45</span></p>
                    <p>第一期: <span>10 15 25 35 45</span></p>
                    <p>第一期: <span>10 15 25 35 45</span></p>
                    <p>第一期: <span>10 15 25 35 45</span></p>
                    <p>第一期: <span>10 15 25 35 45</span></p>
                </div>
            </div>

            <div class="right-contain">
                <div class="right-header">
                    <span class="font-size-18">第6期剩余开始时间</span>
                    <ul class="countdown">
                        <li> <span class="hours">@{{ hour }}</span>
                            <p class="hours_ref">小时</p>
                        </li>
                        <li class="seperator">:</li>
                        <li> <span class="minutes">@{{ minute }}</span>
                            <p class="minutes_ref">分钟</p>
                        </li>
                        <li class="seperator">:</li>
                        <li> <span class="seconds">@{{ second }}</span>
                            <p class="seconds_ref">秒</p>
                        </li>
                    </ul>
                </div>
                <div class="right-body">
                    <span class="font-size-18">第5期出来结果</span>
                    <ul class="result">
                        <li> <span class="hours">0</span>
                            <p class="hours_ref">个位</p>
                        </li>
                        <li> <span class="minutes">0</span>
                            <p class="minutes_ref">十位</p>
                        </li>
                        <li> <span class="seconds">0</span>
                            <p class="seconds_ref">百位</p>
                        </li>
                        <li> <span class="seconds">0</span>
                            <p class="seconds_ref">千位</p>
                        </li>
                        <li> <span class="seconds">0</span>
                            <p class="seconds_ref">万位</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
{{--        <div class="footer">--}}
{{--            <a>版权所有</a>--}}
{{--        </div>--}}
    </div>


<script type="text/javascript" src="resources/js/jquery.min.js"></script>
<script type="text/javascript" src="resources/js/jquery.downCount.js"></script>
<script type="text/javascript" src="resources/js/vue.js"></script>

</body>

<!-- Mirrored from condorthemes.com/cleanzone/ by HTTrack Website Copier/3.x [XR&CO'2013], Mon, 31 Mar 2014 14:32:27 GMT -->
</html>
<script class="source" type="text/javascript">
    // $('.countdown').downCount({
    //     date: '12/29/2022 23:59:55',
    //     offset: 8
    // }, function () {
    //     alert('倒计时结束!');
    // });

    $(document).ready(function(){
        var app = new Vue({
            el: '#contain',
            data: {
                minute: "10",
                second: "00",
                hour: "00",
                real_minute: "0",
                real_second: "59",
                real_hour: "0"
            },
            method:{
                downTime: function () {

                    $closeId = setInterval(function () {

                    }, 1000);
                }
            },
            created: function () {

            }
        })
    });
</script>
