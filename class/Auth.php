<?php 

class Auth extends Db {

    /* SIGN IN FUNCTIONALITY */
    protected function getUser($user, $pass){
        $stmt = $this->connect()->prepare('SELECT id, username, password FROM user WHERE username = ?;');
        if(!$stmt->execute([$user])){
            $stmt = null;
            header('location:../index.php?error=stmtfailed');
            exit();
        }

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if($stmt->rowCount() == 0){
            header('location:../index.php?error=error=usernotfound');
            exit();
        } 

        if(!password_verify($pass, $userData['password'])){
            header('location:../index.php?error=incorrectPassword');
            exit();
        }

        session_start();
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['username'] = $userData['username'];
    }

    /* SIGN UP FUNCTIONALITY */
    protected function createUser($user, $pass, $hours){
        $stmt = $this->connect()->prepare(('INSERT INTO user (username, password, hours) VALUES (?, ?, ?);'));
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

        if(!$stmt->execute([$user, $hashedPass, $hours])){
            $stmt = null;
            header('location:../index.php?error=stmtfailed');
            exit();
        } 
    }

    protected function checkUser($user) {
        $stmt = $this->connect()->prepare('SELECT username FROM user WHERE username = ?;');
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
}