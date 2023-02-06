<Main style="margin-left: 100px;">
    <div class="spacer"></div>
    <div class="mx-2">
        <p class="title mx-3 mb-0" style="margin-bottom: -10px !important;">Overview</p>

        <div class="row p-0 m-0">
            <?php if($totalRecords): ?>
                <?php foreach($totalRecords as $key => $item): ?>
                    <div class="col-12 col-md-6 col-lg-3 px-3 py-0 mt-4 mx-0 mb-0 " style="height: 200px; width: 100%">
                        <div class="background-white border rounded shadow-sm w-100 h-100 m-0 p-4">
                            <i class="fa fa-exclamation-circle text-muted m-0 p-0 float-right" style="font-size: 30px; opacity: 0.5;"aria-hidden="true"></i>
                            <h5 class="text-muted text-truncate"><?=$key?></h5>
                            <div class="h-100">
                                <h1 class=" m-0 h-75"><?=$item->count?></h1>
                                <p class="small text-muted float-right h-25">
                                    Since: <?= date('M. d, Y',strtotime($item->since)) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
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
</Main>