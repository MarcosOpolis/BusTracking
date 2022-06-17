<?php

class Driver_Model extends CI_Model {

    function __construct() {
        parent::__construct();
	}

    function SaveDriver($name,$nic,$vehiNo,$conNo) {

        //check already exist nic 
        $this->db->where('nic', $nic);
        $query = $this->db->get('tbldriver');

        if ($query->num_rows() < 1) {

            //save Data
            $data = array(
                'name' => $name,
                'nic' => $nic,
                'vehiNo' => $vehiNo,
                'conNo' => $conNo,
                'status' => "OK"
                
            );
            $this->db->insert('tbldriver', $data);
            return $this->db->insert_id();
        } else {
             return 0;
        }
    }

    function SaveChildren($driverNIC,$parentNIC,$childrenName,$school,$fee) {

       
            $data = array(
                'driverNIC' => $driverNIC,
                'ParentNIC' => $parentNIC,
                'childrenName' => $childrenName,
                'school' => $school,
                'fee' => $fee
                
            );
            $this->db->insert('tbldriverschildren', $data);
            return $this->db->insert_id();
       
    }

    function SaveLocation($driverID,$lat,$lng) {

        date_default_timezone_set('Asia/Colombo');
        $date = date("Y-m-d");
       
            $data = array(
                'driverID' => $driverID,
                'lat' => $lat,
                'lng' => $lng,
                'serviceDate' => $date
            );
            $this->db->insert('tbllocation', $data);
            return $this->db->insert_id();
       
    }

    function GetAllChildren(){
        $this->db->select('*');
        $this->db->from('tbldriverschildren');
        $query = $this->db->get();
        return $query->result_array();
    }

     function GetAll(){
        $this->db->select('*');
        $this->db->from('tbldriver');
        $query = $this->db->get();
        return $query->result_array();
    }

     public function GetDriverLocation($driverID){

        date_default_timezone_set('Asia/Colombo');
        $date = date("Y-m-d");

        $condition = "serviceDate =" . "'" . $date . "'";
        $condition2 = "driverID =" . "'" . $driverID . "'";

        $query = $this->db->select('*')->where($condition)->where($condition2)->order_by('id','desc')->limit(1)->get('tbllocation')->row('id');


        //get current location from max id
        $condition = "id =" . "'" . $query . "'"; 
        $this->db->select('*');
        $this->db->from('tbllocation');
        $this->db->where($condition);
        $query = $this->db->get();

        return $query->result_array();


    } 
	

}
