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
                            <a class="close" data-dismiss="alert">x</a>
                            <strong><?php echo strip_tags(validation_errors()); ?></strong>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <div class="card">
                    <div class="card-header">
                        <!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
                            <i class="far fa-calendar-alt mr-1"></i> Kalender
                        </button> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-hover" id="table-id" style="font-size:14px;">
                                <thead>
                                    <th>#</th>
                                    <th>Tgl. Input</th>
                                    <th>Nama Pegawai</th>
                                    <th>Sisa Cuti</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($list_cuti as $lc) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo format_indo($lc['tgl_input']); ?></td>
                                            <td><?php echo $lc['nama_lengkap']; ?></td>
                                            <td><?php echo $lc['sisa_cuti']; ?></td>
                                            <td style="font-weight:800;color:red;">Cuti Habis</td>
                                            <td> <button type="button" class="tombol-edit btn btn-danger btn-block btn-sm btn-flat" data-id="<?php echo $lc['id_cuti']; ?>" data-toggle="modal" data-target="#edit-cuti">Reset Cuti</b></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Modal edit cuti -->
<div class="modal fade" id="edit-cuti">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Reset Cuti</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/reset'); ?>" method="post" id="form_id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="hidden" name="id_cuti" id="idjson">
                                    <input type="text" class="form-control form-control-sm" id="nama" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nip">Kode Pegawai</label>
                                    <input type="text" class="form-control form-control-sm" name="kd_pegawai" id="kd_pegawai" readonly>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger">Reset Cuti</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<script>
    $('.tombol-edit').on('click', function() {
        const id_cuti = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_cuti'); ?>',
            data: {
                id_cuti: id_cuti
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nama').val(data.nama_lengkap);
                $('#kd_pegawai').val(data.kd_pegawai);
                $('#idjson').val(data.id_cuti);
            }
        });
    });
</script>