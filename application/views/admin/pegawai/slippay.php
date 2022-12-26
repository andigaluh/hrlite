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
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo base_url('admin/export_payslip/').$pegawai.'/'.$periode?>" class="btn btn-primary" style="float:right">EXPORT</a>
            </div>
        </div>
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
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><?php echo getcompanyname()?></h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class=" table table-bordered table-hover" id="" style="font-size:13px;">
                                        <thead>
                                            <th colspan="2">SLIP GAJI</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="10%">
                                                Bulan
                                                </td>
                                                <td>
                                                <?php echo $payroll_employee['bulan_tahun']?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                
                                                </td>
                                            </tr>

                                            <tr>
                                                <td width="10%">
                                                Nama
                                                </td>
                                                <td>
                                                    <?php echo $payroll_employee['nama_lengkap']?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="10%">
                                                Kode Pegawai
                                                </td>
                                                <td>
                                                    <?php echo $payroll_employee['kode_pegawai']?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                Pendapatan
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="10%">
                                                1. Upah Pokok
                                                </td>
                                                <td>
                                                    <?php echo rupiah($payroll_employee['amount_salary'])?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="10%">
                                                2. Allowance
                                                </td>
                                                <td>
                                                    <?php echo rupiah($payroll_employee['amount_total_allowance'])?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="10%">
                                                3. Pengurangan
                                                </td>
                                                <td>
                                                    <?php echo rupiah($payroll_employee['amount_total_deduction'])?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th width="10%">
                                                Total
                                                </th>
                                                <td>
                                                    <?php echo rupiah($payroll_employee['net_salary'])?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>