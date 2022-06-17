<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login controller class
 */
class Login extends CI_Controller{
    
    function __construct(){
        parent::__construct();
       // $this->load->model('Product_Model');
    }
    
    public function index($msg = NULL){
        // Load our view to be displayed
        // to the user
        $data['msg'] = $msg;
        $this->load->view('Login/login',$data);
    }

    public function registerUser(){
        $data['main_content'] = 'User/AddUser';
        $this->load->view('admin/master', $data);
    }
 
    public function process(){
        // Load the model
        $this->load->model('Login_model');


        $uName = $this->security->xss_clean($this->input->post('txtusername'));
        $password = $this->security->xss_clean($this->input->post('txtpassword'));


        if($uName == "Admin" && $password == "123"){
            redirect('Home');
        }else{
             $msg = '<font color=red>Invalid username and/or password.</font><br />';
        
            // $data['msg'] = $msg;
                $this->index($msg);
        }


        // // Now we verify the result
        // if(! $result){
        //     // If user did not validate, then show them login page again
           
            
        // }else{
        //     // If user did validate, 
        //     // Send them to members area
            
        // }        
    }
}

