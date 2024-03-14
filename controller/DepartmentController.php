<?php
$m = trim($_GET['m'] ?? 'index'); // trim : xoa khoang trang 2 dau
$m = strtolower($m); // chuyen ve chu thuong

switch($m){
    case 'index':
        index();
        break;
    case 'add':
        Add();
        break;
    case 'handle-add':
        handleAdd();
        break;
    default:
        index();
        break;
}
function handleAdd(){
    if(isset($_POST['btnSave'])){
       $name = trim($_POST['name'] ?? null);
       $name = strip_tags($name);

       $leader = trim($_POST['leader'] ?? null);
       $leader = strip_tags($leader);

       $status = trim($_POST['status'] ?? null);
       $status = $status === '0' || $status === '1' ? $status : 0;

       $beginningDate = trim($_POST['beginning_date'] ?? null);
       $beginningDate = date('Y-m-d', strtotime($beginningDate));

       // check du lieu
       $_SESSION['error_department'] = [];
       if(empty($name)){
            $_SESSION['error_department']['name'] = 'Enter name, please';
       } else {
            $_SESSION['error_department']['name'] = null;
       }
       if(empty($leader)){
            $_SESSION['error_department']['leader'] = "Enter name's leader, please";
       } else {
            $_SESSION['error_department']['leader'] = null;
       }

       if(!empty($_SESSION['error_department'])){
            // co loi - thong bao ve lai form add
            header("Location:index.php?c=department&m=add&state=fail");
       } else {
            // insert vao database
            if(isset($_SESSION['error_department'])){
                unset($_SESSION['error_department']);
            }
            
       }
    }
}
function Add(){

    require APP_PATH_VIEW . 'departments/add_view.php';
}
function index(){

    require APP_PATH_VIEW . 'departments/index_view.php';
}