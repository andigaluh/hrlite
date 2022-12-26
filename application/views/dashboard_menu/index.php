<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-white">
                                <div class="icon">
                                    <!--
                                    <i class="fas fa-user-plus"></i>-->
                                    <img src="<?php echo base_url()?>assets/icons/payroll.png" height="90px">
                                </div>
                                <div class="inner">
                                    <!--
                                    <h3> &nbsp;<?php // echo $user_perbulan; ?></h3>
                                    <p>&nbsp;</p>
                                    -->
                                </div>
                                <a href="<?php echo base_url()?>admin/new_payroll" class="small-box-footer">Payroll</a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-white">
                                <div class="icon">
                                    <!--
                                    <i class="fas fa-user-plus"></i>-->
                                    <img src="<?php echo base_url()?>assets/icons/attendance.png" height="90px">
                                </div>
                                <div class="inner">
                                    <!--
                                    <h3> &nbsp;<?php // echo $user_perbulan; ?></h3>
                                    <p>&nbsp;</p>
                                    -->
                                </div>
                                <a href="#" class="small-box-footer">Attendance</a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-white">
                                <div class="icon">
                                    <!--
                                    <i class="fas fa-user-plus"></i>-->
                                    <img src="<?php echo base_url()?>assets/icons/expense.png" height="90px">
                                </div>
                                <div class="inner">
                                    <!--
                                    <h3> &nbsp;<?php // echo $user_perbulan; ?></h3>
                                    <p>&nbsp;</p>
                                    -->
                                </div>
                                <a href="#" class="small-box-footer">Expense Management</a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-white">
                                <div class="icon">
                                    <!--
                                    <i class="fas fa-user-plus"></i>-->
                                    <img src="<?php echo base_url()?>assets/icons/organisasi.png" height="90px">
                                </div>
                                <div class="inner">
                                    <!--
                                    <h3> &nbsp;<?php // echo $user_perbulan; ?></h3>
                                    <p>&nbsp;</p>
                                    -->
                                </div>
                                <a href="#" class="small-box-footer">Organisasi</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-white">
                                <div class="icon">
                                    <!--
                                    <i class="fas fa-user-plus"></i>-->
                                    <img src="<?php echo base_url()?>assets/icons/performance.png" height="90px">
                                </div>
                                <div class="inner">
                                    <!--
                                    <h3> &nbsp;<?php // echo $user_perbulan; ?></h3>
                                    <p>&nbsp;</p>
                                    -->
                                </div>
                                <a href="#" class="small-box-footer">Performance Management</a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-white">
                                <div class="icon">
                                    <!--
                                    <i class="fas fa-user-plus"></i>-->
                                    <img src="<?php echo base_url()?>assets/icons/data.png" height="90px">
                                </div>
                                <div class="inner">
                                    <!--
                                    <h3> &nbsp;<?php // echo $user_perbulan; ?></h3>
                                    <p>&nbsp;</p>
                                    -->
                                </div>
                                <a href="#" class="small-box-footer">Data Analytic</a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-white">
                                <div class="icon">
                                    <!--
                                    <i class="fas fa-user-plus"></i>-->
                                    <img src="<?php echo base_url()?>assets/icons/employee.png" height="90px">
                                </div>
                                <div class="inner">
                                    <!--
                                    <h3> &nbsp;<?php // echo $user_perbulan; ?></h3>
                                    <p>&nbsp;</p>
                                    -->
                                </div>
                                <a href="<?php echo base_url()?>admin/list_pegawai" class="small-box-footer">Employee Data</a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-white">
                                <div class="icon">
                                    <!--
                                    <i class="fas fa-user-plus"></i>-->
                                    <img src="<?php echo base_url()?>assets/icons/industrial.png" height="90px">
                                </div>
                                <div class="inner">
                                    <!--
                                    <h3> &nbsp;<?php // echo $user_perbulan; ?></h3>
                                    <p>&nbsp;</p>
                                    -->
                                </div>
                                <a href="#" class="small-box-footer">Industrial Relation</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                    <?php echo $this->session->flashdata('msg'); ?>
                    <?php if (validation_errors()) { ?>
                        <div class="alert alert-danger">
                            <strong><?php echo strip_tags(validation_errors()); ?></strong>
                            <a href="" class="float-right text-decoration-none" data-dismiss="alert"><i class="fas fa-times"></i></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="edit-profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Profile</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('admin/index'); ?>
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
                        <input type="text" class="form-control" id="username" value="<?php echo $user['username']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nik" class="col-sm-2 col-form-label">Kode Pegawai</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nik" value="<?php echo $user['pegawai_kd']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $user['nama']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2"><label>Photo</label></div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?php echo base_url('assets/dist/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Upload Photo</label>
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-default float-right ml-1" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary float-right">Simpan Perubahan</button>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="edit-pass">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('admin/ubah_password'); ?>" method="post">
                    <div class="form-group">
                        <label for="current_password">Password Lama</label>
                        <input type="password" class="form-control" id="current_password" name="current_password">
                    </div>
                    <div class="form-group">
                        <label for="new_password1">Password Baru</label>
                        <input type="password" class="form-control" id="new_password1" name="new_password1">
                    </div>
                    <div class="form-group">
                        <label for="new_password2">Ulang Password Baru</label>
                        <input type="password" class="form-control" id="new_password2" name="new_password2" placeholder="Ketik ulang password baru">
                    </div>
                    <button type="button" class="btn btn-default float-right ml-1" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary float-right">Simpan Perubahan</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>