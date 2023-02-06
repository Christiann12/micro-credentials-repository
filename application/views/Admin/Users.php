<?php if($this->session->flashdata('successCreate')){ ?>
    <div  x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show"  x-transition.duration.1000ms style="position: fixed; top:10%; right: 0;width: 25%; z-index: 5;">
        <div class="card alert-success w-100 ml-auto" style="">
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
    <div  x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition.duration.1000ms style="position: fixed; top:10%; right: 0;width: 25%; z-index: 5;">
        <div class="card alert-danger w-100 " style="">
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

<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUser" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createUser">Create User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('Admin/Users/create') ?>
        <div class="modal-body">
            <div class="row">
                <div class="col-4">
                    <div class="form-label-group mb-3">
                        <label for="first_name" class="font-weight-bold">First Name<i class="text-danger">*</i></label>
                        <input name="first_name" type="text" id="first_name" class="form-control" placeholder="Ex. John" value="<?= (($this->session->userdata('oldData')) ? $this->session->userdata('oldData')['first_name']: null) ?>">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-label-group mb-3">
                        <label for="middle_initial" class="font-weight-bold">Middle Name</label>
                        <input name="middle_initial" type="text" id="middle_initial" class="form-control" placeholder="Ex. B" value="<?= (($this->session->userdata('oldData')) ? $this->session->userdata('oldData')['middle_name']: null) ?>">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-label-group mb-3">
                        <label for="last_name" class="font-weight-bold">Last Name<i class="text-danger">*</i></label>
                        <input name="last_name" type="text" id="last_name" class="form-control" placeholder="Ex. Doe" value="<?= (($this->session->userdata('oldData')) ? $this->session->userdata('oldData')['last_name']: null) ?>">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-label-group mb-3">
                        <label for="student_no" class="font-weight-bold">Student No.</label>
                        <input name="student_no" type="text" id="student_no" class="form-control" placeholder="Student No." value="<?= (($this->session->userdata('oldData')) ? $this->session->userdata('oldData')['student_no']: null) ?>">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-label-group mb-3">
                        <label for="contact_no" class="font-weight-bold">Contact Information <i class="text-danger">*</i></label>
                        <input name="contact_no" maxlength="10" type="number" id="contact_no" class="form-control" placeholder="Contact Information" value="<?= (($this->session->userdata('oldData')) ? $this->session->userdata('oldData')['contact_no']: null) ?>">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-label-group mb-3">
                        <label for="birthday" class="font-weight-bold">Birhtday</label>
                        <input name="birthday" type="date" id="birthday" class="form-control" placeholder="Birthday" value="<?= (($this->session->userdata('oldData')) ? $this->session->userdata('oldData')['birthday']: null) ?>">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-label-group mb-3">
                        <label for="email" class="font-weight-bold">Email<i class="text-danger">*</i></label>
                        <input name="email" type="text" id="email" class="form-control" placeholder="Ex. johndoe@company.com" value="<?= (($this->session->userdata('oldData')) ? $this->session->userdata('oldData')['email']: null) ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-label-group mb-3">
                        <label for="types" class="font-weight-bold">Type<i class="text-danger">*</i></label>
                        <?php
                            $types = array(
                                '' => 'Select Type',
                                "0" => "User", 
                                "1" => "Admin", 
                            ); 
                            echo form_dropdown('types', $types, (($this->session->userdata('oldData')) ? (string) $this->session->userdata('oldData')['user_type']: null)  , 'class="form-control" id="types"');
                        ?>
                    </div>  
                </div>
                
                <div class="col-6">
                    <div class="form-label-group mb-3">
                        <label for="region" class="font-weight-bold">Region</label>
                        <input name="region" type="text" id="region" class="form-control" placeholder="Region" value="<?= (($this->session->userdata('oldData')) ? $this->session->userdata('oldData')['region']: null) ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-label-group mb-3">
                        <label for="province" class="font-weight-bold">Province</label>
                        <input name="province" type="text" id="province" class="form-control" placeholder="Province" value="<?= (($this->session->userdata('oldData')) ? $this->session->userdata('oldData')['province']: null) ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-label-group mb-3">
                        <label for="municipality" class="font-weight-bold">Municipality</label>
                        <input name="municipality" type="text" id="municipality" class="form-control" placeholder="Municipality"  value="<?= (($this->session->userdata('oldData')) ? $this->session->userdata('oldData')['city']: null) ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-label-group mb-3">
                        <label for="barangay" class="font-weight-bold">Barangay</label>
                        <input name="barangay" type="text" id="barangay" class="form-control" placeholder="Barangay" value="<?= (($this->session->userdata('oldData')) ? $this->session->userdata('oldData')['barangay']: null) ?>">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-label-group">
                        <label for="contact_no" class="font-weight-bold">Address</label>
                        <textarea name="address1" type="textarea" id="address1" class="form-control" placeholder="Street Number/Building No./Subd./ etc."><?= (($this->session->userdata('oldData')) ? $this->session->userdata('oldData')['address1']: null) ?></textarea>
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

<main style="margin-left: 100px;">
    <div class="" style="margin: 32px;">
        
        <div class="row mb-4">
            <div class="col-6">
                <p class="title ">
                    User Management
                </p>
            </div>
            <div class="col-6 ">
                <button type="button" data-toggle="modal" data-target="#createUserModal" class="btn button-primary float-right">Add New User</button>
            </div>
        </div>
        
        <div class="w-100 rounded" style="">
            <table width="100%" class="table shadow-sm table-striped" id="userTable" data-order='[[ 0, "desc" ]]'>
                <thead style="background-color: var(--primary-color); color: white;">
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Contact No.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($users): ?>
                        <?php foreach($users as $item): ?>
                            <tr>
                                <td><?= $item->first_name.' '.$item->middle_name.' '.$item->last_name?></td>
                                <td><?= $item->email ?></td>
                                <td><?= (($item->user_type == 0) ? 'User' : 'Admin') ?></td>
                                <td><?= $item->contact_no ?></td>
                            </tr>
                        <?php endforeach;?>
                    <?php endif; ?>
                    
                </tbody>
            </table>
        </div>

    </div>
</main>