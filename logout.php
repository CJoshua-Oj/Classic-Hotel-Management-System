<?php
declare(strict_types=1);
require_once __DIR__.'/config.php';
$_SESSION=[];if(ini_get('session.use_cookies')){setcookie(session_name(),'',time()-42000,session_get_cookie_params()['path']);}session_destroy();header('Location: login.php');exit;
