<?php

return [
    //是否开启异常通知
    'enabled'   =>  env('DING_ENABLED',true),
    // 机器人的access_token
     'token'    =>  env('DING_TOKEN',''),
    //是否显示Trace
    'trace'     =>  env('DING_TRACE',false),
];