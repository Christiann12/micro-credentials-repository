<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiRepository {
    public $base_url = 'http://9adf-223-25-61-130.ngrok.io';

    public function register($postData){
        $url = $this->base_url.'/register';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    public function updateUser($postData,$id){
        $ch = curl_init (  $this->base_url.'/user/'.$id );
        curl_setopt_array ( $ch, array (
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $postData
        ) );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
        $response = curl_exec ( $ch );
        return $response;
    }
    public function updateCredential($postData,$id){
        $ch = curl_init (  $this->base_url.'/credential/'.$id );
        curl_setopt_array ( $ch, array (
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $postData
        ) );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
        $response = curl_exec ( $ch );
        return $response;
    }
    public function createCourse($postData){
        $ch = curl_init ($this->base_url.'/course');
        curl_setopt_array ( $ch, array (
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $postData
        ) );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        $response = curl_exec ( $ch );
        return $response;
    }
    public function updateCourse($postData,$id){
        $ch = curl_init ($this->base_url.'/course/'.$id);
        curl_setopt_array ( $ch, array (
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $postData
        ) );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
        $response = curl_exec ( $ch );
        return $response;
    }
    public function deleteCred($id){
        $url = $this->base_url.'/credential/'.$id;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        // curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    public function deleteCourse($id){
        $url = $this->base_url.'/course/'.$id;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        // curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    public function login($postData){
        $url = $this->base_url.'/authenticate';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    public function emailvalidate($postData){
        $url = $this->base_url.'/email/validate';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    public function addCredential($postData){
        // $url = $this->base_url.'/credential';
        // $curl = curl_init();
        // curl_setopt($curl, CURLOPT_URL,$url);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        // curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
        // $response = curl_exec($curl);
        // curl_close($curl);
        // return $response;
        $ch = curl_init ($this->base_url.'/credential');
        curl_setopt_array ( $ch, array (
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $postData
        ) );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        $response = curl_exec ( $ch );
        return $response;
    }
    public function getCredentialByUser($id){
        $url = $this->base_url.'/credential/'.$id;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    public function getAnalysisStudent($id){
        $url = $this->base_url.'/credential/a/analysis/?date='.date('Y');
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
       
        if($id != null){
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
            $postData = array(
                "user_id" => $id,
            );
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData)); 
        }
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    public function getCoursesStudent($query){
        $url = $this->base_url.'/course?q='.$query;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    public function getTotalData(){
        
        $url = $this->base_url.'/admin/overview/analysis';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    public function getUsers($id){
        $url = $this->base_url.'/user?q='.$id;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
       
        // curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData)); 
   
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function getAllCredential($search){

        $url = $this->base_url.'/all/credential?q='.$search;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;

    }
}