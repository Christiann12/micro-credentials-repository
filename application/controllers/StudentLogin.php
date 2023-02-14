<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/ApiRepository.php");
class StudentLogin extends CI_Controller {

	private $api;
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Singapore');
		//Load Helpers and Libraries
		$this->load->helper('url');
		$this->load->library('session');
		$this->api = new ApiRepository();
	}

	public function index() //Load Login - Student
	{
		$this->load->view('Students/Login.php');
	}
    public function checkUser(){
		$this->form_validation->set_rules('emailLogin', 'Email' ,'required|callback_checkEmailFormat');
		$this->form_validation->set_rules('passwordLogin', 'Password' ,'required');
        if($this->form_validation->run() === true){
			$postData = array(
				'user' => $this->input->post('emailLogin'),
				'pass' => $this->input->post('passwordLogin'),
			);
			$result = json_decode($this->api->login($postData));

			if($result->success){
				$this->session->set_userdata(
					"userData", $result->data
				);
				if($this->session->userdata("userData")->user_type == 0){
					redirect('Home');
				}
				elseif($this->session->userdata("userData")->user_type == 1){
					redirect('Dashboard');
				}
				$this->session->set_flashdata('successLogin',$result->message);
				
			}
			else{
				$this->session->set_flashdata('errorLogin',$result->message);
				redirect('Login');
			}
			
		}
		else{
			$this->session->set_flashdata('errorLogin',validation_errors());
            redirect('Login');
		}
    }
	public function logout(){
		$this->session->unset_userdata(["userData"]);
		redirect("");
	}
	// validation rules
	public function checkEmailFormat($email = ''){
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->form_validation->set_message('checkEmailFormat', 'The {field} contains an invalid email');
			return false;
		}
		else{
			return true;
		}
	}
}
