<?php
require "database/database.php";

function insertDepartment($name, $leader, $status, $beginDate){
    $db = connectionDb();
    $flagInsert = false;
    $sqlInsert = "INSERT INTO `departments`(`name`, `slug`, `leader`,`beginning_date`, `status`, `created_at`) VALUES(:nameDepartment, :slug, :leader, :beginning_date, :statusDepartment, :created_at)";
    $stmt = $db->prepare($sqlInsert);
    return $flagInsert;
}