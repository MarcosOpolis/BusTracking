<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Home controller class
 * This is only viewable to those members that are logged in
 */
 class WebService extends CI_Controller{
    function __construct(){
        parent::__construct();
       //$this->check_isvalidated();
       $this->load->model('Driver_Model');
       $this->load->model('Parent_Model');
       $this->load->model('User_model');
       $this->load->model('School_Model');
       $this->load->model('Payment_Model');
       $this->load->model('Attendance_Model');
        
    }
    public function getDriverLocation(){

                $content = file_get_contents("php://input");
                $result = json_decode($content);

                $id = $result->id;

                $result=$this->Driver_Model->GetDriverLocation($id);

                if ($result) {
                    $status = "success";
                    $resulta = $result;
                } else {
                    $status = "error";
                    $resulta = "Empty.";
                }

                echo json_encode(array('status' => $status, 'msg' => $resulta));
                
                return $result;

        }

        public function getDropPickLocation(){

                $content = file_get_contents("php://input");
                $result = json_decode($content);

                $name = $result->name;

                $result=$this->Attendance_Model->getLocation($name);

                if ($result) {
                    $status = "success";
                    $resulta = $result;
                } else {
                    $status = "error";
                    $resulta = "Empty.";
                }

                echo json_encode(array('status' => $status, 'frommsg' => $resulta));
                
                return $result;

        }


    public function feeStatus(){

            $content = file_get_contents("php://input");
            $result = json_decode($content);


            $result=$this->Payment_Model->GetPayment();

            if ($result) {
                $status = "success";
                $resulta = $result;
            } else {
                $status = "error";
                $resulta = "Empty.";
            }

            echo json_encode(array('status' => $status, 'msg' => $resulta));
            
            return $result;
    }


    public function UpdatePickFromHome(){

            $content = file_get_contents("php://input");
            $result = json_decode($content);

             //Get Data
            $id = $result->id;

            date_default_timezone_set('Asia/Colombo');
            $today = date("h:i:sa");


            $result=$this->Attendance_Model->pickFromHome($id,$today);

            if ($result) {
                $status = "success";
                $resulta = $result;
            } else {
                $status = "error";
                $resulta = "Empty.";
            }

            echo json_encode(array('status' => $status, 'msg' => $resulta));
            
            return $result;
        }

        public function UpdateDropSchool(){

            $content = file_get_contents("php://input");
            $result = json_decode($content);

             //Get Data
            $id = $result->id;

            date_default_timezone_set('Asia/Colombo');
            $today = date("h:i:sa");


            $result=$this->Attendance_Model->DropSchool($id,$today);

            if ($result) {
                $status = "success";
                $resulta = $result;
            } else {
                $status = "error";
                $resulta = "Empty.";
            }

            echo json_encode(array('status' => $status, 'msg' => $resulta));
            
            return $result;
        }

         public function UpdatePickFromSchool(){

            $content = file_get_contents("php://input");
            $result = json_decode($content);

             //Get Data
            $id = $result->id;

            date_default_timezone_set('Asia/Colombo');
            $today = date("h:i:sa");


            $result=$this->Attendance_Model->pickFromSchool($id,$today);

            if ($result) {
                $status = "success";
                $resulta = $result;
            } else {
                $status = "error";
                $resulta = "Empty.";
            }

            echo json_encode(array('status' => $status, 'msg' => $resulta));
            
            return $result;
        }

        public function UpdateDropHome(){

            $content = file_get_contents("php://input");
            $result = json_decode($content);

             //Get Data
            $id = $result->id;

            date_default_timezone_set('Asia/Colombo');
            $today = date("h:i:sa");


            $result=$this->Attendance_Model->DropHome($id,$today);

            if ($result) {
                $status = "success";
                $resulta = $result;
            } else {
                $status = "error";
                $resulta = "Empty.";
            }

            echo json_encode(array('status' => $status, 'msg' => $resulta));
            
            return $result;
        }

        public function UpdateNotification(){

            $content = file_get_contents("php://input");
            $result = json_decode($content);

             //Get Data
            $id = $result->id;

            $result=$this->Attendance_Model->updateNotificationStatus($id);

            if ($result) {
                $status = "success";
                $resulta = $result;
            } else {
                $status = "error";
                $resulta = "Empty.";
            }

            echo json_encode(array('status' => $status, 'msg' => $resulta));
            
            return $result;
        }


     public function SaveAttendance(){

            $content = file_get_contents("php://input");
            $result = json_decode($content);

             //Get Data
            $parentNIC = $result->parentNIC;
            $driverNIC = $result->driverNIC;
            $name = $result->childrenName;

            date_default_timezone_set('Asia/Colombo');
            $date = date("Y-m-d");


            $result=$this->Parent_Model->saveAtt($name,$parentNIC,$driverNIC,$date);

            if ($result) {
                $status = "success";
                $resulta = $result;
            } else {
                $status = "error";
                $resulta = "Empty.";
            }

            echo json_encode(array('status' => $status, 'msg' => $resulta));
            
            return $result;
        }


    public function SavePayment(){

        $content = file_get_contents("php://input");
        $result = json_decode($content);

        date_default_timezone_set('Asia/Colombo');
        $date = date("Y-m-d");

        //Get Data
        $name = $result->name;
        $driverID = $result->driverID;
        $fee = $result->fee;
        $payment = $result->payment;
        $parentid = $result->parentid;


        $file_id = $this->Payment_Model->SavePayment($name,$date,$fee,$payment,$driverID,$parentid);
        if ($file_id) {
            $status = "success";

            $token = $file_id;
        } else {
            $status = "error";
            $token = "Something went wrong., please try again.";
        }

        echo json_encode(array('status' => $status, 'msg' => $token));
        
        return $result;
    }

    public function SaveLocation(){

        $content = file_get_contents("php://input");
        $result = json_decode($content);

        date_default_timezone_set('Asia/Colombo');
        $date = date("Y-m-d");

        //Get Data
        $driverID = $result->driverID;
        $lat = $result->lat;
        $lng = $result->lng;


        $file_id = $this->Driver_Model->SaveLocation($driverID,$lat,$lng);
        if ($file_id) {
            $status = "success";

            $token = $file_id;
        } else {
            $status = "error";
            $token = "Something went wrong., please try again.";
        }

        echo json_encode(array('status' => $status, 'msg' => $token));
        
        return $result;
    }

    public function SaveDriversChildren(){

        $content = file_get_contents("php://input");
        $result = json_decode($content);

        //Get Data
        $driverNIC = $result->driverNIC;
        $parentNIC = $result->parentNIC;
        $childrenName = $result->childrenName;
        $school = $result->school;
        $fee=$result->fee;

        $file_id = $this->Driver_Model->SaveChildren($driverNIC,$parentNIC,$childrenName,$school,$fee);
        if ($file_id) {
            $status = "success";
            // $this->User_model->createUser($nic,"Parent",$password);

            $token = $file_id;
        } else {
            $status = "error";
            $token = "Something went wrong., please try again.";
        }

        echo json_encode(array('status' => $status, 'msg' => $token));
        
        return $result;
    } 


    public function SaveDriversSchool(){

        $content = file_get_contents("php://input");
        $result = json_decode($content);

        //Get Data
        $driverNIC = $result->driverNIC;
        $school = $result->schoolName;

        $file_id = $this->School_Model->SaveDriversSchool($school,$driverNIC);
        if ($file_id) {
            $status = "success";
            // $this->User_model->createUser($nic,"Parent",$password);

            $token = $file_id;
        } else {
            $status = "error";
            $token = "Something went wrong., please try again.";
        }

        echo json_encode(array('status' => $status, 'msg' => $token));
        
        return $result;
    }

    public function ParentRegister(){

        $content = file_get_contents("php://input");
        $result = json_decode($content);

        //Get Data
        $name = $result->name;
        $nic = $result->nic;
        $address = $result->address;
        $tel = $result->tel;
        $email=$result->email;
        $password=$result->password;

        $file_id = $this->Parent_Model->SaveParent($name,$nic,$address,$tel,$email);
        if ($file_id) {
            $status = "success";

            $this->User_model->createUser($nic,"Parent",$password);

            $token = $file_id;
        } else {
            $status = "error";
            $token = "Something went wrong., please try again.";
        }

        echo json_encode(array('status' => $status, 'msg' => $token));
        
        return $result;
    }


    public function ChildrenRegister(){

        $content = file_get_contents("php://input");
        $result = json_decode($content);

        //Get Data
        $pid = $result->pid;
        $name = $result->name;
        $school = $result->school;
        $lat = $result->lat;
        $lng =$result->lng;


        $file_id = $this->Parent_Model->SaveChildren($pid,$name,$school,$lat,$lng);

        if ($file_id) {
            $status = "success";
            $token = $file_id;
        } else {
            $status = "error";
            $token = "Something went wrong.., please try again.";
        }

        echo json_encode(array('status' => $status, 'msg' => $token));
        
        return $result;
    }

    public function login(){
        $content = file_get_contents("php://input");
        $result = json_decode($content);

        //Get Data
        $userName = $result->userName;
        $password = $result->password;

        $file_id = $this->User_model->loginUser($userName,$password);
        
        if ($file_id) {
            $status = "success";
            $token = $file_id;
        } else {
            $status = "error";
            $token = "Something went wrong., please try again.";
        }
        echo json_encode(array('status' => $status, 'msg' => $token));
        return $result;
    }
   
   
    public function getAllDrivers(){
        $content = file_get_contents("php://input");
        $result = json_decode($content);

        $result=$this->Driver_Model->GetAll();

        if ($result) {
            $status = "success";
            $resulta = $result;
        } else {
            $status = "error";
            $resulta = "Empty.";
        }

        echo json_encode(array('status' => $status, 'msg' => $resulta));
        
        return $result;
    }

    public function getAllSchool(){

        $content = file_get_contents("php://input");
        $result = json_decode($content);

        $result=$this->School_Model->GetAll();

        if ($result) {
            $status = "success";
            $resulta = $result;
        } else {
            $status = "error";
            $resulta = "Empty.";
        }

        echo json_encode(array('status' => $status, 'msg' => $resulta));
        
        return $result;
    }

    public function getAllParent(){

        $content = file_get_contents("php://input");
        $result = json_decode($content);

        $result=$this->Parent_Model->GetAll();

        if ($result) {
            $status = "success";
            $resulta = $result;
        } else {
            $status = "error";
            $resulta = "Empty.";
        }

        echo json_encode(array('status' => $status, 'msg' => $resulta));
        
        return $result;
    } 

    public function getAllChildren(){
        
        $content = file_get_contents("php://input");
        $result = json_decode($content);

        $result=$this->Parent_Model->GetAllChildren();

        if ($result) {
            $status = "success";
            $resulta = $result;
        } else {
            $status = "error";
            $resulta = "Empty.";
        }

        echo json_encode(array('status' => $status, 'msg' => $resulta));
        
        return $result;
    }

    public function getAllDriversChildren(){
        
        $content = file_get_contents("php://input");
        $result = json_decode($content);

        $result=$this->Driver_Model->GetAllChildren();

        if ($result) {
            $status = "success";
            $resulta = $result;
        } else {
            $status = "error";
            $resulta = "Empty.";
        }

        echo json_encode(array('status' => $status, 'msg' => $resulta));
        
        return $result;
    }

    public function getAllTodayAttendance(){
        
        $content = file_get_contents("php://input");
        $result = json_decode($content);

        $result=$this->Parent_Model->GetAllAtt();

        if ($result) {
            $status = "success";
            $resulta = $result;
        } else {
            $status = "error";
            $resulta = "Empty.";
        }

        echo json_encode(array('status' => $status, 'msg' => $resulta));
        
        return $result;
    }

    public function getAllNotifi(){
        
        $content = file_get_contents("php://input");
        $result = json_decode($content);

        $result=$this->Attendance_Model->GetAllNotification();

        if ($result) {
            $status = "success";
            $resulta = $result;
        } else {
            $status = "error";
            $resulta = "Empty.";
        }

        echo json_encode(array('status' => $status, 'msg' => $resulta));
        
        return $result;
    }


    function getDistance(){
        // Google API key
        
        $unit = 'K';
        
        // Get latitude and longitude from the geodata
        $latitudeFrom    = 6.705574;
        $longitudeFrom    = 80.384735;

        $latitudeTo        = 6.927079;
        $longitudeTo    = 79.861244;
        
        // Calculate distance between latitude and longitude
        $theta    = $longitudeFrom - $longitudeTo;
        $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
        $dist    = acos($dist);
        $dist    = rad2deg($dist);
        $miles    = $dist * 60 * 1.1515;
        
        // Convert unit and return distance
        $unit = strtoupper($unit);
        if($unit == "K"){
            echo round($miles * 1.609344, 2).' km';
        }elseif($unit == "M"){
            return round($miles * 1609.344, 2).' meters';
        }else{
            return round($miles, 2).' miles';
        }
    }
    
   
   

 }
 ?>