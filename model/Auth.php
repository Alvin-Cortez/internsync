<?php

class Auth extends Db {

    /* SIGNIN FUNCTIONALITY */

    protected function getUser($email, $pass){
        $stmt = $this->connect()->prepare('SELECT id, firstName, lastName, email, password FROM users WHERE email = ?;');
        if(!$stmt->execute([$email])){
            $stmt = null;
            header('location:index.php?error=stmtfailed');
            exit();
        }

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if($stmt->rowCount() == 0){
            header('location:index.php?error=error=usernotfound');
            exit();
        } 

        if(!password_verify($pass, $userData['password'])){
            header('location:index.php?error=incorrectPassword');
            exit();
        }

        session_start();
        $_SESSION['first_name'] = $userData['firstName'];
        $_SESSION['last_name'] = $userData['lastName'];
        $_SESSION['email'] = $userData['email'];
        $_SESSION['user_id'] = $userData['id'];
    }

    /* SIGNUP FUNCTIONALITY */

    protected function createUser($fname, $lname, $email, $hours, $pass){
        $stmt = $this->connect()->prepare(('INSERT INTO users (firstName, lastName, email, hours, password) VALUES (?, ?, ?, ?, ?);'));
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

        if(!$stmt->execute([$fname, $lname, $email, $hours, $hashedPass])){
            $stmt = null;
            header('location:index.php?error=stmtfailed');
            exit();
        }

        header('Location:index.php?error=none');
        exit();
    }

    protected function checkUser($email) {
        $stmt = $this->connect()->prepare('SELECT email FROM users WHERE email = ?;');
        if(!$stmt->execute([$email])){
            $stmt = null;
            header('location:index.php?error=stmtfailed');
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