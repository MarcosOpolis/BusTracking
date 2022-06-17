<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Driver extends CI_Controller{
    function __construct(){
        parent::__construct();
       //$this->check_isvalidated();
       $this->load->model('Driver_Model');
       $this->load->model('User_model');
        
    }

    public function ManageDriver(){
        
        $All_Driver = $this->Driver_Model->GetAll();
        $data['All_Driver'] = $All_Driver;

        $data['main_content'] = 'Driver/ManageDriver';
        $this->load->view('admin/master', $data);

    }
    public function AllDriver(){
            
            $All_Driver = $this->Driver_Model->GetAll();
            $data['All_Driver'] = $All_Driver;

            $data['main_content'] = 'Driver/AllDriver';
            $this->load->view('admin/master', $data);

    }

    public function AddDriver(){

        $data['main_content'] = 'Driver/AddDriver';
        $this->load->view('admin/master', $data);

    }

    public function DriverLocation(){

        $ID = $_GET['id'];

        $All_Driver = $this->Driver_Model->GetDriverLocation($ID);
        $data['All_Driver'] = $All_Driver;

        $data['main_content'] = 'Driver/ShowLocation';
        $this->load->view('admin/master', $data);

    }

    public function SaveDriver(){

        $status = "success";
        $msg = "";

        $name = trim($this->security->xss_clean($this->input->post('name')));
        $nic = trim($this->security->xss_clean($this->input->post('nic')));
        $vehiNo = trim($this->security->xss_clean($this->input->post('vehiNo')));
        $conNo = trim($this->security->xss_clean($this->input->post('conNo')));
        $pw = trim($this->security->xss_clean($this->input->post('pw')));
         
        $file_id = $this->Driver_Model->SaveDriver($name,$nic,$vehiNo,$conNo);

            if ($file_id !== null) {
                if($file_id===0){
                    $status = "success";
                    $msg = "Duplicate Driver found";
                }else{

                    $this->User_model->createUser($nic,"Driver",$pw);

                    $status = "success";
                    $msg = "New Driver Register Success";
                }
            } else {
                $status = "error";
                $msg = "Something went wrong!!, please try again.";
            }
       
        echo json_encode(array('status' => $status, 'msg' => $msg));
    
    }
    
 }
 ?>