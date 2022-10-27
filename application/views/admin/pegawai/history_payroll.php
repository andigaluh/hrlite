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
                <!-- <div class="card-header">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-lg">
                        Tambah Pegawai
                    </button> 
                </div>-->
                <!-- /.card-header -->
                <div class="card-body">
                    <form role="form" action="<?php echo base_url('admin/history_payroll'); ?>" method="post">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nip">Bulan Tahun</label>
                                    <input type="month" class="form-control form-control-sm" id="bulan_tahun" name="bulan_tahun">
                                </div>
                                
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit_btn" value="1">Search</button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="table-responsive">
                            <table id="table-id-payroll" class="table table-bordered table-striped" style="font-size:13px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Bulan Tahun</th>
                                        <th>Kode Pegawai</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jenis Payslip</th>
                                        <th>Jumlah Gaji</th>
                                        <th>Jumlah Allowance</th>
                                        <th>Jumlah Deduction</th>
                                        <th>Jumlah Gaji Bersih</th>
                                        <th>Payslip</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($payroll_employee as $p) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $p['bulan_tahun']; ?></td>
                                            <td><?php echo $p['kode_pegawai']; ?></td>
                                            <td><?php echo $p['nama_lengkap']; ?></td>
                                            <td><?php echo $p['jenis_payslip']; ?></td>
                                            <td><?php echo $p['amount_salary']; ?></td>
                                            <td><?php echo $p['amount_total_allowance']; ?></td>
                                            <td><?php echo $p['amount_total_deduction']; ?></td>
                                            <td><?php echo $p['net_salary']; ?></td>
                                            <td><a href="<?php echo base_url('admin/payslip/' . $p['kode_pegawai'] . '/' . $p['bulan_tahun']); ?>" class="btn btn-info btn-block btn-xs font-weight-bolder"><i class="fas fa-money-bill"></i></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


