<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->model('Produk_m');
		$this->load->model('Blog_m');
		$this->load->model('Wishlist_m');
		$this->load->model('Kategori_m');
	}

	public function index()
	{
		$data['title'] 			= 'Home';
		$data['user'] 			= $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		$data['katalogProduk'] 	= $this->Produk_m->tampil_data();
		$data['kategori'] 		= $this->Kategori_m->tampil_kategori();
		$data['blogHome'] 		= $this->Blog_m->blogHome();
		if(isset($_SESSION['id_user'])){
			$data['notifcart'] 		= $this->Produk_m->notif_cart($data['user']['id_user']);
		}
		// $data['kategori'] = $this->Blog_m->tampil_kategori()->result();
		// $data['slider'] = $this->slider_m->tampildata()->result();

		$this->load->view('user/template/header', $data);
		$this->load->view('user/home', $data);
		$this->load->view('user/template/footer');
		$this->load->view('user/ajax/ajaxCart');
		$this->load->view('user/ajax/ajaxWishlist');
	}
}
