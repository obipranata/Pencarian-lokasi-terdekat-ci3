<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        $submit = $this->input->post('submit');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if (isset($submit)) {
            $user = $this->db->get_where('user', ['username' => $username])->row_array();
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    if ($user['level'] == 1) {
                        $data = [
                            'username' => $username,
                            'password' => $user['password']
                        ];
                        $this->session->set_userdata($data);
                        redirect('super/cari');
                    } else if ($user['level'] == 2) {
                        $data = [
                            'username' => $username,
                            'password' => $user['password']
                        ];
                        $this->session->set_userdata($data);
                        redirect('admin/cari');
                    }
                } else {
                    $this->session->set_flashdata('pesan', "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Password salah!!</strong> silahkan masukan password yang benar
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>");
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('pesan', "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Username tidak dikenali!!</strong> silahkan masukan username yang telah terdaftar pada sistem
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>");
                redirect('auth');
            }
        }
        $this->load->view('login/index');
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('password');
        redirect('auth');
    }
}
