<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <!-- <img src="<?php echo base_url('assets/'); ?>dist/img/adonia.png" alt="ADONIA Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-bold ml-2">HR Lite Online</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url('assets/dist/img/profile/' . $user['image']); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $user['nama']; ?></a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                    <a href="<?php echo base_url('admin/index'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p class="text">Main Menu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('admin/index_dashboard'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p class="text">Beranda</p>
                    </a>
                </li>
                <li class="nav-header">ADMIN</li>
                <li class="nav-item">
                    <a href="<?php echo base_url('config/form'); ?>" id="configs" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p class="text">Konfigurasi</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Master Pegawai
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/list_pegawai'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Pegawai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/man_user'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/list_jabatan'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Jabatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/list_divisi'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Bagian / Divisi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fas fa-dollar-sign"></i>
                        <p>
                            SKEMA PAYROLL
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/list_kontrak'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Kontrak</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/list_jenis_payslip'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Jenis Payslip</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/list_mst_allowance'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Komp Allowance</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/list_mst_benefit'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Komp Benefit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/list_mst_deduction'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Komp Deduction</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/list_mst_reimbursement'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Komp Reimbursement</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-clone"></i>
                        <p>
                            Payroll
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/new_payroll'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>New Payroll</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/history_payroll'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>History Payroll</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-clone"></i>
                        <p>
                            Master Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/mst_gaji'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penggajian Pegawai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/penilaian'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penilaian Pegawai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/prestasi'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Prestasi Pegawai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/insentif'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Insentif dan Bonus</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/info'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Info HRD</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-calendar"></i>
                        <p>
                            Cuti Staf
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/list_cuti'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Cuti Staf</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/list_cuti_lain'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Cuti Lain Staf</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('admin/reset_cuti'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reset Cuti Staf</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('admin/berita'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-rss-square"></i>
                        <p class="text">Informasi Staf</p>
                    </a>
                </li> -->
                <li class="nav-header">END</li>
                <li class="nav-item">
                    <a href="<?php echo base_url('auth/logout'); ?>" id="tombol-logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                        <p class="text">Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>