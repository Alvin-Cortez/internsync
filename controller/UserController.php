<?php

require_once 'model/Logs.php';

class UserController extends User{

    public function dashboard(){
        $timeSummary = $this->getUserTimeSummary();
        $logs = new Logs();
        $tasks = $logs->showRecentLogs();
        require 'views/dashboard.php';
    }

}