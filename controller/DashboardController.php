<?php

$m = trim($_GET['m'] ?? 'index'); // trim : xoa khoang trang 2 dau
$m = strtolower($m); // chuyen ve chu thuong

switch($m){
    case 'index':
        index();
        break;
    default:
        index();
        break;
}
function index(){

    // load view
    require APP_PATH_VIEW . 'dashboard/index_view.php';
}