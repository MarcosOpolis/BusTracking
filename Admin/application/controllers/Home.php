<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Home controller class
 * This is only viewable to those members that are logged in
 */
 class Home extends CI_Controller{
    function __construct(){
        parent::__construct();
       //$this->check_isvalidated();
      //  $this->load->model('Item_Model');
      //  $this->load->model('Area_Model');
  	   // $this->load->model('Home_Model');
  	   // $this->load->model('Customer_Model');
        
    }

    public function index(){

        // //number of product
        // $All_Product = $this->Home_Model->AddProduct();
        // $data['All_Product'] = $All_Product;

        // //number of Category
        // $All_Category = $this->Home_Model->AddCategory();
        // $data['All_Category'] = $All_Category;

        // //number of Sale today
        // $All_Sale = $this->Home_Model->All_Sale();
        // $data['All_Sale'] = $All_Sale;

        // //total of income
        // $Total_Income = $this->Home_Model->All_Sale_Item();
		// $data['Total_Income'] = $Total_Income;

  //       $All_Service = $this->Area_Model->GetAllService();
  //       $data['All_Service'] = $All_Service;

  //       $All_Item = $this->Item_Model->GetAll();
  //       $data['All_Item'] = $All_Item;
		
		// $All_Product = $this->Customer_Model->GetAll();
		// $data['All_Customer'] = $All_Product;

        $data['main_content'] = 'Home/home';
        $this->load->view('admin/master', $data);
    }

    public function do_logout(){
        $this->session->sess_destroy();
        redirect('Login');
    }
    


   

    
 }
 ?>
