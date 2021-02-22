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
        $data['kantor'] = $this->db->query("SELECT wilayah.*, kantor.*, bank.* FROM kantor,bank,wilayah WHERE wilayah.id_wilayah = kantor.id_wilayah AND bank.id_bank = kantor.id_bank AND kantor.id_bank = '$id_bank' ")->result_array();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/kantor/index', $data);
        $this->load->view('templates/footer_admin');
    }
    // akhir source code
    public function tambah()
    {
        $data['wilayah'] = $this->db->get('wilayah')->result_array();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/kantor/tambah', $data);
        $this->load->view('templates/footer_admin');
    }

    public function insert()
    {
        $username = $this->session->userdata('username');
        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        $id_bank = $user['id_bank'];
        $nama_kantor = $this->input->post('nama_kantor');
        $alamat = $this->input->post('alamat');
        $no_telp = $this->input->post('no_telp');
        $keterangan = $this->input->post('keterangan');
        $id_wilayah = $this->input->post('id_wilayah');
        $data = [
            'nama_kantor' => $nama_kantor,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
            'keterangan' => $keterangan,
            'id_bank' => $id_bank,
            'id_wilayah' => $id_wilayah
        ];
        $this->db->insert('kantor', $data);
        redirect('admin/kantor');
    }

    public function ubah($id)
    {
        $username = $this->session->userdata('username');
        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        $id_bank = $user['id_bank'];
        $data['wilayah'] = $this->db->get('wilayah')->result_array();
        $data['bank'] = $this->db->get('bank')->result_array();
        $data['kantor'] = $this->db->get_where('kantor', ['id_kantor' => $id])->row_array();
        $submit = $this->input->post('submit');

        if (isset($submit)) {
            $nama_kantor = $this->input->post('nama_kantor');
            $alamat = $this->input->post('alamat');
            $no_telp = $this->input->post('no_telp');
            $keterangan = $this->input->post('keterangan');
            $id_wilayah = $this->input->post('id_wilayah');
            $data = [
                'nama_kantor' => $nama_kantor,
                'alamat' => $alamat,
                'no_telp' => $no_telp,
                'keterangan' => $keterangan,
                'id_bank' => $id_bank,
                'id_wilayah' => $id_wilayah
            ];

            $this->db->where('id_kantor', $id);
            $this->db->update('kantor', $data);
            redirect('admin/kantor');
        }

        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/kantor/ubah', $data);
        $this->load->view('templates/footer_admin');
    }

    public function hapus($id_kantor)
    {
        $lokasi = $this->db->query("SELECT * FROM lokasi WHERE is_atm_bank = 1 AND id_bank_atm = '$id_kantor' ")->row_array();
        $id_lokasi = $lokasi['id_lokasi'];
        $this->db->delete('kantor', ['id_kantor' => $id_kantor]);
        $this->db->delete('lokasi', ['is_atm_bank' => 1, 'id_bank_atm' => $id_kantor]);
        $this->db->delete('graph', ['lokasi_awal' => $id_lokasi]);
        $this->db->delete('graph', ['lokasi_akhir' => $id_lokasi]);
        $this->session->set_flashdata('pesan', "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Status Berhasil!</strong> Anda baru saja hapus data kantor
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>");
        redirect('admin/lokasi_bank');
    }
}
