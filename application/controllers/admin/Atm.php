<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Atm extends CI_Controller
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
        $data['atm'] = $this->db->query("SELECT wilayah.*, atm.*, bank.* FROM atm,bank,wilayah WHERE wilayah.id_wilayah = atm.id_wilayah AND bank.id_bank = atm.id_bank AND atm.id_bank = '$id_bank' ")->result_array();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/atm/index', $data);
        $this->load->view('templates/footer_admin');
    }
    // akhir source code 

    public function tambah()
    {
        $username = $this->session->userdata('username');
        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        $id_bank = $user['id_bank'];
        $data['wilayah'] = $this->db->get('wilayah')->result_array();
        $data['bank'] = $this->db->get_where('bank', ['id_bank' => $id_bank])->result_array();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/atm/tambah', $data);
        $this->load->view('templates/footer_admin');
    }

    public function insert()
    {
        $username = $this->session->userdata('username');
        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        $id_bank = $user['id_bank'];
        $nama_atm = $this->input->post('nama_atm');
        $id_wilayah = $this->input->post('id_wilayah');
        $data = [
            'nama_atm' => $nama_atm,
            'id_wilayah' => $id_wilayah,
            'id_bank' => $id_bank
        ];
        $this->db->insert('atm', $data);
        redirect('admin/atm');
    }

    public function ubah($id)
    {
        $username = $this->session->userdata('username');
        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        $id_bank = $user['id_bank'];
        $data['wilayah'] = $this->db->get('wilayah')->result_array();
        $data['bank'] = $this->db->get('bank')->result_array();
        $data['atm'] = $this->db->get_where('atm', ['id_atm' => $id])->row_array();
        $submit = $this->input->post('submit');

        if (isset($submit)) {
            $nama_atm = $this->input->post('nama_atm');
            $id_wilayah = $this->input->post('id_wilayah');
            $data = [
                'nama_atm' => $nama_atm,
                'id_wilayah' => $id_wilayah,
                'id_bank' => $id_bank
            ];

            $this->db->where('id_atm', $id);
            $this->db->update('atm', $data);
            redirect('admin/atm');
        }

        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/atm/ubah', $data);
        $this->load->view('templates/footer_admin');
    }

    public function delete($id_atm)
    {
        $query1 = "SELECT lokasi.*, graph.* FROM graph, lokasi WHERE lokasi.id_lokasi = graph.lokasi_awal AND lokasi.is_atm_bank = 2 AND lokasi.id_bank_atm = '$id_atm'";
        $query2 = "SELECT lokasi.*, graph.* FROM graph, lokasi WHERE lokasi.id_lokasi = graph.lokasi_akhir AND lokasi.is_atm_bank = 2 AND lokasi.id_bank_atm = '$id_atm'";
        $graph1 = $this->db->query($query1)->row_array();
        $graph2 = $this->db->query($query2)->row_array();

        $this->db->delete('graph', ['lokasi_awal' => $graph1['lokasi_awal']]);
        $this->db->delete('graph', ['lokasi_akhir' => $graph2['lokasi_akhir']]);

        $this->db->delete('lokasi', ['id_bank_atm' => $id_atm, 'is_atm_bank' => 2]);
        $this->db->delete('atm', ['id_atm' => $id_atm]);
        redirect('admin/atm');
    }
}
