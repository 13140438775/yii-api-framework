<?php
/**
 * console config
 */
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [],
    'components' => [
        'request' => [
            'class' => 'yii\console\Request',
        ],
        'log' => [
            'flushInterval' => 1,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => [
                        'error',
                        'warning'
                    ],
                    'exportInterval' => 1,
                ],
            ],
        ],
        'db' => $db,
    ]
];

return $config;
