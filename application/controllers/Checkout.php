<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Produk_m');
		$this->load->model('Kategori_m');
	}

	public function index()
	{
		$data['title'] 		= 'Checkout';
		$data['kategori'] 	= $this->Kategori_m->tampil_kategori();
		
		$data['user'] 			= $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		if(isset($_SESSION['id_user'])){
			$data['notifcart'] 	= $this->Produk_m->notif_cart($data['user']['id_user']);
		}

		$this->load->view('user/template/header', $data);
		$this->load->view('user/checkout', $data);
		$this->load->view('user/template/footer');
	}
}