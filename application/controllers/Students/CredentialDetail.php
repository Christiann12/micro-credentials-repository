<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."controllers/ApiRepository.php");

class CredentialDetail extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Singapore');
		//Load Helpers and Libraries
		$this->load->helper('url');
		$this->load->library('session');

		$this->api = new ApiRepository();
	}

	public function index($credId = '') //Load Homepage - Student
	{
		if(!$this->session->has_userdata("userData")){
			redirect("Login");
		}
		else{
			if($this->session->has_userdata("newCredDetail")){
				$data['credDetail'] = $this->session->userdata('newCredDetail');
				$this->session->unset_userdata(['newCredDetail']);
			}
			else{
				$data['credDetail'] = $this->session->userdata('credentials')[$credId];
			}
			$this->load->view('HeaderAndFooter/Header.php');
			$this->load->view('Students/CredentialDetail.php',$data);
			$this->load->view('HeaderAndFooter/Footer.php');
           
		}
	}
	public function edit(){
		$this->form_validation->set_rules('title', 'Title' ,'required');
		$this->form_validation->set_rules('location', 'Location' ,'required');
		$this->form_validation->set_rules('dateAcquired', 'Date Acquisition' ,'required');
		$this->form_validation->set_rules('provider', 'Provider' ,'required');
		$this->form_validation->set_rules('types', 'Type' ,'required');

		$postData = array(
			"type" => (int) $this->input->post("types"),
			// "user_id" => $this->session->userdata("userData")->user_id,
			"title" => $this->input->post("title"),
			"description" => (( $this->input->post("description") != null) ?  $this->input->post("description") : null ),
			"date_from" => (( $this->input->post("dateExpFrom") != null) ?  $this->input->post("dateExpFrom") : null ),
			"date_to" => (( $this->input->post("dateExpTo") != null) ?  $this->input->post("dateExpTo") : null ),
			"date_acquired" => $this->input->post("dateAcquired"),
			"provider_name" => $this->input->post("provider"),
			"location"=> $this->input->post("location"),
		);
		
		if($this->form_validation->run() === true){

			$result = json_decode($this->api->updateCredential($postData,$this->input->post('credid')));

			if($result->success){
				$postData["id"] = $this->session->userdata('credentials')[$credId]->id;
				$temp = json_encode($postData);
				$this->session->set_userdata('newCredDetail',json_decode($temp));
				$this->session->set_flashdata('successEdit',$result->message);
			}
			else{
				$this->session->set_flashdata('successEdit',$result->message);
			}
		}
		else{
			$this->session->set_flashdata('errorEdit',validation_errors());
		}
		redirect('ViewCredential/'.$this->input->post('id'));
	}
}

