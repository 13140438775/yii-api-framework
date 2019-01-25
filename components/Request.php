<?php
/**
 * Request.
 *
 * @Author     : Fri@likingfit.com
 * @CreateTime 2018/7/20 17:25:54
 */

namespace app\components;

use Yii;

class Request extends \yii\web\Request {
    
    /**
     * get request info
     *
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @CreateTime 2018/9/11 15:13:46
     * @Author     : Fri@likingfit.com
     */
    public function getInfo() {
        return [
            'path_info' => $this->getPathInfo(),
            'method'    => $this->getMethod(),
            'header'    => $this->getHeaders()
                                ->toArray(),
            'get'       => $this->get(),
            'post'      => $this->post()
        ];
    }
    
    /**
     * get request unique id
     *
     * @param string $prefix
     *
     * @return string
     * @throws \yii\base\InvalidConfigException
     * @CreateTime 2018/9/11 15:13:31
     * @Author     : Fri@likingfit.com
     */
    public function getUniqueId($prefix = ''){
        $id = md5(json_encode([
            $this->getPathInfo(),
            $this->getMethod(),
            $this->get(),
            $this->post()
        ]));
        
        return Yii::$app->id .":{$prefix}:".$id;
    }
}