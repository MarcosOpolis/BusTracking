<?php

class Payment_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function SavePayment($name,$date,$fee,$payment,$driverID,$parentid) {

            $data = array(
                'driverID' => $driverID,
                'parentid' => $parentid,
                'childrenName' => $name,
                'paymentDate' => $date,
                'fee' => $fee,
                'paymentAmount' => $payment
                
            );
            $this->db->insert('tblfee', $data);
            return $this->db->insert_id();
    }

    function GetPayment(){

        $this->db->select('*');
        $this->db->from('tblfee');
        $query = $this->db->get();
        return $query->result_array();

    }

    function Getfee($parentid){

        $condition = "parentid =" . "'" . $parentid . "'";
        $this->db->select('*');
        $this->db->from('tblfee');
        $this->db->where($condition);
        $query = $this->db->get();

        return $query->result_array();

    }




}

