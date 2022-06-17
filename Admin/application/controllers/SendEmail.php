<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Home controller class
 * This is only viewable to those members that are logged in
 */
 class SendEmail extends CI_Controller{
    function __construct(){
        parent::__construct();
       //$this->check_isvalidated();
       $this->load->library('email');
       $this->load->model('Payment_Model');
       $this->load->model('Attendance_Model');
        
    }

    public function SendIncomeReport(){

            $content = file_get_contents("php://input");
            $result = json_decode($content);

             //Get Data
            $totalAmount = $result->totalAmount;
            $totalDue = $result->totalDue;
            $income = $result->income;
            $sendEmail = $result->sendEmail;


            $msg = "Total Amount: ".$totalAmount. "\nTotal Due: ".$totalDue . "\nIncome: ".$income;


            $this->email->from('bus@gmail.com', 'Smart School Bus');
            $this->email->to($sendEmail);

            $this->email->subject('Income Report');
            $this->email->message($msg);

            

            if ($this->email->send()) {
                $status = "success";
                $resulta = $result;
            } else {
                $status = "error";
                $resulta = "Empty.";
            }

            echo json_encode(array('status' => $status, 'msg' => $resulta));
            
            return $result;
    }

    public function SendfeeStatus(){

            $content = file_get_contents("php://input");
            $result = json_decode($content);

             //Get Data
            $parentid = $result->parentid;
            $sendEmail = $result->sendEmail;

            $file_id = $this->Payment_Model->Getfee($parentid);

            $msg = "";

            if ($file_id) {
                $status = "success";

                $token = $file_id;

                foreach ($file_id as $value) {
                    $msg .=  "\nChildren Name: " . $value['childrenName'] . "\nPayment Date: " . $value['paymentDate'] . "\nVehicle Fee: " . $value['fee'] . "\nPayment: " . $value['fee'] . "\n***************************************\n";
                }


                 $this->email->from('bus@gmail.com', 'Smart School Bus');
                 $this->email->to($sendEmail);

                 $this->email->subject('Vehicle Fee Status');
                 $this->email->message($msg);

                if ($this->email->send()) {
                    $status = "success";
                } else {
                    $status = "error";
                }


            } else {
                $status = "error";
                $token = "Something went wrong., please try again.";
            }

            echo json_encode(array('status' => $status, 'msg' => $token));
            
            return $result;
               
    }

    public function SendDropPickReport(){

            $content = file_get_contents("php://input");
            $result = json_decode($content);

             //Get Data
            $name = $result->name;
            $sendEmail = $result->sendEmail;

            $file_id = $this->Attendance_Model->getLocation($name);

            $msg = "";

            if ($file_id) {
                $status = "success";

                $token = $file_id;

                foreach ($file_id as $value) {
                    $msg .=  "\nStatus: " . $value['msg'] . "\nTime: " . $value['msgtime'] . "\nDate: " . $value['msgDate'] . "\n***************************************\n";
                }


                 $this->email->from('bus@gmail.com', 'Smart School Bus');
                 $this->email->to($sendEmail);

                 $this->email->subject('Drop/Pickup Status-'.$name);
                 $this->email->message($msg);

                if ($this->email->send()) {
                    $status = "success";
                } else {
                    $status = "error";
                }


            } else {
                $status = "error";
                $token = "Something went wrong., please try again.";
            }

            echo json_encode(array('status' => $status, 'msg' => $token));
            
            return $result;
               
    }





 }
 ?>