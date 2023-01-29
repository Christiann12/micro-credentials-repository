<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Singapore');
		//Load Helpers and Libraries
		$this->load->helper('url');
		$this->load->library('session');
	}

	public function index() //Load Homepage - Student
	{
		$this->load->view('HeaderAndFooter/Header.php');
		$this->load->view('Students/Home.php');
		$this->load->view('HeaderAndFooter/Footer.php');
	}
}
