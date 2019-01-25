<?php
/**
 * User model.
 *
 * @Author     : sunforcherry@gmail.com
 * @CreateTime 2018/7/20 18:18:44
 */

namespace app\models;

use Lcobucci\JWT\Token;

class User extends Base {
    public static function tableName() {
        return 't_user';
    }
    
    public static function findIdentity(Token $jwt) {
        //return static::findOne($id);
        return [
            'id' => $jwt->getClaim('user_id'),
            'name' => 'info'
        ];
    }
}