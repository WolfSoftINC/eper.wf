<?php
// session
if ($_SERVER['SERVER_NAME'] == 'eper.wf') {
  $_SESSION['dev'] = true;
}

// session
if (!isset($_SESSION['user'])) $_SESSION['user'] = 'guest';

/*Общие настройки*/
if (isset($_SESSION['dev'])) ini_set('display_errors', 1);
else ini_set('display_errors', 0);
error_reporting(E_ALL);
?>