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
                                        <th>Kesimpulan</th>
                                        <th>Penilaian</th>
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
                                            <td><?php echo $p['kesimpulan']; ?></td>
                                            <td><button type="button" class="tombol-edit-peg btn btn-info btn-block btn-sm" data-id="<?php echo $p['id_pegawai']; ?>" data-toggle="modal" data-target="#gaji-peg"><i class="fas fa-plus"></i>&nbsp Penilaian</button></td>
                                            <td><button type="button" class="tombol-edit-nilai btn btn-warning btn-block btn-sm" data-id="<?php echo $p['id_nilai']; ?>" data-toggle="modal" data-target="#edit-gaji-peg">Edit Data</button></td>
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
                <h4 class="modal-title">Penilaian Pegawai</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo base_url('admin/penilaian'); ?>" method="post">
                    <div class="form-group">
                        <label for="nama">Nama Pegawai</label>
                        <input type="hidden" name="id_pegawai" id="idgaji">
                        <input type="text" class="form-control form-control-sm" id="nama" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Kode Pegawai</label>
                        <input type="text" class="form-control form-control-sm" name="peg_kd" id="kdpeg" readonly>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Kerapian</label>
                                <input type="text" class="form-control form-control-sm" name="rapi" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Tanggung Jawab</label>
                                <input type="text" class="form-control form-control-sm" name="tanggung" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Disiplin</label>
                                <input type="text" class="form-control form-control-sm" name="disiplin" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Inisiatif</label>
                                <input type="text" class="form-control form-control-sm" name="inisiatif" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama">Kesimpulan Penilaian</label>
                        <input type="text" class="form-control form-control-sm" name="kesimpulan" required>
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
                <h4 class="modal-title">Edit Gaji Pegawai</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo base_url('admin/edit_penilaian'); ?>" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Kerapian</label>
                                <input type="hidden" name="id_nilai" id="idnilai">
                                <input type="text" class="form-control form-control-sm" name="rapi" id="rapi" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Tanggung Jawab</label>
                                <input type="text" class="form-control form-control-sm" name="tanggung" id="tanggung" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Disiplin</label>
                                <input type="text" class="form-control form-control-sm" name="disiplin" id="disiplin" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Inisiatif</label>
                                <input type="text" class="form-control form-control-sm" name="inisiatif" id="inisiatif" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama">Kesimpulan Penilaian</label>
                        <input type="text" class="form-control form-control-sm" name="kesimpulan" id="kesimpulan" required>
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
        const id_nilai = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_nilai'); ?>',
            data: {
                id_nilai: id_nilai
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#rapi').val(data.rapi);
                $('#tanggung').val(data.tanggung);
                $('#disiplin').val(data.disiplin);
                $('#inisiatif').val(data.inisiatif);
                $('#kesimpulan').val(data.kesimpulan);
                $('#idnilai').val(data.id_nilai);
            }
        });
    });
</script>