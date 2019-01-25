<?php
/**
 * Exception Notice.
 *
 * @Author     : Fri@likingfit.com
 * @CreateTime 2018/7/27 12:59:01
 */

namespace app\behaviors;

use Yii;
use yii\base\Behavior;
use app\exceptions\BaseException;
use app\components\ErrorHandle;

class ExceptionNotice extends Behavior {
    /**
     * The same Exception, Number of notifications per day
     *
     * The same Exception: same request_url、request_method、request_get、request_post
     *
     * @var int
     */
    public $dayRepeatNum = 0;
    
    /**
     * Notice email
     *
     * @var array
     */
    public $toEmail = [];
    
    public function events() {
        return [
            ErrorHandle::EVENT_AFTER_RENDER => 'eventAfterError'
        ];
    }
    
    public function eventAfterError() {
        if (Yii::$app->errorHandler->exception instanceof BaseException) {
            return;
        }
        if (!$this->dayRepeatNum || !count($this->toEmail)) {
            return;
        }
        
        $prefix = date('Ymd') . ':ExceptionId:';
        $key    = Yii::$app->request->getUniqueId($prefix);
        Yii::$app->sw->task([
            'app\services\MailService',
            'sendException'
        ], '[Api Un know Exception]', $key, Yii::$app->errorHandler->getInfo());
    }
}