<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staf_model extends CI_model
{
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

    public function getEditInfo($id_berita)
    {
        $query = $this->db->get_where('tb_informasi', ['id_berita' => $id_berita])->row_array();
        return $query;
    }

    public function getCountPending()
    {
        $sess_id = $this->session->userdata('id_user');
        $query = $this->db->query(
            "SELECT COUNT(is_approve) as pending
                               FROM tb_cuti
                               WHERE is_approve = 1 AND sess_id = '$sess_id'"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->pending;
        } else {
            return 0;
        }
    }


    public function getCountAll()
    {
        $sess_id = $this->session->userdata('id_user');
        $query = $this->db->query(
            "SELECT COUNT(is_approve) as getall
                               FROM tb_cuti
                               WHERE sess_id = '$sess_id'"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->getall;
        } else {
            return 0;
        }
    }

    public function getCountApprove()
    {
        $sess_id = $this->session->userdata('id_user');
        $query = $this->db->query(
            "SELECT COUNT(is_approve) as approve
                               FROM tb_cuti
                               WHERE is_approve = 0 AND sess_id = '$sess_id'"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->approve;
        } else {
            return 0;
        }
    }

    public function getCountTolak()
    {
        $sess_id = $this->session->userdata('id_user');
        $query = $this->db->query(
            "SELECT COUNT(is_approve) as tolak
                               FROM tb_cuti
                               WHERE is_approve = 2 AND sess_id = '$sess_id'"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->tolak;
        } else {
            return 0;
        }
    }

    public function getMyCuti()
    {
        $sess_id = $this->session->userdata('id_user');
        $this->db->from('tb_cuti');
        $this->db->where('sess_id', $sess_id);
        $this->db->order_by('id_cuti', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getMyCutiLain()
    {
        $sess_id = $this->session->userdata('id_user');
        $this->db->from('tb_cuti_lain');
        $this->db->where('sess_id', $sess_id);
        $this->db->order_by('id_cuti_lain', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getSisaCuti()
    {
        $sess_id = $this->session->userdata('id_user');
        $query = "SELECT * FROM tb_cuti
                        WHERE sess_id = '$sess_id' 
                        ORDER BY id_cuti DESC LIMIT 1";
        return $this->db->query($query)->row_array();
    }

    public function getEditCuti($id_cuti)
    {
        $query = $this->db->get_where('tb_cuti', ['id_cuti' => $id_cuti])->row_array();
        return $query;
    }

    public function getEditCutiLain($id_cuti_lain)
    {
        $query = $this->db->get_where('tb_cuti_lain', ['id_cuti_lain' => $id_cuti_lain])->row_array();
        return $query;
    }

    public function getListCuti()
    {
        $sess_id = $this->session->userdata('id_user');
        $this->db->from('tb_cuti');
        $this->db->where('sess_id', $sess_id);
        $this->db->order_by('id_cuti', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getCutiLain()
    {
        $sess_id = $this->session->userdata('id_user');
        $this->db->from('tb_cuti_lain');
        $this->db->where('sess_id', $sess_id);
        $this->db->order_by('id_cuti_lain', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getCetakCuti($id_cuti)
    {
        $this->db->select('*');
        $this->db->from('mst_pegawai');
        $this->db->join('tb_cuti', 'mst_pegawai.kode_pegawai = tb_cuti.kd_pegawai');
        $this->db->join('tb_struktural', 'mst_pegawai.kode_pegawai = tb_struktural.pegawai_kode');
        $this->db->join('mst_divisi', 'tb_struktural.divisi_kode = mst_divisi.kode_divisi');
        $this->db->join('mst_jabatan', 'tb_struktural.jabatan_kode =mst_jabatan.kode_jabatan');
        $this->db->where('tb_cuti.id_cuti', $id_cuti);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getCetakCutiLain($id_cuti_lain)
    {
        $this->db->select('*');
        $this->db->from('mst_pegawai');
        $this->db->join('tb_cuti_lain', 'mst_pegawai.kode_pegawai = tb_cuti_lain.kd_pegawai');
        $this->db->join('tb_struktural', 'mst_pegawai.kode_pegawai = tb_struktural.pegawai_kode');
        $this->db->join('mst_divisi', 'tb_struktural.divisi_kode = mst_divisi.kode_divisi');
        $this->db->join('mst_jabatan', 'tb_struktural.jabatan_kode =mst_jabatan.kode_jabatan');
        $this->db->where('tb_cuti_lain.id_cuti_lain', $id_cuti_lain);
        $query = $this->db->get();
        return $query->result_array();
    }
}
