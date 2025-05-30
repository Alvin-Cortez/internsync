<?php 

if($_SERVER['REQUEST_METHOD']){
    $username = $_POST['username'];
    $pass = $_POST['password'];

    include '../class/Db.php';
    include '../class/Auth.php';
    include '../controller/AuthController.php';

    $authController = new AuthController($username, $pass);
    $authController->signIn();

    header('location:../index.php?=signinSuccess');
    exit();
}