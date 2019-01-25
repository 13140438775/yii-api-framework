<?php
/**
 * Exception Response Behaviors
 *
 * @Author     : Fri@likingfit.com
 * @CreateTime 2018/7/23 11:13:28
 */

namespace app\behaviors;

use app\components\ErrorHandle;
use Yii;
use yii\base\Behavior;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\UnauthorizedHttpException;
use app\exceptions\BaseException;
use app\exceptions\RequestException;

class ExceptionResponse extends Behavior {
    /**
     * prod err code
     *
     * @var int
     */
    public $prodCode = 10000;
    /**
     * prod err msg
     *
     * @var string
     */
    public $prodMsg = 'system busy';
    
    public function events() {
        return [
            ErrorHandle::EVENT_BEFORE_RENDER => 'beforeRender'
        ];
    }
    
    public function beforeRender() {
        $exception = $this->owner->exception;
        
        $data['code'] = $exception->getCode();
        $data['msg']  = $exception->getMessage();
        
        if ($exception instanceof BaseException) {
            Yii::$app->response->setStatusCode(200);
        }
        else if ($exception instanceof NotFoundHttpException) {
            Yii::$app->response->setStatusCode(404);
            $data['code'] = RequestException::URI_ERR;
            $data['msg']  = RequestException::getReason(RequestException::URI_ERR);
        }
        else if ($exception instanceof ForbiddenHttpException) {
            Yii::$app->response->setStatusCode(403);
            $data['code'] = RequestException::PERMISSION_DENIED;
            $data['msg']  = RequestException::getReason(RequestException::PERMISSION_DENIED);
        }
        else if ($exception instanceof UnauthorizedHttpException) {
            Yii::$app->response->setStatusCode(401);
            $data['code'] = RequestException::UNAUTHORIZED_TOKEN;
            $data['msg']  = RequestException::getReason(RequestException::UNAUTHORIZED_TOKEN);
        }
        else {
            Yii::$app->response->setStatusCode(500);
            $data['debug'] = $this->owner->getInfo();
            Yii::error($data, 'ex');
            
            if (YII_ENV_PROD) {
                $data['code'] = $this->prodCode;
                $data['msg']  = $this->prodMsg;
                unset($data['debug']);
            }
        }
        
        Yii::$app->response->data = $data;
        Yii::$app->response->send();
    }
}