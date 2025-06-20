<?php

class User extends Db {

    protected function showUserInfo(){
        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE id = ?');
        $id = $_SESSION['user_id'];
        if(!$stmt->execute([$id])){
            header('location:index.php?page=dashboard');//stmtfailed
            exit();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}