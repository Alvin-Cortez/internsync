<?php 

class UserActivityController extends userActivity{
    private $date;
    private $timeIn;
    private $timeOut;
    private $activity;

    public function __construct($date, $timeIn, $timeOut, $activity){
        $this->date = $date;
        $this->timeIn = $timeIn;
        $this->timeOut = $timeOut;
        $this->activity = $activity;
    }

    public function saveActivity(){
        if($this->isEmpty() == false){
            header('location:../logs.php?error=allfieldsrequired');
            exit();
        }

        return $this->createActivity($this->date, $this->timeIn, $this->timeOut, $this->activity);
    }

    private function isEmpty(){
        if(empty($this->date) || empty($this->timeIn) || empty($this->timeOut) || empty($this->activity)){
            return false;
        }
        return true;
    }
}