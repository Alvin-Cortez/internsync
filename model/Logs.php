<?php

class Logs extends Db{

    public function addLog($date, $timeIn, $timeout, $activity)
    {
        $id = $_SESSION['user_id'];

        $start = DateTime::createFromFormat('H:i', $timeIn);
        $end = DateTime::createFromFormat('H:i', $timeout);

        if (!$start || !$end || !$date) {
            header('location:index.php?page=logs'); // Invalid format
            exit();
        }

        $interval = $start->diff($end);
        $totalMinutes = $interval->h * 60 + $interval->i;

        if ($totalMinutes >= 300 && $end->format('H:i') != '12:00') {
            $totalMinutes -= 60;
        }

        $startFormatted = $start->format('H:i:s');
        $endFormatted = $end->format('H:i:s');
        $totalHours = round($totalMinutes / 60, 2);

        $stmt = $this->connect()->prepare(
            'INSERT INTO logs (userid, date, timeIn, timeOut, totalHours, activity) VALUES (?, ?, ?, ?, ?, ?)'
        );

        if (!$stmt->execute([$id, $date, $startFormatted, $endFormatted, $totalHours, $activity])) {
            header('location:index.php?page=logs'); // DB error
            exit();
        }
    }

    protected function showLogs($limit, $offset){
        $stmt = $this->connect()->prepare('SELECT * FROM logs WHERE userId = ? LIMIT ? OFFSET ?');
        $id = $_SESSION['user_id'];

        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->bindValue(2, $limit, PDO::PARAM_INT);
        $stmt->bindValue(3, $offset, PDO::PARAM_INT);

        if(!$stmt->execute()){
            header('location:index.php?page=logs');//stmtfailed
            exit();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function countLogs(){
        $stmt = $this->connect()->prepare('SELECT COUNT(*) FROM logs WHERE userId = ?');
        $id = $_SESSION['user_id'];
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }

    public function showRecentLogs(){
        $stmt = $this->connect()->prepare('SELECT * FROM logs WHERE userId = ? ORDER BY date DESC LIMIT 5');
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