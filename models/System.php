<?php
/**
 * System model.
 *
 * @Author     : sunforcherry@gmail.com
 * @CreateTime 30/03/2018 17:33:19
 */

namespace app\models;

class System extends Base {
    const APP_ONLINE = 1;
    const APP_OFFLINE = 2;
    const APP_PARTNER = 3;
    
    public static function tableName() {
        return 't_system';
    }
}