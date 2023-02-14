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
            <!-- Modal -->
            <div class="modal fade" id="datamodal" tabindex="-1" aria-labelledby="datamodal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="datamodal">Data Privacy Act</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    This is a sample data privacy act and the user must read and accept before registering.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>

            <nav class="nav"></nav>
            <div class="logo m-auto">
                <img src="<?= base_url('application/assets/images/imageassets/mcllogo.png'); ?>" alt="MCL Logo" width="100%" height="100%">
            </div>
            <div class="spacer"></div>
            <div style="text-align:center;margin-top:40px;">
                <span class="step <?= ( (strtolower($this->uri->segment(2)) == 'page1') ? "active" : null) ?>"></span>
                <span class="step <?= ( (strtolower($this->uri->segment(2)) == 'page2') ? "active" : null) ?>"></span>
                <span class="step <?= ( (strtolower($this->uri->segment(2)) == 'page3') ? "active" : null) ?>"></span>
            </div>
            <div class="spacer"></div>
            
            <div class="mainpanel box-shadow general-padding mx-auto" style="margin-bottom: 200px;">
                <?php echo form_open_multipart('Students/Register/checkDetails/') ?>

                    
                        <!-- RESULT NOTIFICATION  -->
                        <?php if($this->session->flashdata('successRegister')){ ?>
                            <div  x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show" class="alert alert-success"  style="font-size:12px;"> 
                                <p><?php  echo $this->session->flashdata('successRegister'); $this->session->unset_userdata ( 'successRegister' );?></p>
                            </div>
                        <?php } ?>  
                        <?php if ($this->session->flashdata('errorRegister')){ ?>
                            <div  x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show" class="alert alert-danger" style="font-size:12px;"> 
                                <p><?php  echo $this->session->flashdata('errorRegister'); $this->session->unset_userdata ( 'errorRegister' );?></p>
                            </div>
                        <?php } ?>
                        
                        <?php if(strtolower($this->uri->segment(2)) == 'page1'): ?>
                        <div>
                            <h6 class="">Login Details</h6>
                            <div class="spacer"></div>
                            <input name="uri" type="hidden" id="uri" class="form-control" placeholder="pageuri" value="<?= $this->uri->segment(2)?>">
                            <div class="form-label-group">
                                <input name="emailLogin" type="email" id="email" class="form-control" placeholder="sample@email.com" value="<?= ( ($this->session->userdata('loginDetails') != null) ? $this->session->userdata('loginDetails')['email'] : null ); ?>">
                                <label for="emailLogin" class="">Email</label>
                            </div>


                            <div class="form-label-group">
                                <input name="passwordLogin" type="password" id="passwordLogin" class="form-control" placeholder="Password" value="<?= ( ($this->session->userdata('loginDetails') != null) ? $this->session->userdata('loginDetails')['password'] : null ); ?>">
                                <label for="passwordLogin" class="">Password</label>
                            </div>

                            <div class="form-label-group">
                                <input name="confPassword" type="password" id="confPassword" class="form-control" placeholder="Confirm Password" value="<?= ( ($this->session->userdata('loginDetails') != null) ? $this->session->userdata('loginDetails')['password'] : null ); ?>">
                                <label for="confPassword" class="">Confirm Password</label>
                            </div>
                        </div>

                        <?php elseif(strtolower($this->uri->segment(2)) == 'page2'): ?>
                        <div >
                            <h6 class="">Personal Details</h6>
                            <div class="spacer"></div>
                            <input name="uri" type="hidden" id="uri" class="form-control" placeholder="pageuri" value="<?= $this->uri->segment(2)?>">
                            <div class="form-label-group">
                                <input name="StudentNo" type="text" id="StudentNo" class="form-control" placeholder="Student No." value="<?= ( ($this->session->userdata('personalDetails') != null) ? $this->session->userdata('personalDetails')['student_no'] : null ); ?>">
                                <label for="StudentNo" class="">Student No.</label>
                            </div>
                            <div class="form-label-group">
                                <input name="FirstName" type="text" id="FirstName" class="form-control" placeholder="First Name" value="<?= ( ($this->session->userdata('personalDetails') != null) ? $this->session->userdata('personalDetails')['first_name'] : null ); ?>">
                                <label for="FirstName" class="">First Name</label>
                            </div>

                            <div class="form-label-group">
                                <input name="LastName" type="text" id="LastName" class="form-control" placeholder="Last Name" value="<?= ( ($this->session->userdata('personalDetails') != null) ? $this->session->userdata('personalDetails')['last_name'] : null ); ?>">
                                <label for="LastName" class="">Last Name</label>
                            </div>

                            <div class="form-label-group">
                                <input name="MiddleInitial" type="text" id="MiddleInitial" class="form-control" placeholder="Middle Initial" value="<?= ( ($this->session->userdata('personalDetails') != null && $this->session->userdata('personalDetails')['middle_initial'] != null) ? $this->session->userdata('personalDetails')['middle_initial'] : null ); ?>">
                                <label for="MiddleInitial" class="">Middle Initial (Optional)</label>
                            </div>

                            <div class="form-label-group">
                                <input name="Contact" maxlength="10" type="number" id="Contact" class="form-control" placeholder="Contact Information" value="<?= ( ($this->session->userdata('personalDetails') != null) ? $this->session->userdata('personalDetails')['contact_no'] : null ); ?>">
                                <label for="Contact" class="">Contact Information</label>
                            </div>

                            <div class="form-label-group">
                                <input name="birthday" type="date" id="birthday" class="form-control" placeholder="Birhtday" value="<?= ( ($this->session->userdata('personalDetails') != null) ? $this->session->userdata('personalDetails')['birthday'] : null ); ?>">
                                <label for="birthday" class="">Birhtday</label>
                            </div>
                        </div>

                        <?php elseif(strtolower($this->uri->segment(2)) == 'page3'): ?>
                        <div>
                            <h6 class="">Address Details (Optional)</h6>
                            <div class="spacer"></div>
                            <div class="form-label-group">
                                <input name="region" type="text" id="region" class="form-control" placeholder="Region">
                                <label for="region" class="">Region</label>
                            </div>
                            <div class="form-label-group">
                                <input name="province" type="text" id="province" class="form-control" placeholder="Province">
                                <label for="province" class="">Province</label>
                            </div>
                            <div class="form-label-group">
                                <input name="municipality" type="text" id="municipality" class="form-control" placeholder="Municipality" >
                                <label for="municipality" class="">Municipality</label>
                            </div>
                            <div class="form-label-group">
                                <input name="barangay" type="text" id="barangay" class="form-control" placeholder="Barangay">
                                <label for="barangay" class="">Barangay</label>
                            </div>
                            <input name="uri" type="hidden" id="uri" class="form-control" placeholder="pageuri" value="<?= $this->uri->segment(2)?>">
                            <div class="form-label-group">

                                <textarea name="Address" type="textarea" id="email" class="form-control" placeholder="Street Number/Building No./Subd./ etc."></textarea>
                                <!-- <label for="Address" class="">Address</label> -->
                            </div>
                            <div class="d-flex align-items-start justify-content-between">
                                <label for="dataact" class=" ml-3">Agree to data <a href="#" data-toggle="modal" data-target="#datamodal">policy act</a></label>
                                <input name="dataact" type="checkbox" id="dataact" class="mr-3" style=" width: 20px; height: 20px;">
                            </div>
                        </div>
                        
                        <?php endif; ?>
                        <center class="mt-3">
                            
                            
                            <hr class="separator">
                            <div class="row">
                                <div class="col-md-6 col-12 ">
                                    <a href="<?= base_url('Students/Register/prevpage/'.$this->uri->segment(2)); ?>" id="ct7" class="btn button-secondary <?= ( (strtolower($this->uri->segment(2)) == 'page1') ? "d-none" : null) ?>">Previous</a>
                                </div>
                                <div class="col-md-6 col-12">
                                    <?php if($this->uri->segment(2) != 'page3'): ?>
                                        <button type="submit" id="button" class="btn button-primary">Next</button>
                                    <?php else: ?>
                                        <button type="submit" id="button" class="btn button-primary submitbuttom">Submit</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <a href="<?= base_url('') ?>" class="small text-muted">Back to login</a>
                            
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
    
    <!-- <script src="<?php echo base_url(); ?>application/assets/js/datatables.js"></script>
    <script src="<?php echo base_url(); ?>application/assets/dataTables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>application/assets/dataTables/js/dataTables.semanticui.min.js"></script> -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>application/assets/js/responsive.dataTables.min.js"></script> -->
    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        $(document).ready( function () {
            $('#loadingpage').hide();
            $('#loadingicon').hide();
            $('.submitbuttom').prop('disabled', true);
            
        });	
        $( "#button" ).click(function() {
            $('#email').blur();
            $('#loadingpage').show();
            $('#loadingicon').show();
        });
        $( "#dataact" ).click(function() {
           if($('#dataact').is(":checked")){
                $('.submitbuttom').prop('disabled', false);
           }
           else{
                $('.submitbuttom').prop('disabled', true);
           }
        });
    </script>
    </body>
</html>