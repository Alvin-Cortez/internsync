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

    protected function getUserProfile(){
        $stmt = $this->connect()->prepare('SELECT firstName, lastName, email FROM users WHERE id = ?');
        $id = $_SESSION['user_id'];
        if(!$stmt->execute([$id])){
            echo json_encode(['status' => 'error', 'msg' => 'Unable to execute']);
            exit();
        }

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $fname = $user['firstName'];
        $lname = $user['lastName'];
        $email = $user['email'];

        return [
            'firstName' => $fname,
            'lastName' => $lname,
            'email' => $email
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

    protected function changePassword(){
        $stmt = $this->connect()->prepare('SELECT password FROM users WHERE id = ?');
        $id = $_SESSION['user_id'];
        if(!$stmt->execute([$id])){
            echo json_encode(['status' => 'error', 'msg' => 'Unable to execute']);
            exit();
        }

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $currentPass = $_POST['currentPassword'];

        if(!password_verify($currentPass, $user['password'])){
            echo json_encode(['status' => 'error-current', 'msg' => 'Current password is incorrent!']);
            exit();
            $stmt = null;
        }

        if($_POST['newPassword'] !== $_POST['confirmPassword']){
            echo json_encode(['status' => 'error-pass', 'msg' => 'Passwords did not match']);
            exit();
            $stmt = null;
        }

        $hashedPass = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);

        $stmt = $this->connect()->prepare('UPDATE users set password = ? WHERE id = ?');
         if(!$stmt->execute([$hashedPass, $id])){
            echo json_encode(['status' => 'error', 'msg' => 'Unable to execute']);
            exit();
        }

        echo json_encode(['status' => 'success', 'msg' => 'Password updated successfully!']);
        exit();
    }
}