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
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('assets/dist/img/profile/' . $user['image']); ?>" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center"><?php echo $user['nama']; ?></h3>
                            <p class="text-muted text-center"><?php echo $user['pegawai_kd']; ?></p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Tgl Register</b> <a class="float-right"><?php echo format_indo($user['date_created']); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Level</b> <a class="float-right"><?php echo $user['level']; ?></a>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#edit-profile"><b>Ubah Profile</b></button>
                            <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#edit-pass"><b>Ubah Password</b></button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- About Me Box -->
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Info HRD</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Detail</a></li>
                                <li class="nav-item"><a class="nav-link" href="#history" data-toggle="tab">Struktural</a></li>
                                <li class="nav-item"><a class="nav-link" href="#gaji" data-toggle="tab">Gaji dan Insentif</a></li>
                                <li class="nav-item"><a class="nav-link" href="#nilai" data-toggle="tab">Penilaian Kinerja</a></li>
                                <li class="nav-item"><a class="nav-link" href="#prestasi" data-toggle="tab">Prestasi Kerja</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="table-responsive">
                                        <table id="table-id" class="table table-bordered table-striped" style="font-size:13px;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th width="15%">Tgl Info</th>
                                                    <th width="80%">Info</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php foreach ($info as $in) : ?>
                                                    <tr>
                                                        <td><?php echo $i++; ?></td>
                                                        <td><?php echo format_indo($in['tgl_info']); ?></td>
                                                        <td><textarea class="form-control" rows="4" readonly><?php echo $in['info']; ?></textarea></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="timeline">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Nama Suami/Istri</b> <a class="float-right"><?php echo $keluarga['nama_pasangan']; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <?php if ($keluarga['tgl_lahir_pasangan'] == NULL) : ?>
                                                <b>Tgl Lahir Suami/Istri</b> <a class="float-right"></a>
                                            <?php else : ?>
                                                <b>Tgl Lahir Suami/Istri</b> <a class="float-right"><?php echo format_indo($keluarga['tgl_lahir_pasangan']); ?></a>
                                            <?php endif; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Jumlah Anak</b> <a class="float-right"><?php echo $keluarga['jml_anak']; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>No Telp Suami/Istri</b> <a class="float-right"><?php echo $keluarga['telp_pasangan']; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Alamat Suami/Istri</b> <a class="float-right"><?php echo $keluarga['alamat_pasangan']; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Pekerjaan Suami/Istri</b> <a class="float-right"><?php echo $keluarga['pekerjaan']; ?></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-pane" id="history">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <?php foreach ($struktural as $s) : ?>
                                            <li class="list-group-item">
                                                <b><?php echo format_indo($s['tgl_input']); ?></b> <a class="float-right">Divisi : <?php echo $s['divisi']; ?> &nbsp<i class="fas fa-grip-lines-vertical"></i>&nbsp Jabatan : <?php echo $s['jabatan']; ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div class="tab-pane" id="gaji">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Gaji Pokok</b> <a class="float-right">Rp. <?php echo rupiah($gaji['nominal']); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b><?php echo $insentif['nama_insentif']; ?></b> <a class="float-right">Rp. <?php echo rupiah($insentif['insentif']); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Total Penerimaan </b> <a class="float-right"><button type="button" class="btn btn-outline-info">Rp. <?php echo rupiah($insentif['insentif'] + $gaji['nominal']); ?></button></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-pane" id="nilai">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Kerapihan</b> <a class="float-right"><?php echo $kinerja['rapi']; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Tanggung Jawab</b> <a class="float-right"><?php echo $kinerja['tanggung']; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Kedisiplinan</b> <a class="float-right"><?php echo $kinerja['disiplin']; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Inisiatif</b> <a class="float-right"><?php echo $kinerja['inisiatif']; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Kesimpulan Penilaian</b> <a class="float-right"><?php echo $kinerja['kesimpulan']; ?></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-pane" id="prestasi">
                                    <ul class="list-group list-group-unbordered mb-3">

                                        <li class="list-group-item">
                                            <b>Prestasi Terbaik <a class="float-right"><?php echo $prestasi['prestasi']; ?></a>
                                        </li>

                                    </ul>
                                </div>

                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
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
                <?php echo form_open_multipart('staf/index'); ?>
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
                <form action="<?php echo base_url('staf/ubah_password'); ?>" method="post">
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
            <div class="modal-footer">

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>