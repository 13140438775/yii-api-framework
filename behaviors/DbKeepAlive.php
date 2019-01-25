<?php
/**
 * Db KeepAlive.
 *
 * @Author     : Fri@likingfit.com
 * @CreateTime 2018/7/23 11:13:28
 */
namespace app\behaviors;

use Yii;
use app\filters\RequestFilter;

class DbKeepAlive extends RequestFilter
{
    public function beforeAction($request) {
        if(Yii::$app->db->isGoneWay()){
            Yii::$app->db->close();
        }
    }
}