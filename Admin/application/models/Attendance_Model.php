<?php

class Attendance_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function pickFromHome($id,$today){

            $st = "YES";

            $dataa = array(
                'homePickStatus' => $st,
                'homePickTime' => $today
            );

            $this->db->where('id', $id);
            $this->db->update('tblservice', $dataa); 
            $this->updateNotification($id,"Picked From Home",$today);
            return true;

    }

    public function pickFromSchool($id,$today){
    

            $st = "YES";

            $dataa = array(
                'schoolPickStatus' => $st,
                'schoolPickTime' => $today
            );

            $this->db->where('id', $id);
            $this->db->update('tblservice', $dataa); 
            $this->updateNotification($id,"Picked From School",$today);
            return true;

    }

    public function DropSchool($id,$today){
    

            $st = "YES";

            $dataa = array(
                'schoolDropStatus' => $st,
                'schoolDropTime' => $today
            );

            $this->db->where('id', $id);
            $this->db->update('tblservice', $dataa); 
            $this->updateNotification($id,"Dropped Near School",$today);
            return true;

    }
    public function DropHome($id,$today){
        

                $st = "YES";

                $dataa = array(
                    'homeDropStatus' => $st,
                    'homeDropTime' => $today
                );

                $this->db->where('id', $id);
                $this->db->update('tblservice', $dataa); 
                $this->updateNotification($id,"Dropped Near Home",$today);
                return true;

        }

     public function updateNotification($id,$msg,$today){

        $this->db->where('id', $id);
        
        $query = $this->db->get('tblservice');

        $st = "YES";

        date_default_timezone_set('Asia/Colombo');
        $date = date("Y-m-d");

        if($query->num_rows() == 1)
        {
                $row = $query->row();
                $parentNIC = $row->parentid;
                $name = $row->childrenName;
                $driverNIC = $row->driverid;

            //save notification table
            $data2 = array(
                'serviceID' => $id,
                'parentnic' => $parentNIC,
                'childrenName' => $name,
                'driverid' => $driverNIC,
                'msg' => $msg,
                'msgtime' => $today,
                'msgDate' => $date,
                'status' => $st
                
            );
            $this->db->insert('tblnotification', $data2);      
            return $this->db->insert_id();
 
        }
    }

     public function GetAllNotification(){

        $st = "YES";

        $condition = "status =" . "'" . $st . "'";
        $this->db->select('*');
        $this->db->from('tblnotification');
        $this->db->where($condition);
        $query = $this->db->get();

        return $query->result_array();


    } 

    public function getLocation($name){


        $condition = "childrenName =" . "'" . $name . "'";
        $this->db->select('*');
        $this->db->from('tblnotification');
        $this->db->where($condition);
        $query = $this->db->get();

        return $query->result_array();


    }

    public function updateNotificationStatus($id){
        
            $st = "Read";

            $dataa = array(
                'status' => $st
            );

            $this->db->where('id', $id);
            $this->db->update('tblnotification', $dataa); 

            return true;
    }




}

