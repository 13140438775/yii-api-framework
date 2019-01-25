<?php
/**
 * Created by PhpStorm.
 *
 * @Author     : sunforcherry@gmail.com
 * @CreateTime 03/08/2018 11:13:07
 */

namespace app\models;

use yii\db\ActiveRecord;

class Base extends ActiveRecord {
    /**
     * 有效
     */
    const AVAILABLE = 1;
    /**
     * 无效
     */
    const UNAVAILABLE = 0;
    
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $this->update_time = time();
            if ($insert) {
                $this->create_time = time();
            }
            
            return true;
        }
        
        return false;
    }
}
