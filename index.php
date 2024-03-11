<?php 
// khoi dong session
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
require 'config/constant.php';
require 'helper/CommonHelper.php';

if(file_exists('route/web.php')){
    require 'route/web.php';
} else {
    die('Sorry, website can not access');
}