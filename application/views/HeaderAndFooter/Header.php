<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8">
    <title>Microcredentials Repository</title>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <link rel="icon" type="image/x-icon" href="https://www.mcl.edu.ph/wp-content/uploads/2021/05/MCL-Logo-notext.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- end bootstrap css -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/>

    <!-- developer css  -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/assets/css/General/Global.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/assets/css/General/StudentNav_Footer.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/assets/css/Student/Home.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/assets/css/Student/Profile.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/assets/css/Student/CredentialDetail.css">
    <!-- ----------------------- -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <!-- <body style=" font-family: Montserrat; background-color: #e3deee;"> -->
   
    <body id="body" class="<?= ( (strtolower($this->uri->segment(1)) == 'home') ? "background-primary" : "background-white") ?>" style="font-family: Montserrat; min-width: 1000px;">
    <div id="loadingpage">
        
        </div>
        <div id="loadingicon">
            <div class="loader mx-auto" style="margin-top: 20%; "></div>
            <center>
                <p class="">loading...</p>
            </center>
        </div>
    <nav class="shadow-sm navbar navbar-expand-lg p-0 m-0 navbar-light">
        <a class="navbar-brand " href="#" style="background-color: white;">
            <div style="height: 100%;">
                <img src="<?= base_url('application/assets/images/imageassets/mcllogo.png'); ?>" width="100" height="50" class="d-inline-block align-top mx-3 my-2" alt="">
            </div>
        </a>
        <button class="navbar-toggler mr-1" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation" style="color: red !important;">
            <span class="navbar-toggler-icon " ></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarText" >
            <ul class="navbar-nav ml-auto">
                <li class="nav-item pl-5 pl-lg-3 pr-lg-3 py-lg-4 <?= ( (strtolower($this->uri->segment(1)) == 'home' || strtolower($this->uri->segment(1)) == 'viewcredential') ? "active" : null) ?>" style="height : 100%;">
                    <a class="nav-link" href="<?= base_url('Home'); ?>">Home</a>
                </li>
                <li class="nav-item pl-5 pl-lg-3 pr-lg-3 py-lg-4 <?= ( (strtolower($this->uri->segment(1)) == 'profile') ? "active" : null) ?>">
                    <a class="nav-link" href="<?= base_url('Profile'); ?>">Profile</a>
                </li>
                <!-- <li class="nav-item pl-5 pl-lg-3 pr-lg-3 py-lg-4 <?= ( (strtolower($this->uri->segment(2)) == 'page1') ? "d-none" : null) ?>">
                    <a class="nav-link" href="#">Logout</a>
                </li> -->
            </ul>
            <div class=" py-lg-4 px-3 border-left">
                <span class="navbar-text" >
                    Welcome, <?= $this->session->userdata("userData")->first_name ?>
                </span>
                <a class="ml-3 signout" href="<?= base_url('StudentLogin/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </div>
        </div>
    </nav>

    