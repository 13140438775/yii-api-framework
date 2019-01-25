<?php
/**
 * FileTarget.
 *
 * @Author     : Fri@likingfit.com
 * @CreateTime 2018/3/19 11:22:59
 */

namespace app\components;

class FileTarget extends \yii\log\FileTarget {
    public $logDir;
    
    public $logFileName = 'app.log';
    
    public function export() {
        $this->logFile = call_user_func($this->logDir, $this->logFileName);
        parent::export();
    }
}