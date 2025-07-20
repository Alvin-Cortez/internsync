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
            echo json_encode(['status' => 'error-current', 'msg' => 'Current password is incorrect!']);
            exit();
        }

        if($_POST['newPassword'] !== $_POST['confirmPassword']){
            echo json_encode(['status' => 'error-pass', 'msg' => 'Passwords did not match']);
            exit();
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

    protected function changeEmail($email, $pass){
        $stmt = $this->connect()->prepare('SELECT email, password FROM users WHERE id = ?');
        $id = $_SESSION['user_id'];
        if(!$stmt->execute([$id])){
            echo json_encode(['status' => 'error', 'msg' => 'Unable to execute']);
            exit();
        }

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user['email'] == $email){
            echo json_encode(['status' => 'error-same', 'msg' => 'You already using this email']);
            exit();
        }

        if(!password_verify($pass, $user['password'])){
            echo json_encode(['status' => 'error-pass', 'msg' => 'Incorrect password!']);
            exit();
        }

        $emailStmt = $this->connect()->prepare('SELECT email FROM users WHERE email = ? AND id != ?');
        $emailStmt->execute([$email, $id]);
        if($emailStmt->rowCount() > 0){
            echo json_encode(['status' => 'error-avail', 'msg' => 'Email is already used by another user']);
            exit();
        }

        $updateStmt = $this->connect()->prepare('UPDATE users SET email = ? WHERE id = ?');
        if(!$updateStmt->execute([$email, $id])){
            echo json_encode(['status' => 'error', 'msg' => 'Unable to update email']);
            exit();
        }

        echo json_encode(['status' => 'success', 'msg' => 'Email updated successfully!']);
        exit();
    }
}