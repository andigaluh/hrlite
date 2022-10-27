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
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-info">
                            Tambah Info
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-id" class="table table-bordered table-striped" style="font-size:13px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kirim</th>
                                        <th width="10%">Tanggal Info</th>
                                        <th width="70%">Info</th>
                                        <th width="10%">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($info as $in) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <?php if ($in['kirim'] == 1) : ?>
                                                <td><button type="button" class="tombol-kirim btn btn-info btn-block btn-sm" data-id="<?php echo $in['id_info']; ?>" data-toggle="modal" data-target="#kirim-info"><i class="far fa-paper-plane"></i></button></td>
                                            <?php else : ?>
                                                <td>Sukses</td>
                                            <?php endif; ?>
                                            <td><?php echo format_indo($in['tgl_info']); ?></td>
                                            <td><textarea class="form-control" rows="4" readonly><?php echo $in['info']; ?></textarea></td>
                                            <?php if ($in['kirim'] == 1) : ?>
                                                <td><button type="button" class="tombol-edit-insentif btn btn-warning btn-block btn-sm" data-id="<?php echo $in['id_info']; ?>" data-toggle="modal" data-target="#edit-ins-peg">Edit Data</button></td>
                                            <?php else : ?>
                                                <td>-</td>
                                            <?php endif; ?>
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

<div class="modal fade" id="add-info">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Info</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo base_url('admin/info'); ?>" method="post">
                    <div class="form-group">
                        <label for="nama">Tanggal Info</label>
                        <input type="date" class="form-control form-control-sm" name="tgl_info" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Isi Info</label>
                        <textarea class="form-control" rows="4" name="info" required></textarea>
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

<div class="modal fade" id="edit-ins-peg">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form role="form" action="<?php echo base_url('admin/edit_info'); ?>" method="post">
                    <div class="form-group">
                        <label for="nama">Tanggal Info</label>
                        <input type="hidden" name="id_info" id="idinfo">
                        <input type="date" class="form-control form-control-sm" name="tgl_info" id="tgl" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Isi Info</label>
                        <textarea class="form-control" rows="4" name="info" id="info" required></textarea>
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
<div class="modal fade" id="kirim-info">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form role="form" action="<?php echo base_url('admin/kirim_info'); ?>" method="post">
                    <div class="form-group">
                        <label for="nama">Konfirmasi kirim Info Tanggal :</label>
                        <input type="hidden" name="id_info" id="idinfokirim">
                        <input type="date" class="form-control form-control-sm" id="tglinfo" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Data</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    $('.tombol-edit-insentif').on('click', function() {
        const id_info = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_info'); ?>',
            data: {
                id_info: id_info
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#tglinfo').val(data.tgl_info);
                $('#info').val(data.info);
                $('#idinfo').val(data.id_info);
            }
        });
    });
</script>
<script>
    $('.tombol-kirim').on('click', function() {
        const id_info = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_info'); ?>',
            data: {
                id_info: id_info
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#tglinfo').val(data.tgl_info);
                $('#idinfokirim').val(data.id_info);
            }
        });
    });
</script>