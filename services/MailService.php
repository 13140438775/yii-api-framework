<?php
/**
 * Email service.
 *
 * @Author     : Fri@likingfit.com
 * @CreateTime 2018/7/27 09:52:05
 */

namespace app\services;

use Yii;

class MailService {
    /**
     * Exception email notice.
     *
     * @param $flag
     * @param $key
     * @param $data
     *
     * @CreateTime 2018/7/27 10:38:34
     * @Author     : Fri@likingfit.com
     */
    public static function sendException($flag, $key, $data) {
        if (!Yii::$app->redis->exists($key)) {
            $tomorrow = strtotime(date('Y-m-d', strtotime('+1 day')));
            $now = time();
            Yii::$app->redis->setex($key, $tomorrow - $now, 0);
        }
        if (Yii::$app->redis->incr($key) > Yii::$app->errorHandler->dayRepeatNum) {
            return;
        }
        
        $toEmail = Yii::$app->errorHandler->toEmail;
        $subject = Yii::$app->name . " {$flag} " . date('Y-m-d H:i:s');
        
        foreach ($toEmail as $email) {
            Yii::$app->email->sendEx($data, $email, $subject);
        }
    }
}