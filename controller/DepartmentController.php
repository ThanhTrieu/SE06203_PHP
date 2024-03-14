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

    require APP_PATH_VIEW . 'departments/index_view.php';
}