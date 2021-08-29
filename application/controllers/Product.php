<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->model('Produk_m');
		$this->load->model('Kategori_m');
		$this->load->model('Wishlist_m');
		$this->load->library('pagination');
	}

	public function index()
	{
		$config['base_url'] 	= base_url().'Product/index/';
		$config['total_rows'] 	= $this->Produk_m->pagination();
		$config['per_page']		= 6;
		
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);	

		$data['user'] 			= $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		if(isset($_SESSION['id_user'])){
			$data['notifcart'] 	= $this->Produk_m->notif_cart($data['user']['id_user']);
		}

		$data['title']		= 'Produk';
		$data['ListProduk'] = $this->Produk_m->tampil_produk_limit($config['per_page'],$from);
		$data['kategori'] 	= $this->Kategori_m->tampil_kategori();
		$data['total_limit']= count($data['ListProduk']);
		$data['total_rows'] = $config['total_rows'];
		
		$this->load->view('user/template/header', $data);
		$this->load->view('user/product', $data);
		$this->load->view('user/template/footer');
		$this->load->view('user/ajax/ajaxCart');
		$this->load->view('user/ajax/ajaxWishlist');
	}

	public function product_detail($id)
	{
		$data['title']			= 'Produk Detail';
		$data['kategori'] 		= $this->Kategori_m->tampil_kategori();
		$data['ProdukDetail'] 	= $this->Produk_m->produkDetail($id);
		$data['ListProduk'] 	= $this->Produk_m->tampil_data();

		$data['user'] 		= $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		if(isset($_SESSION['id_user'])){
			$data['notifcart'] 	= $this->Produk_m->notif_cart($data['user']['id_user']);
		}
		
		$this->load->view('user/template/header', $data);
		$this->load->view('user/product_detail', $data);
		$this->load->view('user/template/footer');
		$this->load->view('user/ajax/ajaxCart');
		$this->load->view('user/ajax/ajaxWishlist');
	}

	public function search()
	{
		$keyword = $this->input->get('keyword');

		//setting query string jika mengambil dari url
		$config['page_query_string'] 	= TRUE;
		$config['query_string_segment'] = 'per_page';

		$config['base_url'] 	= base_url().'Product/search?keyword=' . urlencode($keyword);
		$config['total_rows'] 	= $this->Produk_m->pagination_search($keyword);
		$config['per_page'] 	= 6;

		//pagination mulai dari per_page = ?
		$from = urlencode($this->input->get('per_page'));
		$this->pagination->initialize($config);	

		$data['keyword'] 	= urldecode($keyword); // simpan keyword diform control
		$data['ListProduk'] = $this->Produk_m->hasil_search($config['per_page'],$from, $keyword);
		
		$data['user'] 		= $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		if(isset($_SESSION['id_user'])){
			$data['notifcart'] 	= $this->Produk_m->notif_cart($data['user']['id_user']);
		}

		$data['kategori'] 	= $this->Kategori_m->tampil_kategori();
		$data['total_rows'] = $config['total_rows'];
		$data['total_limit']= count($data['ListProduk']);
		$data['title']		= 'Produk pencarian';

		$this->load->view('user/template/header', $data);
		$this->load->view('user/product', $data);
		$this->load->view('user/template/footer');
		$this->load->view('user/ajax/ajaxCart');
	}

	public function sortir()
	{
		$sort = $this->input->get('sort', TRUE);

		//setting query string jika mengambil dari url
		$config['page_query_string'] 	= TRUE;
		$config['query_string_segment'] = 'per_page';

		$config['base_url'] 	= base_url().'Product/sortir?sort=' . $sort;
		$config['total_rows'] 	= $this->Produk_m->sortSale($sort);
		$config['per_page'] 	= 6;

		//pagination mulai dari per_page = ?
		$from = $this->input->get('per_page');
		$this->pagination->initialize($config);	

	   	$data['sort'] 		= $sort; // simpan keyword diform control
		$data['ListProduk'] = $this->Produk_m->sortSaleNew($config['per_page'], $from, $sort);
		
		$data['user'] 		= $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		if(isset($_SESSION['id_user'])){
			$data['notifcart'] 	= $this->Produk_m->notif_cart($data['user']['id_user']);
		}

	    $data['total_rows'] = $config['total_rows'];
	    $data['total_limit']= count($data['ListProduk']);
	    $data['kategori'] 	= $this->Kategori_m->tampil_kategori();
	    $data['title']		= 'Produk sortir';

	    $this->load->view('user/template/header', $data);
		$this->load->view('user/product', $data);
		$this->load->view('user/template/footer');
		$this->load->view('user/ajax/ajaxCart');
	}

	public function filter()
	{
		$kat = $this->input->get('kategori');
		$min = $this->input->get('min_harga');
		$max = $this->input->get('max_harga');

		//setting query string jika mengambil dari url
		$config['page_query_string'] 	= TRUE;
		$config['query_string_segment'] = 'per_page';

		$config['base_url'] 	= base_url().'Product/filter';
		$config['total_rows'] 	= $this->Produk_m->minMax($min, $max, $kat);
		$config['per_page'] 	= 6;
		//mempertahankan query string diurl
		$config['reuse_query_string'] = TRUE;
		
		//pagination mulai dari per_page = ?
		$from = $this->input->get('per_page');
		$this->pagination->initialize($config);	

		$data['user'] 		= $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		if(isset($_SESSION['id_user'])){
			$data['notifcart'] 	= $this->Produk_m->notif_cart($data['user']['id_user']);
		}

		$data['ListProduk'] = $this->Produk_m->filterMinMax($config['per_page'], $from, $min, $max, $kat);
		$data['total_rows'] = $config['total_rows'];
		$data['total_limit']= count($data['ListProduk']);
		$data['kategori'] 	= $this->Kategori_m->tampil_kategori();
		$data['title']		= 'Produk filter';
		$data['id_kat']		= $kat;

		$this->load->view('user/template/header', $data);
		$this->load->view('user/product', $data);
		$this->load->view('user/template/footer');
		$this->load->view('user/ajax/ajaxCart');
	}

	public function product_kategori()
	{

		$kategori = $this->input->get('kategori');

		//setting query string jika mengambil dari url
		$config['page_query_string'] 	= TRUE;
		$config['query_string_segment'] = 'per_page';

		$config['base_url'] 	= base_url().'Product/product_kategori?kategori=' . $kategori;
		$config['total_rows'] 	= $this->Produk_m->filterKat($kategori);
		$config['per_page'] 	= 6;

		//pagination mulai dari per_page = ?
		$from = urlencode($this->input->get('per_page'));
		$this->pagination->initialize($config);	
		
		$data['user'] 		= $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		if(isset($_SESSION['id_user'])){
			$data['notifcart'] 	= $this->Produk_m->notif_cart($data['user']['id_user']);
		}

		$data['ListProduk'] = $this->Produk_m->filterKategori($config['per_page'],$from, $kategori);
		$data['kategori'] 	= $this->Kategori_m->tampil_kategori();
		$data['total_rows'] = $config['total_rows'];
		$data['total_limit']= count($data['ListProduk']);
		$data['title']		= 'Produk kategori';
		$data['id_kat']		= $kategori;

		$this->load->view('user/template/header', $data);
		$this->load->view('user/product', $data);
		$this->load->view('user/template/footer');
		$this->load->view('user/ajax/ajaxCart');
	}
}
