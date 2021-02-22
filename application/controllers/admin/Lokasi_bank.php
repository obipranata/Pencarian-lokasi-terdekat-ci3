<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi_bank extends CI_Controller
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
        $username = $this->session->userdata('username');
        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        $id_bank = $user['id_bank'];

        $data['lokasi'] = $this->db->query("SELECT lokasi.* , wilayah.nama_wilayah, bank.nama_bank, kantor.nama_kantor FROM wilayah, lokasi, bank, kantor WHERE bank.id_bank = kantor.id_bank AND lokasi.id_bank_atm = kantor.id_kantor AND kantor.id_wilayah = wilayah.id_wilayah AND lokasi.is_atm_bank = 1 AND bank.id_bank = '$id_bank' ")->result_array();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/lokasi_bank/index', $data);
        $this->load->view('templates/footer_admin');
    }
    // source code

    public function tambah()
    {

        $username = $this->session->userdata('username');
        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        $id_bank = $user['id_bank'];
        $data['kantor'] = $this->db->get_where('kantor', ['id_bank' => $id_bank])->result_array();
        $data['point_lokasi'] = $this->db->get('lokasi')->result_array();

        $this->form_validation->set_rules('nama_lokasi', 'Nama Lokasi', 'required', ['required' => 'Nama lokasi harus diisi!!!']);
        $this->form_validation->set_rules('latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('longitude', 'Latitude', 'required', ['required' => 'Lokasi belum di pilih !']);
        $this->form_validation->set_rules('id_kantor', 'Bank', 'required', ['required' => 'Bank harus diisi!!!']);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', ['required' => 'Alamat harus diisi!!!']);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_admin');
            $this->load->view('templates/sidebar');
            $this->load->view('admin/lokasi_bank/tambah', $data);
            $this->load->view('templates/footer_admin');
        } else {
            $nama_lokasi = $this->input->post('nama_lokasi');
            $latitude = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');
            $alamat = $this->input->post('alamat');
            $id_kantor = $this->input->post('id_kantor');

            $data = [
                'nama_lokasi' => $nama_lokasi,
                'is_atm_bank' => 1,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'id_bank_atm' => $id_kantor,
                'alamat' => $alamat
            ];
            $this->db->insert('lokasi', $data);
            redirect('admin/lokasi_bank');
        }
    }

    // public function insert()
    // {

    //     $nama_lokasi = $this->input->post('nama_lokasi');
    //     $latitude = $this->input->post('latitude');
    //     $longitude = $this->input->post('longitude');
    //     $alamat = $this->input->post('alamat');
    //     $id_kantor = $this->input->post('id_kantor');

    //     $data = [
    //         'nama_lokasi' => $nama_lokasi,
    //         'is_atm_bank' => 1,
    //         'latitude' => $latitude,
    //         'longitude' => $longitude,
    //         'id_bank_atm' => $id_kantor,
    //         'alamat' => $alamat
    //     ];
    //     $this->db->insert('lokasi', $data);
    //     redirect('admin/lokasi_bank');
    // }

    public function ubah($id)
    {
        $username = $this->session->userdata('username');
        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        $id_bank_atm = $user['id_bank'];

        $data['bank'] = $this->db->get('bank')->result_array();
        $data['point_lokasi'] = $this->db->get('lokasi')->result_array();
        $data['lokasi'] = $this->db->get_where('lokasi', ['id_lokasi' => $id])->row_array();
        $submit = $this->input->post('submit');

        if (isset($submit)) {
            $nama_lokasi = $this->input->post('nama_lokasi');
            $latitude = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');
            $alamat = $this->input->post('alamat');

            $data = [
                'nama_lokasi' => $nama_lokasi,
                'is_atm_bank' => 1,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'id_bank_atm' => $id_bank_atm,
                'alamat' => $alamat
            ];

            $this->db->where('id_lokasi', $id);
            $this->db->update('lokasi', $data);
            redirect('admin/lokasi_bank');
        }

        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/lokasi_bank/ubah', $data);
        $this->load->view('templates/footer_admin');
    }

    public function hapus($id_lokasi)
    {
        $this->db->delete('lokasi', ['id_lokasi' => $id_lokasi]);
        $this->db->delete('graph', ['lokasi_awal' => $id_lokasi]);
        $this->db->delete('graph', ['lokasi_akhir' => $id_lokasi]);
        $this->session->set_flashdata('pesan', "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Status Berhasil!</strong> Anda baru saja hapus data lokasi bank
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>");
        redirect('admin/lokasi_bank');
    }
}
