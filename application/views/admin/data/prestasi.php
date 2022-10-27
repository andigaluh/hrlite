<style>
    .dataTables_wrapper {
        font-size: 16px
    }
</style>

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
            <div class="card card-primary card-outline">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-id" class="table table-bordered table-striped" style="font-size:13px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Pegawai</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jabatan</th>
                                        <th>Divisi</th>
                                        <th>Email</th>
                                        <th>Prestasi</th>
                                        <th>Aksi</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($pegawai as $p) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $p['kode_pegawai']; ?></td>
                                            <td><?php echo $p['nama_lengkap']; ?></td>
                                            <td><?php echo $p['jabatan']; ?></td>
                                            <td><?php echo $p['divisi']; ?></td>
                                            <td><?php echo $p['email']; ?></td>
                                            <td><?php echo $p['prestasi']; ?></td>
                                            <td><button type="button" class="tombol-edit-peg btn btn-info btn-block btn-sm" data-id="<?php echo $p['id_pegawai']; ?>" data-toggle="modal" data-target="#gaji-peg"><i class="fas fa-plus"></i>&nbsp Prestasi</button></td>
                                            <td><button type="button" class="tombol-edit-nilai btn btn-warning btn-block btn-sm" data-id="<?php echo $p['id_prestasi']; ?>" data-toggle="modal" data-target="#edit-gaji-peg">Edit Data</button></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="gaji-peg">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Prestasi Pegawai</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo base_url('admin/prestasi'); ?>" method="post">
                    <div class="form-group">
                        <label for="nama">Nama Pegawai</label>
                        <input type="hidden" name="id_pegawai" id="idgaji">
                        <input type="text" class="form-control form-control-sm" id="nama" readonly>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Kode Pegawai</label>
                                <input type="text" class="form-control form-control-sm" name="pegawai_kd" id="kdpeg" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Tanggal Prestasi</label>
                                <input type="date" class="form-control form-control-sm" name="tgl_prestasi" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Prestasi Pegawai</label>
                        <textarea class="form-control" rows="4" name="prestasi" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="edit-gaji-peg">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Prestasi Pegawai</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo base_url('admin/edit_prestasi'); ?>" method="post">
                    <div class="form-group">
                        <label for="nama">Tanggal Prestasi</label>
                        <input type="hidden" name="id_prestasi" id="idprestasi">
                        <input type="date" class="form-control form-control-sm" name="tgl_prestasi" id="tgl" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Prestasi Pegawai</label>
                        <textarea class="form-control" rows="4" name="prestasi" id="prestasi" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    $('.tombol-edit-peg').on('click', function() {
        const id_pegawai = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_pegawai'); ?>',
            data: {
                id_pegawai: id_pegawai
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nama').val(data.nama_lengkap);
                $('#kdpeg').val(data.kode_pegawai);
                $('#idpegawai').val(data.id_pegawai);
            }
        });
    });
</script>

<script>
    $('.tombol-edit-nilai').on('click', function() {
        const id_prestasi = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_prestasi'); ?>',
            data: {
                id_prestasi: id_prestasi
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#tgl').val(data.tgl_prestasi);
                $('#prestasi').val(data.prestasi);
                $('#idprestasi').val(data.id_prestasi);
            }
        });
    });
</script>