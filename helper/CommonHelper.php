<?php 
if(!function_exists('getSessionUsername')){
    function getSessionUsername(){
        $username = $_SESSION['username'] ?? null;
        return $username;
    }
}
if(!function_exists('getSessionEmail')){
    function getSessionEmail(){
        $email = $_SESSION['email'] ?? null;
        return $email;
    }
}
if(!function_exists('getSessionIdUser')){
    function getSessionIdUser(){
        $idUser = $_SESSION['idUser'] ?? null;
        return $idUser;
    }
}
