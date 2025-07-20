<?php

require_once 'model/Logs.php';
require_once 'model/User.php';

class UserController extends User{

    public function dashboard(){
        $timeSummary = $this->getUserTimeSummary();
        $logs = new Logs();
        $tasks = $logs->showRecentLogs();
        require 'views/dashboard.php';
    }

    public function profile(){
        $userProfile = $this->getUserProfile();
        require 'views/logs.php';
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

    public function updatePassword($data){
        $currrentPass = $data['currentPassword'];
        $newPass = $data['newPassword'];
        $confirmPass = $data['confirmPassword'];

        if(empty($currrentPass) || empty($newPass) || empty($confirmPass)){
            echo json_encode([
                'status' => 'error-all',
                'msg' => 'All fields are required!'
            ]);
            exit();
        }

        return $this->changePassword($currrentPass, $newPass, $confirmPass);
    }

    public function updateEmail($data){
        $email = $data['newEmail'];
        $pass = $data['emailPass'];

        if(empty($email) || empty($pass)){
            echo json_encode(['status' => 'error-all', 'msg' => 'All fields are required!']);
            exit();
        }

        return $this->changeEmail($email, $pass);
    }
}