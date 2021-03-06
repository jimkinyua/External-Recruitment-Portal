<?php

return [
    'bsVersion' => '4.x', // this will set globally `bsVersion` to Bootstrap 5.x for all Krajee Extensions

    'adminEmail' => 'jimkinyua25@gmail.com',
    'senderEmail' => 'jimkinyua25@gmail.com',
    'senderName' => 'Kemri Recruitment Test',

    'NavisionUsername'=>env('NavisionUsername'),
    'NavisionPassword'=>env('NavisionPassword'),
    'server'=>env('server'),
    'WebServicePort'=>env('WebServicePort'),
    'ServerInstance'=>env('ServerInstance'),
    'CompanyName'=>env('CompanyName'),


    'codeUnits' => [
    ],
    'ServiceName'=>[
        'JobsList'=>'JobsList',//55057
        'JobsCard'=>'JobsCard',//55051
    ],

    'SystemConfigs'=>[
        'UsingNTLM'=>env('UsingNTLM'),
    ],


];
