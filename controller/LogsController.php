<?php

class LogsController extends Logs{

    public function create($data){
        $date = $data['date'];
        $timeIn = $data['time-in'];
        $timeOut = $data['time-out'];
        $activity = $data['activity'];

        if(!$this->isEmptyInput($date, $timeIn, $timeOut, $activity))
        {
            echo json_encode(['status' => 'error', 'msg' => 'All fields are required!']);
            exit();
        }

        return $this->addLog($date, $timeIn, $timeOut, $activity);
    }

    public function update($data){
        $id = $data['log_id'];
        $date = $data['edit-date'];
        $timeIn = $data['edit-timeIn'];
        $timeOut = $data['edit-timeOut'];
        $activity = $data['edit-desc'];

        if(!$this->isEmptyInput($date, $timeIn, $timeOut, $activity)) {
            echo json_encode(['status' => 'error', 'msg' => 'All fields are required!']);
            exit();
        }

        if($this->editLog($id, $date, $timeIn, $timeOut, $activity)) {
            echo json_encode(['status' => 'success', 'msg' => 'Update Logs Successfully']);
            exit();
        } else {
            echo json_encode(['status' => 'error', 'msg' => 'Update failed']);
            exit();
        }
    }

    public function delete($data){
        $id = $data['id'];
        return $this->removeLog($id);
    }

    private function isEmptyInput($date, $timeIn, $timeOut, $activity){
        if(empty($date) || empty($timeIn) || empty($timeOut) || empty($activity))
        {
            return false;
        }
        return true;
    }
}