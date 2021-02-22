<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kantor extends CI_Controller
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

    // source code tampilan kantor
    public function index()
    {
        $data['kantor'] = $this->db->query("SELECT wilayah.*, kantor.*, bank.* FROM kantor,bank,wilayah WHERE wilayah.id_wilayah = kantor.id_wilayah AND bank.id_bank = kantor.id_bank")->result_array();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar_super');
        $this->load->view('super/kantor/index', $data);
        $this->load->view('templates/footer_admin');
    }
    // source code tampilan kantor
}
