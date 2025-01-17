<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/ApiRepository.php");

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Singapore');
		//Load Helpers and Libraries
		$this->load->helper('url');
		$this->load->library('session');

		$this->api = new ApiRepository();
	}

	public function index() //Load Homepage - Student
	{
		if(!$this->session->has_userdata("userData")){
			redirect("Login");
		}
		else{
			$data['analysis'] = json_decode($this->api->getAnalysisStudent($this->session->userdata("userData")->user_id))->data;

			$temp = json_decode($this->api->getCredentialByUser($this->session->userdata("userData")->user_id))->data;
			$this->session->set_userdata("credentials",$temp);
			$data['totalProviderCount'] = 0;
			foreach($data['analysis'] as $item){
				$data['totalProviderCount'] += $item->total;
			}
			$this->load->view('HeaderAndFooter/Header.php');
			$this->load->view('Students/Home.php',$data);
			$this->load->view('HeaderAndFooter/Footer.php',$data);
		}
	} 
	public function addNewCred(){
		$this->form_validation->set_rules('credTitle', 'Title' ,'required');
		$this->form_validation->set_rules('location', 'Location' ,'required');
		$this->form_validation->set_rules('dateAcquired', 'Date Acquisition' ,'required');
		$this->form_validation->set_rules('provider', 'Provider' ,'required');
		$this->form_validation->set_rules('types', 'Type' ,'required');
		if($this->form_validation->run() === true){

			$postData = array(
				"type" => $this->input->post("types"),
				"user_id" => $this->session->userdata("userData")->user_id,
				"title" => $this->input->post("credTitle"),
				"description" => $this->input->post("Description"),
				"date_from" => (( $this->input->post("expDateFrom") != null) ?  $this->input->post("expDateFrom") : null ),
				"date_to" => (( $this->input->post("expDateTo") != null) ?  $this->input->post("expDateTo") : null ),
				"date_acquired" => $this->input->post("dateAcquired"),
				"provider_name" => $this->input->post("provider"),
				"location"=> $this->input->post("location"),
			);
			
			$result = json_decode($this->api->addCredential($postData));
			
			if($result->success){
				$this->session->set_flashdata('successAddNewCred',"Add Success!");
			}
			else{
				$this->session->set_flashdata('errorAddNewCred',$result->message);
			}
			redirect('Home');
		}
		else{
			$this->session->set_flashdata('errorAddNewCred',validation_errors());
			redirect('Home');
		}
	}
	public function delete($id = ''){
		$result = json_decode($this->api->deleteCred($id));
		if($result->success){
			$this->session->set_flashdata('successAddNewCred',$result->message);
		}
		else{
			$this->session->set_flashdata('errorAddNewCred',$result->message);
		}
		redirect('Home');
	}
}
