<?php
require "database/database.php";

function updateDepartmentById(
    $name,
    $leader,
    $status,
    $beginDate,
    $logo,
    $id
) {
    $db = connectionDb();
    $checkUpdate = false;
    $sql = "UPDATE `departments` SET `name` = :nameDepartment, `slug` = :slug, `leader` = :leader, `beginning_date` = :beginning_date, `status` = :statusDepartment, `logo` = :logo, `updated_at` = :updated_at WHERE `id` = :id AND `deleted_at` IS NULL";
    
    return $checkUpdate;
}

function getDetailDepartmentById($id = 0){
    $db = connectionDb();
    $sql = "SELECT * FROM `departments` WHERE `id` = :id AND `deleted_at` IS NULL";
    $stmt = $db->prepare($sql);
    $infoDepartment = [];
    if($stmt){
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $infoDepartment = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }   
    }
    disconnectionDb($db);
    return $infoDepartment;
}

function deleteDepartmentById($id = 0){
    // cap nhat lai mui gio vietnamese
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    $db = connectionDb();
    $sql = "UPDATE `departments` SET `deleted_at` = :deleted_at WHERE `id` = :id";
    $deletedAt = date("Y-m-d H:i:s");
    $stmt = $db->prepare($sql);
    $checkDelete = false;
    if($stmt){
        $stmt->bindParam(':deleted_at', $deletedAt, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if($stmt->execute()){
            $checkDelete = true;
        }
    }
    disconnectionDb($db);
    return $checkDelete;
}
function getAllDataDepartments(){
    $db = connectionDb();
    $sql = "SELECT * FROM `departments` WHERE `deleted_at` IS NULL";
    $stmt = $db->prepare($sql);
    $dataDepartments = [];
    if($stmt){
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $dataDepartments = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }
    disconnectionDb($db);
    return $dataDepartments;
}
function insertDepartment(
    $name,
    $leader,
    $status,
    $beginDate,
    $logo = null
) {
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $db = connectionDb();
    $flagInsert = false;
    $sqlInsert = "INSERT INTO `departments`(`name`, `slug`, `leader`,`beginning_date`, `status`, `logo`, `created_at`) VALUES(:nameDepartment, :slug, :leader, :beginning_date, :statusDepartment, :logo, :created_at)";
    $stmt = $db->prepare($sqlInsert);
    $currentDate = date('Y-m-d H:i:s');
    if($stmt){
        $stmt->bindParam(':nameDepartment', $name, PDO::PARAM_STR);
        $stmt->bindParam(':slug', $name, PDO::PARAM_STR);
        $stmt->bindParam(':leader', $leader, PDO::PARAM_STR);
        $stmt->bindParam(':beginning_date', $beginDate, PDO::PARAM_STR);
        $stmt->bindParam(':statusDepartment', $status, PDO::PARAM_INT);
        $stmt->bindParam(':logo', $logo, PDO::PARAM_STR);
        $stmt->bindParam(':created_at', $currentDate, PDO::PARAM_STR);
        if($stmt->execute()){
            $flagInsert = true;
        }
        disconnectionDb($db); // ngat ket noi database
    }
    // $flagInsert la true : insert thanh cong va nguoc lai
    return $flagInsert;
}