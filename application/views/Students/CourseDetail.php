<Main>
    <?php echo form_open_multipart('Students/CredentialDetail/edit') ?>
    <div class="container-md mx-auto row p-5">
        <div class="col-12 col-md-6">
            <p class="title detail-text m-0">
                <?= $credDetail->title ?>
            </p>
            <label for="title" class="field font-weight-bold">Title</label>

        </div>
        <div class="col-12">
            <div class="text-divider my-4"><small>Information</small></div>
        </div>
        <div class="col-12">


            <center>
          
                <?php if(isset($picture)):?>
                    <div style="width: 100%; height: 500px;" id="imageContainer" class="mb-4 rounded"></div>

                <?php elseif(isset($credDetail)):?>
                    <div style="width: 100%; height: 500px;" id="imageContainer" class="mb-4 rounded"></div>
                <?php else:?>
                    <div style="width: 100%; height: 500px;" id="imageContainer" class="mb-4 rounded"></div>
                <?php endif;?>
            </center>
            <div class="row">
                <div class="col-12 form-label-group mb-3">
                    <div class="w-100">
                        <label for="imageUpload" class="font-weight-bold field">AddImage</label>
                    </div>
                </div>
                <div class="col-12 form-label-group mb-3">
                    <label for="description" class="font-weight-bold">Description</label>
                    <p class="detail-text text-wrap m-0" style="word-break: break-all;"><?= (( $credDetail->description ) ? $credDetail->description  : "N/a") ?></p>
                    <textarea name="description" rows="4" type="textarea" id="description" class="form-control field" placeholder="Ex. Course Description"><?= ((  $credDetail->description ) ?  $credDetail->description  : null) ?></textarea>
                </div>
                <div class="col-12 form-label-group mb-3">
                    <div class="form-label-group">
                        <label for="types" class="font-weight-bold">Type</label>
                         <p class="detail-text m-0"><?= (($data->value == 1) ? 'Certification': (($data->value == 2) ? 'Recognition' : (($data->value == 3) ? 'Attendance' : 'Completion' ))) ?></p>
                    </div> 
                </div> 
                <div class="col-12 form-label-group mb-3">
                    <label for="location" class="font-weight-bold">Link</label>
                    <p class="detail-text m-0"><?= (( $credDetail->link ) ? $credDetail->link  : "N/a") ?></p>
        
                </div>
                <div class="col-12 form-label-group mb-3">
                    <label for="provider" class="font-weight-bold">Provider</label>
                    <p class="detail-text m-0"><?= (( $credDetail->provider ) ? $credDetail->provider  : "N/a") ?></p>
        
                </div>
                <div class="col-12 form-label-group mb-3">
                    <label for="dateAcquired" class="font-weight-bold">Created By</label>
                    <p class="detail-text m-0"><?= (( $credDetail->created_by ) ? $credDetail->created_by  : "N/a") ?></p>
        
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close() ?>
</Main>