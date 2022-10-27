<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staf extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        is_staf();
        $this->load->helper('rupiah');
        $this->load->helper('tglindo');
        $this->load->model('Staf_model', 'staf');
    }

    public function index()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Beranda';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $kode_pegawai = $this->session->userdata('pegawai_kd');
            $data['info'] = $this->db->get_where('tb_info', ['kirim' => 0])->result_array();
            $data['gaji'] = $this->db->get_where('tb_gaji', ['pegawai_kd' => $kode_pegawai])->row_array();
            $data['insentif'] = $this->db->get_where('tb_insentif', ['pegawai_kd' => $kode_pegawai])->row_array();
            $data['keluarga'] = $this->db->get_where('dt_keluarga', ['nip' => $kode_pegawai])->row_array();
            $data['kinerja'] = $this->db->get_where('tb_nilai', ['peg_kd' => $kode_pegawai])->row_array();
            $data['prestasi'] = $this->db->get_where('tb_prestasi', ['pegawai_kd' => $kode_pegawai])->row_array();
            $data['struktural'] = $this->staf->getHistoryStruktural($kode_pegawai);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_staf', $data);
            $this->load->view('staf/index', $data);
            $this->load->view('templates/footer');
        } else {
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/dist/img/profile';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/dist/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $id_user = $this->input->post('id_user');
            $nama = $this->input->post('nama');
            $this->db->set('nama', $nama);
            $this->db->where('id_user', $id_user);
            $this->db->update('mst_user');

            $this->session->set_flashdata('message', 'Update data');
            redirect('staf/index');
        }
    }

    public function ubah_password()
    {
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password1', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Beranda';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $kode_pegawai = $this->session->userdata('pegawai_kd');
            $data['info'] = $this->db->get_where('tb_info', ['kirim' => 0])->result_array();
            $data['gaji'] = $this->db->get_where('tb_gaji', ['pegawai_kd' => $kode_pegawai])->row_array();
            $data['insentif'] = $this->db->get_where('tb_insentif', ['pegawai_kd' => $kode_pegawai])->row_array();
            $data['keluarga'] = $this->db->get_where('dt_keluarga', ['nip' => $kode_pegawai])->row_array();
            $data['kinerja'] = $this->db->get_where('tb_nilai', ['peg_kd' => $kode_pegawai])->row_array();
            $data['prestasi'] = $this->db->get_where('tb_prestasi', ['pegawai_kd' => $kode_pegawai])->row_array();
            $data['struktural'] = $this->staf->getHistoryStruktural($kode_pegawai);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_staf', $data);
            $this->load->view('staf/index', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if ($current_password == $new_password) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password lama</div>');
                redirect('staf/index');
            } else {
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $this->db->set('password', $password_hash);
                $this->db->where('id_user', $this->session->userdata('id_user'));
                $this->db->update('mst_user');
                $this->session->set_flashdata('message', 'Ubah password');
                redirect('staf/index');
            }
        }
    }

    public function berita()
    {
        $this->form_validation->set_rules('tgl_berita', 'Tanggal Berita', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Berita & Informasi';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['berita'] = $this->db->get_where('tb_informasi', ['pegawai_kd' => $this->session->userdata('pegawai_kd')])->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_staf', $data);
            $this->load->view('staf/berita', $data);
            $this->load->view('templates/footer');
        } else {

            $pegawai_kd = $this->session->userdata('pegawai_kd');
            $sess_id = $this->session->userdata('id_user');
            $data = [
                'tgl_berita' => $this->input->post('tgl_berita', true),
                'isi_berita' => $this->input->post('isi_berita', true),
                'pegawai_kd' => $pegawai_kd,
                'sess_id' => $sess_id,
                'kirim' => 1
            ];
            $this->db->insert('tb_informasi', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('staf/berita');
        }
    }

    public function get_berita()
    {
        echo json_encode($this->staf->getEditInfo($_POST['id_berita']));
    }

    public function edit_berita()
    {
        $id_berita = $this->input->post('id_berita');
        $tgl_berita = $this->input->post('tgl_berita');
        $isi_berita = $this->input->post('isi_berita');
        $this->db->set('tgl_berita', $tgl_berita);
        $this->db->set('isi_berita', $isi_berita);
        $this->db->where('id_berita', $id_berita);
        $this->db->update('tb_informasi');
        $this->session->set_flashdata('message', 'Update data');
        redirect('staf/berita');
    }

    public function kirim_berita()
    {
        $id_berita = $this->input->post('id_berita');
        $kirim = 0;
        $this->db->set('kirim', $kirim);
        $this->db->where('id_berita', $id_berita);
        $this->db->update('tb_informasi');
        $this->session->set_flashdata('message', 'Kirim data');
        redirect('staf/berita');
    }

    public function list_cuti()
    {
        $this->form_validation->set_rules('kd_pegawai', 'Kode Pegawai', 'required|trim');
        $this->form_validation->set_rules('jml_cuti', 'Ambil cuti', 'required|trim|numeric|greater_than[0]');
        $this->form_validation->set_rules('sisa_cuti', 'Sisa Cuti', 'required|trim|greater_than[-1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'List Cuti';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['sisa_cuti'] = $this->staf->getSisaCuti();
            $data['list_cuti'] = $this->staf->getListCuti();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_staf', $data);
            $this->load->view('staf/list_cuti', $data);
            $this->load->view('templates/footer');
        } else {
            $sess_id = $this->session->userdata('id_user');
            $data = [
                'kd_pegawai' => $this->input->post('kd_pegawai', true),
                'tgl_input' => $this->input->post('tgl_input', true),
                'jenis_cuti' => $this->input->post('jenis_cuti', true),
                'keterangan' => $this->input->post('keterangan', true),
                'jml_cuti' => $this->input->post('jml_cuti', true),
                'sisa_cuti' => $this->input->post('sisa_cuti', true),
                'tgl_cuti' => $this->input->post('tgl_cuti', true),
                'tgl_cuti2' => $this->input->post('tgl_cuti2', true),
                'tgl_masuk' => $this->input->post('tgl_masuk', true),
                'alamat' => $this->input->post('alamat', true),
                'telp' => $this->input->post('telp', true),
                'sess_id' => $sess_id,
                'is_approve' => 1
            ];
            $this->db->insert('tb_cuti', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('staf/list_cuti');
        }
    }

    public function get_cuti()
    {
        echo json_encode($this->staf->getEditCuti($_POST['id_cuti']));
    }

    public function edit_cuti()
    {
        $this->form_validation->set_rules('kd_pegawai', 'Kode Pegawai', 'required|trim');
        $this->form_validation->set_rules('jml_cuti', 'Ambil cuti', 'required|trim|numeric|greater_than[0]');
        $this->form_validation->set_rules('sisa_cuti', 'Sisa Cuti', 'required|trim|greater_than[-1]');

        if ($this->form_validation->run() == false) {

            $data['title'] = 'List Cuti';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['sisa_cuti'] = $this->staf->getSisaCuti();
            $data['list_cuti'] = $this->staf->getListCuti();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_staf', $data);
            $this->load->view('staf/list_cuti', $data);
            $this->load->view('templates/footer');
        } else {
            $id_cuti = $this->input->post('id_cuti');
            $tgl_input = $this->input->post('tgl_input');
            $jenis_cuti = $this->input->post('jenis_cuti');
            $keterangan = $this->input->post('keterangan');
            $jml_cuti = $this->input->post('jml_cuti');
            $sisa_cuti = $this->input->post('sisa_cuti');
            $tgl_cuti = $this->input->post('tgl_cuti');
            $tgl_cuti2 = $this->input->post('tgl_cuti2');
            $tgl_masuk = $this->input->post('tgl_masuk');
            $alamat = $this->input->post('alamat');
            $telp = $this->input->post('telp');

            $this->db->set('tgl_input', $tgl_input);
            $this->db->set('jenis_cuti', $jenis_cuti);
            $this->db->set('keterangan', $keterangan);
            $this->db->set('jml_cuti', $jml_cuti);
            $this->db->set('sisa_cuti', $sisa_cuti);
            $this->db->set('tgl_cuti', $tgl_cuti);
            $this->db->set('tgl_cuti2', $tgl_cuti2);
            $this->db->set('tgl_masuk', $tgl_masuk);
            $this->db->set('alamat', $alamat);
            $this->db->set('telp', $telp);
            $this->db->where('id_cuti', $id_cuti);
            $this->db->update('tb_cuti');
            $this->session->set_flashdata('message', 'Update data');
            redirect('staf/list_cuti');
        }
    }

    public function list_cuti_lain()
    {
        $this->form_validation->set_rules('kd_pegawai', 'Kode Pegawai', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'List Cuti Lain';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['cuti_lain'] = $this->staf->getCutiLain();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_staf', $data);
            $this->load->view('staf/list_cuti_lain', $data);
            $this->load->view('templates/footer');
        } else {
            $sess_id = $this->session->userdata('id_user');
            $data = [
                'kd_pegawai' => $this->input->post('kd_pegawai', true),
                'tgl_input' => $this->input->post('tgl_input', true),
                'jenis_cuti' => $this->input->post('jenis_cuti', true),
                'keterangan' => $this->input->post('keterangan', true),
                'tgl_cuti' => $this->input->post('tgl_cuti', true),
                'tgl_cuti2' => $this->input->post('tgl_cuti2', true),
                'tgl_masuk' => $this->input->post('tgl_masuk', true),
                'alamat' => $this->input->post('alamat', true),
                'telp' => $this->input->post('telp', true),
                'sess_id' => $sess_id,
                'is_approve' => 1
            ];
            $this->db->insert('tb_cuti_lain', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('staf/list_cuti_lain');
        }
    }

    public function get_cuti_lain()
    {
        echo json_encode($this->staf->getEditCutiLain($_POST['id_cuti_lain']));
    }

    public function edit_cuti_lain()
    {
        $id_cuti_lain = $this->input->post('id_cuti_lain', true);
        $tgl_input = $this->input->post('tgl_input', true);
        $jenis_cuti = $this->input->post('jenis_cuti', true);
        $keterangan = $this->input->post('keterangan', true);
        $tgl_cuti = $this->input->post('tgl_cuti', true);
        $tgl_cuti2 = $this->input->post('tgl_cuti2', true);
        $tgl_masuk = $this->input->post('tgl_masuk', true);
        $alamat = $this->input->post('alamat', true);
        $telp = $this->input->post('telp', true);

        $this->db->set('tgl_input', $tgl_input);
        $this->db->set('jenis_cuti', $jenis_cuti);
        $this->db->set('keterangan', $keterangan);
        $this->db->set('tgl_cuti', $tgl_cuti);
        $this->db->set('tgl_cuti2', $tgl_cuti2);
        $this->db->set('tgl_masuk', $tgl_masuk);
        $this->db->set('alamat', $alamat);
        $this->db->set('telp', $telp);
        $this->db->where('id_cuti_lain', $id_cuti_lain);
        $this->db->update('tb_cuti_lain');
        $this->session->set_flashdata('message', 'Update data');
        redirect('staf/list_cuti_lain');
    }

    public function cetak_data($id_cuti)
    {
        $this->load->library('Pdf');
        $pdf = new FPDF('p', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->Cell(50, 25, '', 0, 1, 'C');
        $pdf->SetFont('Times', '', 11);
        $pdf->Ln(3);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(190, 5, 'PERMOHONAN CUTI / IJIN', 0, 1, 'C');
        $pdf->Ln(10);
        $pdf->SetFont('Times', '', 11);
        $pdf->Cell(10, 5, 'Kepada Yth :', 0, 1);
        $pdf->Cell(10, 5, 'Kabag HRD', 0, 1);
        $pdf->Cell(10, 5, 'Di tempat.', 0, 1);
        $pdf->Ln(6);
        $cetak_cuti =  $this->staf->getCetakCuti($id_cuti);
        foreach ($cetak_cuti as $row) {
            $pdf->Cell(10, 5, 'Yang bertanda tangan di bawah ini, Saya :', 0, 1);
            $pdf->Ln(3);
            $pdf->Cell(26, 5, 'Nama', 0, 0);
            $pdf->Cell(2, 5, ':', 0, 0);
            $pdf->Cell(10, 5, ucwords($row['nama_lengkap']), 0, 1);
            $pdf->Cell(26, 5, 'NIK', 0, 0);
            $pdf->Cell(2, 5, ':', 0, 0);
            $pdf->Cell(10, 5, $row['kd_pegawai'], 0, 1);
            $pdf->Cell(26, 5, 'Jabatan', 0, 0);
            $pdf->Cell(2, 5, ':', 0, 0);
            $pdf->Cell(10, 5, $row['jabatan'], 0, 1);
            $pdf->Cell(26, 5, 'Bagian', 0, 0);
            $pdf->Cell(2, 5, ':', 0, 0);
            $pdf->Cell(20, 5, $row['divisi'], 0, 1);
            $pdf->Ln(3);
            $pdf->Cell(60, 5, 'Dengan ini mengajukan permohonan : ' . $row['jenis_cuti'] . ', selama ' . $row['jml_cuti'] . ' hari', 0, 1);
            $pdf->Cell(100, 5, 'Mulai tanggal '  . format_indo($row['tgl_cuti']) . ' sampai tanggal ' . format_indo($row['tgl_cuti2']) . ', dan bekerja kembali pada tanggal ' . format_indo($row['tgl_masuk']) . '.', 0, 1);
            $pdf->Cell(58, 5, 'Selama cuti/ijin Saya dapat dihubungi ke :', 0, 1);
            $pdf->Ln(3);
            $pdf->Cell(26, 5, 'Alamat', 0, 0);
            $pdf->Cell(2, 5, ':', 0, 0);
            $pdf->Cell(10, 5, ucwords($row['alamat']), 0, 1);
            $pdf->Cell(26, 5, 'No. Telp/HP', 0, 0);
            $pdf->Cell(2, 5, ':', 0, 0);
            $pdf->Cell(10, 5, $row['telp'], 0, 1);
            $pdf->Ln(18);
            $pdf->Cell(94, 5, '', 0, 0, 'C');
            $pdf->Cell(94, 5, 'Kudus, ' . format_indo($row['tgl_input']), 0, 1, 'C');
            $pdf->Cell(94, 5, 'Menyetujui', 0, 0, 'C');
            $pdf->Cell(94, 5, 'Hormat saya,', 0, 1, 'C');
            $pdf->Cell(94, 5, '', 0, 0, 'C');
            $pdf->Ln(30);
            $pdf->Cell(94, 5, ucwords($row['atasan']), 0, 0, 'C');
            $pdf->Cell(94, 5, ucwords($row['nama_lengkap']), 0, 1, 'C');
            $pdf->Ln(10);
            // $pdf->Cell(190, 5, 'Mengetahui,', 0, 1, 'C');
            // $pdf->Cell(190, 5, 'Kepala Bidang / Bagian / Instalasi Terkait,', 0, 1, 'C');
            // $pdf->Ln(20);
            // $pdf->Cell(190, 5, ucwords($row['nama_kabid']), 0, 1, 'C');
            $pdf->Ln(30);
            $pdf->Cell(10, 7, 'No', 1, 0, 'C');
            $pdf->Cell(29, 7, 'Jenis Cuti/Ijin', 1, 0, 'C');
            $pdf->Cell(20, 7, 'Tot. Cuti', 1, 0, 'C');
            $pdf->Cell(20, 7, 'Masih Ada', 1, 0, 'C');
            $pdf->Cell(20, 7, 'Diambil', 1, 0, 'C');
            $pdf->Cell(20, 7, 'Sisa Cuti', 1, 0, 'C');
            $pdf->Cell(69, 7, 'Keterangan', 1, 1, 'C');
            $pdf->Cell(10, 7, '1', 1, 0, 'C');
            $pdf->Cell(29, 7, ucwords($row['jenis_cuti']), 1, 0, 'C');
            $pdf->Cell(20, 7, '12', 1, 0, 'C');
            $pdf->Cell(20, 7, $row['sisa_cuti'] + $row['jml_cuti'], 1, 0, 'C');
            $pdf->Cell(20, 7, $row['jml_cuti'], 1, 0, 'C');
            $pdf->Cell(20, 7, $row['sisa_cuti'], 1, 0, 'C');
            $pdf->Cell(69, 7, $row['keterangan'], 1, 1, 'C');
            $pdf->Ln(8);
            $pdf->SetFont('Arial', '', 8);
            $pdf->Line(10, 251, 198, 251);
        }
        $pdf->Output();
    }

    public function cetak_cuti_lain($id_cuti_lain)
    {
        $this->load->library('Pdf');
        $pdf = new FPDF('p', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->Cell(50, 25, '', 0, 1, 'C');
        $pdf->SetFont('Times', '', 11);
        $pdf->Ln(3);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(190, 5, 'PERMOHONAN CUTI / IJIN', 0, 1, 'C');
        $pdf->Ln(10);
        $pdf->SetFont('Times', '', 11);
        $pdf->Cell(10, 5, 'Kepada Yth :', 0, 1);
        $pdf->Cell(10, 5, 'Kabag HRD', 0, 1);
        $pdf->Cell(10, 5, 'Di tempat.', 0, 1);
        $pdf->Ln(6);
        $cetak_cuti =  $this->staf->getCetakCutiLain($id_cuti_lain);
        foreach ($cetak_cuti as $row) {
            $pdf->Cell(10, 5, 'Yang bertanda tangan di bawah ini, Saya :', 0, 1);
            $pdf->Cell(26, 5, 'Nama', 0, 0);
            $pdf->Cell(2, 5, ':', 0, 0);
            $pdf->Cell(10, 5, ucwords($row['nama_lengkap']), 0, 1);
            $pdf->Cell(26, 5, 'NIK', 0, 0);
            $pdf->Cell(2, 5, ':', 0, 0);
            $pdf->Cell(10, 5, $row['kd_pegawai'], 0, 1);
            $pdf->Cell(26, 5, 'Jabatan', 0, 0);
            $pdf->Cell(2, 5, ':', 0, 0);
            $pdf->Cell(10, 5, $row['jabatan'], 0, 1);
            $pdf->Cell(26, 5, 'Bagian', 0, 0);
            $pdf->Cell(2, 5, ':', 0, 0);
            $pdf->Cell(20, 5, $row['divisi'], 0, 1);
            $pdf->Ln(3);
            $pdf->Cell(60, 5, 'Dengan ini mengajukan permohonan : ' . $row['jenis_cuti'], 0, 1);
            $pdf->Ln(2);
            $pdf->Cell(100, 5, 'Mulai tanggal '  . format_indo($row['tgl_cuti']) . ' sampai tanggal ' . format_indo($row['tgl_cuti2']) . ', dan bekerja kembali pada tanggal ' . format_indo($row['tgl_masuk']) . '.', 0, 1);
            $pdf->Ln(2);
            $pdf->Cell(60, 5, 'Adapun yang mendasari cuti saya adalah : ' . $row['keterangan'], 0, 1);
            $pdf->Ln(2);
            $pdf->Cell(58, 5, 'Selama cuti/ijin Saya dapat dihubungi ke :', 0, 1);
            $pdf->Ln(3);
            $pdf->Cell(26, 5, 'Alamat', 0, 0);
            $pdf->Cell(2, 5, ':', 0, 0);
            $pdf->Cell(10, 5, ucwords($row['alamat']), 0, 1);
            $pdf->Cell(26, 5, 'No. Telp/HP', 0, 0);
            $pdf->Cell(2, 5, ':', 0, 0);
            $pdf->Cell(10, 5, $row['telp'], 0, 1);
            $pdf->Ln(30);
            $pdf->Cell(94, 5, '', 0, 0, 'C');
            $pdf->Cell(94, 5, 'Kudus, ' . format_indo($row['tgl_input']), 0, 1, 'C');
            $pdf->Cell(94, 5, 'Menyetujui', 0, 0, 'C');
            $pdf->Cell(94, 5, 'Hormat saya,', 0, 1, 'C');
            $pdf->Cell(94, 5, '', 0, 0, 'C');
            $pdf->Ln(30);
            $pdf->Cell(94, 5, ucwords($row['atasan']), 0, 0, 'C');
            $pdf->Cell(94, 5, ucwords($row['nama_lengkap']), 0, 1, 'C');
            $pdf->Ln(10);
            // $pdf->Cell(190, 5, 'Mengetahui,', 0, 1, 'C');
            // $pdf->Cell(190, 5, 'Kepala Bidang / Bagian / Instalasi Terkait,', 0, 1, 'C');
            // $pdf->Ln(20);
            // $pdf->Cell(190, 5, ucwords($row['nama_kabid']), 0, 1, 'C');
            $pdf->Ln(30);
            // $pdf->Cell(10, 7, 'No', 1, 0, 'C');
            // $pdf->Cell(29, 7, 'Jenis Cuti/Ijin', 1, 0, 'C');
            // $pdf->Cell(20, 7, 'Tot. Cuti', 1, 0, 'C');
            // $pdf->Cell(20, 7, 'Masih Ada', 1, 0, 'C');
            // $pdf->Cell(20, 7, 'Diambil', 1, 0, 'C');
            // $pdf->Cell(20, 7, 'Sisa Cuti', 1, 0, 'C');
            // $pdf->Cell(69, 7, 'Keterangan', 1, 1, 'C');
            // $pdf->Cell(10, 7, '1', 1, 0, 'C');
            // $pdf->Cell(29, 7, ucwords($row['jenis_cuti']), 1, 0, 'C');
            // $pdf->Cell(20, 7, '12', 1, 0, 'C');
            // $pdf->Cell(20, 7, $row['sisa_cuti'] + $row['jml_cuti'], 1, 0, 'C');
            // $pdf->Cell(20, 7, $row['jml_cuti'], 1, 0, 'C');
            // $pdf->Cell(20, 7, $row['sisa_cuti'], 1, 0, 'C');
            // $pdf->Cell(69, 7, $row['keterangan'], 1, 1, 'C');
            // $pdf->Ln(8);
            // $pdf->Line(10, 255, 198, 255);
        }
        $pdf->Output();
    }
}
