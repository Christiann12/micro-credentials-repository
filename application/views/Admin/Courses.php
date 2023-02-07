<?php if($this->session->flashdata('successCreate')){ ?>
    <div  x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show"  x-transition.duration.1000ms style="position: fixed; top:10%; right: 0; width: 25%; z-index: 10000;">
        <div class="card alert-success w-100 ml-auto">
            <div class="card-header">
                <h5>
                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                    Success
                </h5>
            </div>
            <div class="card-body">
                <small><?php  echo $this->session->flashdata('successCreate'); $this->session->unset_userdata ( 'successCreate' );?></small>
            </div>
        </div>
    </div>
<?php } ?>  
<?php if ($this->session->flashdata('errorCreate')){ ?>
    <div  x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show"  x-transition.duration.1000ms style="position: fixed; top:10%; right:0; width: 25%; z-index: 10000;">
        <div class="card alert-danger w-100 ml-auto" style="">
            <div class="card-header">
                <h5>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    Error
                </h5>
            </div>
            <div class="card-body">
                <small><?php  echo $this->session->flashdata('errorCreate'); $this->session->unset_userdata ( 'errorCreate' );?></small>
            </div>
        </div>
    </div>
<?php } ?>


<div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="modalforcourse" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalforcourse">Add Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('Admin/Courses/create') ?>
        <div class="modal-body">
            <div class="background-primary w-100 rounded mb-3" style="height: 500px; background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Image_not_available.png/800px-Image_not_available.png?20210219185637); background-position: center; background-size: cover;" id="imageContainer">

            </div>
            <div class="form-label-group mb-3">
                <div class="w-100">
                    <label for="imageUpload" class="font-weight-bold">Add Image</label>
                </div>
                <input name="imageUpload" type="file" id="imageUpload" class="" placeholder="Upload Image" onchange="readURL(this);">
            </div>
            <div class="form-label-group mb-3">
                <label for="title" class="font-weight-bold">Title<i class="text-danger">*</i></label>
                <input name="title" type="text" id="title" class="form-control" placeholder="Ex. MYSQL Begginer Course" value="<?= ((isset($this->session->userdata('oldData')['title'] )  ) ? $this->session->userdata('oldData')['title']: null) ?>">
            </div>
            <div class="form-label-group mb-3">
                <label for="description" class="font-weight-bold">Description</label>
                <textarea name="description" type="textarea" id="description" class="form-control" placeholder="Course Description"><?= ((isset($this->session->userdata('oldData')['description'])) ? $this->session->userdata('oldData')['description']: null) ?></textarea>
            </div>
            <div class="form-label-group mb-3">
                <label for="link" class="font-weight-bold">Link<i class="text-danger">*</i></label>
                <input name="link" type="text" id="link" class="form-control" placeholder="Ex. www.linkedin.com" value="<?= ((isset($this->session->userdata('oldData')['link'])) ? $this->session->userdata('oldData')['link']: null) ?>">
            </div>
            <div class="form-label-group mb-3">
                <label for="provider" class="font-weight-bold">Provider<i class="text-danger">*</i></label>
                <input name="provider" type="text" id="provider" class="form-control" placeholder="Ex. LinkedIn/Coursera/Etc." value="<?= ((isset($this->session->userdata('oldData')['provider'])) ? $this->session->userdata('oldData')['provider']: null) ?>">
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
                    echo form_dropdown('types', $types, ((isset($this->session->userdata('oldData')['type'])) ? $this->session->userdata('oldData')['type']: '')  , 'class="form-control" id="types"');
                ?>
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
<div class="modal fade" id="courseModalEdit" tabindex="-1" aria-labelledby="modalforcourse" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalforcourse">Update Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('Admin/Courses/update') ?>
        <div class="modal-body">
            <input name="id" type="hidden" id="id" class="form-control" placeholder="" value="<?= ((isset($this->session->userdata('test')['id'] )  ) ? $this->session->userdata('test')['id']: null) ?>">
            <input name="secretImg" type="hidden" id="secretImg" class="form-control" placeholder="" value="<?= ((isset($this->session->userdata('test')['image'] )  ) ? $this->session->userdata('test')['image']: null) ?>">
            <div class="background-primary w-100 rounded mb-3" style="height: 500px; background-image: url('<?= ((isset($this->session->userdata('test')['image'] )  ) ? $base_url.$this->session->userdata('test')['image']: 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Image_not_available.png/800px-Image_not_available.png?20210219185637') ?>') ; background-position: center; background-size: cover;" id="imageContainer1">

            </div>
            <div class="form-label-group mb-3">
                <div class="w-100">
                    <label for="imageUpload" class="font-weight-bold">Add Image</label>
                </div>
                <input name="imageUpload" type="file" id="imageUpload" class="" placeholder="Upload Image" onchange="readURL1(this);">
            </div>
            <div class="form-label-group mb-3">
                <label for="title" class="font-weight-bold">Title<i class="text-danger">*</i></label>
                <input name="title" type="text" id="title" class="form-control" placeholder="Ex. MYSQL Begginer Course" value="<?= ((isset($this->session->userdata('test')['title'] )  ) ? $this->session->userdata('test')['title']: null) ?>">
            </div>
            <div class="form-label-group mb-3">
                <label for="description" class="font-weight-bold">Description</label>
                <textarea name="description" type="textarea" id="description" class="form-control" placeholder="Course Description"><?= ((isset($this->session->userdata('test')['description'] )  ) ? $this->session->userdata('test')['description']: null) ?></textarea>
            </div>
            <div class="form-label-group mb-3">
                <label for="link" class="font-weight-bold">Link<i class="text-danger">*</i></label>
                <input name="link" type="text" id="link" class="form-control" placeholder="Ex. www.linkedin.com" value="<?= ((isset($this->session->userdata('test')['link'] )  ) ? $this->session->userdata('test')['link']: null) ?>">
            </div>
            <div class="form-label-group mb-3">
                <label for="provider" class="font-weight-bold">Provider<i class="text-danger">*</i></label>
                <input name="provider" type="text" id="provider" class="form-control" placeholder="Ex. LinkedIn/Coursera/Etc." value="<?= ((isset($this->session->userdata('test')['provider'] )  ) ? $this->session->userdata('test')['provider']: null) ?>">
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
                    echo form_dropdown('types', $types,  ((isset($this->session->userdata('test')['type'] )  ) ? $this->session->userdata('test')['type']: null)   , 'class="form-control" id="types"');
                ?>
            </div>  
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" id="button1" class="btn button-primary">Save changes</button>
        </div>
        <?php echo form_close() ?>
    </div>
  </div>
