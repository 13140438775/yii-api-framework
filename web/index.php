<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);// true or false
defined('YII_ENV') or define('YII_ENV', 'dev');// dev or test or prod

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

//dd($config);

(new yii\web\Application($config))->run();