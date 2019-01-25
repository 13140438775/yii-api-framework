<?php
/**
 * Response Slow Api Notice.
 *
 * @Author     : Fri@likingfit.com
 * @CreateTime 2018/7/24 11:29:19
 */

namespace app\behaviors;

use Yii;

class ResponseSlowNotice extends \app\filters\ResponseFilter {
    /**
     * Api max response Seconds
     *
     * @var int
     */
    public $maxTime = 5;
    
    public function beforeSend($response) {
        $exclTime = time() - Yii::$app->request->getStartTime();
        
        if ($exclTime > $this->maxTime) {
            $prefix = date('Ymd') . ':TimeId:';
            $key    = Yii::$app->request->getUniqueId($prefix);
            
            Yii::$app->sw->task([
                'app\services\MailService',
                'sendException'
            ], '[Api Excl Time: ' . $exclTime . 's ]', $key, [
                'request_info' => Yii::$app->request->getInfo()
            ]);
        }
    }
}