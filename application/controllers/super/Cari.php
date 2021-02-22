<?php
defined('BASEPATH') or exit('No direct script access allowed');
include 'FloydWarshall.php';
class Cari extends CI_Controller
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

    public function index()
    {
        $data['lokasi_atm'] = $this->db->query("SELECT lokasi.* , wilayah.nama_wilayah, bank.nama_bank, atm.* FROM wilayah, lokasi, bank, atm WHERE lokasi.id_bank_atm = atm.id_atm AND bank.id_bank = atm.id_bank AND atm.id_wilayah = wilayah.id_wilayah AND lokasi.is_atm_bank = 2")->result_array();
        $data['lokasi_bank'] = $this->db->query("SELECT lokasi.* , wilayah.nama_wilayah, bank.nama_bank, kantor.nama_kantor FROM wilayah, lokasi, bank, kantor WHERE bank.id_bank = kantor.id_bank AND lokasi.id_bank_atm = kantor.id_kantor AND kantor.id_wilayah = wilayah.id_wilayah AND lokasi.is_atm_bank = 1")->result_array();
        $data['lokasi_rute'] = $this->db->get_where('lokasi', ['is_atm_bank' => 0])->result_array();
        $data['lokasi'] = $this->db->get('lokasi')->result_array();
        $this->load->view('templates/header_admin');
        $this->load->view('templates/sidebar_super');
        $this->load->view('super/cari/index', $data);
        $this->load->view('templates/footer_admin');
    }

    public function get_all_lokasi()
    {
        $bank = $this->db->query("SELECT * FROM lokasi")->result();
        echo json_encode($bank);
    }

    public function get_nama_lokasi($id)
    {
        //         $res = $this->db->get('tb_spbu')->result()[0];

        $this->db->where('id_lokasi', $id);
        $this->db->limit(1);
        $res = $this->db->get('lokasi');
        if ($res->num_rows()) {
            $res = $res->result();
            return $res[0];
        }
        return false;
    }

    public function jalur_terdekat()
    {
        /* $a = mysqli_connect('localhost','root','','floyd_warshall');
        $b = mysqli_query($a,"SELECT *,x1.nama_lokasi as k_a,x2.nama_lokasi as k_b FROM tb_rute
                        INNER JOIN tb_lokasi  as x1 ON x1.id_lokasi=tb_rute.lok_a
                        INNER JOIN tb_lokasi as x2 ON x2.id_lokasi=tb_rute.lok_b"); */

        $b = $this->db->get('graph')->result_array();

        $lok_dist = array();

        $data_rute = array();

        foreach ($b as $dt_rute) {
            $data_rute[] = array($dt_rute['lokasi_awal'], $dt_rute['lokasi_akhir'], $dt_rute['jarak']);
        }


        function get_r($rt1, $rt2, $data_rute)
        {
            $res = INF;
            for ($o = 0; $o < count($data_rute); $o++) {
                if (($rt1 == $data_rute[$o][0]) and ($rt2 == $data_rute[$o][1])) {
                    $res = $data_rute[$o][2];
                    break;
                }
                if ($rt1 == $rt2) {
                    $res = 0;
                    break;
                }
            }
            return floatval($res);
        }


        foreach ($b as $r) {
            $lok_dist[0][] = $r['lokasi_akhir'];
            $lok_dist[1][] = $r['lokasi_awal'];
        }
        $merge = array_merge($lok_dist[0], $lok_dist[1]);
        $nodes = array_unique($merge);
        // print_r($nodes);
        $k = array();
        $no_k = 0;
        foreach ($nodes as $e) {
            $k[$no_k] = $e;
            $no_k++;
        }
        $nodes = $k;
        /* for ($i = 0; $i < count($nodes); $i++) {
         print $k[$i];
         print "------------------------------------";
         } */

        $m = array();
        for ($x = 0; $x < count($k); $x++) {
            for ($l = 0, $p = 0; $l < count($k); $l++) {
                $m[$p][] = get_r($k[$x], $k[$l], $data_rute);
                //         print $k[$x].' '.$k[$l];
                $p++;
            }
            //get_r(1,$k[$x],$data_rute);
        }
        $graph = $m;
        $fw = new FloydWarshall($graph, $nodes);

        $a = $this->input->post('point_a');
        $b = $this->input->post('point_b');
        $a = array_search($a, $nodes);
        $b = array_search($b, $nodes);

        /* 	    $fw->print_graph();
         $fw->print_dist();
         $fw->print_pred(); */

        $sp = $fw->get_path($a, $b);
        $res = array();
        /* $this->db->select('tb_lokasi.nama_lokasi as l_a,tb_lokasi.nama_lokasi as l_b');
         $this->db->join('tb_rute as a',"a.lok_a=tb_lokasi.id_lokasi","RIGHT");
         $this->db->join('tb_rute as b',"b.lok_b=tb_lokasi.id_lokasi","RIGHT");
         $res = $this->db->get('tb_lokasi')->result(); */
        $lll = array();
        foreach ($sp as $value) {
            if (!$this->get_nama_lokasi($nodes[$value])) {
                return false;
            }
            $lll['data_lokasi'][] = $this->get_nama_lokasi($nodes[$value])->nama_lokasi;
            $res['kordinat'][] = '{"lat":' . $this->get_nama_lokasi($nodes[$value])->latitude . ',"lng":' . $this->get_nama_lokasi($nodes[$value])->longitude . '}';
            $lll['id_lokasi'][] = $value;
        }

        //$res['test'][] = var_dump($this->get_nama_lokasi($nodes[$value]));
        $res['nodes'][] = implode(" - ", $lll['data_lokasi']);
        /*
         $res['nodes'][] = $sss;
         $res['kor'] = $kor; */
        $res['distance'][] = $fw->get_distance($a, $b);

        echo json_encode($res);
    }
}
