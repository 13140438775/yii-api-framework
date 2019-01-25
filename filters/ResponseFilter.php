<?php
/**
 * Abstract response filter behavior.
 */
namespace app\filters;

use yii\web\Response;

abstract class ResponseFilter extends BaseFilter {
    public function events()
    {
        return [
            Response::EVENT_BEFORE_SEND => 'eventBeforeSend'
        ];
    }
    
    public function eventBeforeSend()
    {
        if (!$this->isActive()) {
            return;
        }
        
        $this->beforeSend(\Yii::$app->response);
    }
    
    /**
     * Response before send.
     *
     * @param $response
     */
    abstract public function beforeSend($response);
}