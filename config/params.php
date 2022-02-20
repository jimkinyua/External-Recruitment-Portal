<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',

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
    ],

    'SystemConfigs'=>[
        'UsingNTLM'=>env('UsingNTLM'),
    ],


];
