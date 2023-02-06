<?php


defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/ApiRepository.php");
class Register extends CI_Controller {

	private $api;

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Singapore');
		//Load Helpers and Libraries
		$this->load->helper('url');
		$this->load->library('session');

        $this->api = new ApiRepository();
	}

	public function index($page = '') //Load Register - Student
	{   
        $pageList = array ('page1','page2','page3');
        if($page == 'blank'){
            redirect('register/page1');
        }
        if(strtolower($page) == 'page2' && $this->session->userdata('loginDetails') == null){
            redirect('register/page1');
        }
        if(strtolower($page) == 'page3' && ($this->session->userdata('loginDetails') == null || $this->session->userdata('personalDetails') == null)){
            redirect('register/page1');
        }
        if(!in_array($page, $pageList)){
            redirect('register/page1');
        }
        else{
            // $this->load->view('HeaderAndFooter/Header.php');
            $this->load->view('Students/Register.php');
            // $this->load->view('HeaderAndFooter/Footer.php');
        }
	}
    public function checkDetails(){
        if(strtolower($this->input->post('uri')) == "page1"){
            $this->form_validation->set_rules('emailLogin', 'Email' ,'required|callback_validateEmail');
            $this->form_validation->set_rules('passwordLogin', 'Password' ,'required');
            $this->form_validation->set_rules('confPassword', 'Confirm Password' ,'required|matches[passwordLogin]');
        }
        if(strtolower($this->input->post('uri')) == "page2"){
            $this->form_validation->set_rules('FirstName', 'First Name' ,'required|callback_checkFieldIfHasNum|callback_checkFieldIfHasSP');
            $this->form_validation->set_rules('LastName', 'Last Name' ,'required|callback_checkFieldIfHasNum|callback_checkFieldIfHasSP');
            $this->form_validation->set_rules('Contact', 'Contact' ,'required|max_length[10]');
        }
        if(strtolower($this->input->post('uri')) == "page3"){
            $this->form_validation->set_rules('Address', 'Address' ,'max_length[10000]');
           
        }
        if($this->form_validation->run() === true){
            if(strtolower($this->input->post('uri')) == "page1"){
                $postData = array(
                    'email' => $this->input->post('emailLogin'),
                    'password' => $this->input->post('passwordLogin'),
                );
                $this->session->set_userdata([
					'loginDetails' => $postData,
				]);
                $pageNum = substr($this->input->post('uri'),4);
                echo $pageNum;
        
                redirect('register/page'.$pageNum+=1 );
            }
            else if(strtolower($this->input->post('uri')) == "page2"){
                $postData = array(
                    'first_name' => $this->input->post('FirstName'),
                    'last_name' => $this->input->post('LastName'),
                    'contact_no' => $this->input->post('Contact'),
                    'student_no' => ( ($this->input->post('StudentNo') != null) ? $this->input->post('StudentNo') : null ),
                    'middle_initial' => ( ($this->input->post('MiddleInitial') != null) ? $this->input->post('MiddleInitial') : null ),
                    'birthday' => ( ($this->input->post('birthday') != null) ? $this->input->post('birthday') : null ),
                );

                $this->session->set_userdata([
					'personalDetails' => $postData,
				]);

                $pageNum = substr($this->input->post('uri'),4);
                echo $pageNum;
        
                redirect('register/page'.$pageNum+=1 );
            }
            else if(strtolower($this->input->post('uri')) == "page3"){
                $postData = array(
                    "email"=> $this->session->userdata('loginDetails')['email'],
                    "password"=> $this->session->userdata('loginDetails')['password'],
                    "first_name"=> $this->session->userdata('personalDetails')['first_name'],
                    "middle_name"=>( ($this->session->userdata('personalDetails') != null) ? $this->session->userdata('personalDetails')['middle_initial'] : null ),
                    "last_name"=> $this->session->userdata('personalDetails')['last_name'],
                    "student_no"=>( ($this->session->userdata('personalDetails') != null) ? $this->session->userdata('personalDetails')['student_no'] : null ),
                    "birthday"=>( ($this->session->userdata('personalDetails') != null) ? $this->session->userdata('personalDetails')['birthday'] : null ),
                    "contact_no"=> $this->session->userdata('personalDetails')['contact_no'],
                    "region"=>$this->input->post('region'),
                    "province"=>$this->input->post('province'),
                    "city"=>$this->input->post('municipality'),
                    "barangay"=>$this->input->post('barangay'),
                    "address1"=>$this->input->post('Address')
                );
                $result = json_decode($this->api->register($postData));

                if($result->success){
                    $this->session->set_flashdata('successRegister', $result->message);
                    $this->session->unset_userdata(['loginDetails','personalDetails']);
                }
                else{
                    $this->session->set_flashdata('errorRegister', $result->message);
                }
                redirect('Register/page1');
            }
        }
        else{
            $this->session->set_flashdata('errorRegister',validation_errors());
            redirect('Register/'.$this->input->post('uri'));
        }
        
    }
    public function prevpage($uri = ''){
        $pageNum = substr($uri,4);
        echo $pageNum;

        redirect('register/page'.$pageNum-=1 );
    }


    // validation functions
    public function validateEmail($email = ''){
        $postData = array(
            "email" => $email
        );
        $result = json_decode($this->api->emailvalidate($postData));
        if($result->success){
            return true;
        }
        else{
            $this->form_validation->set_message('validateEmail', 'The {field} already exist!');
            return false;
        }
    }
    public function checkFieldIfHasNum($text = ''){
		if( preg_match('~[0-9]+~', $text)){
			$this->form_validation->set_message('checkFieldIfHasNum', 'The {field} has numeric value!');
            return false;
		}
		else{
			return true;
		}
	}
	public function checkFieldIfHasSP($text = ''){
		if( preg_match('/[\'^£$%&*(!)}+{@#~?><>\[\],|=_¬-]/', $text)){
			$this->form_validation->set_message('checkFieldIfHasSP', 'The {field} has special character!');
            return false;
		}
		else{
			return true;
		}
	}
    public function checkPasswordStrength($password = ''){
		if( strlen($password) < 8 ){
			$this->form_validation->set_message('checkPasswordStrength', 'The {field} must be 8 characters long');
            return false;
		}
		if( !preg_match('/[\'^£$%&*(!)}+{@#~?><>\[\],|=_¬-]/', $password)){
			$this->form_validation->set_message('checkPasswordStrength', 'The {field} must contain atleast 1 special character');
            return false;
		}
		if( !preg_match('/[A-Z]/', $password)){
			$this->form_validation->set_message('checkPasswordStrength', 'The {field} must contain atleast 1 upper character');
            return false;
		}
		if( !preg_match('/[a-z]/', $password)){
			$this->form_validation->set_message('checkPasswordStrength', 'The {field} must contain atleast 1 lower character');
            return false;
		}
		else{
			return true;
		}
	}
}
