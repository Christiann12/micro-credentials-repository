<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiRepository {
    private $base_url = 'https://6c86-223-25-61-130.ngrok.io/';

    public function register($postData){
        $url = $this->base_url.'register';
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
        $url = $this->base_url.'user/'.$id;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    public function updateCredential($postData,$id){
        $url = $this->base_url.'credential/'.$id;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    public function deleteCred($id){
        $url = $this->base_url.'credential/'.$id;
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
        $url = $this->base_url.'authenticate';
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
        $url = $this->base_url.'email/validate';
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
        $url = $this->base_url.'credential';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    public function getCredentialByUser($id){
        $url = $this->base_url.'credential/'.$id;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    public function getAnalysisStudent($id){
        $url = $this->base_url.'credential/analysis/'.$id;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}