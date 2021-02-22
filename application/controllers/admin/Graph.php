<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Graph extends CI_Controller
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
        $data['graph'] = $this->db->query("SELECT a.*, b.nama_lokasi as lok_awal , c.nama_lokasi as lok_tujuan FROM graph a JOIN lokasi b ON a.lokasi_awal = b.id_lokasi JOIN lokasi c ON a.lokasi_akhir = c.id_lokasi")->result_array();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/graph/index', $data);
        $this->load->view('templates/footer_admin');
    }
    // akhir source code

    public function tambah()
    {
        $data['point_lokasi'] = $this->db->get('lokasi')->result_array();
        $data['lokasi'] = $this->db->get('lokasi')->result_array();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/graph/tambah', $data);
        $this->load->view('templates/footer_admin');
    }

    public function insert()
    {
        $lokasi_awal = $this->input->post('lokasi_awal');
        $lokasi_akhir = $this->input->post('lokasi_akhir');
        $jarak = $this->input->post('jarak');

        $graph = $this->db->get('graph')->result_array();

        foreach ($graph as $g) {
            if ($g['lokasi_awal'] == $lokasi_awal and $g['lokasi_akhir'] == $lokasi_akhir) {
                $this->session->set_flashdata('pesan', "<div class='alert alert-danger' role='alert'>
                proses pembuatan graph gagal!! data yang anda masukan sudah ada.
              </div>");
                redirect('admin/graph/tambah');
            }
        }

        $data_1 = [
            'lokasi_awal' => $lokasi_awal,
            'lokasi_akhir' => $lokasi_akhir,
            'jarak' => $jarak
        ];
        $data_2 = [
            'lokasi_awal' => $lokasi_akhir,
            'lokasi_akhir' => $lokasi_awal,
            'jarak' => $jarak
        ];

        $this->db->insert('graph', $data_1);
        $this->db->insert('graph', $data_2);
        redirect('admin/graph');
    }

    public function delete($lokasi_awal, $lokasi_akhir)
    {
        $this->db->delete('graph', ['lokasi_awal' => $lokasi_awal, 'lokasi_akhir' => $lokasi_akhir]);
        $this->db->delete('graph', ['lokasi_awal' => $lokasi_akhir, 'lokasi_akhir' => $lokasi_awal]);
        redirect('admin/graph');
    }
}
