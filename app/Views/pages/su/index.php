<?=$this->Extend('layout/index');?>
<?=$this->section('content');?>

<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Apaxy</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="font-size-14">Number of Sales</h5>
                        </div>
                        <div class="avatar-xs">
                            <span class="avatar-title rounded-circle bg-primary">
                                <i class="dripicons-box"></i>
                            </span>
                        </div>
                    </div>
                    <h4 class="m-0 align-self-center">1,753</h4>
                    <p class="mb-0 mt-3 text-muted"><span class="text-success">1.23 % <i
                                class="mdi mdi-trending-up mr-1"></i></span> From previous period</p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="font-size-14">Sales Revenue</h5>
                        </div>
                        <div class="avatar-xs">
                            <span class="avatar-title rounded-circle bg-primary">
                                <i class="dripicons-briefcase"></i>
                            </span>
                        </div>
                    </div>
                    <h4 class="m-0 align-self-center">$45,253</h4>
                    <p class="mb-0 mt-3 text-muted"><span class="text-success">2.73 % <i
                                class="mdi mdi-trending-up mr-1"></i></span> From previous period</p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="font-size-14">Average Price</h5>
                        </div>
                        <div class="avatar-xs">
                            <span class="avatar-title rounded-circle bg-primary">
                                <i class="dripicons-tags"></i>
                            </span>
                        </div>
                    </div>
                    <h4 class="m-0 align-self-center">$12.74</h4>
                    <p class="mb-0 mt-3 text-muted"><span class="text-danger">4.35 % <i
                                class="mdi mdi-trending-down mr-1"></i></span> From previous period</p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="font-size-14">Product Sold</h5>
                        </div>
                        <div class="avatar-xs">
                            <span class="avatar-title rounded-circle bg-primary">
                                <i class="dripicons-cart"></i>
                            </span>
                        </div>
                    </div>
                    <h4 class="m-0 align-self-center">20,781</h4>
                    <p class="mb-0 mt-3 text-muted"><span class="text-success">7.21 % <i
                                class="mdi mdi-trending-up mr-1"></i></span> From previous period</p>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->


    <!-- <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Latest Transaction</h4>

                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 50px;">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheckall">
                                            <label class="custom-control-label" for="customCheckall"></label>
                                        </div>
                                    </th>
                                    <th scope="col" style="width: 60px;"></th>
                                    <th scope="col">ID & Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <img src="<?=base_url()?>assets/images/users/avatar-2.jpg" alt="user"
                                            class="avatar-xs rounded-circle" />
                                    </td>
                                    <td>
                                        <p class="mb-1 font-size-12">#AP1234</p>
                                        <h5 class="font-size-15 mb-0">David Wiley</h5>
                                    </td>
                                    <td>02 Nov, 2019</td>
                                    <td>$ 1,234</td>
                                    <td>1</td>

                                    <td>
                                        $ 1,234
                                    </td>
                                    <td>
                                        <i class="mdi mdi-checkbox-blank-circle text-success mr-1"></i>
                                        Confirm
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-success btn-sm">Edit</button>
                                        <button type="button" class="btn btn-outline-danger btn-sm">Cancel</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-xs">
                                            <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                W
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-1 font-size-12">#AP1235</p>
                                        <h5 class="font-size-15 mb-0">Walter Jones</h5>
                                    </td>
                                    <td>04 Nov, 2019</td>
                                    <td>$ 822</td>
                                    <td>2</td>

                                    <td>
                                        $ 1,644
                                    </td>
                                    <td>
                                        <i class="mdi mdi-checkbox-blank-circle text-success mr-1"></i>
                                        Confirm
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-success btn-sm">Edit</button>
                                        <button type="button" class="btn btn-outline-danger btn-sm">Cancel</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck3">
                                            <label class="custom-control-label" for="customCheck3"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <img src="<?=base_url()?>assets/images/users/avatar-3.jpg" alt="user"
                                            class="avatar-xs rounded-circle" />
                                    </td>
                                    <td>
                                        <p class="mb-1 font-size-12">#AP1236</p>
                                        <h5 class="font-size-15 mb-0">Eric Ryder</h5>
                                    </td>
                                    <td>05 Nov, 2019</td>
                                    <td>$ 1,153</td>
                                    <td>1</td>

                                    <td>
                                        $ 1,153
                                    </td>
                                    <td>
                                        <i class="mdi mdi-checkbox-blank-circle text-danger mr-1"></i>
                                        Cancel
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-success btn-sm">Edit</button>
                                        <button type="button" class="btn btn-outline-danger btn-sm">Cancel</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck4">
                                            <label class="custom-control-label" for="customCheck4"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <img src="<?=base_url()?>assets/images/users/avatar-6.jpg" alt="user"
                                            class="avatar-xs rounded-circle" />
                                    </td>
                                    <td>
                                        <p class="mb-1 font-size-12">#AP1237</p>
                                        <h5 class="font-size-15 mb-0">Kenneth Jackson</h5>
                                    </td>
                                    <td>06 Nov, 2019</td>
                                    <td>$ 1,365</td>
                                    <td>1</td>

                                    <td>
                                        $ 1,365
                                    </td>
                                    <td>
                                        <i class="mdi mdi-checkbox-blank-circle text-success mr-1"></i>
                                        Confirm
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-success btn-sm">Edit</button>
                                        <button type="button" class="btn btn-outline-danger btn-sm">Cancel</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck5">
                                            <label class="custom-control-label" for="customCheck5"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-xs">
                                            <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                R
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-1 font-size-12">#AP1238</p>
                                        <h5 class="font-size-15 mb-0">Ronnie Spiller</h5>
                                    </td>
                                    <td>08 Nov, 2019</td>
                                    <td>$ 740</td>
                                    <td>2</td>

                                    <td>
                                        $ 1,480
                                    </td>
                                    <td>
                                        <i class="mdi mdi-checkbox-blank-circle text-warning mr-1"></i>
                                        Pending
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-success btn-sm">Edit</button>
                                        <button type="button" class="btn btn-outline-danger btn-sm">Cancel</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- end row -->
</div>
<!-- container-fluid -->


<?=$this->endSection();?>