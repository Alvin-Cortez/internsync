<?php

require_once 'model/Logs.php';

class UserController extends User{

    public function dashboard(){
        $userData = $this->showUserInfo();
        $logs = new Logs();
        $tasks = $logs->showRecentLogs();
        require 'views/dashboard.php';
    }

}