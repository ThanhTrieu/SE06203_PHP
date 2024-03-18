<?php
require 'model/DepartmentModel.php';

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
       // tien hanh upload logo cua khoa
       $logo = null;
       if(!empty($_FILES['logo'])){
            // thuc su nguoi dung muon upload logo
            $logo = uploadFile(
                $_FILES['logo'],
                'public/uploads/images/',
                ['image/png','image/jpeg','image/jpg','image/svg'],
                3*1024*1024
            );
            if(empty($logo)){
                $_SESSION['error_department']['logo'] = 'Type file is allow .png, .jpg, .jpeg, .svg and size file <= 3Mb';
            } else {
                $_SESSION['error_department']['logo'] = null;
            }
       }
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

       if(  !empty($_SESSION['error_department']['name'])
            ||
            !empty($_SESSION['error_department']['leader'])
            ||
            !empty($_SESSION['error_department']['logo'])
        ) {
            // co loi - thong bao ve lai form add
            header("Location:index.php?c=department&m=add&state=fail");
       } else {
            // insert vao database
            if(isset($_SESSION['error_department'])){
                unset($_SESSION['error_department']);
            }
            $insert = insertDepartment($name, $leader, $status, $beginningDate, $logo);
            if($insert){
                header("Location:index.php?c=department&state=success");
            } else {
                header("Location:index.php?c=department&m=add&state=error");
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