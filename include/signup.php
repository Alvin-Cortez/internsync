<?php 

if($_SERVER['REQUEST_METHOD']){
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $cPass = $_POST['cPass'];
    $hours = $_POST['hours'];

    include_once '../class/Db.php';
    include_once '../class/Auth.php';
    include_once '../controller/AuthController.php';
    $authController = new AuthController($user, $pass, $cPass, $hours);
    $authController->signUp();

    header('location:../index.php?error=signupSuccess');
    exit();
}