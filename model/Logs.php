<?php

class Logs extends Db{

    public function addLog($date, $timeIn, $timeout, $activity)
    {
        $id = $_SESSION['user_id'];

        $dateObj = DateTime::createFromFormat('m/d/y', $date);
        $dateFormatted = $dateObj ? $dateObj->format('Y-m-d') : null;

        $start = DateTime::createFromFormat('h:i a', $timeIn);
        $end = DateTime::createFromFormat('h:i a', $timeout);
        if (!$dateFormatted || !$start || !$end) {
            header('location:index.php?page=logs');
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

    public function showLogs($limit, $offset){
        $stmt = $this->connect()->prepare('SELECT * FROM logs WHERE userId = ? ORDER BY id DESC LIMIT ? OFFSET ?');
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

    public function countLogs(){
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

    protected function editLog($logId, $date, $timeIn, $timeOut, $activity) {
        $dateObj = DateTime::createFromFormat('Y-m-d', trim($date));
        $start = DateTime::createFromFormat('H:i:s', trim($timeIn));
        $end = DateTime::createFromFormat('H:i:s', trim($timeOut));

        if (!$dateObj || !$start || !$end) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid date or time format.'
            ]);
            exit();
        }

        $dateFormatted = $dateObj->format('Y-m-d');
        $interval = $start->diff($end);
        $totalMinutes = $interval->h * 60 + $interval->i;

        if ($totalMinutes >= 300 && $end->format('H:i') !== '12:00') {
            $totalMinutes -= 60;
        }

        $startFormatted = $start->format('H:i:s');
        $endFormatted = $end->format('H:i:s');
        $totalHours = round($totalMinutes / 60, 2);

        $stmt = $this->connect()->prepare('UPDATE logs SET date = ?, timeIn = ?, timeOut = ?, totalHours = ?, activity = ? WHERE id = ?');
        if (!$stmt->execute([$dateFormatted, $startFormatted, $endFormatted, $totalHours, $activity, $logId])) {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update log in the database.']);
            exit();
        }

        echo json_encode(['status' => 'success', 'message' => 'Log updated successfully.']);
        exit();
    }

    protected function removeLog(){

    }
}