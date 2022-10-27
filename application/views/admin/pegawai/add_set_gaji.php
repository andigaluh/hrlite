<style>
    .dataTables_wrapper {
        font-size: 13px
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
                        <a href="<?php echo base_url('admin/list_pegawai'); ?>" class="btn btn-default btn-sm">List Pegawai</a>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><?php echo $kode_pegawai?></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control form-control-sm" id="nama" name="nama" value="<?php echo $employee['nama_lengkap']; ?>" readonly>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control form-control-sm" id="email" name="email" value="<?php echo $employee['email']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="no_telepon">No Telepon</label>
                                        <input type="text" class="form-control form-control-sm" id="no_telepon" name="no_telepon" value="<?php echo $employee['no_telepon']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-header">
                            KOMPONEN GAJI
                        </div>
                        <div class="card-body">
                            <div class="list-group" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action active" id="list-salary-list" data-toggle="list" href="#list-salary" role="tab" aria-controls="salary">Basic Salary</a>
                                <a class="list-group-item list-group-item-action " id="list-allowance-list" data-toggle="list" href="#list-allowance" role="tab" aria-controls="allowance">Allowance</a>
                                <a class="list-group-item list-group-item-action" id="list-benefit-list" data-toggle="list" href="#list-benefit" role="tab" aria-controls="benefit">Benefit</a>
                                <a class="list-group-item list-group-item-action" id="list-deduction-list" data-toggle="list" href="#list-deduction" role="tab" aria-controls="deduction">Deduction</a>
                                <a class="list-group-item list-group-item-action" id="list-reimbursement-list" data-toggle="list" href="#list-reimbursement" role="tab" aria-controls="reimbursement">Reimbursement</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-10">
                    <div class="tab-content" id="nav-tabContent">
                        <!-- start salary -->
                        <div class="tab-pane fade show active" id="list-salary" role="tabpanel" aria-labelledby="list-salary-list">
                            <div class="card">
                                <div class="card-header">
                                    Basic Salary
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="table-id-salary" class="table table-bordered table-striped" style="font-size:13px;">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Bulan - Tahun</th>
                                                            <th>Judul salary</th>
                                                            <th style="text-align: right">Total salary (IDR)</th>
                                                            <th>Edit</th>
                                                            <th>Hapus</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($salary as $a) : ?>
                                                            <tr>
                                                                <td><?php echo $i++; ?></td>
                                                                <td><?php echo $a["bulan_tahun"]; ?></td>
                                                                <td><?php echo $a['title']; ?></td>
                                                                <td style="text-align: right"><?php echo rupiah($a['amount']); ?></td>
                                                                <td><button type="buton" class="tombol-edit-salary btn btn-info btn-block btn-sm" data-id="<?php echo $a['id_salary']; ?>" data-toggle="modal" data-target="#edit-salary"><i class="fas fa-edit"></i> </button></td>
                                                                <td><a href="<?php echo base_url('admin/del_set_gaji_salary/' . $a['id_salary'] . '/' . $kode_pegawai); ?>" class="btn btn-info btn-block btn-xs font-weight-bolder"><i class="fas fa-trash"></i></a></td> 
                                                            </tr>
                                                        <?php endforeach;  ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">Tambah salary</div>
                                            <div class="card-body">
                                                <form role="form" action="<?php echo base_url('admin/add_set_gaji_salary/'.$kode_pegawai); ?>" method="post">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="kd_pegawai">No Induk Pegawai</label>
                                                                <input type="text" class="form-control form-control-sm" id="kd_pegawai" name="kd_pegawai" value="<?php echo $kode_pegawai; ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="bulan_tahun">Bulan Tahun</label>
                                                                <input type="month" class="form-control form-control-sm" id="bulan_tahun" name="bulan_tahun" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="title">Jenis payslip</label>
                                                                <select class="form-control form-control-sm" id="id_jenis_payslip" name="id_jenis_payslip" required>
                                                                    <?php foreach ($mst_jenis_payslip as $msta) : ?>
                                                                        <option value="<?php echo $msta['id_jenis_payslip']; ?>"><?php echo $msta['title']; ?></option>
                                                                    <?php endforeach;  ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="amount">Jumlah</label>
                                                                <input type="number" class="form-control form-control-sm" id="amount" name="amount" required>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- end salary -->


                        <!-- start allowance -->
                        <div class="tab-pane fade show" id="list-allowance" role="tabpanel" aria-labelledby="list-allowance-list">
                            <div class="card">
                                <div class="card-header">
                                    Allowance
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="table-id" class="table table-bordered table-striped" style="font-size:13px;">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Bulan - Tahun</th>
                                                            <th>Judul Allowance</th>
                                                            <th style="text-align: right">Total Allowance (IDR)</th>
                                                            <th>Edit</th>
                                                            <th>Hapus</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($allowance as $a) : ?>
                                                            <tr>
                                                                <td><?php echo $i++; ?></td>
                                                                <td><?php echo $a["bulan_tahun"]; ?></td>
                                                                <td><?php echo $a['title']; ?></td>
                                                                <td style="text-align: right"><?php echo rupiah($a['amount']); ?></td>
                                                                <td><button type="buton" class="tombol-edit btn btn-info btn-block btn-sm" data-id="<?php echo $a['id_allowance']; ?>" data-toggle="modal" data-target="#edit-allowance"><i class="fas fa-edit"></i> </button></td>
                                                                <td><a href="<?php echo base_url('admin/del_set_gaji_allowance/' . $a['id_allowance'] . '/' . $kode_pegawai); ?>" class="btn btn-info btn-block btn-xs font-weight-bolder"><i class="fas fa-trash"></i></a></td> 
                                                            </tr>
                                                        <?php endforeach;  ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">Tambah Allowance</div>
                                            <div class="card-body">
                                                <form role="form" action="<?php echo base_url('admin/add_set_gaji/'.$kode_pegawai); ?>" method="post">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="kd_pegawai">No Induk Pegawai</label>
                                                                <input type="text" class="form-control form-control-sm" id="kd_pegawai" name="kd_pegawai" value="<?php echo $kode_pegawai; ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="bulan_tahun">Bulan Tahun</label>
                                                                <input type="month" class="form-control form-control-sm" id="bulan_tahun" name="bulan_tahun" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="title">Allowance</label>
                                                                <select class="form-control form-control-sm" id="id_mst_allowance" name="id_mst_allowance" required>
                                                                    <?php foreach ($mst_allowance as $msta) : ?>
                                                                        <option value="<?php echo $msta['id_mst_allowance']; ?>"><?php echo $msta['title']; ?></option>
                                                                    <?php endforeach;  ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="amount">Jumlah</label>
                                                                <input type="number" class="form-control form-control-sm" id="amount" name="amount" required>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- end allowance -->


                        <!-- start benefit -->
                        <div class="tab-pane fade" id="list-benefit" role="tabpanel" aria-labelledby="list-benefit-list">
                            <div class="card">
                                <div class="card-header">
                                    Benefit
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="table-id-benefit" class="table table-bordered table-striped" style="font-size:13px;">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Bulan - Tahun</th>
                                                            <th>Judul benefit</th>
                                                            <th style="text-align: right">Total benefit (IDR)</th>
                                                            <th>Edit</th>
                                                            <th>Hapus</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($benefit as $a) : ?>
                                                            <tr>
                                                                <td><?php echo $i++; ?></td>
                                                                <td><?php echo $a["bulan_tahun"]; ?></td>
                                                                <td><?php echo $a['title']; ?></td>
                                                                <td style="text-align: right"><?php echo rupiah($a['amount']); ?></td>
                                                                <td><button type="buton" class="tombol-edit-benefit btn btn-info btn-block btn-sm" data-id="<?php echo $a['id_benefit']; ?>" data-toggle="modal" data-target="#edit-benefit"><i class="fas fa-edit"></i> </button></td>
                                                                <td><a href="<?php echo base_url('admin/del_set_gaji_benefit/' . $a['id_benefit'] . '/' . $kode_pegawai); ?>" class="btn btn-info btn-block btn-xs font-weight-bolder"><i class="fas fa-trash"></i></a></td> 
                                                            </tr>
                                                        <?php endforeach;  ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">Tambah benefit</div>
                                            <div class="card-body">
                                                <form role="form" action="<?php echo base_url('admin/add_set_gaji_benefit/'.$kode_pegawai); ?>" method="post">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="kd_pegawai">No Induk Pegawai</label>
                                                                <input type="text" class="form-control form-control-sm" id="kd_pegawai" name="kd_pegawai" value="<?php echo $kode_pegawai; ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="bulan_tahun">Bulan Tahun</label>
                                                                <input type="month" class="form-control form-control-sm" id="bulan_tahun" name="bulan_tahun" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="title">Nama</label>
                                                                <select class="form-control form-control-sm" id="id_mst_benefit" name="id_mst_benefit" required>
                                                                    <?php foreach ($mst_benefit as $msta) : ?>
                                                                        <option value="<?php echo $msta['id_mst_benefit']; ?>"><?php echo $msta['title']; ?></option>
                                                                    <?php endforeach;  ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="amount">Jumlah</label>
                                                                <input type="number" class="form-control form-control-sm" id="amount" name="amount" required>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- end benefit -->

                        <!-- start deduction -->
                        <div class="tab-pane fade" id="list-deduction" role="tabpanel" aria-labelledby="list-deduction-list">
                            <div class="card">
                                <div class="card-header">
                                    Deduction
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="table-id-deduction" class="table table-bordered table-striped" style="font-size:13px;">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Bulan - Tahun</th>
                                                            <th>Judul deduction</th>
                                                            <th style="text-align: right">Total deduction (IDR)</th>
                                                            <th>Edit</th>
                                                            <th>Hapus</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($deduction as $a) : ?>
                                                            <tr>
                                                                <td><?php echo $i++; ?></td>
                                                                <td><?php echo $a["bulan_tahun"]; ?></td>
                                                                <td><?php echo $a['title']; ?></td>
                                                                <td style="text-align: right"><?php echo rupiah($a['amount']); ?></td>
                                                                <td><button type="buton" class="tombol-edit-deduction btn btn-info btn-block btn-sm" data-id="<?php echo $a['id_deduction']; ?>" data-toggle="modal" data-target="#edit-deduction"><i class="fas fa-edit"></i> </button></td>
                                                                <td><a href="<?php echo base_url('admin/del_set_gaji_deduction/' . $a['id_deduction'] . '/' . $kode_pegawai); ?>" class="btn btn-info btn-block btn-xs font-weight-bolder"><i class="fas fa-trash"></i></a></td> 
                                                            </tr>
                                                        <?php endforeach;  ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">Tambah deduction</div>
                                            <div class="card-body">
                                                <form role="form" action="<?php echo base_url('admin/add_set_gaji_deduction/'.$kode_pegawai); ?>" method="post">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="kd_pegawai">No Induk Pegawai</label>
                                                                <input type="text" class="form-control form-control-sm" id="kd_pegawai" name="kd_pegawai" value="<?php echo $kode_pegawai; ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="bulan_tahun">Bulan Tahun</label>
                                                                <input type="month" class="form-control form-control-sm" id="bulan_tahun" name="bulan_tahun" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="title">Nama</label>
                                                                <select class="form-control form-control-sm" id="id_mst_deduction" name="id_mst_deduction" required>
                                                                    <?php foreach ($mst_deduction as $msta) : ?>
                                                                        <option value="<?php echo $msta['id_mst_deduction']; ?>"><?php echo $msta['title']; ?></option>
                                                                    <?php endforeach;  ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="amount">Jumlah</label>
                                                                <input type="number" class="form-control form-control-sm" id="amount" name="amount" required>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- end deduction -->

                        <!-- start reimbursement -->
                        <div class="tab-pane fade" id="list-reimbursement" role="tabpanel" aria-labelledby="list-reimbursement-list">
                            <div class="card">
                                <div class="card-header">
                                    Reimbursement
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="table-id-reimbursement" class="table table-bordered table-striped" style="font-size:13px;">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Bulan - Tahun</th>
                                                            <th>Judul reimbursement</th>
                                                            <th style="text-align: right">Total reimbursement (IDR)</th>
                                                            <th>Edit</th>
                                                            <th>Hapus</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($reimbursement as $a) : ?>
                                                            <tr>
                                                                <td><?php echo $i++; ?></td>
                                                                <td><?php echo $a["bulan_tahun"]; ?></td>
                                                                <td><?php echo $a['title']; ?></td>
                                                                <td style="text-align: right"><?php echo rupiah($a['amount']); ?></td>
                                                                <td><button type="buton" class="tombol-edit-reimbursement btn btn-info btn-block btn-sm" data-id="<?php echo $a['id_reimbursement']; ?>" data-toggle="modal" data-target="#edit-reimbursement"><i class="fas fa-edit"></i> </button></td>
                                                                <td><a href="<?php echo base_url('admin/del_set_gaji_reimbursement/' . $a['id_reimbursement'] . '/' . $kode_pegawai); ?>" class="btn btn-info btn-block btn-xs font-weight-bolder"><i class="fas fa-trash"></i></a></td> 
                                                            </tr>
                                                        <?php endforeach;  ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">Tambah reimbursement</div>
                                            <div class="card-body">
                                                <form role="form" action="<?php echo base_url('admin/add_set_gaji_reimbursement/'.$kode_pegawai); ?>" method="post">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="kd_pegawai">No Induk Pegawai</label>
                                                                <input type="text" class="form-control form-control-sm" id="kd_pegawai" name="kd_pegawai" value="<?php echo $kode_pegawai; ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="bulan_tahun">Bulan Tahun</label>
                                                                <input type="month" class="form-control form-control-sm" id="bulan_tahun" name="bulan_tahun" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="title">Nama</label>
                                                                <select class="form-control form-control-sm" id="id_mst_reimbursement" name="id_mst_reimbursement" required>
                                                                    <?php foreach ($mst_reimbursement as $msta) : ?>
                                                                        <option value="<?php echo $msta['id_mst_reimbursement']; ?>"><?php echo $msta['title']; ?></option>
                                                                    <?php endforeach;  ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="amount">Jumlah</label>
                                                                <input type="number" class="form-control form-control-sm" id="amount" name="amount" required>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- end reimbursement -->
                    </div>
                </div>

                
            </div>
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="edit-salary">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Salary</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/proses_edit_set_gaji_salary/'.$kode_pegawai); ?>" method="post" id="form_id">
                        <div class="form-group">
                            <label for="bulan_tahun">Bulan Tahun</label>
                            <input type="hidden" name="id_salary" id="idsalaryjson">
                            <input type="month" class="form-control" id="bulantahunjson" name="bulan_tahun">
                        </div>
                        <div class="form-group">
                            <label for="judul">Jenis Payslip</label>
                            <select class="form-control form-control-sm" id="idjenispayslipjson" name="id_jenis_payslip" required>
                                <?php foreach ($mst_jenis_payslip as $msta) : ?>
                                    <option value="<?php echo $msta['id_jenis_payslip']; ?>"><?php echo $msta['title']; ?></option>
                                <?php endforeach;  ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Jumlah</label>
                            <input type="number" class="form-control" id="amountjson" name="amount">
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Simpan Perubahan</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

<div class="modal fade" id="edit-allowance">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Allowance</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/proses_edit_set_gaji_allowance/'.$kode_pegawai); ?>" method="post" id="form_id">
                        <div class="form-group">
                            <label for="bulan_tahun">Bulan Tahun</label>
                            <input type="hidden" name="id_allowance" id="idallowancejson">
                            <input type="month" class="form-control" id="bulantahunjson" name="bulan_tahun">
                        </div>
                        <div class="form-group">
                            <label for="judul">Nama</label>
                            <select class="form-control form-control-sm" id="idmstallowancejson" name="id_mst_allowance" required>
                                <?php foreach ($mst_allowance as $msta) : ?>
                                    <option value="<?php echo $msta['id_mst_allowance']; ?>"><?php echo $msta['title']; ?></option>
                                <?php endforeach;  ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Jumlah</label>
                            <input type="number" class="form-control" id="amountjson" name="amount">
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Simpan Perubahan</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

<div class="modal fade" id="edit-benefit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Benefit</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/proses_edit_set_gaji_benefit/'.$kode_pegawai); ?>" method="post" id="form_id">
                        <div class="form-group">
                            <label for="bulan_tahun">Bulan Tahun</label>
                            <input type="hidden" name="id_benefit" id="idbenefitjson">
                            <input type="month" class="form-control" id="bulantahunbenefitjson" name="bulan_tahun">
                        </div>
                        <div class="form-group">
                            <label for="judul">Nama</label>
                            <select class="form-control form-control-sm" id="idmstbenefitjson" name="id_mst_benefit" required>
                                <?php foreach ($mst_benefit as $msta) : ?>
                                    <option value="<?php echo $msta['id_mst_benefit']; ?>"><?php echo $msta['title']; ?></option>
                                <?php endforeach;  ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Jumlah</label>
                            <input type="number" class="form-control" id="amountbenefitjson" name="amount">
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Simpan Perubahan</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

<div class="modal fade" id="edit-deduction">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Deduction</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/proses_edit_set_gaji_deduction/'.$kode_pegawai); ?>" method="post" id="form_id">
                        <div class="form-group">
                            <label for="bulan_tahun">Bulan Tahun</label>
                            <input type="hidden" name="id_deduction" id="iddeductionjson">
                            <input type="month" class="form-control" id="bulantahundeductionjson" name="bulan_tahun">
                        </div>
                        <div class="form-group">
                            <label for="judul">Nama</label>
                            <select class="form-control form-control-sm" id="idmstdeductionjson" name="id_mst_deduction" required>
                                <?php foreach ($mst_deduction as $msta) : ?>
                                    <option value="<?php echo $msta['id_mst_deduction']; ?>"><?php echo $msta['title']; ?></option>
                                <?php endforeach;  ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Jumlah</label>
                            <input type="number" class="form-control" id="amountdeductionjson" name="amount">
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Simpan Perubahan</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

<div class="modal fade" id="edit-reimbursement">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Reimbursement</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/proses_edit_set_gaji_reimbursement/'.$kode_pegawai); ?>" method="post" id="form_id">
                        <div class="form-group">
                            <label for="bulan_tahun">Bulan Tahun</label>
                            <input type="hidden" name="id_reimbursement" id="idreimbursementjson">
                            <input type="month" class="form-control" id="bulantahunreimbursementjson" name="bulan_tahun">
                        </div>
                        <div class="form-group">
                            <label for="judul">Nama</label>
                            <select class="form-control form-control-sm" id="idmstreimbursementjson" name="id_mst_reimbursement" required>
                                <?php foreach ($mst_reimbursement as $msta) : ?>
                                    <option value="<?php echo $msta['id_mst_reimbursement']; ?>"><?php echo $msta['title']; ?></option>
                                <?php endforeach;  ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Jumlah</label>
                            <input type="number" class="form-control" id="amountreimbursementjson" name="amount">
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Simpan Perubahan</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

<script>
    $('.tombol-edit-salary').on('click', function() {
        const id_salary = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/edit_set_gaji_salary'); ?>',
            // id kiri data yg dikirimkan, yang kanan isi datanya
            data: {
                id_salary: id_salary
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#bulantahunjson').val(data.bulan_tahun);
                $('#idjenispayslipjson').val(data.id_jenis_payslip);
                $('#idsalaryjson').val(data.id_salary);
                $('#amountjson').val(data.amount);
            }
        });
    });

    $('.tombol-edit').on('click', function() {
        const id_allowance = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/edit_set_gaji_allowance'); ?>',
            // id kiri data yg dikirimkan, yang kanan isi datanya
            data: {
                id_allowance: id_allowance
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#bulantahunjson').val(data.bulan_tahun);
                $('#idmstallowancejson').val(data.id_mst_allowance);
                $('#idallowancejson').val(data.id_allowance);
                $('#amountjson').val(data.amount);
            }
        });
    });

    $('.tombol-edit-benefit').on('click', function() {
        const id_benefit = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/edit_set_gaji_benefit'); ?>',
            data: {
                id_benefit: id_benefit
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#bulantahunbenefitjson').val(data.bulan_tahun);
                $('#idmstbenefitjson').val(data.id_mst_benefit);
                $('#idbenefitjson').val(data.id_benefit);
                $('#amountbenefitjson').val(data.amount);
            }
        });
    });

    $('.tombol-edit-deduction').on('click', function() {
        const id_deduction = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/edit_set_gaji_deduction'); ?>',
            data: {
                id_deduction: id_deduction
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#bulantahundeductionjson').val(data.bulan_tahun);
                $('#idmstdeductionjson').val(data.id_mst_deduction);
                $('#iddeductionjson').val(data.id_deduction);
                $('#amountdeductionjson').val(data.amount);
            }
        });
    });

    $('.tombol-edit-reimbursement').on('click', function() {
        const id_reimbursement = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/edit_set_gaji_reimbursement'); ?>',
            data: {
                id_reimbursement: id_reimbursement
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#bulantahunreimbursementjson').val(data.bulan_tahun);
                $('#idmstreimbursementjson').val(data.id_mst_reimbursement);
                $('#idreimbursementjson').val(data.id_reimbursement);
                $('#amountreimbursementjson').val(data.amount);
            }
        });
    });
</script>
