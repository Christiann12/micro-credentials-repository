<Main  style="margin-left: 100px;">
    <div style="margin: 32px;">
        <div class="row">
            <div class="col-6">
                <p class="title">
                    Credential List
                </p>
            </div>
            <div class="d-none col-6">
                <form action="<?= base_url('CredentialList') ?>">
                    <button type="submit" class="btn button-primary float-right">Search</button>
                    <div class="float-right mr-3">
                    
                        <div class="form-label-group">
                            <input name="search" type="text" id="search" class="form-control" placeholder=' Enter Search Keyword' value="<?= urldecode($this->input->get('search'))?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="spacer"></div>
                <div class="row">
                    <?php if($credentials): ?>
                        <?php foreach($credentials as $key => $cred): ?>
                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <div class="card" style="height: 300px;">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="m-0 small " style="line-height: 23px;">
                                                    <?= $cred->provider_name; ?>
                                                </p>
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
                                            <div class="col-12">
                                                <p class="small text-muted m-0">
                                                    <i class="fa fa-calendar text-muted" aria-hidden="true"></i>
                                                    <?= date("Y-m-d",strtotime($cred->date_acquired)); ?>
                                                </p>
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
        <!-- <div class="w-100 rounded" style="">
            <table width="100%" class="table shadow-sm table-striped" id="userTable" data-order='[[ 0, "desc" ]]'>
                <thead style="background-color: var(--primary-color); color: white;">
                    <tr>
                        <th>Title</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Contact No.</th>
                    </tr>
                </thead>
                <tbody>
                   
                    
                </tbody>
            </table>
        </div> -->
    </div>
    
</Main>