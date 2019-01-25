<?php
/**
 * RestFul url.
 *
 * @Author     : Fri@likingfit.com
 * @CreateTime 2018/7/19 15:00:42
 */
return [
    [
        'class'         => 'yii\rest\UrlRule',
        'pluralize'     => false,
        'controller'    => [
            'login',
            'user',
            'v1/user'
        ],
        'extraPatterns' => [
            'POST sms' => 'sms',
        ]
    ]
];