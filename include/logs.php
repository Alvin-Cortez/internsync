<?php 

if($_SERVER['REQUEST_METHOD']){
    $date = $_POST['date'];
    $timeIn = $_POST['time-in'];
    $timeOut = $_POST['time-out'];
    $activity = $_POST['activity'];

    include '../class/Db.php';
    include '../class/UserActivity.php';
    include '../controller/UserActivityController.php';

    $userController = new UserActivityController($date, $timeIn, $timeOut, $activity);
    $userController->saveActivity();
}