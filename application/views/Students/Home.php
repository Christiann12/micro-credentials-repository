<!-- Modal -->
<div class="modal fade" id="credModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Credential</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('Students/Home/addNewCred') ?>
        <div class="modal-body">
            <div class="form-label-group mb-3">
                <label for="credTitle" class="font-weight-bold">Title<i class="text-danger">*</i></label>
                <input name="credTitle" type="text" id="Title" class="form-control" placeholder="Ex. Certificate of Completion">
            </div>
            <div class="form-label-group mb-3">
                <label for="Description" class="font-weight-bold">Description</label>
                <textarea name="Description" type="textarea" id="email" class="form-control" placeholder="Course Description"></textarea>
            </div>
            <div class="form-label-group mb-3">
                <label for="location" class="font-weight-bold">Location<i class="text-danger">*</i></label>
                <input name="location" type="text" id="Title" class="form-control" placeholder="Ex. Philippines">
            </div>
            <div class="form-label-group mb-3">
                <label for="types" class="font-weight-bold">Type<i class="text-danger">*</i></label>
                <?php
                    $types = array(
                        '' => 'Select Type',
                        "1" => "Certification", 
                        "2" => "Recognition", 
                        "3" => "Attendance", 
                        "4" => "Completion", 
                    ); 
                    echo form_dropdown('types', $types, '' , 'class="form-control" id="types"');
                ?>
            </div>  
            <div class="row">
                <div class="col-6">
                    <div class="form-label-group mb-3">
                        <label for="provider" class="font-weight-bold">Provider<i class="text-danger">*</i></label>
                        <input name="provider" type="text" id="Provider" class="form-control" placeholder="Ex. LinkedIn, Coursera, Etc.">
                    </div>
                    <div class="form-label-group mb-3">
                        <label for="expDateFrom" class="font-weight-bold">Expiration Date From</label>
                        <input name="expDateFrom" type="date" id="expDateFrom" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-label-group mb-3">
                        <label for="dateAcquired" class="font-weight-bold">Date Acquisition<i class="text-danger">*</i></label>
                        <input name="dateAcquired" type="date" id="dateAcquired" class="form-control" placeholder="">
                    </div>
                    <div class="form-label-group mb-3">
                        <label for="expDateTo" class="font-weight-bold">Expiration Date To</label>
                        <input name="expDateTo" type="date" id="expDateTo" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" id="button" class="btn button-primary">Save changes</button>
        </div>
        <?php echo form_close() ?>
    </div>
  </div>
</div>
<?php if($this->session->flashdata('successAddNewCred')){ ?>
    <div  x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show"  x-transition.duration.1000ms style="position: fixed; top:10%; right: 0;width: 25%; z-index: 5;">
        <div class="card alert-success w-100 ml-auto" style="">
            <div class="card-header">
                <h5>
                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                    Success
                </h5>
            </div>
            <div class="card-body">
                <small><?php  echo $this->session->flashdata('successAddNewCred'); $this->session->unset_userdata ( 'successAddNewCred' );?></small>
            </div>
        </div>
    </div>
<?php } ?>  
<?php if ($this->session->flashdata('errorAddNewCred')){ ?>
    <div  x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition.duration.1000ms style="position: fixed; top:10%; right: 0;width: 25%; z-index: 5;">
        <div class="card alert-danger w-100 " style="">
            <div class="card-header">
                <h5>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    Error
                </h5>
            </div>
            <div class="card-body">
                <small><?php  echo $this->session->flashdata('errorAddNewCred'); $this->session->unset_userdata ( 'errorAddNewCred' );?></small>
            </div>
        </div>
    </div>
<?php } ?>

<Main>
        
    <div class="spacer"></div>
    <div class="mx-4">
        <p class="title">Charts</p>

        <div class="row">
            <div class="col-12 col-lg-4 mb-3" style="height: 500px;">
                <div class="card h-100">
                    <div class="card-header">
                        <p class="card-title m-0">
                            Percentage of credential provider
                        </p>
                    </div>
                    <div class="card-body  h-100 w-100" id="percentProviderPie">
                         
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 mb-4" style="height: 500px;">
                <div class="card h-100">
                    <div class="card-header">
                        <p class="card-title m-0">
                            Credential count gathered per month
                        </p>
                    </div>
                    <div class="card-body h-100 w-100" id="Dates">
                        
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 mb-4" style="height: 500px;">
                <div class="card h-100">
                    <div class="card-header">
                        <p class="card-title m-0">
                            Percentage of credential type
                        </p>
                    </div>
                    <div class="card-body h-100 w-100" id="percentTypePie">
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="mx-4">
        
        <p class="text-justify m-0"><span class="font-weight-bold">Suggested Job:</span> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
    </div>
    <div class="mx-4">
        <div class="row">
            <div class="col-6">
                <p class="title mt-2"  style="">Micro Credentials</p>
            </div>
            <div class="col-6">
                <button class="btn button-primary float-right" data-toggle="modal" data-target="#credModal"><i class="fa fa-plus small" aria-hidden="true"></i> Add New</button>
            </div>
        </div>
        <div class="row">
            <?php if($this->session->userdata("credentials")): ?>
                <?php foreach($this->session->userdata("credentials") as $key => $cred): ?>
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card" style="height: 300px;">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <p class="m-0 small " style="line-height: 23px;">
                                            <?= $cred->provider_name; ?>
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <a href="<?= base_url("Students/CredentialDetail/clearCache/".$key); ?>" onclick="myFunction();"><i class="fa fa-pencil float-right text-muted" aria-hidden="true" ></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="card-title truncate-1">
                                    <?= $cred->title; ?>
                                </h6>
                                <div style="height: 100px;" class="d-flex">
                                        <?php if($cred->description): ?>
                                               <div class="justify-content-center align-self-center w-100">
                                                    <p class="truncate-4" style=""> <?= $cred->description; ?> </p>
                                               </div>
                                        <?php else: ?>
                                            <div class="justify-content-center align-self-center">
                                                    <center>
                                                        <p class="text-muted">No Description Available</p>
                                                    </center>
                                            </div>
                                        <?php endif; ?>
                                </div>
                                <p class="text-muted truncate-1"><i class="fa fa-map-marker small" aria-hidden="true"></i> <?= $cred->location; ?></p>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-6">
                                        <p class="small text-muted m-0">
                                            <i class="fa fa-calendar text-muted" aria-hidden="true"></i>
                                            <?= date("Y-m-d",strtotime($cred->date_acquired)); ?>
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <a href="<?= base_url('Students/Home/delete/'.$cred->id) ?>" onclick="ConfirmDelete();"><i class="fa fa-trash float-right text-muted" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <center>
                        <h4 class="text-muted">No Credentials Found!</h4>
                    </center>
                </div>
            <?php endif; ?>
        </div>
    </div>
</Main>
