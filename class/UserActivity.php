<?php

class userActivity extends Db{
    protected function createActivity($date, $timeIn, $timeOut, $activity){
        session_start();
        $id = $_SESSION['user_id'];
        $start = new DateTime($timeIn);
        $end = new DateTime($timeOut);
        $interval = $start->diff($end); 

        $totalMinutes = $interval->h * 60 + $interval->i;

        if ($totalMinutes >= 300 && $end->format('H:i') !== '12:00') {
            $totalMinutes -= 60;
        }

        if($totalMinutes < 0) $totalMinutes = 0;
        $decimalHours = round($totalMinutes / 60, 2);

        $stmt = $this->connect()->prepare('INSERT INTO logs (userId, date, timeIn, timeOut, totalHours, activity) VALUES (?, ?, ?, ?, ?, ?);');
        if(!$stmt->execute([$id, $date, $timeIn, $timeOut, $decimalHours, $activity])){
            header('location:../index.php?');
            exit();
        }

        header('location: ../logs.php?=Success');
        exit();
    }

    public function getAllLogsByUser($userId){
        $stmt = $this->connect()->prepare('SELECT * FROM logs WHERE userId = ?;');
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRecentLogs($userId) {
        $stmt = $this->connect()->prepare('SELECT date, totalHours, activity FROM logs WHERE userId = ? ORDER BY date DESC LIMIT 5');
        $stmt->execute([$userId]);
        return $stmt->fetchAll((PDO::FETCH_ASSOC));
    }

    public function getUserRequiredHours($userId){
        $stmt = $this->connect()->prepare('SELECT hours FROM user WHERE id = ?');
        $stmt->execute([$userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['hours'] : null;
    }

    public function totalTimeSpent($userId) {
        $stmt = $this->connect()->prepare('SELECT SUM(totalHours) AS totalHours FROM logs WHERE userId = ?');
        $stmt->execute([$userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['totalHours'] : 0;
    }

    public function getRemainingTime($userId){
        $requiredHours = $this->getUserRequiredHours($userId);
        $timeSpent = $this->totalTimeSpent($userId);
        return $requiredHours - $timeSpent;
    }

}