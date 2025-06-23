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
        $perPage = 10;
        $page = isset($_GET['p']) ? max(1, intval($_GET['p'])) : 1;
        $offset = ($page - 1) * $perPage;

        $tasks = $this->showLogs($perPage, $offset);
        $total = $this->countLogs();
        $totalPages = ceil($total / $perPage);

        require 'views/logs.php';
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