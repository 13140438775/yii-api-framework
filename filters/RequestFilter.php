<?php
/**
 * Abstract request filter behavior.
 */

namespace app\filters;

use yii\base\Controller;

abstract class RequestFilter extends BaseFilter {
    public function events() {
        return [
            Controller::EVENT_BEFORE_ACTION => 'eventBeforeAction'
        ];
    }
    
    public function eventBeforeAction() {
        if (!$this->isActive()) {
            return;
        }
        
        $this->beforeAction(\Yii::$app->request);
    }
    
    /**
     * Controller before action.
     *
     * @param $request
     */
    abstract public function beforeAction($request);
}