<?php
/**
 * Email components
 */
namespace app\components\email;

use yii\swiftmailer\Mailer;

class Email extends Mailer
{
    public $htmlLayout = false;
    
    public function sendEx($data,$email,$subject) {
        return $this->compose('@app/components/email/template/ex', $data)
                    ->setTo($email)
                    ->setSubject($subject)
                    ->send();
    }
}