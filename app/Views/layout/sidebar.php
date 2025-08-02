<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <?php if (session()->get('level') === "Mitra") {?>
                <li>
                    <a href="<?=base_url("mitra")?>" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?=base_url('pelanggan_mitra')?>" class=" waves-effect">
                        <i class="mdi mdi-account-group"></i>
                        <span>Pelanggan</span>
                    </a>
                </li>
                <?php } else {?>
                <li>
                    <a href="<?=base_url()?>" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <?php }?>

                <?php if (session()->get('level') === "super admin") {?>
                <li>
                    <a href="<?=base_url('users_management')?>" class=" waves-effect">
                        <i class="mdi mdi-account-group"></i>
                        <span>users Management</span>
                    </a>
                </li>
                <?php }?>
                <?php if (session()->get('level') === "super admin" || session()->get('level') === "Admin") {?>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-apps"></i>
                        <span>Modul Master</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="<?=base_url("master/supported_document")?>">
                                Document Support
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Employee Management
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Asset Management
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-apps"></i>
                        <span>Modul Pelanggan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <!-- <li><a href="javascript: void(0);">Retail</a></li>
                        <li><a href="javascript: void(0);">B2B</a></li> -->
                        <li><a href="javascript: void(0);" class="has-arrow">Kemitraan / Reseller</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li>
                                    <a href="<?=base_url("profile_pelanggan/register")?>">
                                        Data Registrasi
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=base_url("profile_pelanggan/kemitraan_reseller")?>">
                                        Profile Legalitas
                                    </a>
                                </li>
                                <li><a href="javascript: void(0);">Hostory Deleted Account</a></li>
                                <li><a href="javascript: void(0);">Data Pelanggan</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>
                <?php }?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>