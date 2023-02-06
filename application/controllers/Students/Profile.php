<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/ApiRepository.php");
class Profile extends CI_Controller {

	private $api;
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Singapore');
		//Load Helpers and Libraries
		$this->load->helper('url');
		$this->load->library('session');

		$this->api = new ApiRepository();
		$this->session->set_userdata('base_url',$this->api->base_url);
	}

	public function index() //Load Homepage - Student
	{
		if(!$this->session->has_userdata("userData")){
			redirect("Login");
		}
		else{
			$this->load->view('HeaderAndFooter/Header.php');
			$this->load->view('Students/Profile.php');
			$this->load->view('HeaderAndFooter/Footer.php');
		}
	}
	public function edit(){
		if($this->input->post('email') != $this->session->userdata('userData')->email){
			$this->form_validation->set_rules('email', 'Email' ,'required|callback_validateEmail');
		}
		if($this->input->post('Password') != null){
			$this->form_validation->set_rules('Password', 'Password' ,'required');
			$this->form_validation->set_rules('confPassword', 'Confirm Password' ,'required|matches[Password]');
		}
 		$this->form_validation->set_rules('firstName', 'First Name' ,'required|callback_checkFieldIfHasNum|callback_checkFieldIfHasSP');
		$this->form_validation->set_rules('lastName', 'Last Name' ,'required|callback_checkFieldIfHasNum|callback_checkFieldIfHasSP');
		$this->form_validation->set_rules('contact', 'Contact' ,'required|max_length[10]');
		$this->form_validation->set_rules('Address', 'Address' ,'max_length[10000]');

		if($this->form_validation->run() === true){
			$postData = array(
				"first_name"=> $this->input->post('firstName'),
				
				"middle_name"=>( ($this->input->post('middleName') != null) ? $this->input->post('middleName') : null),
				"last_name"=> $this->input->post('lastName'),
				"student_no"=>( ($this->input->post('studentno') != null) ? $this->input->post('studentno') : null ),
				"contact_no"=> $this->input->post('contact'),
				"region"=>$this->input->post('Region'),
				"province"=>$this->input->post('Province'),
				"city"=>$this->input->post('Municipality'),
				"barangay"=>$this->input->post('Barangay'),
				"address1"=>$this->input->post('Address')
			);

			if($this->input->post('email') != $this->session->userdata('userData')->email){
				$postData['email'] = $this->input->post('email');
			}
			if($this->input->post('Password') != null){
				$postData['password'] = $this->input->post('Password');
			}
			if($_FILES["imageUpload"]['tmp_name'] != null){
				$postData['image'] = new CURLFile( $_FILES["imageUpload"]['tmp_name']);
			}
			else{
				$postData['image'] = '';
			}
			
			$result = json_decode($this->api->updateUser($postData,$this->input->post('id')));
			if($result->success){
				$userData = array(
					"data"=> array (
						"email"=> $this->input->post('email'),
						"password"=> (($this->input->post('Password') != null) ? $this->input->post('Password') : $this->session->userdata('userData')->password),
						"first_name"=> $this->input->post('firstName'),
						"user_type"=> $this->session->userdata("userData")->user_type,
						"middle_name"=>( ($this->input->post('middleName') != null) ? $this->input->post('middleName') : null),
						"last_name"=> $this->input->post('lastName'),
						"student_no"=>( ($this->input->post('studentno') != null) ? $this->input->post('studentno') : null ),
						"contact_no"=> $this->input->post('contact'),
						"region"=> (($this->input->post('Region') != null) ? $this->input->post('Region'): null),
						"province"=> (($this->input->post('Province') != null) ? $this->input->post('Province'): null),
						"city"=> (($this->input->post('Municipality') != null) ? $this->input->post('Municipality'): null),
						"barangay"=> (($this->input->post('Barangay') != null) ? $this->input->post('Barangay'): null),
						"address1"=>(($this->input->post('Address') != null) ? $this->input->post('Address'): null),
						"id" => $this->session->userdata("userData")->id,
						"user_id" => $this->session->userdata("userData")->user_id,
						"date_created" => $this->session->userdata("userData")->date_created,
						"date_updated" => date("Y-m-d"),
						"image" => (($_FILES["imageUpload"]['tmp_name'] != null) ? $result->data->image : $this->session->userdata('userData')->image)
					)
				);
				$temp = json_encode($userData);
				$this->session->set_userdata('userData',json_decode($temp)->data);
				$this->session->set_flashdata('successEdit',$result->message);
			}
			else{
				$this->session->set_flashdata('errorEdit',$result->message);
			}
		}
		else{
			$this->session->set_flashdata('errorEdit',validation_errors());
		}
		redirect('Profile');
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
