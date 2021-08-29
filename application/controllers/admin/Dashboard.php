<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	 function __construct(){
        parent::__construct();
        $this->load->model('visitor_m');
        $this->load->model('inbox_m');
    }

	public function index()
	{	
		check_tidak_login(); // hak akses fungsi dihelper

		$ip    		= $this->input->ip_address(); // Mendapatkan IP user
        $date  		= date("Y-m-d"); // Mendapatkan tanggal sekarang
        $waktu 		= time(); //
        $timeinsert = date("Y-m-d H:i:s");

        // Cek berdasarkan IP, apakah user sudah pernah mengakses hari ini
        $s = $this->db->query("SELECT * FROM visitor WHERE ip='".$ip."' AND date='".$date."'")->num_rows();
        $ss = isset($s)?($s):0;


        // Kalau belum ada, simpan data user tersebut ke database
        if($ss == 0){
            $this->db->query("INSERT INTO visitor(ip, date, hits, online, time) VALUES('".$ip."','".$date."','1','".$waktu."','".$timeinsert."')");
        }

        // Jika sudah ada, update
        else{
            $this->db->query("UPDATE visitor SET hits=hits+1, online='".$waktu."' WHERE ip='".$ip."' AND date='".$date."'");
        }

        // Hitung jumlah pengunjung  
        $pengunjunghariini  = $this->db->query("SELECT * FROM visitor WHERE date='".$date."' GROUP BY ip")->num_rows();

        $dbpengunjung = $this->db->query("SELECT COUNT(hits) as hits FROM visitor")->row(); 

        $totalpengunjung = isset($dbpengunjung->hits)?($dbpengunjung->hits):0; // hitung total pengunjung

        $bataswaktu = time() - 300;

        $pengunjungonline  = $this->db->query("SELECT * FROM visitor WHERE online > '".$bataswaktu."'")->num_rows(); // hitung pengunjung online
            
        $totalblog = $this->db->query("SELECT * FROM blog WHERE id_blog GROUP BY id_blog")->num_rows();

        $totalproduk = $this->db->query("SELECT * FROM produk WHERE id_produk GROUP BY id_produk")->num_rows();

        $totaluser = $this->db->query("SELECT * FROM user WHERE id GROUP BY id")->num_rows();

        $data['grafik'] = $this->visitor_m->grafik();
        $data['grafikphi'] = $this->visitor_m->grafikphi();
        $data['grafikpo'] = $this->visitor_m->grafikpo();
        $data['pengunjunghariini']=$pengunjunghariini;
        $data['totalpengunjung']=$totalpengunjung;
        $data['pengunjungonline']=$pengunjungonline;
        $data['totalblog']=$totalblog;
        $data['totalproduk']=$totalproduk;
        $data['totaluser']=$totaluser;

		$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $data['notif'] = $this->db->where('status',1)->count_all_results('inbox');
        $data['msg']   = $this->db->select('*')->from('inbox')->order_by('id_inbox','desc')->where('status', 1)->get();

		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar');
		$this->load->view('admin/Dashboard');
		$this->load->view('admin/template/footer');
        $this->load->view('user/ajax/ajaxContact');
	}
}
