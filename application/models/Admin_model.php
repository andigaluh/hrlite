<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_model
{
    public function countJmlUser()
    {

        $query = $this->db->query(
            "SELECT COUNT(id_pegawai) as jml_pegawai
                               FROM mst_pegawai"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->jml_pegawai;
        } else {
            return 0;
        }
    }

    public function countUserAktif()
    {

        $query = $this->db->query(
            "SELECT COUNT(id_user) as user_aktif
                               FROM mst_user
                               WHERE is_active = 1"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->user_aktif;
        } else {
            return 0;
        }
    }

    public function countUserTakAktif()
    {

        $query = $this->db->query(
            "SELECT COUNT(id_user) as user_tak_aktif
                               FROM mst_user
                               WHERE is_active = 0"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->user_tak_aktif;
        } else {
            return 0;
        }
    }

    public function countUserPerbulan()
    {
        $query = $this->db->query(
            "SELECT CONCAT(YEAR(date_created),'/',MONTH(date_created)) AS tahun_bulan, COUNT(*) AS jumlah_bulanan
                FROM mst_user
                WHERE CONCAT(YEAR(date_created),'/',MONTH(date_created))=CONCAT(YEAR(NOW()),'/',MONTH(NOW()))
                GROUP BY YEAR(date_created),MONTH(date_created);"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->jumlah_bulanan;
        } else {
            return 0;
        }
    }

    function getKodePegawai()
    {
        $this->db->select('RIGHT(kode_pegawai,4) as kode', FALSE);
        $this->db->order_by('id_pegawai', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('mst_pegawai');
        if ($query->num_rows() <> 0) {

            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = "PEG-" . date('ym') . "-" . $kodemax;
        return $kodejadi;
    }

    public function getUserEdit($id_user)
    {
        $query = $this->db->get_where('mst_user', ['id_user' => $id_user])->row_array();
        return $query;
    }

    function getKodeJabatan()
    {
        $this->db->select('RIGHT(kode_jabatan,4) as kode', FALSE);
        $this->db->order_by('id_jabatan', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('mst_jabatan');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = "JAB-" . date('ym') . "-" . $kodemax;
        return $kodejadi;
    }

    public function getEditJabatan($id_jabatan)
    {
        $query = $this->db->get_where('mst_jabatan', ['id_jabatan' => $id_jabatan])->row_array();
        return $query;
    }

    function getKodeDivisi()
    {
        $this->db->select('RIGHT(kode_divisi,4) as kode', FALSE);
        $this->db->order_by('id_divisi', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('mst_divisi');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = "DEP-" . date('ym') . "-" . $kodemax;
        return $kodejadi;
    }

    public function getEditDivisi($id_divisi)
    {
        $query = $this->db->get_where('mst_divisi', ['id_divisi' => $id_divisi])->row_array();
        return $query;
    }

    function getKodeStruktural()
    {
        $this->db->select('RIGHT(kode_struktural,4) as kode', FALSE);
        $this->db->order_by('id_struktural', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_struktural');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = date('YmdHis') . $kodemax;
        return $kodejadi;
    }

    public function getHistoryStruktural($kode_pegawai)
    {
        $query = "SELECT id_struktural,divisi,jabatan,tgl_input
                  FROM tb_struktural 
                  LEFT JOIN mst_divisi
                  ON tb_struktural.divisi_kode = mst_divisi.kode_divisi
                  LEFT JOIN mst_jabatan
                  ON mst_jabatan.kode_jabatan = tb_struktural.jabatan_kode
                  WHERE tb_struktural.pegawai_kode = '$kode_pegawai'";
        return $this->db->query($query)->result_array();
    }

    public function getEditGaji($id_gaji)
    {
        $query = $this->db->get_where('mst_gaji', ['id_gaji' => $id_gaji])->row_array();
        return $query;
    }

    public function getGajiPegawai($id_pegawai)
    {
        $query = $this->db->get_where('mst_pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        return $query;
    }

    public function getPegawai()
    {
        $query = "SELECT id_pegawai,email,kode_pegawai,nama_lengkap,pend_akhir,jabatan,divisi,nominal,id_tb_gaji
                  FROM mst_pegawai
                  JOIN tb_struktural
                  ON tb_struktural.pegawai_kode = mst_pegawai.kode_pegawai
                  JOIN mst_jabatan
                  ON mst_jabatan.kode_jabatan = tb_struktural.jabatan_kode
                  JOIN mst_divisi
                  ON mst_divisi.kode_divisi = tb_struktural.divisi_kode
                  LEFT JOIN tb_gaji
                  ON tb_gaji.pegawai_kd = mst_pegawai.kode_pegawai
                  ";
        return $this->db->query($query)->result_array();
    }

    public function getTbGajiPegawai($id_tb_gaji)
    {
        $query = $this->db->get_where('tb_gaji', ['id_tb_gaji' => $id_tb_gaji])->row_array();
        return $query;
    }

    public function getPegawaiNilai()
    {
        $query = "SELECT id_pegawai,email,kode_pegawai,nama_lengkap,jabatan,divisi,kesimpulan,id_nilai
                  FROM mst_pegawai
                  JOIN tb_struktural
                  ON tb_struktural.pegawai_kode = mst_pegawai.kode_pegawai
                  JOIN mst_jabatan
                  ON mst_jabatan.kode_jabatan = tb_struktural.jabatan_kode
                  JOIN mst_divisi
                  ON mst_divisi.kode_divisi = tb_struktural.divisi_kode
                  LEFT JOIN tb_nilai
                  ON tb_nilai.peg_kd = mst_pegawai.kode_pegawai
                  ";
        return $this->db->query($query)->result_array();
    }

    public function getNilaiPegawai($id_nilai)
    {
        $query = $this->db->get_where('tb_nilai', ['id_nilai' => $id_nilai])->row_array();
        return $query;
    }

    public function getPrestasiPegawai()
    {
        $query = "SELECT id_pegawai,email,kode_pegawai,nama_lengkap,jabatan,divisi,prestasi,id_prestasi
                  FROM mst_pegawai
                  JOIN tb_struktural
                  ON tb_struktural.pegawai_kode = mst_pegawai.kode_pegawai
                  JOIN mst_jabatan
                  ON mst_jabatan.kode_jabatan = tb_struktural.jabatan_kode
                  JOIN mst_divisi
                  ON mst_divisi.kode_divisi = tb_struktural.divisi_kode
                  LEFT JOIN tb_prestasi
                  ON tb_prestasi.pegawai_kd = mst_pegawai.kode_pegawai
                  ";
        return $this->db->query($query)->result_array();
    }

    public function getEditPrestasi($id_prestasi)
    {
        $query = $this->db->get_where('tb_prestasi', ['id_prestasi' => $id_prestasi])->row_array();
        return $query;
    }

    public function getInsentifPegawai()
    {
        $query = "SELECT id_pegawai,email,kode_pegawai,nama_lengkap,jabatan,divisi,tgl_insentif,nama_insentif,insentif,id_insentif
                  FROM mst_pegawai
                  JOIN tb_struktural
                  ON tb_struktural.pegawai_kode = mst_pegawai.kode_pegawai
                  JOIN mst_jabatan
                  ON mst_jabatan.kode_jabatan = tb_struktural.jabatan_kode
                  JOIN mst_divisi
                  ON mst_divisi.kode_divisi = tb_struktural.divisi_kode
                  LEFT JOIN tb_insentif
                  ON tb_insentif.pegawai_kd = mst_pegawai.kode_pegawai
                  ";
        return $this->db->query($query)->result_array();
    }

    public function getEditInsentif($id_insentif)
    {
        $query = $this->db->get_where('tb_insentif', ['id_insentif' => $id_insentif])->row_array();
        return $query;
    }

    public function getEditInfo($id_info)
    {
        $query = $this->db->get_where('tb_info', ['id_info' => $id_info])->row_array();
        return $query;
    }

    public function getBerita()
    {
        $query = "SELECT nama_lengkap,jabatan,divisi,tgl_berita,isi_berita
                  FROM mst_pegawai
                  JOIN tb_struktural
                  ON tb_struktural.pegawai_kode = mst_pegawai.kode_pegawai
                  JOIN mst_jabatan
                  ON mst_jabatan.kode_jabatan = tb_struktural.jabatan_kode
                  JOIN mst_divisi
                  ON mst_divisi.kode_divisi = tb_struktural.divisi_kode
                  JOIN tb_informasi
                  ON tb_informasi.pegawai_kd = mst_pegawai.kode_pegawai
                  WHERE tb_informasi.kirim = 0
                  ";
        return $this->db->query($query)->result_array();
    }

    public function getCutiStaf()
    {

        $query = "SELECT *
                  FROM tb_cuti
                  JOIN mst_pegawai
                  ON mst_pegawai.kode_pegawai = tb_cuti.kd_pegawai";
        return $this->db->query($query)->result_array();
    }

    public function getCutiStafNol()
    {

        $query = "SELECT *
                  FROM tb_cuti
                  JOIN mst_pegawai
                  ON mst_pegawai.kode_pegawai = tb_cuti.kd_pegawai
                  WHERE tb_cuti.sisa_cuti = 0";
        return $this->db->query($query)->result_array();
    }


    public function getEditCuti($id_cuti)
    {

        $query = "SELECT *
                  FROM tb_cuti
                  JOIN mst_pegawai
                  ON mst_pegawai.kode_pegawai = tb_cuti.kd_pegawai
                                 WHERE tb_cuti.id_cuti= $id_cuti
                  ";
        return $this->db->query($query)->row_array();
    }

    public function getCutiLain()
    {

        $query = "SELECT *
                  FROM tb_cuti_lain
                  JOIN mst_pegawai
                  ON mst_pegawai.kode_pegawai = tb_cuti_lain.kd_pegawai";
        return $this->db->query($query)->result_array();
    }

    public function getEditCutiLain($id_cuti_lain)
    {

        $query = "SELECT *
                  FROM tb_cuti_lain
                  JOIN mst_pegawai
                  ON mst_pegawai.kode_pegawai = tb_cuti_lain.kd_pegawai
                                 WHERE tb_cuti_lain.id_cuti_lain= $id_cuti_lain
                  ";
        return $this->db->query($query)->row_array();
    }

    function getKodeKontrak()
    {
        $this->db->select('RIGHT(kode_kontrak,4) as kode', FALSE);
        $this->db->order_by('id_kontrak', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('mst_kontrak');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = "CTR-" . date('ym') . "-" . $kodemax;
        return $kodejadi;
    }

    public function getEditKontrak($id_kontrak)
    {
        $query = $this->db->get_where('mst_kontrak', ['id_kontrak' => $id_kontrak])->row_array();
        return $query;
    }

    function getKodeJenisPayslip()
    {
        $this->db->select('RIGHT(kode_jenis_payslip,4) as kode', FALSE);
        $this->db->order_by('id_jenis_payslip', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('mst_jenis_payslip');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = "JPS-" . date('ym') . "-" . $kodemax;
        return $kodejadi;
    }

    public function getEditjenisPayslip($id_jenis_payslip)
    {
        $query = $this->db->get_where('mst_jenis_payslip', ['id_jenis_payslip' => $id_jenis_payslip])->row_array();
        return $query;
    }

    public function getEditAllowance($id_allowance)
    {
        $query = $this->db->get_where('tb_allowance', ['id_allowance' => $id_allowance])->row_array();
        return $query;
    }

    public function getEditBenefit($id_benefit)
    {
        $query = $this->db->get_where('tb_benefit', ['id_benefit' => $id_benefit])->row_array();
        return $query;
    }

    public function getEditDeduction($id_deduction)
    {
        $query = $this->db->get_where('tb_deduction', ['id_deduction' => $id_deduction])->row_array();
        return $query;
    }

    public function getEditReimbursement($id_reimbursement)
    {
        $query = $this->db->get_where('tb_reimbursement', ['id_reimbursement' => $id_reimbursement])->row_array();
        return $query;
    }

    function getKodeMstAllowance()
    {
        $this->db->select('RIGHT(kode_mst_allowance,4) as kode', FALSE);
        $this->db->order_by('id_mst_allowance', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('mst_allowance');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = "MAL-" . date('ym') . "-" . $kodemax;
        return $kodejadi;
    }

    public function getEditMstAllowance($id_mst_allowance)
    {
        $query = $this->db->get_where('mst_allowance', ['id_mst_allowance' => $id_mst_allowance])->row_array();
        return $query;
    }

    function getKodeMstBenefit()
    {
        $this->db->select('RIGHT(kode_mst_benefit,4) as kode', FALSE);
        $this->db->order_by('id_mst_benefit', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('mst_benefit');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = "MBE-" . date('ym') . "-" . $kodemax;
        return $kodejadi;
    }

    public function getEditMstBenefit($id_mst_benefit)
    {
        $query = $this->db->get_where('mst_benefit', ['id_mst_benefit' => $id_mst_benefit])->row_array();
        return $query;
    }

    function getKodeMstDeduction()
    {
        $this->db->select('RIGHT(kode_mst_deduction,4) as kode', FALSE);
        $this->db->order_by('id_mst_deduction', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('mst_deduction');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = "MDE-" . date('ym') . "-" . $kodemax;
        return $kodejadi;
    }

    public function getEditMstDeduction($id_mst_deduction)
    {
        $query = $this->db->get_where('mst_deduction', ['id_mst_deduction' => $id_mst_deduction])->row_array();
        return $query;
    }

    function getKodeMstReimbursement()
    {
        $this->db->select('RIGHT(kode_mst_reimbursement,4) as kode', FALSE);
        $this->db->order_by('id_mst_reimbursement', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('mst_reimbursement');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = "MDE-" . date('ym') . "-" . $kodemax;
        return $kodejadi;
    }

    public function getEditMstReimbursement($id_mst_reimbursement)
    {
        $query = $this->db->get_where('mst_reimbursement', ['id_mst_reimbursement' => $id_mst_reimbursement])->row_array();
        return $query;
    }

    function getAllowanceByKodePegawai($kode_pegawai)
    {
        $this->db->select('tb_allowance.id_allowance as id_allowance, tb_allowance.bulan_tahun as bulan_tahun, tb_allowance.amount as amount, mst_allowance.title as title');
        $this->db->from('tb_allowance');
        $this->db->where('kd_pegawai', $kode_pegawai);
        $this->db->join('mst_allowance', 'mst_allowance.id_mst_allowance = tb_allowance.id_mst_allowance');
        $query = $this->db->get();
        return $query;
    }

    function getBenefitByKodePegawai($kode_pegawai)
    {
        $this->db->select('tb_benefit.id_benefit as id_benefit, tb_benefit.bulan_tahun as bulan_tahun, tb_benefit.amount as amount, mst_benefit.title as title');
        $this->db->from('tb_benefit');
        $this->db->where('kd_pegawai', $kode_pegawai);
        $this->db->join('mst_benefit', 'mst_benefit.id_mst_benefit = tb_benefit.id_mst_benefit');
        $query = $this->db->get();
        return $query;
    }

    function getDeductionByKodePegawai($kode_pegawai)
    {
        $this->db->select('tb_deduction.id_deduction as id_deduction, tb_deduction.bulan_tahun as bulan_tahun, tb_deduction.amount as amount, mst_deduction.title as title');
        $this->db->from('tb_deduction');
        $this->db->where('kd_pegawai', $kode_pegawai);
        $this->db->join('mst_deduction', 'mst_deduction.id_mst_deduction = tb_deduction.id_mst_deduction');
        $query = $this->db->get();
        return $query;
    }

    function getReimbursementByKodePegawai($kode_pegawai)
    {
        $this->db->select('tb_reimbursement.id_reimbursement as id_reimbursement, tb_reimbursement.bulan_tahun as bulan_tahun, tb_reimbursement.amount as amount, mst_reimbursement.title as title');
        $this->db->from('tb_reimbursement');
        $this->db->where('kd_pegawai', $kode_pegawai);
        $this->db->join('mst_reimbursement', 'mst_reimbursement.id_mst_reimbursement = tb_reimbursement.id_mst_reimbursement');
        $query = $this->db->get();
        return $query;
    }

    function getSalaryByKodePegawai($kode_pegawai)
    {
        $this->db->select('tb_salary.id_salary as id_salary, tb_salary.bulan_tahun as bulan_tahun, tb_salary.amount as amount, mst_jenis_payslip.title as title');
        $this->db->from('tb_salary');
        $this->db->where('kd_pegawai', $kode_pegawai);
        $this->db->join('mst_jenis_payslip', 'mst_jenis_payslip.id_jenis_payslip = tb_salary.id_jenis_payslip');
        $query = $this->db->get();
        return $query;
    }

    public function getEditSalary($id_salary)
    {
        $query = $this->db->get_where('tb_salary', ['id_salary' => $id_salary])->row_array();
        return $query;
    }

    function getLastSalaryByKodePegawai($kode_pegawai) 
    {
        $this->db->select('tb_salary.bulan_tahun as bulan_tahun, tb_salary.amount as amount, mst_jenis_payslip.title as jenis_payslip');
        $this->db->where('tb_salary.kd_pegawai', $kode_pegawai);
        $this->db->order_by('tb_salary.id_salary', 'DESC');
        $this->db->limit(1);
        $this->db->join('mst_jenis_payslip', 'mst_jenis_payslip.id_jenis_payslip = tb_salary.id_jenis_payslip');
        $query = $this->db->get('tb_salary');
        return $query;
    }

    function getAllowanceAmountByKodePegawai($kode_pegawai, $bulan_tahun) 
    {
        $this->db->select_sum('amount');
        $this->db->where('kd_pegawai', $kode_pegawai);
        $this->db->where('bulan_tahun', $bulan_tahun);
        $query = $this->db->get('tb_allowance');
        return $query;
    }

    function getBenefitAmountByKodePegawai($kode_pegawai, $bulan_tahun) 
    {
        $this->db->select_sum('amount');
        $this->db->where('kd_pegawai', $kode_pegawai);
        $this->db->where('bulan_tahun', $bulan_tahun);
        $query = $this->db->get('tb_benefit');
        return $query;
    }

    function getReimbursementAmountByKodePegawai($kode_pegawai, $bulan_tahun) 
    {
        $this->db->select_sum('amount');
        $this->db->where('kd_pegawai', $kode_pegawai);
        $this->db->where('bulan_tahun', $bulan_tahun);
        $query = $this->db->get('tb_reimbursement');
        return $query;
    }

    function getDeductionAmountByKodePegawai($kode_pegawai, $bulan_tahun) 
    {
        $this->db->select_sum('amount');
        $this->db->where('kd_pegawai', $kode_pegawai);
        $this->db->where('bulan_tahun', $bulan_tahun);
        $query = $this->db->get('tb_deduction');
        return $query;
    }

    function getAllPayrollEmployee() 
    {
        $this->db->select('tb_payroll_employee.bulan_tahun as bulan_tahun, tb_payroll_employee.kode_pegawai as kode_pegawai, tb_payroll_employee.jenis_payslip as jenis_payslip, tb_payroll_employee.amount_salary as amount_salary, tb_payroll_employee.amount_total_allowance as amount_total_allowance, tb_payroll_employee.amount_total_deduction as amount_total_deduction, tb_payroll_employee.net_salary as net_salary, mst_pegawai.nama_lengkap as nama_lengkap');
        $this->db->from('tb_payroll_employee');
        $this->db->join('mst_pegawai', 'tb_payroll_employee.kode_pegawai = mst_pegawai.kode_pegawai');
        $this->db->order_by('tb_payroll_employee.id_payroll_employee', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    function getAllPayrollEmployeeByBulanTahun($bulan_tahun) 
    {
        $this->db->select('tb_payroll_employee.bulan_tahun as bulan_tahun, tb_payroll_employee.kode_pegawai as kode_pegawai, tb_payroll_employee.jenis_payslip as jenis_payslip, tb_payroll_employee.amount_salary as amount_salary, tb_payroll_employee.amount_total_allowance as amount_total_allowance, tb_payroll_employee.amount_total_deduction as amount_total_deduction, tb_payroll_employee.net_salary as net_salary, mst_pegawai.nama_lengkap as nama_lengkap');
        $this->db->from('tb_payroll_employee');
        $this->db->join('mst_pegawai', 'tb_payroll_employee.kode_pegawai = mst_pegawai.kode_pegawai');
        $this->db->where('tb_payroll_employee.bulan_tahun', $bulan_tahun);
        $this->db->order_by('tb_payroll_employee.id_payroll_employee', 'DESC');
        $query = $this->db->get();
        return $query;
    }

}
