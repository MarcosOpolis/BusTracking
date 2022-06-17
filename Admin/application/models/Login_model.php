<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Login_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function validate($uName,$password){

        //check username and password
        $this->db->where('uname', $uName);
        $this->db->where('password', $password);
        
        $query = $this->db->get('tbluser');
        if($query->num_rows() == 1)
        {
            //store session 
            $row = $query->row();
            $data = array(
                    'userID' => $row->id,
                    'userName' => $row->uname,
                    'userType' => $row->utype,
                    'validated' => true
                    );
            $this->session->set_userdata($data);
            return true;
        }
        return false;
    }
}

