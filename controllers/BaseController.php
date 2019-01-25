<?php
/**
 * Created by PhpStorm.
 *
 * @Author     : Fri@likingfit.com
 * @CreateTime 2018/3/19 15:05:29
 */

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\ForbiddenHttpException;
use app\exceptions\RequestException;
use app\behaviors\DbKeepAlive;
use app\behaviors\TokenValidate;
use app\behaviors\ParamsValidate;
use app\behaviors\RequestXssFilter;
use app\behaviors\SignValidate;

class BaseController extends Controller {
    public function behaviors() {
        return [
            'DbKeepAlive'          => [
                'class' => DbKeepAlive::class,
            ],
            'requestXssFilter'     => [
                'class' => RequestXssFilter::class,
            ],
            'requestHeadersFilter' => [
                'class'   => ParamsValidate::class,
                // 验证数据
                'data'    => Yii::$app->request->getHeaders()->toArray(),
                // 验证规则
                'rules'   => Yii::$app->params['requestHeadersRules'],
                // 错误回调函数
                'errFunc' => function ($data) {
                    throw new ForbiddenHttpException(reset($data), RequestException::INVALID_PARAM);
                },
                'except' => ['*']
            ],
            'requestParamsFilter'  => [
                'class'   => ParamsValidate::class,
                'data'    => array_merge(Yii::$app->request->getQueryParams(), Yii::$app->request->getBodyParams()),
                'rules'   => Yii::$app->params['requestParamsRules'],
                'errFunc' => function ($data) {
                    throw new RequestException(RequestException::INVALID_PARAM, reset($data));
                },
                'except' => ['*']
            ],
            'signValidate'         => [
                'class'     => SignValidate::class,
                'secretKey' => [
                    '1.1.0' => 'pb!@#$%%^&*(^^)',
                    '1.1.1' => 'pb!@#$%%^&*(^^)'
                ],
                'except' => ['*']
            ],
            'tokenValidate'        => [
                'class' => TokenValidate::class,
                'except' => ['*']
            ]
        ];
    }
}