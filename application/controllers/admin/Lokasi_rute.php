<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi_rute extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $username = $this->session->userdata('username');
        $password = $this->session->userdata('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        if ($user) {
            if ($user['password'] == $password) {
                $masuk = true;
            } else {
                $masuk = false;
            }
        } else {
            $masuk = false;
        }

        if (!$masuk) {
            redirect('auth');
        }

        if ($user['level'] != 2) {
            redirect('auth');
        }
    }

    // source code
    public function index()
    {
        $data['lokasi'] = $this->db->get_where('lokasi', ['is_atm_bank' => 0])->result_array();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/lokasi_rute/index', $data);
        $this->load->view('templates/footer_admin');
    }
    // source code

    public function tambah()
    {
        $data['point_lokasi'] = $this->db->get('lokasi')->result_array();

        $this->form_validation->set_rules('latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('longitude', 'Latitude', 'required', ['required' => 'Lokasi belum di pilih !']);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_admin');
            $this->load->view('templates/sidebar');
            $this->load->view('admin/lokasi_rute/tambah', $data);
            $this->load->view('templates/footer_admin');
        } else {
            $latitude = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');
            $alamat = $this->input->post('alamat');

            if (empty($this->db->get_where('lokasi', ['is_atm_bank' => 0])->result_array())) {
                $nama_lokasi =  1;
            } else {
                $nama_lokasi_akhir = $this->db->query("SELECT nama_lokasi FROM lokasi WHERE is_atm_bank = 0 ORDER BY id_lokasi DESC")->row_array();
                $nama_lokasi = $nama_lokasi_akhir['nama_lokasi'] + 1;
            }

            $data = [
                'nama_lokasi' => $nama_lokasi,
                'is_atm_bank' => 0,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'id_bank_atm' => 0,
                'alamat' => ''
            ];
            $this->db->insert('lokasi', $data);
            redirect('admin/lokasi_rute');
        }
    }

    // public function insert()
    // {
    //     // $nama_lokasi = $this->input->post('nama_lokasi');
    //     $latitude = $this->input->post('latitude');
    //     $longitude = $this->input->post('longitude');
    //     $alamat = $this->input->post('alamat');

    //     if (empty($this->db->get_where('lokasi', ['is_atm_bank' => 0])->result_array())) {
    //         $nama_lokasi =  1;
    //     } else {
    //         $nama_lokasi_akhir = $this->db->query("SELECT nama_lokasi FROM lokasi WHERE is_atm_bank = 0 ORDER BY id_lokasi DESC")->row_array();
    //         $nama_lokasi = $nama_lokasi_akhir['nama_lokasi'] + 1;
    //     }

    //     $data = [
    //         'nama_lokasi' => $nama_lokasi,
    //         'is_atm_bank' => 0,
    //         'latitude' => $latitude,
    //         'longitude' => $longitude,
    //         'id_bank_atm' => 0,
    //         'alamat' => ''
    //     ];
    //     $this->db->insert('lokasi', $data);
    //     redirect('admin/lokasi_rute');
    // }

    public function ubah($id)
    {
        $data['point_lokasi'] = $this->db->get('lokasi')->result_array();
        $data['lokasi'] = $this->db->get_where('lokasi', ['id_lokasi' => $id])->row_array();
        $submit = $this->input->post('submit');

        if (isset($submit)) {
            $latitude = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');
            $alamat = $this->input->post('alamat');

            $data = [
                'is_atm_bank' => 0,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'id_bank_atm' => 0,
                'alamat' => ''
            ];

            $this->db->where('id_lokasi', $id);
            $this->db->update('lokasi', $data);
            redirect('admin/lokasi_rute');
        }

        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/lokasi_rute/ubah', $data);
        $this->load->view('templates/footer_admin');
    }

    public function hapus($id_lokasi)
    {
        $this->db->delete('lokasi', ['id_lokasi' => $id_lokasi]);
        $this->db->delete('graph', ['lokasi_awal' => $id_lokasi]);
        $this->db->delete('graph', ['lokasi_akhir' => $id_lokasi]);
        $this->session->set_flashdata('pesan', "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Status Berhasil!</strong> Anda baru saja hapus data lokasi rute
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>");
        redirect('admin/lokasi_rute');
    }
}
