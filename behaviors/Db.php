<?php
/**
 * Db Gone away
 *
 * @Author     : Fri@likingfit.com
 * @CreateTime 2018/7/23 11:13:28
 */
namespace app\behaviors;

use yii\base\Behavior;
use yii\db\Connection;

class Db extends Behavior {
    /**
     * db wait_time
     *
     * @var int
     */
    public $waitTime = 28000;
    
    /**
     * db connect_time
     *
     * @var int
     */
    private $connectTime = 0;
    
    public function events() {
        return array_merge(parent::events(), [
            Connection::EVENT_AFTER_OPEN => 'afterOpen'
        ]);
    }
    
    public function afterOpen() {
        $this->connectTime = time();
    }
    
    /**
     * check db gone way
     *
     * @return bool
     */
    public function isGoneWay() {
        if (time() - $this->connectTime > $this->waitTime) {
            return true;
        }
        
        return false;
    }
}