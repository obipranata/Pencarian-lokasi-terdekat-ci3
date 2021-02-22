<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wilayah extends CI_Controller
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

        if ($user['level'] != 1) {
            redirect('auth');
        }
    }

    // source code tampilan wilayah
    public function index()
    {
        $data['wilayah'] = $this->db->get('wilayah')->result_array();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar_super');
        $this->load->view('super/wilayah/index', $data);
        $this->load->view('templates/footer_admin');
    }
    // akhir source code tampilan wilayah

    public function tambah()
    {
        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar_super');
        $this->load->view('super/wilayah/tambah');
        $this->load->view('templates/footer_admin');
    }

    public function insert()
    {
        $nama_wilayah = $this->input->post('nama_wilayah');
        $data = [
            'nama_wilayah' => $nama_wilayah
        ];
        $this->db->insert('wilayah', $data);
        redirect('super/wilayah');
    }

    public function ubah($id)
    {
        $data['wilayah'] = $this->db->get_where('wilayah', ['id_wilayah' => $id])->row_array();
        $submit = $this->input->post('submit');

        if (isset($submit)) {
            $nama_wilayah = $this->input->post('nama_wilayah');
            $data = [
                'nama_wilayah' => $nama_wilayah
            ];

            $this->db->where('id_wilayah', $id);
            $this->db->update('wilayah', $data);
            redirect('admin/wilayah');
        }

        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar_super');
        $this->load->view('super/wilayah/ubah', $data);
        $this->load->view('templates/footer_admin');
    }
}
