<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/ApiRepository.php");

class Courses extends CI_Controller {

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
			$data['base_url'] = $this->api->base_url;
            $data['courses'] = json_decode($this->api->getCoursesStudent(''))->data;
            
			$this->load->view('HeaderAndFooter/Header.php');
			$this->load->view('Admin/Courses.php',$data);
			$this->load->view('HeaderAndFooter/Footer.php');
		}
    }
	public function create(){
		$this->form_validation->set_rules('title', 'Title' ,'required');
		$this->form_validation->set_rules('link', 'Link' ,'required');
		$this->form_validation->set_rules('provider', 'Provider' ,'required');
		$this->form_validation->set_rules('types', 'Type' ,'required');

		$postData = array(
            "title"=> $this->input->post('title'),
            "description"=> (($this->input->post('description') != null) ? $this->input->post('description'):null),
            "type"=> $this->input->post('types'),
            "link"=> $this->input->post('link'),
            "provider"=> $this->input->post('provider'),
            "created_by"=> $this->session->userdata('userData')->email,
		);
		if($_FILES["imageUpload"]['tmp_name'] != null){
			$postData['image'] = new CURLFile( $_FILES["imageUpload"]['tmp_name']);
		}
		else{
			$postData['image'] = '';
		}
		if($this->form_validation->run() === true){

			$this->session->unset_userdata('oldData');
			$result = json_decode($this->api->createCourse($postData));
			if($result->success){
				$this->session->set_flashdata('successCreate',$result->message);
			}
			else{
				$this->session->set_flashdata('errorCreate',$result->message);
			}
		}
		else{
			$postData['image'] = '';
			$this->session->set_userdata('oldData',$postData);
			$this->session->set_flashdata('errorCreate',validation_errors());
			$this->session->set_userdata('ManageCoursesError',true);
		}
		
		redirect('ManageCourses');
	}
	public function update(){
		$this->form_validation->set_rules('title', 'Title' ,'required');
		$this->form_validation->set_rules('link', 'Link' ,'required');
		$this->form_validation->set_rules('provider', 'Provider' ,'required');
		$this->form_validation->set_rules('types', 'Type' ,'required');

		$postData = array(
            "title"=> $this->input->post('title'),
            "description"=> (($this->input->post('description') != null) ? $this->input->post('description'):null),
            "type"=> $this->input->post('types'),
            "link"=> $this->input->post('link'),
            "provider"=> $this->input->post('provider'),
            "created_by"=> $this->session->userdata('userData')->email,
		);
		if($_FILES["imageUpload"]['tmp_name'] != null){
			$postData['image'] = new CURLFile( $_FILES["imageUpload"]['tmp_name']);
		}
		else{
			$postData['image'] = '';
		}
		if($this->form_validation->run() === true){
			$this->session->unset_userdata('test');
			$result = json_decode($this->api->updateCourse($postData,$this->input->post('id')));
			if($result->success){
				$this->session->set_flashdata('successCreate',$result->message);
			}
			else{
				$this->session->set_flashdata('errorCreate',$result->message);
			}
		}
		else{
			$postData['image'] = $this->input->post('secretImg');
			$postData['id'] = $this->input->post('id');
			$this->session->set_userdata('test',$postData);
			$this->session->set_flashdata('errorCreate',validation_errors());
			$this->session->set_userdata('ManageCoursesErrorUpdate',true);
		}
		redirect('ManageCourses');
		
	}
	public function delete($id){
		$result = json_decode($this->api->deleteCourse($id));
		if($result->success){
			$this->session->set_flashdata('successCreate',$result->message);
		}
		else{
			$this->session->set_flashdata('errorCreate',$result->message);
		}
		redirect('ManageCourses');
	}
	public function clearCache(){
		$this->session->unset_userdata('test');
		echo 'true';
	}
}