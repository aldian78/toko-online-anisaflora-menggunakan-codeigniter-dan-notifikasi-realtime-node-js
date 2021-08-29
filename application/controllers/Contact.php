<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Produk_m');
		$this->load->model('Kategori_m');
		$this->load->model('Inbox_m');
	}

	public function index()
	{
		$data['title']	 	= 'Kontak kami';
		$data['kategori'] 	= $this->Kategori_m->tampil_kategori();
		
		$data['user'] 			= $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		if(isset($_SESSION['id_user'])){
			$data['notifcart'] 	= $this->Produk_m->notif_cart($data['user']['id_user']);
		}

		$this->load->library('googlemaps');

	    $config['center'] = '-7.4091288, 112.6681989';//Coordinate tengah peta
	    $config['zoom'] = '18';
	    $this->googlemaps->initialize($config);

	    $marker = array();
	    $marker['icon'] = base_url(). 'assets_user/images/icons/icon-position-map.png';
	    $marker['position'] = '-7.4091288, 112.6681989';//Posisi marker (itu tuh yang merah2 lancip itu loh :-p)
    	$this->googlemaps->add_marker($marker);
     
    	$data['map'] = $this->googlemaps->create_map();

		$this->load->view('user/template/header', $data);
		$this->load->view('user/contact', $data);
		$this->load->view('user/template/footer');
		$this->load->view('user/ajax/ajaxCart');
		$this->load->view('user/ajax/ajaxContact');
	}

	public function send_msg()
	{
		$data['nama'] 		= $this->input->post('nama');
		$data['nohp'] 		= $this->input->post('nohp');
		$data['email'] 		= $this->input->post('email');
		$data['pesan'] 		= $this->input->post('pesan');
		$data['status']		= 1;

		$this->db->insert('inbox',$data);
        $get = $this->db->select('*')->from('inbox')->where('id_inbox', $this->db->insert_id())->get()->row();

        $data['nama'] 		= $get->nama;
        $data['nohp'] 		= $get->nohp;
        $data['email'] 		= $get->email;
        $data['pesan'] 		= $get->pesan;
        $data['id_inbox']	= $get->id_inbox;

        $time_get = strtotime($get->tanggal);
        $data['tanggal'] 	= time_ago($time_get);

		$count = $this->db->where('status',1)->count_all_results('inbox');
        $data['hitung'] = $count;

		$data['success'] = TRUE;
		echo json_encode($data);
	}

	public function getpesanKontak()
	{
		$id = $this->input->get('id');

        $this->db->where('id_inbox', $id);
        $data = $this->db->get('inbox')->row();
        echo json_encode($data);
	}

	public function update_status()
	{
		$id = $this->input->post('id_inbox');

		$update['status'] = 0;
		$this->db->where('id_inbox', $id);
		$this->db->update('inbox', $update);

		$data['success'] = TRUE;
		echo json_encode($data);
	}

	public function status_where()
	{
		$data = $this->Inbox_m->status_where()->result();

		echo json_encode($data);
	}
}
