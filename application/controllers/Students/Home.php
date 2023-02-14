<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/ApiRepository.php");
require_once(APPPATH."controllers/Permission.php");

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Singapore');
		//Load Helpers and Libraries
		$this->load->helper('url');
		$this->load->library('session');

		$this->api = new ApiRepository();
		$this->permission = new Permission();
		if($this->permission->checkUser($this->session->userdata('userData'))){
			redirect('Login');
		}
	}

	public function index() //Load Homepage - Student
	{
		$months = array('filler','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
		$records = json_decode($this->api->getAnalysisStudent($this->session->userdata("userData")->user_id));
		$data['analysisProvider'] = $records->data->providers;
		$data['analysisTypes'] = $records->data->types;
		$data['analysisTopFive'] = $records->data->topFiveSkills;
		$dateData = $records->data->dates;
		
		$data['totalProviderCount'] = 0;
		
		if(isset($data['analysisProvider'])){
			foreach($data['analysisProvider'] as $item){
				$data['totalProviderCount'] += $item->total;
			}
		}
		
		$data['totalTypeCount'] = 0;
		
		if(isset($data['analysisTypes'])){
			foreach($data['analysisTypes'] as $item){
				$data['totalTypeCount'] += $item->total;
			}
		}

		$data['totalTopCount'] = 0;

		if(isset($data['analysisTopFive'])){
			foreach($data['analysisTopFive'] as $item){
				$data['totalTopCount'] += $item->total;
			}
		}

		$temp1 = array();
		foreach($months as $key => $monthValue){
			if($monthValue != 'filler'){
				foreach($dateData as $items){
					if($key == $items->value){
						$temp1[$items->value] = $items->total;
					}
				}
			}
		}
		
		$temp = json_decode($this->api->getCredentialByUser($this->session->userdata("userData")->user_id))->data;
		$this->session->set_userdata("credentials",$temp);
		$data['analysisDate'] = $temp1;
			
		$this->load->view('HeaderAndFooter/Header.php');
		$this->load->view('Students/Home.php',$data);
		$this->load->view('HeaderAndFooter/Footer.php',$data);

	} 
	public function addNewCred(){
		$this->form_validation->set_rules('credTitle', 'Title' ,'required');
		$this->form_validation->set_rules('location', 'Location' ,'required');
		$this->form_validation->set_rules('dateAcquired', 'Date Acquisition' ,'required');
		$this->form_validation->set_rules('provider', 'Provider' ,'required');
		$this->form_validation->set_rules('types', 'Type' ,'required');
		$this->form_validation->set_rules('skills', 'Skill' ,'required');
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
				"skill"=> $this->input->post("skills"),
			);
			if($_FILES["imageUpload"]['tmp_name'] != null){
				$postData['image'] = new CURLFile( $_FILES["imageUpload"]['tmp_name']);
			}
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
	public function test(){
		$postData = array(
			'image' => new CURLFile($_FILES["file"]['tmp_name']),
		);
		$result = $this->api->imagetotext($postData);
		echo $result;
	}
}
