<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank extends CI_Controller
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

    // source code tampilan bank
    public function index()
    {
        $data['bank'] = $this->db->get('bank')->result_array();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar_super');
        $this->load->view('super/bank/index', $data);
        $this->load->view('templates/footer_admin');
    }
    // akhir source code tampilan bank

    public function tambah()
    {
        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar_super');
        $this->load->view('super/bank/tambah');
        $this->load->view('templates/footer_admin');
    }

    public function insert()
    {
        $nama_bank = $this->input->post('nama_bank');
        $id_bank = $this->input->post('id_bank');
        $username = $this->input->post('username');
        $data = [
            'id_bank' => $id_bank,
            'nama_bank' => $nama_bank
        ];
        $data_user = [
            'username' => $username,
            'password' => password_hash($id_bank, PASSWORD_DEFAULT),
            'id_bank' => $id_bank,
            'level' => 2
        ];
        $this->db->insert('user', $data_user);
        $this->db->insert('bank', $data);
        redirect('super/bank');
    }

    public function ubah($id)
    {
        $data['bank'] = $this->db->get_where('bank', ['id_bank' => $id])->row_array();
        $submit = $this->input->post('submit');

        if (isset($submit)) {
            $nama_bank = $this->input->post('nama_bank');
            $periode = $this->input->post('periode');

            $data = [
                'nama_bank' => $nama_bank,
                'periode' => $periode
            ];

            $this->db->where('id_bank', $id);
            $this->db->update('bank', $data);
            redirect('admin/bank');
        }

        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar_super');
        $this->load->view('super/bank/ubah', $data);
        $this->load->view('templates/footer_admin');
    }
}
