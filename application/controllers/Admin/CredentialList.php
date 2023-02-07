<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/ApiRepository.php");
require_once(APPPATH."controllers/Permission.php");

class CredentialList extends CI_Controller {

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

	public function index()
	{
		$data['credentials'] = json_decode($this->api->getAllCredential(urlencode($this->input->get('search'))))->data;
		$this->load->view('HeaderAndFooter/Header.php');
		$this->load->view('Admin/CredentialList.php',$data);
		$this->load->view('HeaderAndFooter/Footer.php');
    }
}