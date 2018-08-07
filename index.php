<?php
/*Начало сессий*/
session_start();

/* Константы */
define("ROOT",dirname(__FILE__));
define("SNAME",$_SERVER['SERVER_NAME']);

/*База данных*/
require_once(ROOT.'/config/setting.php');
require_once(ROOT.'/router.php');
require_once(ROOT.'/ct.php');
require_once(ROOT.'/db.php');

$router = new Router();
$router->run();

// exit session
// session_destroy();