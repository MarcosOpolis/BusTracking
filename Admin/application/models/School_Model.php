<?php

class School_Model extends CI_Model {

    function __construct() {
        parent::__construct();
	}

    function SaveSchool($name,$locatoin,$lat,$lon) {

        $this->db->where('name', $name);
        $query = $this->db->get('tblschool');

        if ($query->num_rows() < 1) {

            $data = array(
                'name' => $name,
                'location' => $locatoin,
                'lat' => $lat,
                'log' => $lon
                
            );
            $this->db->insert('tblschool', $data);
            return $this->db->insert_id();
        } else {
             return 0;
        }
    }

    function SaveDriversSchool($name,$driverNIC) {

        $this->db->where('schoolName', $name);
        $query = $this->db->get('tbldriversschool');

        if ($query->num_rows() < 1) {

            $data = array(
                'schoolName' => $name,
                'driverID' => $driverNIC
            );
            $this->db->insert('tbldriversschool', $data);
            return $this->db->insert_id();
        } else {
             return 0;
        }
    }

     function GetAll(){
        $this->db->select('*');
        $this->db->from('tblschool');
        $query = $this->db->get();
        return $query->result_array();
    }
	

}
