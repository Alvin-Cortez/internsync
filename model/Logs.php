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
            echo json_encode(['status' => 'error', 'msg' => 'Invalid Date & Time Format, Please follow the placeholder']);
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
            echo json_encode(['status' => 'error', 'msg' => 'Unable to execute']);
            exit();
        } else {
            echo json_encode(['status' => 'success', 'msg' => 'Log added successfully']);
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
            echo json_encode(['status' => 'error', 'msg' => 'Unable to execute']);
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
            echo json_encode(['status' => 'error', 'msg' => 'Unable to execute']);
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
                'msg' => 'Invalid date or time format.'
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
            echo json_encode(['status' => 'error', 'msg' => 'Failed to update log in the database.']);
            exit();
        } else {
            echo json_encode(['status' => 'success', 'msg' => 'Log updated successfully.']);
            exit();
        }
    }

    protected function removeLog($id) {
        $stmt = $this->connect()->prepare('DELETE FROM logs WHERE id = ?');
        if ($stmt->execute([$id])) {
            echo json_encode(['status' => 'success', 'msg' => 'Log deleted successfully']);
            exit();
        } else {
            echo json_encode(['status' => 'error', 'msg' => 'Unable to delete log']);
            exit();
        }
    }

    public function countSearchResult($data) {
        $sql = 'SELECT COUNT(*) FROM logs WHERE userId = ? AND (
            date LIKE ? 
            OR DATE_FORMAT(date, "%b") LIKE ? 
            OR DATE_FORMAT(date, "%M") LIKE ? 
            OR DATE_FORMAT(date, "%m") LIKE ? 
            OR totalHours LIKE ? 
            OR activity LIKE ?
        )';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([
            $_SESSION['user_id'],
            "%$data%",
            "%$data%",
            "%$data%",
            "%$data%",
            "%$data%",
            "%$data%"
        ]);
        return $stmt->fetchColumn();
    }

    public function showSearchResult($data, $perPage ,$offset){
        $limit = intval($perPage);
        $offset = intval($offset);
        $sql = 'SELECT * FROM logs WHERE userId = ? AND (
            date LIKE ? 
            OR DATE_FORMAT(date, "%b") LIKE ? 
            OR DATE_FORMAT(date, "%M") LIKE ? 
            OR DATE_FORMAT(date, "%m") LIKE ? 
            OR totalHours LIKE ? 
            OR activity LIKE ?
        ) LIMIT ' . $limit . ' OFFSET ' . $offset;

        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([
            $_SESSION['user_id'],
            "%$data%",
            "%$data%",
            "%$data%",
            "%$data%",
            "%$data%",
            "%$data%"
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}