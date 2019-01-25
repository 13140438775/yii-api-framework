<?php

namespace app\modules\v1\controllers;

use app\controllers\BaseController;
use Yii;

class UserController extends BaseController {
    public function actionView() {
        return [
            'get' => Yii::$app->request->getQueryParams(),
            'post' => Yii::$app->request->getBodyParams(),
            'headers' => Yii::$app->request->getHeaders()->toArray()
        ];
    }
    
    public function actionIndex() {
        return [
            'get' => \Yii::$app->request->getQueryParams(),
            'post' => \Yii::$app->request->getBodyParams(),
        ];
    }
    
    public function actionCreate() {
        return [
            'get' => \Yii::$app->request->getQueryParams(),
            'post' => \Yii::$app->request->getBodyParams(),
        ];
    }
}
