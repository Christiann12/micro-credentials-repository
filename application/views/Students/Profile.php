<?php if($this->session->flashdata('successEdit')){ ?>
    <div  x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show"  x-transition.duration.1000ms style="position: fixed; top:10%; right: 0; width: 25%; z-index: 5;">
        <div class="card alert-success w-100 ml-auto">
            <div class="card-header">
                <h5>
                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                    Success
                </h5>
            </div>
            <div class="card-body">
                <small><?php  echo $this->session->flashdata('successEdit'); $this->session->unset_userdata ( 'successEdit' );?></small>
            </div>
        </div>
    </div>
<?php } ?>  
<?php if ($this->session->flashdata('errorEdit')){ ?>
    <div  x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show"  x-transition.duration.1000ms style="position: fixed; top:10%; right:0; width: 25%; z-index: 5;">
        <div class="card alert-danger w-100 ml-auto" style="">
            <div class="card-header">
                <h5>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    Error
                </h5>
            </div>
            <div class="card-body">
                <small><?php  echo $this->session->flashdata('errorEdit'); $this->session->unset_userdata ( 'errorEdit' );?></small>
            </div>
        </div>
    </div>
<?php } ?>

<Main>
    <?php echo form_open_multipart('Students/Profile/edit') ?>
    <div class="row p-5">
        <div class="col-12 col-sm-12 col-md-6 col-lg-3 pt-3 px-4 ">
           
            <center>
                <img src="<?= (($this->session->userdata("userData")->image) ? $this->session->userdata('base_url').$this->session->userdata("userData")->image : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png') ?>" id="profilePic" style="max-width: 100%; height: auto; max-height: 275px;"class="mb-2 rounded"alt="No Picture">
                
                <p class="mt-1 mb-0 mx-0">
                    <?= (( $this->session->userdata("userData")->first_name ) ? $this->session->userdata("userData")->first_name  : null) ?>
                    <?= (( $this->session->userdata("userData")->middle_name ) ? $this->session->userdata("userData")->middle_name  : null) ?>
                    <?= (( $this->session->userdata("userData")->last_name ) ? $this->session->userdata("userData")->last_name  : null) ?>
                </p>
                <p class="small d-none font-italic mb-5 detail-text"><?= (( $this->session->userdata("userData")->email ) ? $this->session->userdata("userData")->email  : "N/a") ?></p>
                
                <div style="margin-top:-60px; ">
                    <label for="imageUpload" class="field px-2" style="background-color: black; opacity: 0.5; color:white;" >Select file</label>
                    <input name="imageUpload" type="file" id="imageUpload" class="d-none w-50" placeholder="Upload Image" onchange="readURL2(this);">
                </div>
            </center>
          
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-9 p-3">
            <div class="container">
                <p class="h5 mb-4">Edit Profile Details</p>
                
                <div class="row">
                    <input name="id" type="hidden" class="form-control field" placeholder="" value="<?= (( $this->session->userdata("userData")->user_id ) ? $this->session->userdata("userData")->user_id  : null) ?>">
                    <div class=" col-12 col-lg-4 form-label-group mb-3">
                        <label for="firstName" class="font-weight-bold">First Name</label>
                        <p class="detail-text m-0"><?= (( $this->session->userdata("userData")->first_name ) ? $this->session->userdata("userData")->first_name  : "N/a") ?></p>
                        <input name="firstName" type="text" id="test" class="form-control field" placeholder="Ex. John" value="<?= (( $this->session->userdata("userData")->first_name ) ? $this->session->userdata("userData")->first_name  : null) ?>">
                    </div>
                    <div class=" col-12 col-lg-4 form-label-group mb-3">
                        <label for="middleName" class="font-weight-bold">Middle Name</label>
                        <p class="detail-text m-0"><?= (( $this->session->userdata("userData")->middle_name ) ? $this->session->userdata("userData")->middle_name  : "N/a") ?></p>
                        <input name="middleName" type="text" id="middleName" class="form-control field" placeholder="Ex. B" value="<?= (( $this->session->userdata("userData")->middle_name ) ? $this->session->userdata("userData")->middle_name  : null) ?>">
                    </div>
                    <div class=" col-12 col-lg-4 form-label-group mb-3">
                        <label for="lastName" class="font-weight-bold">Last Name</label>
                        <p class="detail-text m-0"><?= (( $this->session->userdata("userData")->last_name ) ? $this->session->userdata("userData")->last_name  : "N/a") ?></p>
                        <input name="lastName" type="text" id="lastName" class="form-control field" placeholder="Ex. Doe" value="<?= (( $this->session->userdata("userData")->last_name ) ? $this->session->userdata("userData")->last_name  : null) ?>">
                    </div>
                    <div class="col-12">
                        <div class="text-divider my-4"><small>Address Information</small></div>
                    </div>
                    <div class=" col-12 col-lg-6 form-label-group mb-3">
                        <label for="Region" class="font-weight-bold">Region</label>
                        <p class="detail-text m-0"><?= (( $this->session->userdata("userData")->region ) ? $this->session->userdata("userData")->region  : "N/a") ?></p>
                        <input name="Region" type="text" id="Region" class="form-control field" placeholder="Ex. Region IV-A" value="<?= (( $this->session->userdata("userData")->region ) ? $this->session->userdata("userData")->region  : null) ?>">
                    </div>
                    <div class=" col-12 col-lg-6 form-label-group mb-3">
                        <label for="Province" class="font-weight-bold">Province</label>
                        <p class="detail-text m-0"><?= (( $this->session->userdata("userData")->province ) ? $this->session->userdata("userData")->province  : "N/a") ?></p>
                        <input name="Province" type="text" id="Province" class="form-control field" placeholder="Ex. Laguna" value="<?= (( $this->session->userdata("userData")->province ) ? $this->session->userdata("userData")->province  : null) ?>">
                    </div>
                    <div class=" col-12 col-lg-6 form-label-group mb-3">
                        <label for="Municipality" class="font-weight-bold">Municipality</label>
                        <p class="detail-text m-0"><?= (( $this->session->userdata("userData")->city ) ? $this->session->userdata("userData")->city  : "N/a") ?></p>
                        <input name="Municipality" type="text" id="Municipality" class="form-control field" placeholder="Ex. Calamba" value="<?= (( $this->session->userdata("userData")->city ) ? $this->session->userdata("userData")->city  : null) ?>">
                    </div>
                    <div class=" col-12 col-lg-6 form-label-group mb-3">
                        <label for="Barangay" class="font-weight-bold">Barangay</label>
                        <p class="detail-text m-0"><?= (( $this->session->userdata("userData")->barangay ) ? $this->session->userdata("userData")->barangay  : "N/a") ?></p>
                        <input name="Barangay" type="text" id="Barangay" class="form-control field" placeholder="Ex. BRGY. Lamesa" value="<?= (( $this->session->userdata("userData")->barangay ) ? $this->session->userdata("userData")->barangay  : null) ?>">
                    </div>
                    <div class="col-12">
                        <div class="form-label-group mb-3">
                            <label for="Address" class="font-weight-bold">Address</label>
                            <p class="detail-text m-0"><?= (( $this->session->userdata("userData")->address1 ) ? $this->session->userdata("userData")->address1  : "N/a") ?></p>
                            <textarea name="Address" type="textarea" id="email" class="form-control field" placeholder="Street Number/Building No./Subd./ etc."><?= (( $this->session->userdata("userData")->address1 ) ? $this->session->userdata("userData")->address1  : null) ?></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="text-divider my-4"><small>Student Information</small></div>
                    </div>
                    <div class=" col-12 col-lg-4 form-label-group mb-3">
                        <label for="contact" class="font-weight-bold">Contact Number</label>
                        <p class="detail-text m-0"><?= (( $this->session->userdata("userData")->contact_no ) ? $this->session->userdata("userData")->contact_no  : "N/a") ?></p>
                        <input name="contact" type="number" id="contact" class="form-control field" placeholder="Ex. 915xxxxxx" value="<?= (( $this->session->userdata("userData")->contact_no ) ? $this->session->userdata("userData")->contact_no  : null) ?>">
                    </div>
                    <div class=" col-12 col-lg-4 form-label-group mb-3">
                        <label for="studentno" class="font-weight-bold">Student Number</label>
                        <p class="detail-text m-0"><?= (( $this->session->userdata("userData")->student_no ) ? $this->session->userdata("userData")->student_no  : "N/a") ?></p>
                        <input name="studentno" type="text" id="studentno" class="form-control field" placeholder="Ex. School Student Number" value="<?= (( $this->session->userdata("userData")->student_no ) ? $this->session->userdata("userData")->student_no  : null) ?>">
                    </div>
                    <div class=" col-12 col-lg-4 form-label-group mb-3">
                        <label for="email" class="font-weight-bold">Email</label>
                        <p class="detail-text m-0"><?= (( $this->session->userdata("userData")->email ) ? $this->session->userdata("userData")->email  : "N/a") ?></p>
                        <input name="email" type="text" id="email" class="form-control field" placeholder="Ex. johndoe@company.com" value="<?= (( $this->session->userdata("userData")->email ) ? $this->session->userdata("userData")->email  : null) ?>">
                    </div>
                    <div class=" col-12 col-lg-6 form-label-group mb-3">
                        <label for="Password" class="font-weight-bold field">Password</label>
                        <input name="Password" type="password" id="Password" class="form-control field mb-3" placeholder="Enter Password">
                    </div>
                    <div class=" col-12 col-lg-6 form-label-group mb-3">
                        <label for="confPassword" class="font-weight-bold field">Confirm Password</label>
                        <input name="confPassword" type="password" id="confPassword" class="form-control field" placeholder="Re-Type Password">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn button-primary px-5 float-right field ml-3">Save</button>
                        <button type="Button" id="canceledit" class="btn button-secondary px-5 float-right field">Cancel</button>
                        <button type="Button" id="editbutton" class="btn button-primary px-5 float-right detail-text">Edit</button>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
    <?php echo form_close() ?>
</Main>