</div>

<main style="margin-left: 100px;">
    <div class="mx-5 px-5 mt-5">
        <div class="row mb-4 mx-1">
            <div class="col-6 pl-0">
                <p class="h3">
                   Course List
                </p>
            </div>
            <div class="col-6 pr-0">
                <button type="Button" class="btn button-primary float-right" data-toggle="modal" data-target="#courseModal"><i class="fa fa-plus small" aria-hidden="true"></i> Add New</button>
            </div>
        </div>
        <div class="row">
            <?php if($courses != null): ?>
                <?php foreach($courses as $item):?>
                    <div class="col-12 col-md-6 col-lg-6 mb-5" style="min-height: 250px; height: 250px; max-height: 250px; ">

                            <div class="row h-100">
                                <div class="col-5 col-sm-6 col-md-6 col-lg-6 h-100" style="">
                                    <div class="h-100 rounded" style="background-image: url('<?= (($item->image) ? $base_url.$item->image : 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Image_not_available.png/800px-Image_not_available.png?20210219185637') ?>'); background-size: cover; background-position: center;">
                                    
                                    </div>
                                </div>
                                <div class=" col-7 col-sm-6 col-md-6 col-lg-6 h-100 pr-3" style="">
                                    <div class="w-100 h-25 d-flex">
                                        <div class=" w-100 align-self-center">
                                            <h4 class=" float-left w-75 text-truncate">
                                                <?= $item->title ?>
                                            </h4>
                                            <button data-id="<?= $item->id ?>" data-toggle="modal" data-image="<?= $item->image ?>" data-provider="<?= $item->provider ?>" data-description="<?= $item->description ?>" data-link="<?= $item->link ?>" data-type="<?= $item->type ?>" data-title="<?= $item->title ?>" data-target="#courseModalEdit" class="test1 btn p-0 float-right mt-1 ml-3"><i class="fa fa-pencil text-primary" aria-hidden="true" style="font-size: 19px;"></i></button>
                                            
                                        </div>
                                    </div>
                                    <div class="w-100 h-25 d-flex">
                                        <?php if($item->description != null): ?>
                                            <p class="truncate-3 small align-self-center text-justify pr-4">
                                                <?= $item->description ?>
                                            </p>
                                        <?php else: ?>
                                            <p class="truncate-3 small text-muted align-self-center text-justify pr-4">
                                                No Description Available
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="w-100 h-25 d-flex">
                                        <a href="<?= $item->link ?>" class="truncate-1 align-self-center small"><i class="fa fa-external-link" aria-hidden="true"></i> <?= $item->link ?></a>
                                    </div>
                                    <div class="w-100 h-25 d-flex text-muted small">
                                        <div class="align-self-center p-0 m-0 w-100">
                                            <div class="p-0 float-left w-75">
                                                <p class="my-0 mr-3"><i class="fa fa-book" aria-hidden="true"></i> <?= $item->provider?></p>
                                                <p class="my-0 mr-3">Created By: <?= $item->created_by ?></p>
                                            </div>
                                            <div class="p-0 float-right pt-2 ">
                                                <a href="<?= base_url('Admin/Courses/delete/'.$item->id) ?>" class="mr-1" onclick="ConfirmDelete();" ><i class="fa fa-trash text-danger p-0" aria-hidden="true" style="font-size: 19px;"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                    </div>
                <?php endforeach;?>
            <?php else:?>
                <div class="col-12">
                    <center>
                        <h4 class="text-muted">No Courses Found!</h4>
                    </center>
                </div>
            <?php endif;?>
        </div>
    </div>
</main>


