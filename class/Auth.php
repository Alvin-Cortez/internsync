<?php 

class Auth extends Db {

    protected function checkUser($user) {
        $stmt = $this->connect()->prepare('SELECT username FROM users WHERE username = ?;');
        if(!$stmt->execute([$user])){
            $stmt = null;
            header('location:../index.php?error=stmtfailed');
            exit();
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($result) > 0){
            return false;
        } else {
            return true;
        }
    }

    protected function createUser($user, $pass, $hours){
        $stmt = $this->connect()->prepare(('INSERT INTO users (username, password, hours) VALUES (?, ?, ?);'));
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
        if(!$stmt->execute([$user, $hashedPass, $hours])){
            $stmt = null;
            header('location:../index.php?error=stmtfailed');
            exit();
        } 
    }
}