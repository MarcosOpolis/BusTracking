<?php

class Parent_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function SaveParent($name,$nic,$address,$conNo,$email) {

        $this->db->where('nic', $nic);
        $query = $this->db->get('tblparent');

        if ($query->num_rows() < 1) {

            $data = array(
                'name' => $name,
                'nic' => $nic,
                'address' => $address,
                'tel' => $conNo,
                'email' => $email
                
            );

            $this->db->insert('tblparent', $data);
            return $this->db->insert_id();

        } else {
             return 0;
        }
    }

    function GetAll(){
        $this->db->select('*');
        $this->db->from('tblparent');
        $query = $this->db->get();
        return $query->result_array();
    }


    function SaveChildren($pid,$name,$school,$lat,$lng) {

        $data = array(
                'parentid' => $pid,
                'name' => $name,
                'school' => $school,
                'lat' => $lat,
                'lng' => $lng
                
            );
            $this->db->insert('tblchildren', $data);
            return $this->db->insert_id();
    }


    function saveAtt($name,$parentNIC,$driverNIC,$today){


        $this->db->where('name', $name);
        
        $query = $this->db->get('tblchildren');

        if($query->num_rows() == 1)
        {
                $row = $query->row();
                $dblat = $row->lat;
                $dblng = $row->lng;
                $dbschool = $row->school;

            $data = array(
                'parentid' => $parentNIC,
                'driverid' => $driverNIC,
                'childrenName' => $name,
                'school' => $dbschool,
                'homeLat' => $dblat,
                'homeLng' => $dblng,
                'serviceDate' => $today
                
            );
            $this->db->insert('tblservice', $data);        
            return $this->db->insert_id();


        }

    }

    public function GetAllAtt(){

        date_default_timezone_set('Asia/Colombo');
        $date = date("Y-m-d");

        $condition = "serviceDate =" . "'" . $date . "'";
        $this->db->select('*');
        $this->db->from('tblservice');
        $this->db->where($condition);
        $query = $this->db->get();

        return $query->result_array();


    }

    public function GetDriverLocation(){

        date_default_timezone_set('Asia/Colombo');
        $date = date("Y-m-d");

        $condition = "serviceDate =" . "'" . $date . "'";
        $query = $this->db->select('*')->where($condition)->order_by('id','desc')->limit(1)->get('tblservice')->row('id');

        // $this->db->select('*');
        // $this->db->from('tblservice');
        // $this->db->where($condition);
        // $query = $this->db->get();

        return $query->result_array();


    }


     function GetAllChildren(){
        $this->db->select('*');
        $this->db->from('tblchildren');
        $query = $this->db->get();
        return $query->result_array();
    }




}

