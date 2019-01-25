<?php
/**
 * Response log.
 *
 * @Author     : Fri@likingfit.com
 * @CreateTime 2018/7/24 11:29:19
 */

namespace app\behaviors;

use Yii;

class ResponseLog extends \app\filters\ResponseFilter {
    public function beforeSend($response) {
        $log              = [
            'request'    => Yii::$app->request->getHeaders()->toArray(),
            'params'     => array_merge(Yii::$app->request->getQueryParams(), Yii::$app->request->getBodyParams()),
            'response'   => $response->data
        ];
        
        Yii::info(json_encode($log));
    }
}