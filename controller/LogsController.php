<?php

class LogsController extends Logs{

    public function create($data){
        $date = $data['date'];
        $timeIn = $data['time-in'];
        $timeOut = $data['time-out'];
        $activity = $data['activity'];

        if(!$this->isEmptyInput($date, $timeIn, $timeOut, $activity))
        {
            header('location:index.php?page=logs');
            exit();
        }

        return $this->addLog($date, $timeIn, $timeOut, $activity);
    }

    public function get(){
        $tasks = $this->showLogs();
        require 'views/logs.php';
    }

    public function getRecent(){
        $tasks = $this->showLogs();
        require 'views/dashboard.php';
    }

    public function update(){
        
    }

    public function delete(){

    }

    private function isEmptyInput($date, $timeIn, $timeOut, $activity){
        if(empty($date) || empty($timeIn) || empty($timeOut) || empty($activity))
        {
            return false;
        }
        return true;
    }
}