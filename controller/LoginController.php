<?php
// http://localhost/students/index.php?c=login&m=index
// m : ten ham nam trong controller
// vd : index
$m = trim($_GET['m'] ?? 'index'); // trim : xoa khoang trang 2 dau
$m = strtolower($m); // chuyen ve chu thuong

switch($m){
    case 'index':
        index();
    break;
    default:
        echo 'Not found request';
    break;
}
function index(){
    echo "Hello you";
}
