<?php
/**
 * Number dynamic validator
 *
 * @Author     : Fri@likingfit.com
 * @CreateTime 2018/7/19 15:44:13
 */

namespace app\validators;

class NumberValidator extends \yii\validators\NumberValidator {
    /**
     * min call func
     *
     * @var
     */
    public $minFunc;
    public $min = 1;
    
    /**
     * max call func
     *
     * @var
     */
    public $maxFunc;
    public $max = 2;
    
    public function validateAttribute($model, $attribute) {
        $this->max = call_user_func($this->maxFunc);
        $this->min = call_user_func($this->minFunc);
        parent::validateAttribute($model, $attribute);
    }
}