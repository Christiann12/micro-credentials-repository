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
    <?php echo form_open_multipart('Students/CredentialDetail/edit') ?>
    <div class="container-md mx-auto row p-5">
        <div class="col-12 col-md-6">
            <p class="title detail-text m-0">
                <?= $credDetail->title ?>
            </p>
            <label for="title" class="field font-weight-bold">Title</label>
            <input name="title" type="text" id="title" class="form-control field" placeholder="Ex. Certificate of Completion" value="<?= (( $credDetail->title ) ? $credDetail->title  : null) ?>">
        </div>
        <div class="col-12">
            <div class="text-divider my-4"><small>Information</small></div>
        </div>
        <div class="col-12">
            <input name="id" type="hidden" id="id" class="form-control field" placeholder="Ex. Philippines" value="<?= $this->uri->segment(2) ?>">
            <input name="credid" type="hidden" id="id" class="form-control field" placeholder="Ex. Philippines" value="<?= $credDetail->id ?>">
            <center>
                <img src="https://user-images.githubusercontent.com/1825286/26859182-9d8c266c-4afb-11e7-8913-93d29b3f47e5.png" style="width: 100%; height: 500px;"class="mb-4 rounded"alt="No Picture">
            </center>
            <div class="row">
                <div class="col-12 form-label-group mb-3">
                    <label for="description" class="font-weight-bold">Description</label>
                    <p class="detail-text text-wrap m-0" style="word-break: break-all;"><?= (( $credDetail->description ) ? $credDetail->description  : "N/a") ?></p>
                    <textarea name="description" rows="4" type="textarea" id="description" class="form-control field" placeholder="Ex. Course Description"><?= ((  $credDetail->description ) ?  $credDetail->description  : null) ?></textarea>
                </div>
                <div class="col-12 form-label-group mb-3">
                    <div class="form-label-group">
                        <label for="types" class="font-weight-bold">Type</label>
                        <?php
                            $types = array(
                                '' => 'Select Type',
                                "1" => "Certification", 
                                "2" => "Recognition", 
                                "3" => "Attendance", 
                                "4" => "Completion", 
                            ); 
                        ?>
                        <p class="detail-text m-0"><?= (( $credDetail->type ) ? $types[$credDetail->type]  : "N/a") ?></p>
                        <?php
                            echo form_dropdown('types', $types,  (( $credDetail->type ) ? $credDetail->type  : null)  , 'class="form-control field" id="types"');
                        ?>
                    </div> 
                </div> 
                <div class="col-12 form-label-group mb-3">
                    <label for="location" class="font-weight-bold">Location</label>
                    <p class="detail-text m-0"><?= (( $credDetail->location ) ? $credDetail->location  : "N/a") ?></p>
                    <input name="location" type="text" id="location" class="form-control field" placeholder="Ex. Philippines" value="<?= (( $credDetail->location ) ? $credDetail->location  : null) ?>">
                </div>
                <div class="col-12 form-label-group mb-3">
                    <label for="provider" class="font-weight-bold">Provider</label>
                    <p class="detail-text m-0"><?= (( $credDetail->provider_name ) ? $credDetail->provider_name  : "N/a") ?></p>
                    <input name="provider" type="text" id="provider" class="form-control field" placeholder="Ex. LinkedIn,Corsera,Etc." value="<?= (( $credDetail->provider_name ) ? $credDetail->provider_name  : null) ?>">
                </div>
                <div class="col-12 form-label-group mb-3">
                    <label for="dateAcquired" class="font-weight-bold">Date Acquisition</label>
                    <p class="detail-text m-0"><?= (( $credDetail->date_acquired ) ? date('Y-m-d',strtotime($credDetail->date_acquired))  : "N/a") ?></p>
                    <input name="dateAcquired" type="date" id="dateAcquired" class="form-control field" placeholder="" value="<?= (( $credDetail->date_acquired ) ? $credDetail->date_acquired  : null) ?>">
                </div>
                <div class="col-12 form-label-group mb-3">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-label-group">
                                <label for="dateExpFrom" class="font-weight-bold">Date Expiration From</label>
                                <p class="detail-text m-0"><?= (( $credDetail->date_from ) ? date('Y-m-d',strtotime($credDetail->date_from),)  : "N/a") ?></p>
                                <input name="dateExpFrom" type="date" id="dateExpFrom" class="form-control field" placeholder="" value="<?= (( $credDetail->date_from ) ? $credDetail->date_from  : null) ?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-label-group">
                                <label for="dateExpTo" class="font-weight-bold">Date Expiration To</label>
                                <p class="detail-text m-0"><?= (( $credDetail->date_to ) ? date('Y-m-d',strtotime($credDetail->date_to))  : "N/a") ?></p>
                                <input name="dateExpTo" type="date" id="dateExpTo" class="form-control field" placeholder="" value="<?= (( $credDetail->date_to ) ? $credDetail->date_to  : null) ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="Button" id="editbutton" class="btn button-primary px-5 float-md-right detail-text ml-md-3 credButton mt-3 mt-md-0">Edit</button>
                    <button type="submit" class="btn button-primary px-5 float-md-right field ml-md-3 credButton mt-3 mt-md-0">Save</button>
                    <button type="Button" id="canceledit" class="btn button-secondary px-5 float-md-right field credButton mt-3 mt-md-0">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close() ?>
</Main>