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
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card">
                    <div class="card-header">
                        <!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-cuti2">
                            Tambah Cuti Lain
                        </button>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
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
                                    <th>Jenis Cuti</th>
                                    <th>Keterangan</th>
                                    <th>Tgl. Cuti - Tgl Cuti 2</th>
                                    <th>Tgl Masuk</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($cuti_lain as $cl) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo format_indo($cl['tgl_input']); ?></td>
                                            <td><?php echo $cl['nama_lengkap']; ?></td>
                                            <td><?php echo $cl['jenis_cuti']; ?></td>
                                            <td><?php echo $cl['keterangan']; ?></td>
                                            <td><?php echo format_indo($cl['tgl_cuti']); ?> - <?php echo format_indo($cl['tgl_cuti2']); ?> </td>
                                            <td><?php echo format_indo($cl['tgl_masuk']); ?></td>
                                            <?php if ($cl['is_approve'] == 1) : ?>
                                                <td><button type="button" class="btn btn-info btn-block btn-sm">Tunggu</button></td>
                                            <?php elseif ($cl['is_approve'] == 2) : ?>
                                                <td><button type="button" class="btn btn-dark btn-block btn-sm">Ditolak</button></td>
                                            <?php else : ?>
                                                <td><button type="button" class="btn btn-success btn-block btn-sm">Disetujui</button></td>
                                            <?php endif; ?>
                                            <?php if ($cl['is_approve'] == 1) : ?>
                                                <td> <button type="button" class="tombol-edit btn btn-primary btn-block btn-sm btn-flat" data-id="<?php echo $cl['id_cuti_lain']; ?>" data-toggle="modal" data-target="#edit-cuti">Konfirmasi</b></td>
                                            <?php else : ?>
                                                <td> <button type="button" class="tombol-edit btn btn-warning btn-block btn-sm btn-flat" data-id="<?php echo $cl['id_cuti_lain']; ?>" data-toggle="modal" data-target="#edit-cuti">Cek Ulang</b></td>
                                            <?php endif; ?>
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
                <h4 class="modal-title">Konfirmasi Cuti Lain</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/edit_cuti_lain'); ?>" method="post" id="form_id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="hidden" name="id_cuti_lain" id="idcutilain">
                                    <input type="text" class="form-control form-control-sm" id="nama" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nip">Kode Pegawai</label>
                                    <input type="text" class="form-control form-control-sm" id="kd" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cutiname">Tgl Input</label>
                                    <input type="date" class="form-control form-control-sm" name="tgl_input" id="input" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cutiname">Jenis Cuti</label>
                                    <input type="text" class="form-control form-control-sm" id="jns" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cutiname">Keterangan</label>
                            <input type="text" class="form-control form-control-sm" name="keterangan" id="ket" readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cutiname">Tgl Cuti</label>
                                    <input type="date" class="form-control form-control-sm" name="tgl_cuti" id="cuti" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cutiname">Tgl Cuti 2</label>
                                    <input type="date" class="form-control form-control-sm" name="tgl_cuti2" id="cuti2" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cutiname">Tgl Masuk</label>
                                    <input type="date" class="form-control form-control-sm" name="tgl_masuk" id="masuk" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cutiname">Alasan Penolakan</label>
                                    <input type="text" class="form-control form-control-sm" name="alasan_ditolak" Placeholder="isi jika ditolak">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cutiname">Atasan</label>
                                    <input type="text" class="form-control form-control-sm" name="atasan" required>
                                </div>
                            </div>
                        </div>
                        <div class="form_group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_approve" value="0" required>
                                <label class="form-check-label">
                                    Setujui
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_approve" value="2">
                                <label class="form-check-label">
                                    Tolak
                                </label>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Konfirmasi</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target=".bd-example-modal-lg">
                            <i class="far fa-calendar-alt mr-1"></i> Kalender
                        </button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

<!-- Modal Kalender -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Kalendar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <center>
                <iframe src="https://calendar.google.com/calendar/embed?height=400&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=Asia%2FBangkok&amp;showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;hl=id&amp;src=ZW4uaW5kb25lc2lhbiNob2xpZGF5QGdyb3VwLnYuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;color=%237986CB" style="border-width:0" width="700" height="400" frameborder="0" scrolling="no"></iframe>
            </center>
            <br>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.tombol-edit').on('click', function() {
        const id_cuti_lain = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_cuti_lain'); ?>',
            data: {
                id_cuti_lain: id_cuti_lain
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nama').val(data.nama_lengkap);
                $('#kd').val(data.kd_pegawai);
                $('#input').val(data.tgl_input);
                $('#jns').val(data.jenis_cuti);
                $('#ket').val(data.keterangan);
                $('#cuti').val(data.tgl_cuti);
                $('#cuti2').val(data.tgl_cuti2);
                $('#masuk').val(data.tgl_masuk);

                $('#idcutilain').val(data.id_cuti_lain);
            }
        });
    });
</script>