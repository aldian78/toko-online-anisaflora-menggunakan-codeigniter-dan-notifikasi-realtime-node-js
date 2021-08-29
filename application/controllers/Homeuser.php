<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homeuser extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->model('Produk_m');
		$this->load->model('Blog_m');
		$this->load->model('Login_m');
		$this->load->model('Wishlist_m');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		check_login_user();
	}

	public function index()
	{
		$data['title'] = 'Akun saya';
		$data['user'] = $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		$data['prov'] = $this->get_provinsi();
		$data['notifcart'] 	= $this->Produk_m->notif_cart($data['user']['id_user']);
		
		$this->load->view('user/homeuser/header_user', $data);
		$this->load->view('user/homeuser/dashboard', $data);
		$this->load->view('user/homeuser/footer_user');
	}

	public function pemesanan()
	{
		$data['title'] = 'Pemesanan';
		$data['user'] = $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		$data['notifcart'] 	= $this->Produk_m->notif_cart($data['user']['id_user']);
		
		$this->load->view('user/homeuser/header_user', $data);
		$this->load->view('user/homeuser/pemesanan', $data);
		$this->load->view('user/homeuser/footer_user');
	}

	public function edit_profile()
	{
		$data['title'] 	= 'Edit profil';
		$data['user'] 	= $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		$data['notifcart'] 	= $this->Produk_m->notif_cart($data['user']['id_user']);
		$data['province'] = $this->get_provinsi();

		$this->load->view('user/homeuser/header_user', $data);
		$this->load->view('user/homeuser/edit_profil', $data);
		$this->load->view('user/homeuser/footer_user');
	}

	public function proses_edit() 
	{
		$data = array();
        $data['status'] = TRUE;
        $user['user'] = $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('username', 'Username', 'required|trim',[
            'required' 	  => '<i>*Username tidak boleh kosong<i>',
        ]);
		$this->form_validation->set_rules('notlp', 'Notlp', 'required|trim', [
			'required' 	  => '<i>*No telepon tidak boleh kosong</i>',
		]);

		if(empty($_POST['provinsiprofile'])){
			$this->form_validation->set_rules('provisiprofile', 'Provisi', 'required|trim',[
				'required'	  => '<i>*Provisi tidak boleh kosong</i>'
			]);
			$this->form_validation->set_rules('kotaprofile', 'Kota', 'required|trim',[
				'required'	  => '<i>*Kabupaten atau kota tidak boleh kosong</i>'
			]);
		}
		$this->form_validation->set_rules('kodepos', 'Kodepos', 'required|trim',[
			'required'	  => '<i>*Kodepos tidak boleh kosong</i>'
		]);
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim',[
			'required'	  => '<i>*Alamat tidak boleh kosong</i>'
		]);

		$this->form_validation->set_error_delimiters('', '');

		if($this->form_validation->run() == FALSE)
		{
			$data['inputerror'][] = 'username';
            $data['error_string'][] = form_error('username');

            $data['inputerror'][] = 'notlp';
            $data['error_string'][] = form_error('notlp');

            $data['inputerror'][] = 'kodepos';
            $data['error_string'][] = form_error('kodepos');

            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = form_error('alamat');

            if(empty($_POST['provinsiprofile'])){
            	$data['inputerror'][] = 'provisiprofile';
            	$data['error_string'][] = form_error('provisiprofile');

            	$data['inputerror'][] = 'kotaprofile';
            	$data['error_string'][] = form_error('kotaprofile');
            }      
            
            $data['status'] = FALSE;
            echo json_encode($data);

		}else{

			$data = array(
				'username'	   => $this->input->post('username'),
				'notlp' 	   => $this->input->post('notlp'),
				'provinsi' 	   => $this->input->post('provisiprofile'),
				'kabataukota'  => $this->input->post('kotaprofile'),
				'kodepos' 	   => $this->input->post('kodepos'),
				'alamat' 	   => $this->input->post('alamat'),
			);
	        
			$config['upload_path']    = './assets_user/images/fotoprofil/';
			$config['allowed_types']  = 'jpeg|jpg|png';
			$config['max_size'] 	  = '5000';
			$config['encrypt_name']   = 'file_name';

			$this->upload->initialize($config);

			if ($this->upload->do_upload('gambar'))
			{
				$img = $this->upload->data();
				$this->_create($img['file_name']);
				$data['gambar'] = $img['file_name'];

				$old_gambar = $user['user']['gambar'];
				if($old_gambar != 'default.jpg'){
					@unlink(FCPATH . 'assets_user/images/fotoprofil/' . $old_gambar);
				}
			}

	        $query = $this->Login_m->edit_profil_user($data, array('email' => $this->input->post('email')));
	        $data['success'] = TRUE;

            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}	

	public function ubah_password()
	{
		$data = array();
        $data['status'] = TRUE;
        $user['user'] = $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('passwordlama', 'Password lama', 'required|trim',[
        	'required' 	 => '<i>*Password lama tidak boleh kosong</i>',
        ]);

        $this->form_validation->set_rules('passwordbaru', 'Password baru', 'required|trim|min_length[3]|max_length[8]|matches[konfirmasipassword]',[
        	'required' 	 => '<i>*Password baru tidak boleh kosong</i>',
        	'min_length' =>	'<i>*Password min 3 karakter</i>',
        	'max_length' =>	'<i>*Password max 8 karakter</i>',
        	'matches'	 => '<i>*Konfirmasi password tidak cocok!<i>'
        ]);

        $this->form_validation->set_rules('konfirmasipassword', 'Konfirmasi password', 'required|trim|matches[passwordbaru]');

        $this->form_validation->set_error_delimiters('', '');

        if($this->form_validation->run() == FALSE){

        	$data['inputerror'][] = 'passwordlama';
        	$data['error_string'][] = form_error('passwordlama'); 

        	$data['inputerror'][] = 'passwordbaru';
        	$data['error_string'][] = form_error('passwordbaru');        
            
            $data['status'] = FALSE;
            echo json_encode($data);
        }else{

        	$old_password = $this->input->post('passwordlama');
        	$new_password = $this->input->post('passwordbaru');

        	//jika passwordnya tidak sama dengan password didatabase
        	if(!password_verify($old_password, $user['user']['password'])){
        		$data['inputerror'][] = 'passwordlama';
        		$data['error_string'][] = '<i>*Password lama tidak cocok !</i>';

        		$data['status'] = FALSE;
        		echo json_encode($data);
        	}else{
        		//jika password lama sama dengan password baru
        		if($old_password == $new_password){
        			$data['inputerror'][] = 'passwordbaru';
        			$data['error_string'][] = '<i>*Password tidak boleh sama dengan password lama!</i>';

        			$data['status'] = FALSE;
        			echo json_encode($data);
        		}else{

        			$email 		= $this->input->post('email');
        			$password 	= password_hash($new_password, PASSWORD_DEFAULT);

        			$this->db->set('password', $password);
        			$this->db->where('email', $this->session->userdata('email'));
        			$this->db->update('loginuser');	

        			$data['success'] = TRUE;
        			$this->output->set_content_type('application/json')->set_output(json_encode($data));
        		}
        	}

        }
	}

	// RESIZE IMAGE
    function _create($file_name)
    {
        //Compress Image
        $config['image_library']    ='gd2';
        $config['source_image']     ='./assets_user/images/fotoprofil/' . $file_name;
        $config['maintain_ratio']   = FALSE;
        $config['width']            = 1000;
        $config['height']           = 981;
        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();
    }

	public function get_provinsi()
	{
		$user['user'] = $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: 2c3638e5cdec670b46b23783b49b2f2d"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$provinsi = json_decode($response, TRUE);
			$prov = $provinsi['rajaongkir']['results'];

			return $prov;
		}
	}

	public function get_kota($id_provinsi)
	{	
		
		$user['user'] = $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $id_provinsi,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: 2c3638e5cdec670b46b23783b49b2f2d"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {

			$city = json_decode($response, TRUE);
			$kota = $city['rajaongkir']['results'];
			echo $response;
		}
	}

	public function wishlist()
	{
		$data['title'] 		= 'Wishlist';
		$data['user'] 		= $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		$data['notifcart'] 	= $this->Produk_m->notif_cart($data['user']['id_user']);
		$data['wishlist']	= $this->Wishlist_m->get_wishlist();

		$this->load->view('user/homeuser/header_user', $data);
		$this->load->view('user/homeuser/wishlist', $data);
		$this->load->view('user/homeuser/footer_user');
		$this->load->view('user/ajax/ajaxWishlist');
	}

	public function tambah_wishlist()
	{
		if(isset($_SESSION['email'])){
			$user 			= $_SESSION["id_user"];
			$id_produk 		= $this->input->post('id_produk');
			$cek = $this->db->query("SELECT * FROM wishlist WHERE id_user = '$user' AND id_produk = '$id_produk'");
			if($cek->num_rows() == 0){
				$data = array(
					'id_user'		=> $user,
					'id_produk'		=> $id_produk,
					'nama_produk'	=> $this->input->post('produk'),
					'harga'			=> $this->input->post('harga'),
					'gambar'		=> $this->input->post('gambar'),
				);
				
				$this->db->insert('wishlist', $data);
				$this->output->set_content_type('application/json')->set_output(json_encode(['success'=>true]));
			}else{

				$this->output->set_content_type('application/json')->set_output(json_encode(['error'=>false]));
			}
		}
	}

	public function hapus_wishlist($id)
	{
		$data['user'] = $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();

		$this->db->where('id_user', $data['user']['id_user']);
		$this->db->where('id_produk', $id);
		$this->db->delete('wishlist');

		$info['status'] = TRUE;
		echo json_encode($info);
	}

	public function tableWishlist()
    {

        $list = $this->Wishlist_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $wishlist) {

            $row = array();
            $row[] 	= '<img src="'.base_url() .'assets_admin/img/produk/'.$wishlist->gambar.'" alt="image" style="width:70px; height: 70px; border-radius:0px;">';
            $row[] 	= $wishlist->nama_produk;
            $row[] 	= 'Rp.'.number_format($wishlist->harga).'';
            $row[] 	= date('d-m-Y', strtotime($wishlist->tgl));

            if($wishlist->stok == 0){
 				$row[] 	= '<label class="badge badge-danger" style="width: 50px;">Habis</label>';
 			}elseif($wishlist->stok < 3){
 				$row[] 	= '<label class="badge badge-warning" style="width: 50px;">Sisa '.$wishlist->stok.'</label>';
 			}else{
 				$row[]	= '<label class="badge badge-success">Ready</label>';
 			}
 			if($wishlist->stok == 0){
 				$row[]	= '<button class="hapuswishlist badge badge-danger" id="'.$wishlist->id_produk.'" nama="'.$wishlist->nama_produk.'"><i class="fas fa-trash-alt"></i></button>';
 			}else{
 				$row[]	= '<a href="'.base_url() . 'Product/product_detail/' . $wishlist->id_produk.'" class="badge badge-primary"><i class="fas fa-eye"></i></a> <button class="hapuswishlist badge badge-danger" id="'.$wishlist->id_produk.'" nama="'.$wishlist->nama_produk.'"><i class="fas fa-trash-alt"></i></button>';
 			}
 			$row[] 	= $wishlist->id_user;
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => @$_POST['draw'],
                        "recordsTotal" => $this->Wishlist_m->count_all(),
                        "recordsFiltered" => $this->Wishlist_m->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 

}
