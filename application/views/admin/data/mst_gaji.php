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
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-gaji">
                            Tambah Master Gaji
                        </button>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#view-gaji">
                            Lihat Master Gaji
                        </button>
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
                                        <th>Pend. Terakhir</th>
                                        <th>Jabatan</th>
                                        <th>Divisi</th>
                                        <th>Email</th>
                                        <th>Gaji</th>
                                        <th>Penggajian</th>
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
                                            <td><?php echo $p['pend_akhir']; ?></td>
                                            <td><?php echo $p['jabatan']; ?></td>
                                            <td><?php echo $p['divisi']; ?></td>
                                            <td><?php echo $p['email']; ?></td>
                                            <td>Rp. <?php echo rupiah($p['nominal']); ?></td>
                                            <td><button type="button" class="tombol-edit-peg btn btn-info btn-block btn-sm" data-id="<?php echo $p['id_pegawai']; ?>" data-toggle="modal" data-target="#gaji-peg">Input Gaji</button></td>
                                            <td><button type="button" class="tombol-edit-gaji btn btn-warning btn-block btn-sm" data-id="<?php echo $p['id_tb_gaji']; ?>" data-toggle="modal" data-target="#edit-gaji-peg">Edit Data</button></td>
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

<div class="modal fade" id="add-gaji">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Master Gaji</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo base_url('admin/mst_gaji'); ?>" method="post">
                    <div class="form-group">
                        <label for="nama">Golongan Gaji</label>
                        <input type="text" class="form-control form-control-sm" name="gol_gaji" required>
                    </div>
                    <div class="form-group">
                        <label for="tglLahir">Nominal Gaji</label>
                        <input type="number" class="form-control form-control-sm" name="nom_gaji" required>
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

<div class="modal fade" id="view-gaji">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Daftar Master Gaji</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class=" table table-bordered table-hover" id="id-table" style="font-size:13px;">
                        <thead>
                            <th>#</th>
                            <th>Golongan Gaji</th>
                            <th>Nominal Gaji</th>
                            <th>Edit</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($mst_gaji as $md) : ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $md['gol_gaji']; ?></td>
                                    <td><?php echo $md['nom_gaji']; ?></td>
                                    <td><button type="buton" class="tombol-edit btn btn-info btn-block btn-sm" data-id="<?php echo $md['id_gaji']; ?>" data-toggle="modal" data-target="#edit-gaji">Edit</button></td>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-default mt-2" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="edit-gaji">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Master Gaji</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo base_url('admin/edit_gaji'); ?>" method="post">
                    <div class="form-group">
                        <label for="nama">Golongan Gaji</label>
                        <input type="hidden" name="id_gaji" id="idgaji">
                        <input type="text" class="form-control form-control-sm" name="gol_gaji" id="gol" required>
                    </div>
                    <div class="form-group">
                        <label for="tglLahir">Nominal Gaji</label>
                        <input type="number" class="form-control form-control-sm" name="nom_gaji" id="nom" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="gaji-peg">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Penggajian Pegawai</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo base_url('admin/gaji_pegawai'); ?>" method="post">
                    <div class="form-group">
                        <label for="nama">Nama Pegawai</label>
                        <input type="hidden" name="id_pegawai" id="idgaji">
                        <input type="text" class="form-control form-control-sm" id="nama" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Kode Pegawai</label>
                        <input type="text" class="form-control form-control-sm" name="pegawai_kd" id="kdpeg" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tglLahir">Nominal Gaji</label>
                        <select class="form-control form-control-sm" name="nominal" required>
                            <option value="">- Pilih Gaji -</option>
                            <?php foreach ($mst_gaji as $mg) : ?>
                                <option value="<?php echo $mg['nom_gaji']; ?>"><?php echo $mg['gol_gaji']; ?> / Rp. <?php echo rupiah($mg['nom_gaji']); ?></option>
                            <?php endforeach; ?>
                        </select>
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
                <form role="form" action="<?php echo base_url('admin/edit_gaji_pegawai'); ?>" method="post">
                    <div class="form-group">
                        <label for="tglLahir">Nominal Gaji</label>
                        <input type="hidden" name="id_tb_gaji" id="idtbgaji">
                        <select class="form-control form-control-sm" name="nominal" id="nomgaji" required>
                            <option value="">- Pilih Gaji -</option>
                            <?php foreach ($mst_gaji as $mg) : ?>
                                <option value="<?php echo $mg['nom_gaji']; ?>"><?php echo $mg['gol_gaji']; ?> / Rp. <?php echo rupiah($mg['nom_gaji']); ?></option>
                            <?php endforeach; ?>
                        </select>
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
    $('.tombol-edit').on('click', function() {
        const id_gaji = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_gaji'); ?>',
            data: {
                id_gaji: id_gaji
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#gol').val(data.gol_gaji);
                $('#nom').val(data.nom_gaji);
                $('#idgaji').val(data.id_gaji);
            }
        });
    });
</script>
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
    $('.tombol-edit-gaji').on('click', function() {
        const id_tb_gaji = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_tb_gaji'); ?>',
            data: {
                id_tb_gaji: id_tb_gaji
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nomgaji').val(data.nominal);
                $('#idtbgaji').val(data.id_tb_gaji);
            }
        });
    });
</script>