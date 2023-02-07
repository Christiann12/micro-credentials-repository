<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/ApiRepository.php");
require_once(APPPATH."controllers/Permission.php");
class Courses extends CI_Controller {

	private $api;
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Singapore');
		//Load Helpers and Libraries
		$this->load->helper('url');
		$this->load->library('session');

		$this->api = new ApiRepository();
        $this->session->set_userdata('base_url',$this->api->base_url);
        $this->permission = new Permission();
        if($this->permission->checkUser($this->session->userdata('userData'))){
			redirect('Login');
		}
	}

	public function index()
	{

        $data['base_url'] = $this->api->base_url;
        $this->session->set_userdata('courses', json_decode($this->api->getCoursesStudent(urlencode($this->input->get('search'))))->data);
        $this->load->view('HeaderAndFooter/Header.php');
        $this->load->view('Students/Courses.php',$data);
        $this->load->view('HeaderAndFooter/Footer.php');

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
