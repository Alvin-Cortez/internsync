<?php

class Db{
    private $host = 'localhost';
    private $user = 'root';

    protected function connect(){
        try{
            $conn = new PDO(("mysql:host=$this->host;dbname=internsync"), $this->user , '');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }
}