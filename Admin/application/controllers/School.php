<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class School extends CI_Controller{
    function __construct(){
        parent::__construct();
       //$this->check_isvalidated();
        $this->load->model('School_Model');

        
	}
	
    public function AddSchool(){

        $data['main_content'] = 'School/AddSchool';
        $this->load->view('admin/master', $data);

    }

    public function ShowShool(){

         $All_School = $this->School_Model->GetAll();
         $data['All_School'] = $All_School; 

        $data['main_content'] = 'School/ViewAll';
        $this->load->view('admin/master', $data);

    }

    public function SaveSchool(){

        $status = "success";
        $msg = "";

        $name = trim($this->security->xss_clean($this->input->post('name')));
        $location = trim($this->security->xss_clean($this->input->post('location')));
        $lat = trim($this->security->xss_clean($this->input->post('lat')));
        $lon = trim($this->security->xss_clean($this->input->post('lon')));
         
        $file_id = $this->School_Model->SaveSchool($name,$location,$lat,$lon);

            if ($file_id !== null) {
                if($file_id===0){
                    $status = "success";
                    $msg = "Duplicate School found";
                }else{
                    $status = "success";
                    $msg = "New School Register Success";
                }
            } else {
                $status = "error";
                $msg = "Something went wrong!!, please try again.";
            }
       
        echo json_encode(array('status' => $status, 'msg' => $msg));
    
    }

 }
 ?>
