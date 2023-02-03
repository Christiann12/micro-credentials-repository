<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <title>Microcredentials Repository</title>
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
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/assets/css/Student/Login_Register.css">
    <!-- ----------------------- -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <!-- <body style=" font-family: Montserrat; background-color: #e3deee;"> -->
    <body style=" font-family: Montserrat;">
        
    <!-- loading screen  -->
    <div id="loadingpage" style="background-color: #1f4480; width: 100%; height: 100vh; z-index: 1; position: fixed; top: 0; left:0;opacity: 0.3;">
        
    </div>
    <div id="loadingicon" style="width: 100%; height: 100vh; z-index: 2; position: fixed; top: 0; left:0">
        <div class="loader mx-auto" style="margin-top: 20%; "></div>
        <center>
        <p class="">loading...</p>
        </center>
    </div>

    <Main>
            <nav class="nav"></nav>
            <div class="logo m-auto">
                <img src="<?= base_url('application/assets/images/imageassets/mcllogo.png'); ?>" alt="MCL Logo" width="100%" height="100%">
            </div>
            <div class="spacer"></div>
            <div class="mainpanel m-auto box-shadow general-padding">
                <?php echo form_open_multipart('StudentLogin/checkUser') ?>

                        <div class="form-label-group">
                            <input name="emailLogin" type="text" id="email" class="form-control" placeholder="Email/Username">
                            <label for="emailLogin" class="">Email</label>
                        </div>

                        <div class="form-label-group">
                            <input name="passwordLogin" type="password" id="passwordLogin" class="form-control" placeholder="Password">
                            <label for="passwordLogin" class="">Password</label>
                        </div>

                        <div class="row d-none">
                            <div class="col-6 d-flex align-items-start">
                                <label for="rememberme" class="mr-3">Stay Signed In?</label>
                                <input name="rememberme" type="checkbox" id="rememberme" class="mt-1">
                            </div>
                            <div class="col-6">
                                <center>
                                    <!-- <p style="text-align: right;" class="forgot-password">Forgot Password?</p> -->
                                    <p style="text-align: right;" class="" onclick=" location.href = '#'" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Forgot Password?</p>
                                </center>
                            </div>
                        </div>
                        <!-- RESULT NOTIFICATION  -->
                        <?php if($this->session->flashdata('successLogin')){ ?>
                            <div  x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show" class="alert alert-success" > 
                                <?php  echo $this->session->flashdata('successLogin'); $this->session->unset_userdata ( 'successLogin' );?>
                            </div>
                        <?php } ?>  
                        <?php if ($this->session->flashdata('errorLogin')){ ?>
                            <div  x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show" class="alert alert-danger" > 
                                <?php  echo $this->session->flashdata('errorLogin'); $this->session->unset_userdata ( 'errorLogin' );?>
                            </div>
                        <?php } ?>
                        <center class="mt-3">
                            <button type="submit" class="btn button-primary" id="button">Log In</button>
                            
                           <div class="text-divider">or</div>
                            
                            <a href="register/page1" class="btn button-secondary">Create Account</a>
                        </center>
                    

                <?php echo form_close() ?>
            </div>
            
        <footer class="footer">
            <p>Malayan Colleges Laguna Â © 2018 All Rights Reserved</p>
        </footer>
    </Main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>		
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    
    <!-- <script src="https://code.highcharts.com/highcharts.js"></script> -->
        <script>
           $(document).ready( function () {
            $('#loadingpage').hide();
            $('#loadingicon').hide();
               
            });	
           $( "#button" ).click(function() {
            $('#email').blur();
            $('#loadingpage').show();
            $('#loadingicon').show();
           });

            // $('#email').blur(function () {
            // $('#loadingpage').hide();
            // $('#loadingicon').hide();
            // });
        </script>
    </body>
</html>