<main>
   <div class="mx-5 px-5 mt-5">
        <div class="row mb-4">
            <div class="col-6">
                <p class="h3">
                    Search Courses
                </p>
            </div>
            <div class="col-6">
                <form action="<?= base_url('Courses') ?>">
                    <button type="submit" class="btn button-primary float-right">Search</button>
                    <div class="float-right mr-3">
                    
                        <div class="form-label-group">
                            <input name="search" type="text" id="search" class="form-control" placeholder=' Enter Search Keyword' value="<?= urldecode($this->input->get('search'))?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <?php if($this->session->userdata('courses')): ?>
                <?php foreach($this->session->userdata('courses') as $key => $item):?>
                    <div class="col-12 col-md-6 col-lg-4 mb-4" onclick="window.open('<?= $item->link ?>', '_blank').focus();" style=" cursor: pointer;">
                        <div class="card border-0 shadow-sm" style="height: 400px;">
                            <div class="card-body boder-0 card-course rounded-top" style="background-image: url('<?= (($item->image) ? $this->session->userdata('base_url').$item->image : 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Image_not_available.png/800px-Image_not_available.png?20210219185637') ?>');">
                                <div class="rounded-top" style="z-index: 0; position: absolute; top:0; left: 0; height: 300px; width: 100%; background-image: linear-gradient(to bottom, rgba(255,0,0,0), black); opacity: 0.4">
                                </div>
                            </div>
                            <div class="card-footer background-white" style="height: 100px;">
                                <div style="height: 100%; " class="d-flex align-items-start">
                                    <?php if($item->description != null): ?>
                                        <div class="w-100" style="z-index: 1000;">
                                            <h6 class="mx-0 mt-0 mb-2 truncate-1" style="font-size: 18px;">
                                                <?= $item->title ?>
                                            </h6>
                                            <p class="truncate-2 m-0" style="font-size: 14px;"> <?= $item->description ?></p>
                                        </div>
                                    <?php else: ?>
                                        <div class="w-100">
                                            <h6 class="mx-0 mt-0 mb-2 truncate-1" style="font-size: 18px;">
                                                <?= $item->title ?>
                                            </h6>
                                            <p class="m-0 text-muted" style="font-size: 14px;">No Description Available</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
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