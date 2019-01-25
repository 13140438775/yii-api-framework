<?php
/**
 * redis conf
 *
 * @Author     : Fri@likingfit.com
 * @CreateTime 2018/3/16 19:00:29
 */

return [
    'class'    => yii\redis\Connection::class,
    'hostname' => 'localhost',
    'port'     => 6379,
    'database' => 0,
    //if don't enable redis auth, comment this config.
    //'password' => '',
    'retries'  => 1
];