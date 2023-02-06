<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/ApiRepository.php");

class Dashboard extends CI_Controller {

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
			$months = array('filler','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
			$records = json_decode($this->api->getAnalysisStudent(null));
			$data['totalRecords'] = json_decode($this->api->getTotalData())->data;

			$data['analysisProvider'] = $records->data->providers;
			$data['analysisTypes'] = $records->data->types;
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
		
			$data['analysisDate'] = $temp1;

			$this->load->view('HeaderAndFooter/Header.php');
			$this->load->view('Admin/Dashboard.php', $data);
			$this->load->view('HeaderAndFooter/Footer.php', $data);
		}
    }
}