<?php
require "database/database.php";

function insertDepartment(
    $name,
    $leader,
    $status,
    $beginDate,
    $logo = null
) {
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