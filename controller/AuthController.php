<?php

class AuthController extends Auth{

    public function index(){
        return require 'views/index.php';
    }

    /* SIGN IN FUNCTIONALITY */
    public function signIn($data){
        $email = $data['email'];
        $pass = $data['pass'];

        if($this->isSignInEmpty($email, $pass) == false){
            header('location:index.php?error=emptyFields');
            exit();
        }

        return $this->getUser($email, $pass);
    }

    private function isSignInEmpty($email, $pass){
        if(empty($email) || empty($pass)){
            return false;
        }
        return true;
    }

    /* SIGN UP FUNCTIONALITY */

    public function signUp($data){
        $fname = $data['firstName'];
        $lname = $data['lastName'];
        $email = $data['regEmail'];
        $hours = $data['requiredHours'];
        $pass = $data['regPassword'];
        $confirm = $data['confirmPassword'];

        if($this->isSignUpEmpty($fname, $lname, $email, $hours, $pass, $confirm) == false){
            header('Location: index.php?error=allFieldseuired');
            exit();
        }
        if($this->isPasswordMatch($pass, $confirm) == false){
            header('Location: index.php?error=passwordNotMatch');
            exit();
        }
        if($this->isValidNumber($hours) == false){
            header('Location: index.php?error=hoursNotValidNumber');
            exit();
        }
        if($this->isValidEmail($email) == false){
            header('Location: index.php?error=invalidemail');
            exit();
        }
        if($this->usernameHasTaken($email) == false){
            header('Location: index.php?error=emailHasTaken');
            exit();
        }
        return $this->createUser($fname, $lname, $email, $hours, $pass);
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit();
    }

    private function isSignUpEmpty($fname, $lname, $email, $hours, $pass, $confirm): bool{
        if(empty($fname) || empty($lname) || empty($email) || empty($hours) || empty($pass) || empty($confirm)){
            return false;
        }
        return true;
    }

    private function isPasswordMatch($pass, $confirm){
        if($pass !== $confirm){
            return false;
        }
        return true;
    }

    private function isValidNumber($hours){
        if(!is_numeric($hours) || $hours <=0){
            return false;
        }
        return true;
    }

    private function isValidEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }
        return true;
    }

    private function usernameHasTaken($email){
        return $this->checkUser($email);
    }
}