<?php 

class AuthController extends Auth{
    private $user;
    private $pass;
    private $cPass;
    private $hours;

    public function __construct($user, $pass, $cPass, $hours)
    {
        $this->user = $user;
        $this->pass = $pass;
        $this->cPass = $cPass;
        $this->hours = $hours;
    }

    public function signUp(){
        if($this->isEmpty() == false){
            header('location:../index.php?error=allFieldseuired');
            exit();
        }
        if($this->isPasswordMatch() == false){
            header('location:../index.php?error=passwordNotMatch');
            exit();
        }
        if($this->isValidNumber() == false){
            header('location:../index.php?error=hoursNotValidNumber');
            exit();
        }
        if($this->usernameHasTaken() == false){
            header('location:../index.php?error=usernameHasTaken');
            exit();
        }

        return $this->createUser($this->user, $this->pass, $this->hours);

    }

    private function isEmpty(){
        if(empty($this->user) || empty($this->pass) || empty($this->cPass) || empty($this->hours)){
            return false;
        }
        return true;
    }

    private function isPasswordMatch(){
        if($this->pass !== $this->cPass){
            return false;
        }
        return true;
    }

    private function isValidNumber(){
        if(!is_numeric($this->hours) || $this->hours <=0){
            return false;
        }
        return true;
    }

    private function usernameHasTaken(){
        return $this->checkUser($this->user);
    }
}