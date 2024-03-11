<?php
require "model/LoginModel.php"; // import model

// http://localhost/students/index.php?c=login&m=index
// m : ten ham nam trong controller
// vd : index
$m = trim($_GET['m'] ?? 'index'); // trim : xoa khoang trang 2 dau
$m = strtolower($m); // chuyen ve chu thuong

switch($m){
    case 'index':
        index();
    break;
    case 'handle':
        handleLogin();
    break;
    default:
        echo 'Not found request';
    break;
}
function handleLogin(){
    // kiem tra nguoi bam submit login chua ?
    if(isset($_POST['btnLogin'])){
        // lay thong tin username
        $username = trim($_POST['username'] ?? null);
        $username = strip_tags($username);

        // lay thong tin password
        $password = trim($_POST['password'] ?? null);
        $password = strip_tags($password);

        if(empty($username) || empty($password)){
            // nguoi dung ko nhap du thong tin
            // quay ve lai trang login
            header("Location:index.php?state=error");
        } else {
            // nguoi dung co nhap du thong tin
            $userInfo = checkLoginUser($username, $password);
        }
    }
}
function index(){
    
    // load view
    require APP_PATH_VIEW . 'login/index_view.php';
}
