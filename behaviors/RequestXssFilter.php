<?php
/**
 * Xss filter.
 */

namespace app\behaviors;

use app\filters\RequestFilter;

class RequestXssFilter extends RequestFilter {
    public function beforeAction($request)
    {
        $cleanQueryParams = self::xssCleaner($request->getQueryParams());
        $cleanBodyParams = self::xssCleaner($request->getBodyParams());
    
        $header = $request->getHeaders()->toArray();
        $cleanHeader = self::xssCleaner($header);
    
        $request->setQueryParams($cleanQueryParams);
        $request->setBodyParams($cleanBodyParams);
        foreach ($cleanHeader as $headerName => $headerValue) {
            $request->getHeaders()->set($headerName, $headerValue);
        }
    }
    
    public function xssCleaner($waitClean)
    {
        if (is_array($waitClean)) {
            foreach ($waitClean as $key => $reqValue) {
                $waitClean[$key] = self::xssCleaner($reqValue);
            }
        } else {
            $waitClean = self::cleanReqVal($waitClean);
        }
        
        return $waitClean;
    }
    
    public function cleanReqVal($reqVal)
    {
        $purifier = \HTMLPurifier::getInstance();
        $clean = $purifier->purify($reqVal);
        return $clean;
    }
}