<?php


//admin
//rosafloreternalgarden
//
//
//secretary
//rosaflorsecretary


defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);


$yii=dirname(__FILE__).'/protected/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';



require_once($yii);
Yii::createWebApplication($config)->run();
