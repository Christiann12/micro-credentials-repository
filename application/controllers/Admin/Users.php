<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/ApiRepository.php");

class Users extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Singapore');
		//Load Helpers and Libraries
		$this->load->helper('url');
		$this->load->library('session');

		$this->api = new ApiRepository();
		$this->session->set_userdata('base_url',$this->api->base_url);
	}

	public function index() //Load Homepage - Admin
	{
		if(!$this->session->has_userdata("userData")){
			redirect("Login");
		}
		else{  
			$this->load->view('HeaderAndFooter/Header.php');
			$this->load->view('Admin/Users.php');
			$this->load->view('HeaderAndFooter/Footer.php');
		}
    }

}