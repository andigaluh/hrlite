<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Config extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        is_admin();
        $this->load->helper('tglindo');
        $this->load->helper('rupiah');
        $this->load->helper('jhanojan');
        $this->load->model('Admin_model', 'admin');
    }
    public function index_bk(){
        $this->load->view('dashboard_menu/index');
    }
    public function index()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Main Menu';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['user_perbulan'] = $this->admin->countUserPerbulan();
            $data['count_user'] = $this->admin->countJmlUser();
            $data['user_aktif'] = $this->admin->countUserAktif();
            $data['user_tak_aktif'] = $this->admin->countUserTakAktif();
            $data['list_user'] = $this->db->get('mst_user')->result_array();
            $data['pegawai'] = $this->db->get('mst_pegawai')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('dashboard_menu/index', $data);
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
            redirect('admin/index');
        }
    }
    public function index_dashboard()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Beranda';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['user_perbulan'] = $this->admin->countUserPerbulan();
            $data['count_user'] = $this->admin->countJmlUser();
            $data['user_aktif'] = $this->admin->countUserAktif();
            $data['user_tak_aktif'] = $this->admin->countUserTakAktif();
            $data['list_user'] = $this->db->get('mst_user')->result_array();
            $data['pegawai'] = $this->db->get('mst_pegawai')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/index', $data);
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
            redirect('admin/index');
        }
    }

    public function ubah_password()
    {
        $this->form_validation->set_rules('current_password', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'Password Baru', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Konfirm Password Baru', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Beranda';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['user_perbulan'] = $this->admin->countUserPerbulan();
            $data['count_user'] = $this->admin->countJmlUser();
            $data['user_aktif'] = $this->admin->countUserAktif();
            $data['user_tak_aktif'] = $this->admin->countUserTakAktif();
            $data['list_user'] = $this->db->get('mst_user')->result_array();
            $data['pegawai'] = $this->db->get('mst_pegawai')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if ($current_password == $new_password) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password lama</div>');
                redirect('admin/index');
            } else {
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $this->db->set('password', $password_hash);
                $this->db->where('username', $this->session->userdata('username'));
                $this->db->update('mst_user');
                $this->session->set_flashdata('message', 'Ubah password');
                redirect('admin/index');
            }
        }
    }

    public function list_pegawai()
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('kota_lahir', 'Kota Lahir', 'required|trim');
        $this->form_validation->set_rules('tgl_lahir', 'Tgl Lahir', 'required|trim');
        $this->form_validation->set_rules('alamat_skrg', 'Alamat Sekarang', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('agama', 'Agama', 'required|trim');
        $this->form_validation->set_rules('no_ktp', 'No KTP', 'required|trim');
        $this->form_validation->set_rules('status', 'Status Perkawinan', 'required|trim');
        $this->form_validation->set_rules('pend_akhir', 'Pendidikan Terakhir', 'required|trim');
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Daftar Pegawai';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['kode_pegawai'] = $this->admin->getKodePegawai();
            $data['pegawai'] = $this->db->get('mst_pegawai')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/list_pegawai', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_pegawai' => $this->input->post('kode_pegawai', true),
                'nama_lengkap' => $this->input->post('nama_lengkap', true),
                'sex' => $this->input->post('sex', true),
                'kota_lahir' => $this->input->post('kota_lahir', true),
                'tgl_lahir' => $this->input->post('tgl_lahir', true),
                'alamat_skrg' => $this->input->post('alamat_skrg', true),
                'email' => $this->input->post('email', true),
                'agama' => $this->input->post('agama', true),
                'no_ktp' => $this->input->post('no_ktp', true),
                'status' => $this->input->post('status', true),
                'pend_akhir' => $this->input->post('pend_akhir', true),
                'image' => 'default.jpg',
                'pegawai_created' => date("Y/m/d"),
                'pegawai_active' => 1,
                'no_telepon' => $this->input->post('no_telepon', true)
            ];
            $this->db->insert('mst_pegawai', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/list_pegawai');
        }
    }

    public function detail_pegawai($kode_pegawai)
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('kota_lahir', 'Kota Lahir', 'required|trim');
        $this->form_validation->set_rules('tgl_lahir', 'Tgl Lahir', 'required|trim');
        $this->form_validation->set_rules('alamat_skrg', 'Alamat Sekarang', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('agama', 'Agama', 'required|trim');
        $this->form_validation->set_rules('no_ktp', 'No KTP', 'required|trim');
        $this->form_validation->set_rules('status', 'Status Perkawinan', 'required|trim');
        $this->form_validation->set_rules('pend_akhir', 'Pendidikan Terakhir', 'required|trim');
        $this->form_validation->set_rules('pegawai_active', 'Pegawai Aktif ??', 'required|trim');
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Detail Pegawai';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['pegawai'] = $this->db->get_where('mst_pegawai', ['kode_pegawai' => $kode_pegawai])->row_array();
            $data['keluarga'] = $this->db->get_where('dt_keluarga', ['nip' => $kode_pegawai])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/detail_pegawai', $data);
            $this->load->view('templates/footer');
        } else {
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/dist/img/profile';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
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
            $kode_pegawai = $this->input->post('kode_pegawai');
            $nama_lengkap = $this->input->post('nama_lengkap');
            $sex = $this->input->post('sex');
            $kota_lahir = $this->input->post('kota_lahir');
            $tgl_lahir = $this->input->post('tgl_lahir');
            $alamat_skrg = $this->input->post('alamat_skrg');
            $email = $this->input->post('email');
            $agama = $this->input->post('agama');
            $no_ktp = $this->input->post('no_ktp');
            $status = $this->input->post('status');
            $pend_akhir = $this->input->post('pend_akhir');
            $pegawai_active = $this->input->post('pegawai_active');
            $no_telepon = $this->input->post('no_telepon');

            $this->db->set('nama_lengkap', $nama_lengkap);
            $this->db->set('sex', $sex);
            $this->db->set('kota_lahir', $kota_lahir);
            $this->db->set('tgl_lahir', $tgl_lahir);
            $this->db->set('alamat_skrg', $alamat_skrg);
            $this->db->set('email', $email);
            $this->db->set('agama', $agama);
            $this->db->set('no_ktp', $no_ktp);
            $this->db->set('status', $status);
            $this->db->set('pend_akhir', $pend_akhir);
            $this->db->set('pegawai_active', $pegawai_active);
            $this->db->set('no_telepon', $no_telepon);

            $this->db->where('kode_pegawai', $kode_pegawai);
            $this->db->update('mst_pegawai');
            $this->session->set_flashdata('message', 'Update data');
            redirect('admin/detail_pegawai/' . $kode_pegawai);
        }
    }

    public function add_data_lain($kode_pegawai)
    {
        $this->form_validation->set_rules('nip', 'No Induk Pegawai', 'required|trim|is_unique[dt_keluarga.nip]', array(
            'is_unique' => 'SIMPAN GAGAL !!.. No Induk Pegawai sudah ada'
        ));

        if ($this->form_validation->run() == false) {

            $data['title'] = 'Detail Pegawai';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['pegawai'] = $this->db->get_where('mst_pegawai', ['kode_pegawai' => $kode_pegawai])->row_array();
            $data['keluarga'] = $this->db->get_where('dt_keluarga', ['nip' => $kode_pegawai])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/detail_pegawai', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'nip' => $this->input->post('nip', true),
                'nama_pasangan' => $this->input->post('nama_pasangan', true),
                'tgl_lahir_pasangan' => $this->input->post('tgl_lahir_pasangan', true),
                'alamat_pasangan' => $this->input->post('alamat_pasangan', true),
                'jml_anak' => $this->input->post('jml_anak', true),
                'telp_pasangan' => $this->input->post('telp_pasangan', true),
                'pekerjaan' => $this->input->post('pekerjaan', true)
            );
            $this->db->insert('dt_keluarga', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/detail_pegawai/' . $kode_pegawai);
        }
    }

    public function add_user($kode_pegawai)
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[mst_user.username]', array(
            'is_unique' => 'SIMPAN GAGAL !!.. Username sudah ada'
        ));
        $this->form_validation->set_rules('pegawai_kd', 'Kode Pegawai', 'required|trim|is_unique[mst_user.pegawai_kd]', array(
            'is_unique' => 'SIMPAN GAGAL !!.. Kode Pegawai sudah ada'
        ));
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', array(
            'matches' => 'Password tidak sama',
            'min_length' => 'password min 3 karakter'
        ));
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == FALSE) {

            $data['title'] = 'Buat User Akun Pegawai';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['list_user'] = $this->db->get('mst_user')->result_array();
            $data['pegawai'] = $this->db->get_where('mst_pegawai', ['kode_pegawai' => $kode_pegawai])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/add_user', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'nama' => $this->input->post('nama', true),
                'pegawai_kd' => $this->input->post('pegawai_kd', true),
                'level' => $this->input->post('level', true),
                'username' => $this->input->post('username', true),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'date_created' => date('Y/m/d'),
                'image' => 'default.jpg',
                'is_active' => 1
            );
            $this->db->insert('mst_user', $data);
            $this->session->set_flashdata('message', 'Tambah user');
            redirect('admin/man_user');
        }
    }

    public function man_user()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[mst_user.username]', array(
            'is_unique' => 'Username sudah ada'
        ));
        $this->form_validation->set_rules('pegawai_kd', 'Kode Pegawai', 'required|trim|is_unique[mst_user.pegawai_kd]', array(
            'is_unique' => 'No Induk Pegawai Sudah terdaftar'
        ));
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', array(
            'matches' => 'Password tidak sama',
            'min_length' => 'password min 3 karakter'
        ));
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Management User';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['list_user'] = $this->db->get('mst_user')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/man_user', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'nama' => $this->input->post('nama', true),
                'pegawai_kd' => $this->input->post('pegawai_kd', true),
                'level' => $this->input->post('level', true),
                'username' => $this->input->post('username', true),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'date_created' => date('Y/m/d'),
                'image' => 'default.jpg',
                'is_active' => 1
            );
            $this->db->insert('mst_user', $data);
            $this->session->set_flashdata('message', 'Tambah user');
            redirect('admin/man_user');
        }
    }

    public function edit_user()
    {
        echo json_encode($this->admin->getUserEdit($_POST['id_user']));
    }

    public function proses_edit_user()
    {
        $id_user = $this->input->post('id_user');
        $nama = $this->input->post('nama');
        $level = $this->input->post('level');
        $is_active = $this->input->post('is_active');

        $this->db->set('nama', $nama);
        $this->db->set('level', $level);
        $this->db->set('is_active', $is_active);

        $this->db->where('id_user', $id_user);
        $this->db->update('mst_user');
        $this->session->set_flashdata('message', 'Update data');
        redirect('admin/man_user');
    }

    public function del_user($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete('mst_user');
        $this->session->set_flashdata('message', 'Hapus user');
        redirect('admin/man_user');
    }

    public function list_jabatan()
    {
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim|is_unique[mst_jabatan.jabatan]', array(
            'is_unique' => 'Simpan Gagal !.. Jabatan sudah ada'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Master Jabatan';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['kode_jabatan'] = $this->admin->getKodeJabatan();
            $data['mst_jabatan'] = $this->db->get('mst_jabatan')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/list_jabatan', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_jabatan' => $this->input->post('kode_jabatan', true),
                'jabatan' => $this->input->post('jabatan', true),
            ];
            $this->db->insert('mst_jabatan', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/list_jabatan');
        }
    }

    public function edit_jabatan()
    {
        echo json_encode($this->admin->getEditJabatan($_POST['id_jabatan']));
    }

    public function proses_edit_jabatan()
    {
        $id_jabatan = $this->input->post('id_jabatan');
        $jabatan = $this->input->post('jabatan');
        $this->db->set('jabatan', $jabatan);
        $this->db->where('id_jabatan', $id_jabatan);
        $this->db->update('mst_jabatan');
        $this->session->set_flashdata('message', 'Update data');
        redirect('admin/list_jabatan');
    }

    public function list_divisi()
    {
        $this->form_validation->set_rules('divisi', 'Divisi', 'required|trim|is_unique[mst_divisi.divisi]', array(
            'is_unique' => 'Simpan Gagal !.. Divisi / Departemen sudah ada'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Master Divisi';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['kode_divisi'] = $this->admin->getKodeDivisi();
            $data['mst_divisi'] = $this->db->get('mst_divisi')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/list_divisi', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_divisi' => $this->input->post('kode_divisi', true),
                'divisi' => $this->input->post('divisi', true),
            ];
            $this->db->insert('mst_divisi', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/list_divisi');
        }
    }

    public function edit_divisi()
    {
        echo json_encode($this->admin->getEditDivisi($_POST['id_divisi']));
    }

    public function proses_edit_divisi()
    {
        $id_divisi = $this->input->post('id_divisi');
        $divisi = $this->input->post('divisi');
        $this->db->set('divisi', $divisi);
        $this->db->where('id_divisi', $id_divisi);
        $this->db->update('mst_divisi');
        $this->session->set_flashdata('message', 'Update data');
        redirect('admin/list_divisi');
    }

    public function add_struktur($kode_pegawai)
    {
        $this->form_validation->set_rules('kode_struktural', 'Kode Struktural', 'required|trim|is_unique[tb_struktural.kode_struktural]', array(
            'is_unique' => 'Simpan Gagal !.. Kode Struktural sudah ada'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Level Struktural';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['history'] = $this->admin->getHistoryStruktural($kode_pegawai);
            $data['kode_struktural'] = $this->admin->getKodeStruktural();
            $data['pegawai'] = $this->db->get_where('mst_pegawai', ['kode_pegawai' => $kode_pegawai])->row_array();
            $data['divisi'] = $this->db->get('mst_divisi')->result_array();
            $data['jabatan'] = $this->db->get('mst_jabatan')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/add_struktur', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_struktural' => $this->input->post('kode_struktural', true),
                'pegawai_kode' => $this->input->post('pegawai_kode', true),
                'divisi_kode' => $this->input->post('divisi_kode', true),
                'jabatan_kode' => $this->input->post('jabatan_kode', true),
                'tgl_input' => date('Y/m/d')
            ];
            $this->db->insert('tb_struktural', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/add_struktur/' . $kode_pegawai);
        }
    }

    public function del_struktur($id_struktural)
    {
        $this->db->where('id_struktural', $id_struktural);
        $this->db->delete('tb_struktural');
        $this->session->set_flashdata('message', 'Hapus data');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function mst_gaji()
    {
        $this->form_validation->set_rules('nom_gaji', 'Nominal Gaji', 'required|trim|is_unique[mst_gaji.nom_gaji]', array(
            'is_unique' => 'Simpan Gagal !.. Nominal Gaji sudah ada'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Penggajian Pegawai';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['pegawai'] = $this->admin->getPegawai();
            $data['mst_gaji'] = $this->db->get('mst_gaji')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/data/mst_gaji', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'gol_gaji' => $this->input->post('gol_gaji', true),
                'nom_gaji' => $this->input->post('nom_gaji', true),
            ];
            $this->db->insert('mst_gaji', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/mst_gaji');
        }
    }

    public function get_gaji()
    {
        echo json_encode($this->admin->getEditGaji($_POST['id_gaji']));
    }

    public function edit_gaji()
    {
        $id_gaji = $this->input->post('id_gaji');
        $gol_gaji = $this->input->post('gol_gaji');
        $nom_gaji = $this->input->post('nom_gaji');
        $this->db->set('gol_gaji', $gol_gaji);
        $this->db->set('nom_gaji', $nom_gaji);
        $this->db->where('id_gaji', $id_gaji);
        $this->db->update('mst_gaji');
        $this->session->set_flashdata('message', 'Update data');
        redirect('admin/mst_gaji');
    }

    public function get_pegawai()
    {
        echo json_encode($this->admin->getGajiPegawai($_POST['id_pegawai']));
    }

    public function gaji_pegawai()
    {
        $this->form_validation->set_rules('pegawai_kd', 'Kode Pegawai', 'required|trim|is_unique[tb_gaji.pegawai_kd]', array(
            'is_unique' => 'Simpan Gagal !.. Kode Pegawai sudah ada'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Penggajian Pegawai';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['pegawai'] = $this->admin->getPegawai();
            $data['mst_gaji'] = $this->db->get('mst_gaji')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/data/mst_gaji', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'pegawai_kd' => $this->input->post('pegawai_kd', true),
                'nominal' => $this->input->post('nominal', true),
            ];
            $this->db->insert('tb_gaji', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/mst_gaji');
        }
    }

    public function get_tb_gaji()
    {
        echo json_encode($this->admin->getTbGajiPegawai($_POST['id_tb_gaji']));
    }

    public function edit_gaji_pegawai()
    {
        $id_tb_gaji = $this->input->post('id_tb_gaji');
        $nominal = $this->input->post('nominal');
        $this->db->set('nominal', $nominal);
        $this->db->where('id_tb_gaji', $id_tb_gaji);
        $this->db->update('tb_gaji');
        $this->session->set_flashdata('message', 'Update data');
        redirect('admin/mst_gaji');
    }

    public function penilaian()
    {
        $this->form_validation->set_rules('peg_kd', 'Kode Pegawai', 'required|trim|is_unique[tb_nilai.peg_kd]', array(
            'is_unique' => 'Simpan Gagal !.. Kode Pegawai sudah ada'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Penilaian Pegawai';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['pegawai'] = $this->admin->getPegawaiNilai();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/data/penilaian', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'peg_kd' => $this->input->post('peg_kd', true),
                'rapi' => $this->input->post('rapi', true),
                'tanggung' => $this->input->post('tanggung', true),
                'disiplin' => $this->input->post('disiplin', true),
                'inisiatif' => $this->input->post('inisiatif', true),
                'kesimpulan' => $this->input->post('kesimpulan', true),
            ];
            $this->db->insert('tb_nilai', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/penilaian');
        }
    }

    public function get_nilai()
    {
        echo json_encode($this->admin->getNilaiPegawai($_POST['id_nilai']));
    }

    public function edit_penilaian()
    {
        $id_nilai = $this->input->post('id_nilai');
        $rapi = $this->input->post('rapi');
        $tanggung = $this->input->post('tanggung');
        $disiplin = $this->input->post('disiplin');
        $inisiatif = $this->input->post('inisiatif');
        $kesimpulan = $this->input->post('kesimpulan');
        $this->db->set('rapi', $rapi);
        $this->db->set('tanggung', $tanggung);
        $this->db->set('disiplin', $disiplin);
        $this->db->set('inisiatif', $inisiatif);
        $this->db->set('kesimpulan', $kesimpulan);
        $this->db->where('id_nilai', $id_nilai);
        $this->db->update('tb_nilai');
        $this->session->set_flashdata('message', 'Update data');
        redirect('admin/penilaian');
    }

    public function prestasi()
    {
        $this->form_validation->set_rules('pegawai_kd', 'Kode Pegawai', 'required|trim|is_unique[tb_prestasi.pegawai_kd]', array(
            'is_unique' => 'Simpan Gagal !.. Kode Pegawai sudah ada'
        ));
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Prestasi Pegawai';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['pegawai'] = $this->admin->getPrestasiPegawai();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/data/prestasi', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'pegawai_kd' => $this->input->post('pegawai_kd', true),
                'tgl_prestasi' => $this->input->post('tgl_prestasi', true),
                'prestasi' => $this->input->post('prestasi', true),
            ];
            $this->db->insert('tb_prestasi', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/prestasi');
        }
    }

    public function get_prestasi()
    {
        echo json_encode($this->admin->getEditPrestasi($_POST['id_prestasi']));
    }

    public function edit_prestasi()
    {
        $id_prestasi = $this->input->post('id_prestasi');
        $tgl_prestasi = $this->input->post('tgl_prestasi');
        $prestasi = $this->input->post('prestasi');
        $this->db->set('tgl_prestasi', $tgl_prestasi);
        $this->db->set('prestasi', $prestasi);
        $this->db->where('id_prestasi', $id_prestasi);
        $this->db->update('tb_prestasi');
        $this->session->set_flashdata('message', 'Update data');
        redirect('admin/prestasi');
    }

    public function insentif()
    {
        $this->form_validation->set_rules('pegawai_kd', 'Kode Pegawai', 'required|trim|is_unique[tb_insentif.pegawai_kd]', array(
            'is_unique' => 'Simpan Gagal !.. Kode Pegawai sudah ada'
        ));
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Insentif dan Bonus Pegawai';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['pegawai'] = $this->admin->getInsentifPegawai();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/data/insentif', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'pegawai_kd' => $this->input->post('pegawai_kd', true),
                'tgl_insentif' => $this->input->post('tgl_insentif', true),
                'nama_insentif' => $this->input->post('nama_insentif', true),
                'insentif' => $this->input->post('insentif', true),
            ];
            $this->db->insert('tb_insentif', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/insentif');
        }
    }

    public function get_insentif()
    {
        echo json_encode($this->admin->getEditInsentif($_POST['id_insentif']));
    }

    public function edit_insentif()
    {
        $id_insentif = $this->input->post('id_insentif');
        $tgl_insentif = $this->input->post('tgl_insentif');
        $nama_insentif = $this->input->post('nama_insentif');
        $insentif = $this->input->post('insentif');
        $this->db->set('tgl_insentif', $tgl_insentif);
        $this->db->set('nama_insentif', $nama_insentif);
        $this->db->set('insentif', $insentif);
        $this->db->where('id_insentif', $id_insentif);
        $this->db->update('tb_insentif');
        $this->session->set_flashdata('message', 'Update data');
        redirect('admin/insentif');
    }

    public function info()
    {
        $this->form_validation->set_rules('tgl_info', 'Tanggal Info', 'required|trim');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Info Administrator';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['info'] = $this->db->get('tb_info')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/data/info', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'tgl_info' => $this->input->post('tgl_info', true),
                'info' => $this->input->post('info', true),
                'kirim' => 1
            ];
            $this->db->insert('tb_info', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/info');
        }
    }

    public function get_info()
    {
        echo json_encode($this->admin->getEditInfo($_POST['id_info']));
    }

    public function edit_info()
    {
        $id_info = $this->input->post('id_info');
        $tgl_info = $this->input->post('tgl_info');
        $info = $this->input->post('info');
        $this->db->set('tgl_info', $tgl_info);
        $this->db->set('info', $info);
        $this->db->where('id_info', $id_info);
        $this->db->update('tb_info');
        $this->session->set_flashdata('message', 'Update data');
        redirect('admin/info');
    }

    public function kirim_info()
    {
        $id_info = $this->input->post('id_info');
        $kirim = 0;
        $this->db->set('kirim', $kirim);
        $this->db->where('id_info', $id_info);
        $this->db->update('tb_info');
        $this->session->set_flashdata('message', 'Kirim data');
        redirect('admin/info');
    }

    public function berita()
    {
        $data['title'] = 'Berita & Informasi Staf';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['berita'] = $this->admin->getBerita();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/data/berita', $data);
        $this->load->view('templates/footer');
    }

    public function list_cuti()
    {
        $this->form_validation->set_rules('kd_pegawai', 'Kode Pegawai', 'required|trim');
        $this->form_validation->set_rules('jml_cuti', 'Ambil cuti', 'required|trim|numeric|greater_than[0]');
        $this->form_validation->set_rules('sisa_cuti', 'Sisa Cuti', 'required|trim|greater_than[-1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'List Cuti Staf';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['list_cuti'] = $this->admin->getCutiStaf();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/list_cuti', $data);
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
            redirect('admin/list_cuti');
        }
    }

    public function get_cuti()
    {
        echo json_encode($this->admin->getEditCuti($_POST['id_cuti']));
    }

    public function edit_cuti()
    {
        $this->form_validation->set_rules('is_approve', 'Konfirmasi', 'required|trim');

        if ($this->form_validation->run() == false) {

            $data['title'] = 'List Cuti';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['list_cuti'] = $this->admin->getCutiStaf();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/list_cuti', $data);
            $this->load->view('templates/footer');
        } else {
            $id_cuti = $this->input->post('id_cuti');
            $is_approve = $this->input->post('is_approve');
            $alasan_ditolak = $this->input->post('alasan_ditolak');
            $atasan = $this->input->post('atasan');
            $this->db->set('is_approve', $is_approve);
            $this->db->set('alasan_ditolak', $alasan_ditolak);
            $this->db->set('atasan', $atasan);
            $this->db->where('id_cuti', $id_cuti);
            $this->db->update('tb_cuti');
            $this->session->set_flashdata('message', 'Konfirmasi data');
            redirect('admin/list_cuti');
        }
    }

    public function list_cuti_lain()
    {
        $this->form_validation->set_rules('kd_pegawai', 'Kode Pegawai', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'List Cuti Lain Staf';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['cuti_lain'] = $this->admin->getCutiLain();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/list_cuti_lain', $data);
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
            redirect('admin/list_cuti_lain');
        }
    }

    public function get_cuti_lain()
    {
        echo json_encode($this->admin->getEditCutiLain($_POST['id_cuti_lain']));
    }

    public function edit_cuti_lain()
    {
        $id_cuti_lain = $this->input->post('id_cuti_lain', true);
        $alasan_ditolak = $this->input->post('alasan_ditolak', true);
        $atasan = $this->input->post('atasan', true);
        $is_approve = $this->input->post('is_approve', true);
        $this->db->set('alasan_ditolak', $alasan_ditolak);
        $this->db->set('atasan', $atasan);
        $this->db->set('is_approve', $is_approve);
        $this->db->where('id_cuti_lain', $id_cuti_lain);
        $this->db->update('tb_cuti_lain');
        $this->session->set_flashdata('message', 'Konfirmasi data');
        redirect('admin/list_cuti_lain');
    }

    public function reset_cuti()
    {
        $data['title'] = 'Reset Cuti Staf';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['list_cuti'] = $this->admin->getCutiStafNol();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/reset_cuti', $data);
        $this->load->view('templates/footer');
    }

    public function reset()
    {
        $kd_pegawai = $this->input->post('kd_pegawai', true);
        $this->db->where('kd_pegawai', $kd_pegawai);
        $this->db->delete('tb_cuti');
        $this->session->set_flashdata('message', 'Reset cuti');
        redirect('admin/reset_cuti');
    }

    public function list_kontrak()
    {
        $this->form_validation->set_rules('title', 'Jenis kontrak', 'required|trim|is_unique[mst_kontrak.title]', array(
            'is_unique' => 'Simpan Gagal !.. Jenis Kontrak sudah ada'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Master Jenis Kontrak';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['kode_kontrak'] = $this->admin->getKodeKontrak();
            $data['mst_kontrak'] = $this->db->get('mst_kontrak')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/list_kontrak', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_kontrak' => $this->input->post('kode_kontrak', true),
                'title' => $this->input->post('title', true),
                'status' => true,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('mst_kontrak', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/list_kontrak');
        }
    }

    public function edit_kontrak()
    {
        echo json_encode($this->admin->getEditkontrak($_POST['id_kontrak']));
    }

    public function proses_edit_kontrak()
    {
        $id_kontrak = $this->input->post('id_kontrak');
        $title = $this->input->post('title');
        $this->db->set('title', $title);
        $this->db->set('date_updated', date("Y-m-d H:i:s"));
        $this->db->where('id_kontrak', $id_kontrak);
        $this->db->update('mst_kontrak');
        $this->session->set_flashdata('message', 'Update data');
        redirect('admin/list_kontrak');
    }

    public function del_kontrak($id_kontrak)
    {
        $this->db->where('id_kontrak', $id_kontrak);
        $this->db->delete('mst_kontrak');
        $this->session->set_flashdata('message', 'Hapus kontrak');
        redirect('admin/list_kontrak');
    }

    
    public function list_jenis_payslip()
    {
        $this->form_validation->set_rules('title', 'Jenis payslip', 'required|trim|is_unique[mst_jenis_payslip.title]', array(
            'is_unique' => 'Simpan Gagal !.. Jenis payslip sudah ada'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Master Jenis Payslip';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['kode_jenis_payslip'] = $this->admin->getKodejenisPayslip();
            $data['mst_jenis_payslip'] = $this->db->get('mst_jenis_payslip')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/list_jenis_payslip', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_jenis_payslip' => $this->input->post('kode_jenis_payslip', true),
                'title' => $this->input->post('title', true),
                'status' => true,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('mst_jenis_payslip', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/list_jenis_payslip');
        }
    }

    public function edit_jenis_payslip()
    {
        echo json_encode($this->admin->getEditjenisPayslip($_POST['id_jenis_payslip']));
    }

    public function proses_edit_jenis_payslip()
    {
        $id_jenis_payslip = $this->input->post('id_jenis_payslip');
        $title = $this->input->post('title');
        $this->db->set('title', $title);
        $this->db->set('date_updated', date("Y-m-d H:i:s"));
        $this->db->where('id_jenis_payslip', $id_jenis_payslip);
        $this->db->update('mst_jenis_payslip');
        $this->session->set_flashdata('message', 'Update data');
        redirect('admin/list_jenis_payslip');
    }

    public function del_jenis_payslip($id_jenis_payslip)
    {
        $this->db->where('id_jenis_payslip', $id_jenis_payslip);
        $this->db->delete('mst_jenis_payslip');
        $this->session->set_flashdata('message', 'Hapus jenis payslip');
        redirect('admin/list_jenis_payslip');
    }

    public function add_set_gaji_salary($kode_pegawai)
    {
        $this->form_validation->set_rules('bulan_tahun', 'Bulan Tahun', 'required|trim');
        $this->form_validation->set_rules('id_jenis_payslip', 'Jenis Payslip', 'required|trim');
        $this->form_validation->set_rules('amount', 'Jumlah', 'required|trim');
        
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Set Gaji';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['employee'] = $this->db->get_where('mst_pegawai',['kode_pegawai' => $kode_pegawai])->row_array();
            $data['salary'] = $this->admin->getSalaryByKodePegawai($kode_pegawai)->result_array();
            $data['allowance'] = $this->admin->getAllowanceByKodePegawai($kode_pegawai)->result_array();
            $data['benefit'] = $this->admin->getBenefitByKodePegawai($kode_pegawai)->result_array();
            $data['deduction'] = $this->admin->getDeductionByKodePegawai($kode_pegawai)->result_array();
            $data['reimbursement'] = $this->admin->getReimbursementByKodePegawai($kode_pegawai)->result_array();
            $data['mst_jenis_payslip'] = $this->db->get_where('mst_jenis_payslip',['status' => 1])->result_array();
            $data['mst_allowance'] = $this->db->get_where('mst_allowance',['status' => 1])->result_array();
            $data['mst_benefit'] = $this->db->get_where('mst_benefit',['status' => 1])->result_array();
            $data['mst_deduction'] = $this->db->get_where('mst_deduction',['status' => 1])->result_array();
            $data['mst_reimbursement'] = $this->db->get_where('mst_reimbursement',['status' => 1])->result_array();
            $data['kode_pegawai'] = $kode_pegawai;
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/add_set_gaji', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'bulan_tahun' => $this->input->post('bulan_tahun', true),
                'id_jenis_payslip' => $this->input->post('id_jenis_payslip', true),
                'amount' => $this->input->post('amount', true),
                'date_created' => date('Y-m-d H:i:s'),
                'date_updated' => date('Y-m-d H:i:s'),
                'kd_pegawai' => $this->input->post('kd_pegawai', true)
            ];
            $this->db->insert('tb_salary', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/add_set_gaji/' . $kode_pegawai);
        }
    }

    public function edit_set_gaji_salary()
    {
        echo json_encode($this->admin->getEditSalary($_POST['id_salary']));
    }

    public function proses_edit_set_gaji_salary($kode_pegawai)
    {
        $id_salary = $this->input->post('id_salary');
        $id_jenis_payslip = $this->input->post('id_jenis_payslip');
        $bulan_tahun = $this->input->post('bulan_tahun');
        $amount = $this->input->post('amount');
        $this->db->set('id_jenis_payslip', $id_jenis_payslip);
        $this->db->set('bulan_tahun', $bulan_tahun);
        $this->db->set('amount', $amount);
        $this->db->set('date_updated', date("Y-m-d H:i:s"));
        $this->db->where('id_salary', $id_salary);
        $this->db->update('tb_salary');
        $this->session->set_flashdata('message', 'Update salary');
        redirect('admin/add_set_gaji/'.$kode_pegawai);
    }

    public function del_set_gaji_salary($id_salary, $kode_pegawai)
    {
        $this->db->where('id_salary', $id_salary);
        $this->db->where('kd_pegawai', $kode_pegawai);
        $this->db->delete('tb_salary');
        $this->session->set_flashdata('message', 'Hapus Salary');
        redirect('admin/add_set_gaji/'.$kode_pegawai);
    }

    public function add_set_gaji($kode_pegawai)
    {
        $this->form_validation->set_rules('bulan_tahun', 'Bulan Tahun', 'required|trim');
        $this->form_validation->set_rules('id_mst_allowance', 'Allowance', 'required|trim');
        $this->form_validation->set_rules('amount', 'Jumlah', 'required|trim');
        
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Set Gaji';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['employee'] = $this->db->get_where('mst_pegawai',['kode_pegawai' => $kode_pegawai])->row_array();
            $data['salary'] = $this->admin->getSalaryByKodePegawai($kode_pegawai)->result_array();
            $data['allowance'] = $this->admin->getAllowanceByKodePegawai($kode_pegawai)->result_array();
            $data['benefit'] = $this->admin->getBenefitByKodePegawai($kode_pegawai)->result_array();
            $data['deduction'] = $this->admin->getDeductionByKodePegawai($kode_pegawai)->result_array();
            $data['reimbursement'] = $this->admin->getReimbursementByKodePegawai($kode_pegawai)->result_array();
            $data['mst_jenis_payslip'] = $this->db->get_where('mst_jenis_payslip',['status' => 1])->result_array();
            $data['mst_allowance'] = $this->db->get_where('mst_allowance',['status' => 1])->result_array();
            $data['mst_benefit'] = $this->db->get_where('mst_benefit',['status' => 1])->result_array();
            $data['mst_deduction'] = $this->db->get_where('mst_deduction',['status' => 1])->result_array();
            $data['mst_reimbursement'] = $this->db->get_where('mst_reimbursement',['status' => 1])->result_array();
            $data['kode_pegawai'] = $kode_pegawai;
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/add_set_gaji', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'bulan_tahun' => $this->input->post('bulan_tahun', true),
                'id_mst_allowance' => $this->input->post('id_mst_allowance', true),
                'amount' => $this->input->post('amount', true),
                'date_created' => date('Y-m-d H:i:s'),
                'date_updated' => date('Y-m-d H:i:s'),
                'kd_pegawai' => $this->input->post('kd_pegawai', true)
            ];
            $this->db->insert('tb_salary', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/add_set_gaji/' . $kode_pegawai);
        }
    }

    public function del_set_gaji_allowance($id_allowance, $kode_pegawai)
    {
        $this->db->where('id_allowance', $id_allowance);
        $this->db->where('kd_pegawai', $kode_pegawai);
        $this->db->delete('tb_allowance');
        $this->session->set_flashdata('message', 'Hapus Allowance');
        redirect('admin/add_set_gaji/'.$kode_pegawai);
    }

    public function edit_set_gaji_allowance()
    {
        echo json_encode($this->admin->getEditAllowance($_POST['id_allowance']));
    }

    public function proses_edit_set_gaji_allowance($kode_pegawai)
    {
        $id_allowance = $this->input->post('id_allowance');
        $id_mst_allowance = $this->input->post('id_mst_allowance');
        $bulan_tahun = $this->input->post('bulan_tahun');
        $amount = $this->input->post('amount');
        $this->db->set('id_mst_allowance', $id_mst_allowance);
        $this->db->set('bulan_tahun', $bulan_tahun);
        $this->db->set('amount', $amount);
        $this->db->set('date_updated', date("Y-m-d H:i:s"));
        $this->db->where('id_allowance', $id_allowance);
        $this->db->update('tb_allowance');
        $this->session->set_flashdata('message', 'Update allowance');
        redirect('admin/add_set_gaji/'.$kode_pegawai);
    }

    public function add_set_gaji_benefit($kode_pegawai)
    {
        $this->form_validation->set_rules('bulan_tahun', 'Bulan Tahun', 'required|trim');
        $this->form_validation->set_rules('id_mst_benefit', 'Nama', 'required|trim');
        $this->form_validation->set_rules('amount', 'Jumlah', 'required|trim');
        
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Set Gaji';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['employee'] = $this->db->get_where('mst_pegawai',['kode_pegawai' => $kode_pegawai])->row_array();
            $data['salary'] = $this->admin->getSalaryByKodePegawai($kode_pegawai)->result_array();
            $data['allowance'] = $this->admin->getAllowanceByKodePegawai($kode_pegawai)->result_array();
            $data['benefit'] = $this->admin->getBenefitByKodePegawai($kode_pegawai)->result_array();
            $data['deduction'] = $this->admin->getDeductionByKodePegawai($kode_pegawai)->result_array();
            $data['reimbursement'] = $this->admin->getReimbursementByKodePegawai($kode_pegawai)->result_array();
            $data['mst_jenis_payslip'] = $this->db->get_where('mst_jenis_payslip',['status' => 1])->result_array();
            $data['mst_allowance'] = $this->db->get_where('mst_allowance',['status' => 1])->result_array();
            $data['mst_benefit'] = $this->db->get_where('mst_benefit',['status' => 1])->result_array();
            $data['mst_deduction'] = $this->db->get_where('mst_deduction',['status' => 1])->result_array();
            $data['mst_reimbursement'] = $this->db->get_where('mst_reimbursement',['status' => 1])->result_array();
            $data['kode_pegawai'] = $kode_pegawai;
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/add_set_gaji', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'bulan_tahun' => $this->input->post('bulan_tahun', true),
                'id_mst_benefit' => $this->input->post('id_mst_benefit', true),
                'amount' => $this->input->post('amount', true),
                'date_created' => date('Y-m-d H:i:s'),
                'date_updated' => date('Y-m-d H:i:s'),
                'kd_pegawai' => $this->input->post('kd_pegawai', true)
            ];
            $this->db->insert('tb_benefit', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/add_set_gaji/' . $kode_pegawai);
        }
    }

    public function del_set_gaji_benefit($id_benefit, $kode_pegawai)
    {
        $this->db->where('id_benefit', $id_benefit);
        $this->db->where('kd_pegawai', $kode_pegawai);
        $this->db->delete('tb_benefit');
        $this->session->set_flashdata('message', 'Hapus Benefit');
        redirect('admin/add_set_gaji/'.$kode_pegawai);
    }

    public function edit_set_gaji_benefit()
    {
        echo json_encode($this->admin->getEditBenefit($_POST['id_benefit']));
    }

    public function proses_edit_set_gaji_benefit($kode_pegawai)
    {
        $id_benefit = $this->input->post('id_benefit');
        $id_mst_benefit = $this->input->post('id_mst_benefit');
        $bulan_tahun = $this->input->post('bulan_tahun');
        $amount = $this->input->post('amount');
        $this->db->set('id_mst_benefit', $id_mst_benefit);
        $this->db->set('bulan_tahun', $bulan_tahun);
        $this->db->set('amount', $amount);
        $this->db->set('date_updated', date("Y-m-d H:i:s"));
        $this->db->where('id_benefit', $id_benefit);
        $this->db->update('tb_benefit');
        $this->session->set_flashdata('message', 'Update Benefit');
        redirect('admin/add_set_gaji/'.$kode_pegawai);
    }

    public function add_set_gaji_deduction($kode_pegawai)
    {
        $this->form_validation->set_rules('bulan_tahun', 'Bulan Tahun', 'required|trim');
        $this->form_validation->set_rules('id_mst_deduction', 'Nama', 'required|trim');
        $this->form_validation->set_rules('amount', 'Jumlah', 'required|trim');
        
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Set Gaji';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['employee'] = $this->db->get_where('mst_pegawai',['kode_pegawai' => $kode_pegawai])->row_array();
            $data['salary'] = $this->admin->getSalaryByKodePegawai($kode_pegawai)->result_array();
            $data['allowance'] = $this->admin->getAllowanceByKodePegawai($kode_pegawai)->result_array();
            $data['benefit'] = $this->admin->getBenefitByKodePegawai($kode_pegawai)->result_array();
            $data['deduction'] = $this->admin->getDeductionByKodePegawai($kode_pegawai)->result_array();
            $data['reimbursement'] = $this->admin->getReimbursementByKodePegawai($kode_pegawai)->result_array();
            $data['mst_jenis_payslip'] = $this->db->get_where('mst_jenis_payslip',['status' => 1])->result_array();
            $data['mst_allowance'] = $this->db->get_where('mst_allowance',['status' => 1])->result_array();
            $data['mst_benefit'] = $this->db->get_where('mst_benefit',['status' => 1])->result_array();
            $data['mst_deduction'] = $this->db->get_where('mst_deduction',['status' => 1])->result_array();
            $data['mst_reimbursement'] = $this->db->get_where('mst_reimbursement',['status' => 1])->result_array();
            $data['kode_pegawai'] = $kode_pegawai;
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/add_set_gaji', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'bulan_tahun' => $this->input->post('bulan_tahun', true),
                'id_mst_deduction' => $this->input->post('id_mst_deduction', true),
                'amount' => $this->input->post('amount', true),
                'date_created' => date('Y-m-d H:i:s'),
                'date_updated' => date('Y-m-d H:i:s'),
                'kd_pegawai' => $this->input->post('kd_pegawai', true)
            ];
            $this->db->insert('tb_deduction', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/add_set_gaji/' . $kode_pegawai);
        }
    }

    public function del_set_gaji_deduction($id_deduction, $kode_pegawai)
    {
        $this->db->where('id_deduction', $id_deduction);
        $this->db->where('kd_pegawai', $kode_pegawai);
        $this->db->delete('tb_deduction');
        $this->session->set_flashdata('message', 'Hapus deduction');
        redirect('admin/add_set_gaji/'.$kode_pegawai);
    }

    public function edit_set_gaji_deduction()
    {
        echo json_encode($this->admin->getEditDeduction($_POST['id_deduction']));
    }

    public function proses_edit_set_gaji_deduction($kode_pegawai)
    {
        $id_deduction = $this->input->post('id_deduction');
        $id_mst_deduction = $this->input->post('id_mst_deduction');
        $bulan_tahun = $this->input->post('bulan_tahun');
        $amount = $this->input->post('amount');
        $this->db->set('id_mst_deduction', $id_mst_deduction);
        $this->db->set('bulan_tahun', $bulan_tahun);
        $this->db->set('amount', $amount);
        $this->db->set('date_updated', date("Y-m-d H:i:s"));
        $this->db->where('id_deduction', $id_deduction);
        $this->db->update('tb_deduction');
        $this->session->set_flashdata('message', 'Update Deduction');
        redirect('admin/add_set_gaji/'.$kode_pegawai);
    }

    public function add_set_gaji_reimbursement($kode_pegawai)
    {
        $this->form_validation->set_rules('bulan_tahun', 'Bulan Tahun', 'required|trim');
        $this->form_validation->set_rules('id_mst_reimbursement', 'Nama', 'required|trim');
        $this->form_validation->set_rules('amount', 'Jumlah', 'required|trim');
        
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Set Gaji';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['employee'] = $this->db->get_where('mst_pegawai',['kode_pegawai' => $kode_pegawai])->row_array();
            $data['salary'] = $this->admin->getSalaryByKodePegawai($kode_pegawai)->result_array();
            $data['allowance'] = $this->admin->getAllowanceByKodePegawai($kode_pegawai)->result_array();
            $data['benefit'] = $this->admin->getBenefitByKodePegawai($kode_pegawai)->result_array();
            $data['deduction'] = $this->admin->getDeductionByKodePegawai($kode_pegawai)->result_array();
            $data['reimbursement'] = $this->admin->getReimbursementByKodePegawai($kode_pegawai)->result_array();
            $data['mst_jenis_payslip'] = $this->db->get_where('mst_jenis_payslip',['status' => 1])->result_array();
            $data['mst_allowance'] = $this->db->get_where('mst_allowance',['status' => 1])->result_array();
            $data['mst_benefit'] = $this->db->get_where('mst_benefit',['status' => 1])->result_array();
            $data['mst_deduction'] = $this->db->get_where('mst_deduction',['status' => 1])->result_array();
            $data['mst_reimbursement'] = $this->db->get_where('mst_reimbursement',['status' => 1])->result_array();
            $data['kode_pegawai'] = $kode_pegawai;
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/add_set_gaji', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'bulan_tahun' => $this->input->post('bulan_tahun', true),
                'id_mst_reimbursement' => $this->input->post('id_mst_reimbursement', true),
                'amount' => $this->input->post('amount', true),
                'date_created' => date('Y-m-d H:i:s'),
                'date_updated' => date('Y-m-d H:i:s'),
                'kd_pegawai' => $this->input->post('kd_pegawai', true)
            ];
            $this->db->insert('tb_reimbursement', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/add_set_gaji/' . $kode_pegawai);
        }
    }

    public function del_set_gaji_reimbursement($id_reimbursement, $kode_pegawai)
    {
        $this->db->where('id_reimbursement', $id_reimbursement);
        $this->db->where('kd_pegawai', $kode_pegawai);
        $this->db->delete('tb_reimbursement');
        $this->session->set_flashdata('message', 'Hapus reimbursement');
        redirect('admin/add_set_gaji/'.$kode_pegawai);
    }

    public function edit_set_gaji_reimbursement()
    {
        echo json_encode($this->admin->getEditReimbursement($_POST['id_reimbursement']));
    }

    public function proses_edit_set_gaji_reimbursement($kode_pegawai)
    {
        $id_reimbursement = $this->input->post('id_reimbursement');
        $id_mst_reimbursement = $this->input->post('id_mst_reimbursement');
        $bulan_tahun = $this->input->post('bulan_tahun');
        $amount = $this->input->post('amount');
        $this->db->set('id_mst_reimbursement', $id_mst_reimbursement);
        $this->db->set('bulan_tahun', $bulan_tahun);
        $this->db->set('amount', $amount);
        $this->db->set('date_updated', date("Y-m-d H:i:s"));
        $this->db->where('id_reimbursement', $id_reimbursement);
        $this->db->update('tb_reimbursement');
        $this->session->set_flashdata('message', 'Update Reimbursement');
        redirect('admin/add_set_gaji/'.$kode_pegawai);
    }

    public function list_mst_allowance()
    {
        $this->form_validation->set_rules('title', 'Nama allowance', 'required|trim|is_unique[mst_allowance.title]', array(
            'is_unique' => 'Simpan Gagal !.. Nama allowance sudah ada'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Master Allowance';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['kode_mst_allowance'] = $this->admin->getKodeMstAllowance();
            $data['mst_allowance'] = $this->db->get('mst_allowance')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/list_allowance', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_mst_allowance' => $this->input->post('kode_mst_allowance', true),
                'title' => $this->input->post('title', true),
                'status' => true,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('mst_allowance', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/list_mst_allowance');
        }
    }

    public function edit_mst_allowance()
    {
        echo json_encode($this->admin->getEditMstAllowance($_POST['id_mst_allowance']));
    }

    public function proses_edit_mst_allowance()
    {
        $id_mst_allowance = $this->input->post('id_mst_allowance');
        $title = $this->input->post('title');
        $this->db->set('title', $title);
        $this->db->set('date_updated', date("Y-m-d H:i:s"));
        $this->db->where('id_mst_allowance', $id_mst_allowance);
        $this->db->update('mst_allowance');
        $this->session->set_flashdata('message', 'Update data');
        redirect('admin/list_mst_allowance');
    }

    public function del_mst_allowance($id_mst_allowance)
    {
        $this->db->where('id_mst_allowance', $id_mst_allowance);
        $this->db->delete('mst_allowance');
        $this->session->set_flashdata('message', 'Hapus Mst Allowance');
        redirect('admin/list_mst_allowance');
    }

    public function list_mst_benefit()
    {
        $this->form_validation->set_rules('title', 'Nama allowance', 'required|trim|is_unique[mst_benefit.title]', array(
            'is_unique' => 'Simpan Gagal !.. Nama allowance sudah ada'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Master Benefit';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['kode_mst_benefit'] = $this->admin->getKodeMstBenefit();
            $data['mst_benefit'] = $this->db->get('mst_benefit')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/list_benefit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_mst_benefit' => $this->input->post('kode_mst_benefit', true),
                'title' => $this->input->post('title', true),
                'status' => true,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('mst_benefit', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/list_mst_benefit');
        }
    }

    public function edit_mst_benefit()
    {
        echo json_encode($this->admin->getEditMstBenefit($_POST['id_mst_benefit']));
    }

    public function proses_edit_mst_benefit()
    {
        $id_mst_benefit = $this->input->post('id_mst_benefit');
        $title = $this->input->post('title');
        $this->db->set('title', $title);
        $this->db->set('date_updated', date("Y-m-d H:i:s"));
        $this->db->where('id_mst_benefit', $id_mst_benefit);
        $this->db->update('mst_benefit');
        $this->session->set_flashdata('message', 'Update data benefit');
        redirect('admin/list_mst_benefit');
    }

    public function del_mst_benefit($id_mst_benefit)
    {
        $this->db->where('id_mst_benefit', $id_mst_benefit);
        $this->db->delete('mst_benefit');
        $this->session->set_flashdata('message', 'Hapus Mst Benefit');
        redirect('admin/list_mst_benefit');
    }

    public function list_mst_deduction()
    {
        $this->form_validation->set_rules('title', 'Nama allowance', 'required|trim|is_unique[mst_deduction.title]', array(
            'is_unique' => 'Simpan Gagal !.. Nama allowance sudah ada'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Master deduction';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['kode_mst_deduction'] = $this->admin->getKodeMstDeduction();
            $data['mst_deduction'] = $this->db->get('mst_deduction')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/list_deduction', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_mst_deduction' => $this->input->post('kode_mst_deduction', true),
                'title' => $this->input->post('title', true),
                'status' => true,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('mst_deduction', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/list_mst_deduction');
        }
    }

    public function edit_mst_deduction()
    {
        echo json_encode($this->admin->getEditMstDeduction($_POST['id_mst_deduction']));
    }

    public function proses_edit_mst_deduction()
    {
        $id_mst_deduction = $this->input->post('id_mst_deduction');
        $title = $this->input->post('title');
        $this->db->set('title', $title);
        $this->db->set('date_updated', date("Y-m-d H:i:s"));
        $this->db->where('id_mst_deduction', $id_mst_deduction);
        $this->db->update('mst_deduction');
        $this->session->set_flashdata('message', 'Update data deduction');
        redirect('admin/list_mst_deduction');
    }

    public function del_mst_deduction($id_mst_deduction)
    {
        $this->db->where('id_mst_deduction', $id_mst_deduction);
        $this->db->delete('mst_deduction');
        $this->session->set_flashdata('message', 'Hapus Mst deduction');
        redirect('admin/list_mst_deduction');
    }

    public function list_mst_reimbursement()
    {
        $this->form_validation->set_rules('title', 'Nama allowance', 'required|trim|is_unique[mst_reimbursement.title]', array(
            'is_unique' => 'Simpan Gagal !.. Nama allowance sudah ada'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Master reimbursement';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['kode_mst_reimbursement'] = $this->admin->getKodeMstReimbursement();
            $data['mst_reimbursement'] = $this->db->get('mst_reimbursement')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/list_reimbursement', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_mst_reimbursement' => $this->input->post('kode_mst_reimbursement', true),
                'title' => $this->input->post('title', true),
                'status' => true,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('mst_reimbursement', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/list_mst_reimbursement');
        }
    }

    public function edit_mst_reimbursement()
    {
        echo json_encode($this->admin->getEditMstReimbursement($_POST['id_mst_reimbursement']));
    }

    public function proses_edit_mst_reimbursement()
    {
        $id_mst_reimbursement = $this->input->post('id_mst_reimbursement');
        $title = $this->input->post('title');
        $this->db->set('title', $title);
        $this->db->set('date_updated', date("Y-m-d H:i:s"));
        $this->db->where('id_mst_reimbursement', $id_mst_reimbursement);
        $this->db->update('mst_reimbursement');
        $this->session->set_flashdata('message', 'Update data reimbursement');
        redirect('admin/list_mst_reimbursement');
    }

    public function del_mst_reimbursement($id_mst_reimbursement)
    {
        $this->db->where('id_mst_reimbursement', $id_mst_reimbursement);
        $this->db->delete('mst_reimbursement');
        $this->session->set_flashdata('message', 'Hapus Mst reimbursement');
        redirect('admin/list_mst_reimbursement');
    }

    public function new_payroll()
    {
        $this->form_validation->set_rules('bulan_tahun', 'Bulan Tahun', 'required|trim|is_unique[tb_payroll.bulan_tahun]', array(
            'is_unique' => 'Simpan Gagal !.. Payroll bulan dan tahun sudah ada'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Generate Payroll';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['payroll'] = $this->db->get('tb_payroll')->result_array();
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/new_payroll', $data);
            $this->load->view('templates/footer');
        } else {
            $insert_array = array();
            $item_array = array();
            $data = [
                'bulan_tahun' => $this->input->post('bulan_tahun'),
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s"),
                'id_user' => $this->session->userdata('id_user')
            ];
            $this->db->insert('tb_payroll', $data);

            $data_pegawai = $this->db->get_where('mst_pegawai',['pegawai_active' => true]);
            if($data_pegawai->num_rows() > 0) {
                $data_pegawai_array = $data_pegawai->result_array();
                foreach ($data_pegawai_array as $key => $value) {
                    $salary_pegawai = $this->admin->getLastSalaryByKodePegawai($value['kode_pegawai'])->row_array();
                    $allowance_pegawai = $this->admin->getAllowanceAmountByKodePegawai($value['kode_pegawai'], $this->input->post('bulan_tahun'))->row_array();
                    $benefit_pegawai = $this->admin->getBenefitAmountByKodePegawai($value['kode_pegawai'], $this->input->post('bulan_tahun'))->row_array();
                    $reimbursement_pegawai = $this->admin->getReimbursementAmountByKodePegawai($value['kode_pegawai'], $this->input->post('bulan_tahun'))->row_array();
                    $deduction_pegawai = $this->admin->getDeductionAmountByKodePegawai($value['kode_pegawai'], $this->input->post('bulan_tahun'))->row_array();
                    
                    $bulan_tahun = $this->input->post('bulan_tahun');
                    $salary_amount_pegawai = $salary_pegawai['amount'];
                    $jenis_payslip_pegawai = $salary_pegawai['jenis_payslip'];
                    $amount_allowance =  $allowance_pegawai['amount'];
                    $amount_benefit =  $benefit_pegawai['amount'];
                    $amount_reimbursement =  $reimbursement_pegawai['amount'];
                    $amount_deduction =  $deduction_pegawai['amount'];

                    $amount_total_allowance = $amount_allowance + $amount_benefit + $amount_reimbursement;
                    $amount_total_net_salary = ($salary_amount_pegawai + $amount_total_allowance) - $amount_deduction; 

                    $insert_array[] = array(
                        'bulan_tahun' => $bulan_tahun,
                        'kode_pegawai' => $value['kode_pegawai'],
                        'jenis_payslip' => $jenis_payslip_pegawai,
                        'amount_salary' => $salary_amount_pegawai,
                        'amount_total_allowance' => $amount_allowance + $amount_benefit + $amount_reimbursement,
                        'amount_total_deduction' => $amount_deduction,
                        'net_salary' => $amount_total_net_salary,
                        'date_created' => date('Y-m-d H:i:s'),
                        'date_updated' => date('Y-m-d H:i:s'),
                    );
                }
                $this->db->insert_batch('tb_payroll_employee',$insert_array);
            }
            $this->session->set_flashdata('message', 'Generate payroll ' . $this->input->post('bulan_tahun'));
            redirect('admin/new_payroll');
        }
    }

    public function del_new_payroll($id_payroll)
    {
        $dt_payroll = $this->db->get_where('tb_payroll', ['id_payroll' => $id_payroll])->row_array();
        $bulan_tahun = $dt_payroll['bulan_tahun'];

        $this->db->where('bulan_tahun', $bulan_tahun);
        $this->db->delete('tb_payroll_employee');

        $this->db->where('id_payroll', $id_payroll);
        $this->db->delete('tb_payroll');
        $this->session->set_flashdata('message', 'Hapus Payroll');
        redirect('admin/new_payroll');
    }

    public function history_payroll()
    {

        $this->form_validation->set_rules('bulan_tahun', 'Bulan Tahun', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Payroll Pegawai';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['payroll'] = $this->db->get('tb_payroll')->result_array();
            $data['payroll_employee'] = $this->admin->getAllPayrollEmployee()->result_array();
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/history_payroll', $data);
            $this->load->view('templates/footer');
        } else {
            $data['title'] = 'Payroll Pegawai';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['payroll'] = $this->db->get('tb_payroll')->result_array();
            $data['payroll_employee'] = $this->admin->getAllPayrollEmployeeByBulanTahun($this->input->post('bulan_tahun'))->result_array();
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/history_payroll', $data);
            $this->load->view('templates/footer');
        }
        
    }

    public function payslip($pegawai,$periode)
    {

        $this->form_validation->set_rules('bulan_tahun', 'Bulan Tahun', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Slip Gaji Pegawai';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['payroll'] = $this->db->get('tb_payroll')->result_array();
            $data['payroll_employee'] = $this->admin->getAllPayrollEmployee()->result_array();
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/slippay', $data);
            $this->load->view('templates/footer');
        } else {
            $data['title'] = 'Payroll Pegawai';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['payroll'] = $this->db->get('tb_payroll')->result_array();
            $data['payroll_employee'] = $this->admin->getAllPayrollEmployeeByBulanTahun($this->input->post('bulan_tahun'))->result_array();
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/pegawai/slippay', $data);
            $this->load->view('templates/footer');
        }
        
    }

	function form($id=null){
        $data['title'] = 'Konfigurasi Perusahaan';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
		$setup=GetAll('tb_setup_company')->num_rows();
		$id=($setup==0 ? NULL : 1);
		
		if($id!=NULL){
			$filter=array('id'=>'where/'.$id);
			$data['type']='Edit';
		$data['list']=GetAll('tb_setup_company',$filter);
		}
		else{
			$data['type']='New';
		}
		//End Global
		
		//Attendance
		
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('config/form', $data);
        $this->load->view('templates/footer');
	}
    function submit(){
        $webmaster_id=$this->session->userdata('webmaster_id');
        $id = $this->input->post('id');
            $GetColumns = GetColumns('tb_setup_company');
            foreach($GetColumns as $r)
            {
                $data[$r['Field']] = $this->input->post($r['Field']);
                $data[$r['Field']."_temp"] = $this->input->post($r['Field']."_temp");
    
                if(!$data[$r['Field']] && !$data[$r['Field']."_temp"]) unset($data[$r['Field']]);
                unset($data[$r['Field']."_temp"]);
            }	
            /* if(!$this->input->post('is_active')){$data['is_active']='InActive';}
            else{$data['is_active']='Active';} */
            
            if($id != NULL && $id != '')
            {
                /* if(!$this->input->post('password')){unset($data['password']);}
                else{$data['password']=md5($this->config->item('encryption_key').$this->input->post("password"));} */
                $data['modify_user_id'] = $webmaster_id;
                $data['modify_date']=date("Y-m-d");
                $this->db->where("id", $id);
                $this->db->update('tb_setup_company', $data);
                
                $this->session->set_flashdata("message", 'Sukses diupdate');
            }
            else
            {
                $data['create_user_id'] = $webmaster_id;
                $data['create_date'] = date("Y-m-d H:i:s");
                $this->db->insert('tb_setup_company', $data);
                $id = $this->db->insert_id();
                $this->session->set_flashdata("message", 'Sukses ditambahkan');
            }
            
            redirect('config/form');
            
    }
    
}
