<?php

class User extends Db {

    protected function getUserTimeSummary(){
        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE id = ?');
        $id = $_SESSION['user_id'];
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->connect()->prepare('SELECT SUM(totalHours) as totalHours FROM logs WHERE userId = ?');
        $stmt->execute([$id]);
        $log = $stmt->fetch(PDO::FETCH_ASSOC);

        $required = $user['hours'];
        $rendered = floatval($log['totalHours']);
        $remainng = max(0, $required - $rendered);
        if(($rendered / $required) * 100 > 100){
            $percent = 100;
        } else {
            $percent = round(($rendered / $required) * 100);
        }

        return[
            'requiredHours' => $required,
            'renderedHours' => $rendered,
            'remainingHours' => $remainng,
            'renderedPercent' => $percent
        ];
    }

    protected function updateProfile($fName, $lName){
        $stmt = $this->connect()->prepare('UPDATE users SET firstName = ?, lastName = ? WHERE id = ?');
        $id = $_SESSION['user_id'];
        if(!$stmt->execute([$fName, $lName, $id])){
            echo json_encode(['status' => 'error', 'msg' => 'Unable to execute']);
            exit();
        }
        echo json_encode(['status' => 'success', 'msg' => 'Profile updated successfully']);
        exit();
    }
}