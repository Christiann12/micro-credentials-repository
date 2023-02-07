<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission {

    public function checkAdmin($userData){
        if(empty($userData)){
            return true;
        }
        if($userData->user_type != 1){
            return true;
        }
    }
    public function checkUser($userData){
        if(empty($userData)){
            return true;
        }
        if($userData->user_type != 0){
            return true;
        }
    }

}