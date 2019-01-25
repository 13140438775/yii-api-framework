<?php
/**
 * Sign validate
 *
 * @Author     : Fri@likingfit.com
 * @CreateTime 2018/7/24 11:29:19
 */

namespace app\behaviors;

use app\exceptions\RequestException;
use app\filters\RequestFilter;

class SignValidate extends RequestFilter {
    /**
     * data sign secret
     *
     * @var string
     */
    public $secretKey = [];
    
    public function beforeAction($request) {
        $header    = $request->getHeaders();
        $version   = $header->get('app-version');
        $signature = $header->get('signature');
        
        $secret = $this->getVersionSecret($version);
        if ($signature != $this->getSystemSign($request, $secret)) {
            throw new RequestException(RequestException::INVALID_SIGNATURE);
        }
    }
    
    public function getSystemSign($request, $secret) {
        $header      = $request->getHeaders();
        $requestId   = $header->get('request-id');
        $timestamp   = $header->get('request-time');
        $uri         = rtrim($request->getPathInfo(), "/");
        $queryString = $request->getQueryString();
        
        $data = [
            $secret,
            $timestamp,
            $requestId,
            $request->getRawBody(),
            "/" . $uri . ($queryString ? "?" . $queryString : "")
        ];
        sort($data, SORT_STRING);
        
        return sha1(implode($data));
    }
    
    public function getVersionSecret($version) {
        return isset($this->secretKey[$version]) ? $this->secretKey[$version] : '';
    }
}