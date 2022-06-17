<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class parents extends CI_Controller{
    function __construct(){
        parent::__construct();
       //$this->check_isvalidated();
       $this->load->model('Driver_Model');
       $this->load->model('User_model');
       $this->load->model('Parent_Model');
        
    }

    public function AllParent(){
            
            $All_Children = $this->Parent_Model->GetAllChildren();
            $data['All_Children'] = $All_Children; 

            $All_Parent = $this->Parent_Model->GetAll();
            $data['All_Parent'] = $All_Parent;

            $data['main_content'] = 'ViewAll/AllParent';
            $this->load->view('admin/master', $data);
    }



    
 }
 ?>