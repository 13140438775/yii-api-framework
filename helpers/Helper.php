<?php
/**
 * Helper func
 *
 * @Author     : Fri@likingfit.com
 * @CreateTime 27/07/2018 16:56:17
 */

namespace app\helpers;

use Yii;
use yii\httpclient\Client;

class Helper {
    public static function Curl($url, $method, $data) {
        try {
            $client   = new Client();
            $response = $client->createRequest()
                               ->addHeaders([
                                   'Content-Type' => 'application/json'
                               ])
                               ->setOptions([
                                   'timeout' => 3
                               ])
                               ->setUrl($url)
                               ->setMethod($method)
                               ->setData($data)
                               ->send();
            
            if (!$response->isOk) {
                Yii::error("curl no 200");
                return false;
            }
            
            return $response->data;
        } catch (\Exception $e) {
            Yii::error($e->getMessage());
            return false;
        }
    }
    
    /**
     * generate random string by specify length
     *
     * @param $length
     *
     * @return string
     * @throws \yii\base\Exception
     * @CreateTime 2018/5/31 11:59:07
     * @Author     : fangxing@likingfit.com
     */
    public static function generateRandomStr($length) {
        $security = Yii::$app->getSecurity();
        
        return $security->generateRandomString($length);
    }
}