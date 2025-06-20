<?php

class Logs extends Db{

    public function addLog($date, $timeIn, $timeout, $activity){
        $id = $_SESSION['user_id'];

        $dateObj = DateTime::createFromFormat('m/d/y', $date);
        $dateFormatted = $dateObj ? $dateObj->format('Y-m-d') : null;

        $start = DateTime::createFromFormat('h:i a', $timeIn);
        $end = DateTime::createFromFormat('h:i a', $timeout);

        if (!$dateFormatted || !$start || !$end) {
            header('location:index.php?page=logs');//Invalid date and time format
            exit();
        }

        $interval = $start->diff($end);
        $totalMinutes = $interval->h * 60 + $interval->i;

        if($totalMinutes >= 300 && $end->format('H:i') != '12:00')
        {
            $totalMinutes -=60;
        }

        $startFormatted = $start->format('H:i:s');
        $endFormatted = $end->format('H:i:s');
        $totalHours = round($totalMinutes / 60, 2); 

        $stmt = $this->connect()->prepare('INSERT INTO logs (userid, date, timeIn, timeOut, totalHours, activity) VALUES (?, ?, ?, ?, ?, ?)');
        if(!$stmt->execute([$id, $dateFormatted, $startFormatted, $endFormatted, $totalHours, $activity]))
        {
            header('location:index.php?page=logs');//stmtfailed
            exit();
        }
    }

    protected function showLogs(){
        $stmt = $this->connect()->prepare('SELECT * FROM logs WHERE userId = ?');
        $id = $_SESSION['user_id'];

        if(!$stmt->execute([$id])){
            header('location:index.php?page=logs');//stmtfailed
            exit();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function showRecentLogs(){
        $stmt = $this->connect()->prepare('SELECT * FROM logs WHERE userId = ? LIMIT 5');
        $id = $_SESSION['user_id'];

        if(!$stmt->execute([$id])){
            header('location:index.php?page=logs');//stmtfailed
            exit();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function editLog(){

    }

    protected function removeLog(){

    }
}