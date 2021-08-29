<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->model('Produk_m');
		$this->load->model('Kategori_m');
		$this->load->model('Blog_m');
		$this->load->library('pagination');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] 			= 'Blog';
		$config['base_url'] 	= base_url().'Blogs/index/';
		$config['total_rows'] 	= $this->Blog_m->pagination();
		$config['per_page']		= 3;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);	

		$data['total_rows'] = $config['total_rows'];
		$data['blog'] 		= $this->Blog_m->tampil_blog_limit($config['per_page'],$from);

		$data['katalogProduk']  = $this->Produk_m->katalog_produk();
		$data['kategori'] 		= $this->Kategori_m->tampil_kategori();
		$data['arsipBlog']		= $this->Blog_m->arsip_blog();
		
		$data['user'] 			= $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		if(isset($_SESSION['id_user'])){
			$data['notifcart'] 	= $this->Produk_m->notif_cart($data['user']['id_user']);
		}
		
		$this->load->view('user/template/header', $data);
		$this->load->view('user/blogs', $data);
		$this->load->view('user/template/footer');
		$this->load->view('user/ajax/ajaxCart');
	}

	public function search_blog()
	{
		$keyword = $this->input->get('keyword');

		//setting query string jika mengambil dari url
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'per_page';

		$config['base_url'] = base_url().'Blogs/search_blog?keyword=' . urlencode($keyword);
		$config['total_rows'] = $this->Blog_m->pagination_search_blog($keyword);
		$config['per_page'] = 3;

					//pagination mulai dari per_page = ?
		$from = urlencode($this->input->get('per_page'));
		$this->pagination->initialize($config);	

		$data['keyword'] 		= urldecode($keyword); // simpan keyword diform control
		$data['total_rows'] 	= $config['total_rows'];
		$data['blog'] 			= $this->Blog_m->hasil_search_blog($config['per_page'],$from, $keyword);
		$data['katalogProduk'] 	= $this->Produk_m->katalog_produk();
		$data['kategori'] 		= $this->Kategori_m->tampil_kategori();
		$data['arsipBlog']		= $this->Blog_m->arsip_blog();
		$data['title']			= 'Blog';

		$data['user'] 			= $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		if(isset($_SESSION['id_user'])){
			$data['notifcart'] 	= $this->Produk_m->notif_cart($data['user']['id_user']);
		}

		$this->load->view('user/template/header', $data);
		$this->load->view('user/blogs', $data);
		$this->load->view('user/template/footer');
		$this->load->view('user/ajax/ajaxCart');
	}

	public function filter_blog()
	{
		$kat = $this->input->get('katBlog');

		//setting query string jika mengambil dari url
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'per_page';

		$config['base_url'] = base_url().'Blog/filter_blog';
		$config['total_rows'] = $this->Blog_m->filter_blog_by_id($kat);
		$config['per_page'] = 3;
		//mempertahankan query string diurl
		$config['reuse_query_string'] = TRUE;
		
		//pagination mulai dari per_page = ?
		$from = $this->input->get('per_page');
		$this->pagination->initialize($config);	
		$data['blog'] = $this->Blog_m->filterBlog($config['per_page'], $from, $kat);

		$data['total_rows'] 	= $config['total_rows'];
		$data['kategori'] 		= $this->Kategori_m->tampil_kategori();
		$data['katalogProduk'] 	= $this->Produk_m->katalog_produk();
		$data['arsipBlog']		= $this->Blog_m->arsip_blog();
		$data['title']			= 'Blog';
		$data['id_kat']			= $kat;
		

		$data['user'] 			= $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		if(isset($_SESSION['id_user'])){
			$data['notifcart'] 	= $this->Produk_m->notif_cart($data['user']['id_user']);
		}

		$this->load->view('user/template/header', $data);
		$this->load->view('user/blogs', $data);
		$this->load->view('user/template/footer');
		$this->load->view('user/ajax/ajaxCart');
	}

	public function arsip_blog()
	{
		$tgl = $this->input->get('arsip');

		//setting query string jika mengambil dari url
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'per_page';
		$config['base_url'] = base_url().'Blogs/arsip_blog?arsip=' . $tgl;
		$config['total_rows'] = $this->Blog_m->getArsip($tgl);
		$config['per_page']	= 3;
		$from = $this->input->get('per_page');
		$this->pagination->initialize($config);	

		$data['total_rows'] 	= $config['total_rows'];
		$data['blog']			= $this->Blog_m->arsipBytgl($config['per_page'], $from, $tgl);
		$data['kategori'] 		= $this->Kategori_m->tampil_kategori();
		$data['katalogProduk'] 	= $this->Produk_m->katalog_produk();
		$data['arsipBlog']		= $this->Blog_m->arsip_blog();
		$data['title']			= 'Blog';
		$data['tglactive']		= $tgl;
	
		$data['user'] 			= $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		if(isset($_SESSION['id_user'])){
			$data['notifcart'] 	= $this->Produk_m->notif_cart($data['user']['id_user']);
		}

		$this->load->view('user/template/header', $data);
		$this->load->view('user/blogs', $data);
		$this->load->view('user/template/footer');
		$this->load->view('user/ajax/ajaxCart');
	}

	public function blogs_detail()
	{
		$kode 					= $this->uri->segment(3);

		$data['blogDetail']		= $this->Blog_m->blog_detail($kode);
		$data['kategori'] 		= $this->Kategori_m->tampil_kategori();
		$data['katalogProduk'] 	= $this->Produk_m->katalog_produk();
		$data['arsipBlog']		= $this->Blog_m->arsip_blog();
		$data['komentar']		= $this->Blog_m->comment($kode);
		$data['title'] 		 	= 'Blog detail'; 
		$data['id_kat']			= $kode;
		
		$data['user'] 			= $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		if(isset($_SESSION['id_user'])){
			$data['notifcart'] 	= $this->Produk_m->notif_cart($data['user']['id_user']);
		}

		$this->load->view('user/template/header', $data);
		$this->load->view('user/blogs_detail', $data);
		$this->load->view('user/template/footer');
		$this->load->view('user/ajax/ajaxInput');
		$this->load->view('user/ajax/ajaxCart');
	}

	public function comment() 
	{
		$data = array();
        $data['status'] = TRUE;

		$this->form_validation->set_rules("nama", "Nama", "required",[
            'required' => '<i>*Nama tidak boleh kosong !</i>'
        ]);
        $this->form_validation->set_rules("email", "Email", "trim|required",[
            'required' => '<i>*Email tidak boleh kosong !</i>'
        ]);
        $this->form_validation->set_rules("komentar", "Komentar", "trim|required",[
            'required' => '<i>*Komentar tidak boleh kosong !</i>'
        ]);

        $this->form_validation->set_error_delimiters('', '');
        if($this->form_validation->run() == FALSE)
        {
        	$data['inputerror'][] = 'nama';
            $data['error_string'][] = form_error('nama');

            $data['inputerror'][] = 'email';
            $data['error_string'][] = form_error('email');

            $data['inputerror'][] = 'komentar';
            $data['error_string'][] = form_error('komentar');            
            $data['status'] = FALSE;

            echo json_encode($data);

        }else{
	        $data = array(
	        	'nama'      => $this->input->post('nama'),
	        	'email'     => $this->input->post('email'),
	        	'komentar'  => $this->input->post('komentar'),
	        	'id_blog'   => $this->input->post('id'),
	        	'status'    => '0', // 0 komentar, 1 reply komentar
	        );

	        $this->Blog_m->send_comment($data);
	        $data['success'] = TRUE;

            $this->output->set_content_type('application/json')->set_output(json_encode($data));
    	}
    }
}