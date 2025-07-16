<?php

require_once 'model/Logs.php';

class UserController extends User{

    public function dashboard(){
        $timeSummary = $this->getUserTimeSummary();
        $logs = new Logs();
        $tasks = $logs->showRecentLogs();
        require 'views/dashboard.php';
    }

    public function update($data){
        $fName = $data['firstName'];
        $lName = $data['lastName'];

        if(empty($fName) || empty($lName)){
            echo json_encode(['status' => 'error', 'msg' => 'All fields are required!']);
            exit();
        }
        echo $this->updateProfile($fName, $lName);
        exit();
    }
}