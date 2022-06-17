<?php


class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function createUser($userName,$userType,$pw){

            $encrypt = md5($pw);

            $data = array(
                'uname' => $userName,
                'password' => $encrypt,
                'utype' => $userType
               
            );
            $this->db->insert('tbluser', $data);
            return $this->db->insert_id();
       
    }
    function loginUser($userName,$password){
        $currentDate=date('Y-m-d');
        $dataR=array();

        $encrypt = md5($password);

        $this->db->where('uname', $userName);
        $this->db->where('password', $encrypt);
        $query = $this->db->get('tbluser');
        if ($query->num_rows() == 1) {
            
            $row = $query->row();

            $uName=$row->uname;
            $uType=$row->utype;

            return $query->result_array();

        }else{
            return false;
        }
    }
    
    function logoutUser($token){
        $this->db->where('token', $token);
        $this->db->delete('userlogin');  
        return true;
    }
    
   function changePassword($mobile,$password){
         $data = array(
                
                'password' => $password
            );
            $this->db->where('mobile', $mobile);
           if( $this->db->update('user',$data)){
                return true;
           }else{
                return false;
           }
           
    }
}

