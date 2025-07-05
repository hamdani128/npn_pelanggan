<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="<?=base_url()?>" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="<?=base_url('users_management')?>" class=" waves-effect">
                        <i class="mdi mdi-account-group"></i>
                        <span>users Management</span>
                    </a>
                </li>
                <?php if (session()->get('level') === "super admin") {?>
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
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-apps"></i>
                        <span>Modul Pelanggan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="javascript: void(0);">Retail</a></li>
                        <li><a href="javascript: void(0);">B2B</a></li>
                        <li><a href="javascript: void(0);" class="has-arrow">Kemitraan / Reseller</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li>
                                    <a href="<?=base_url("profile_pelanggan/kemitraan_reseller")?>">
                                        Registrasi Legalitas
                                    </a>
                                </li>
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