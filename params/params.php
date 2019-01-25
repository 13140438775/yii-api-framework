<?php
/**
 * App params.
 *
 * @Author     : Fri@likingfit.com
 * @CreateTime 2018/7/19 15:44:13
 */
return [
    // params validate rules
    'requestHeadersRules' => [
        'user/index' => [
            [
                [
                    'timestamp',
                    'sign'
                ],
                'required',
                '参数错误'
            ],
            [
                'timestamp',
                \app\validators\NumberValidator::class,
                'minFunc' => function () {
                    return time();
                },
                'maxFunc' => function () {
                    return time() + 30;
                }
            ]
        ]
    ],
    // params validate rules
    'requestParamsRules' => [
        'user/create' => [
            [
                [
                    'param1',
                    'param2',
                    'param3'
                ],
                'required'
            ]
        ],
        'user/index' => [
            [
                'phone',
                'required',
                'message' => '手机号不能为空'
            ],
            [
                'phone',
                'match',
                'pattern' => '/^(((1[3|4|5|6|7|8|9]{1}[0-9]{1}))[0-9]{8})$/',
                'message' => '请输入正确的11位手机号'
            ]
        ],
    ],
];