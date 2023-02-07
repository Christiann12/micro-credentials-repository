<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/ApiRepository.php");
require_once(APPPATH."controllers/Permission.php");
class Users extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Singapore');
		//Load Helpers and Libraries
		$this->load->helper('url');
		$this->load->library('session');

		$this->api = new ApiRepository();
		$this->session->set_userdata('base_url',$this->api->base_url);

		$this->permission = new Permission();
		if($this->permission->checkAdmin($this->session->userdata('userData'))){
			redirect('Login');
		}
	}
	public function index() //Load Homepage - Admin
	{
		$data['users'] = json_decode($this->api->getUsers(''))->data;
		$this->load->view('HeaderAndFooter/Header.php');
		$this->load->view('Admin/Users.php',$data);
		$this->load->view('HeaderAndFooter/Footer.php');
    }
	public function create(){
		$this->form_validation->set_rules('email', 'Email' ,'required');
		$this->form_validation->set_rules('first_name', 'First Name' ,'required|callback_checkFieldIfHasNum|callback_checkFieldIfHasSP');
		$this->form_validation->set_rules('last_name', 'Last Name' ,'required|callback_checkFieldIfHasNum|callback_checkFieldIfHasSP');
		$this->form_validation->set_rules('contact_no', 'Contact' ,'required|max_length[10]');
		$this->form_validation->set_rules('address1', 'Address' ,'max_length[10000]');
		$this->form_validation->set_rules('types', 'Type' ,'required');
		$postData = array(
			"email"=> $this->input->post('email'),
			"password"=> $this->input->post('password'),
			"first_name"=> $this->input->post('first_name'),
			"middle_name"=>( ($this->input->post('middle_name') != null) ? $this->input->post('middle_name') : null ),
			"last_name"=> $this->input->post('last_name'),
			"student_no"=>( ($this->input->post('student_no') != null) ? $this->input->post('student_no') : null ),
			"contact_no"=> $this->input->post('contact_no'),
			"region"=>$this->input->post('region'),
			"province"=>$this->input->post('province'),
			"city"=>$this->input->post('municipality'),
			"barangay"=>$this->input->post('barangay'),
			"address1"=>$this->input->post('Address'),
			"birthday"=>$this->input->post('birthday'),
			"user_type"=> (int) $this->input->post('types'),
			"password"=>$this->input->post('email'),
		);
		if($this->form_validation->run() === true){
			$result = json_decode($this->api->register($postData));
			if($result->success){
				$this->session->set_flashdata('successCreate',$result->message);
			}
			else{
				$this->session->set_flashdata('errorCreate',$result->message);
			}
		}
		else{
			$this->session->set_userdata('oldData', $postData);
			$this->session->set_flashdata('errorCreate',validation_errors());
		}
		redirect('Users');
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