<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->library('form_validation');
		$this->load->model('Login_m');
		$this->load->model('Blog_m');
		$this->load->model('Kategori_m');
		$this->load->model('Produk_m');
	}

	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim',[
            'required' => '<i>*Email tidak boleh kosong</i>'
        ]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim',[
            'required' => '<i>*Password tidak boleh kosong</i>'
        ]);

		if ($this->form_validation->run() == false){

			$data['title'] 		= 'Login';
			$data['kategori'] 	= $this->Kategori_m->tampil_kategori();
			$data['user'] 		= $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
			if(!empty($data['user'])){
 				$data['notifcart'] 	= $this->Produk_m->notif_cart($data['user']['id_user']);
			}

			$this->load->view('user/template/header', $data);
			$this->load->view('user/login', $data);
			$this->load->view('user/template/footer');
			$this->load->view('user/ajax/ajaxInput');
		
		}else{
			$this->_login();
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('loginuser', ['email' => $email])->row_array();
		
		//jika usernya ada
		if($user){
			//jika status aktif / = 1
			if($user['status'] == 1){
				if(password_verify($password, $user['password'])){
					$data = [
						'id_user' 	=> $user['id_user'],
						'email' 	=> $user['email'],
						'status' 	=> $user['status'],
					];

					$this->session->set_userdata($data);
					redirect('Homeuser');

				}else{
					$this->session->set_flashdata('gagal', '<div class="alert alert-danger" style="max-width: 380px; width: 100%" role="alert">
					Password anda salah! </div>');
					redirect('Auth');
				}
			}else{
				$this->session->set_flashdata('gagal', '<div class="alert alert-danger" style="max-width: 380px; width: 100%" role="alert">
				Akun anda tidak aktif! </div>');
				redirect('Auth');
			}
		}else{

			$this->session->set_flashdata('gagal', '<div class="alert alert-danger" style="max-width: 380px; width: 100%" role="alert">
			Email belum terdaftar! </div>');
			redirect('Auth');
		}
	}

	public function register()
	{
		$this->form_validation->set_rules('emailregis', 'Email', 'required|trim|valid_email|is_unique[loginuser.email]',[
            'required' 	  => '<i>*Email tidak boleh kosong</i>',
            'is_unique'	  => '<i>*Email sudah terdaftar</i>',
            'valid_email' => '<i>*Email tidak valid</i>'
        ]);
		$this->form_validation->set_rules('username', 'Username', 'required|trim',[
            'required' => '<i>*Username tidak boleh kosong</i>'
        ]);
        $this->form_validation->set_rules('notlp', 'No tlp', 'required|trim|max_length[12]',[
            'required' 	 => '<i>*No telepon tidak boleh kosong</i>',
            'max_length' => '<i>*No telepon max 12 nomor</i>',
        ]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|max_length[8]|matches[password2]',[
            'required' 	 => '<i>*Password tidak boleh kosong</i>',
            'matches'	 => '<i>*Password tidak cocok</i>',
            'min_length' =>	'<i>*Password min 3 karakter</i>',
            'max_length' =>	'<i>*Password max 8 karakter</i>',
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if($this->form_validation->run() == false)
		{
			$data['title'] 		= 'Registration';
			$data['kategori'] 	= $this->Kategori_m->tampil_kategori();

			$this->load->view('user/template/header', $data);
			$this->load->view('user/register', $data);
			$this->load->view('user/template/footer');

		}else{

			$data = array(
				'email'		=> htmlspecialchars($this->input->post('emailregis', TRUE)),
				'username'	=> htmlspecialchars($this->input->post('username', TRUE)),
				'notlp'		=> htmlspecialchars($this->input->post('notlp', TRUE)),
				'password'	=> password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'tanggal'	=> date("Y-m-d h:i:s"),
				'gambar'	=> 'default.jpg',
				'status'	=>	1,
			);

			$this->db->insert('loginuser', $data);
			$this->session->set_flashdata('success', '<div class="alert alert-success" style="max-width: 380px; width: 100%" role="alert">
            Selamat akun anda sudah terdaftar, Silahkan login </div>');
			redirect('Auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('status');

		$this->session->set_flashdata('success', '<div class="alert alert-success" style="max-width: 380px; width: 100%" role="alert">
        Berhasil logout</div>');
		redirect('Auth');
	}

	public function forgot_password()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
			'required' => '<i>*Silahkan masukkan Email</i>'
		]); 

		if ( $this->form_validation->run() == FALSE){

			$data['title'] = "Lupa password";
			$data['kategori'] 	= $this->Kategori_m->tampil_kategori();

			$this->load->view('user/template/header', $data);
			$this->load->view('user/forgot_password');
			$this->load->view('user/template/footer');
		}else{

			$email = $this->input->post('email');
			$user  = $this->db->get_where('loginuser', ['email' => $email])->row_array();

			if($user){
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'waktu'	=> time(),
				];

				$this->db->insert('loginuser_token', $user_token);
				$this->_sendemail($token, 'forgot_password');

				$this->session->set_flashdata('success','<div class="alert alert-success" style="max-width: 380px; width: 100%" role="alert">
				Silahkan check spam atau kotak masuk email untuk reset password</div>');
				redirect('Auth/forgot_password');
			}else{

				$this->session->set_flashdata('gagal','<div class="alert alert-danger" style="max-width: 380px; width: 100%" role="alert">
				Email belum terdaftar ! </div>');
				redirect('Auth/forgot_password');
			}
		}
	}

	private function _sendemail($token, $type){
        
        $this->load->library('email');  
  
        $config = array();  
        $config['protocol'] 	= 'smtp';  
        $config['smtp_host'] 	= 'ssl://smtp.googlemail.com';  
        $config['smtp_user'] 	= 'anisaflorasidoarjo@gmail.com';  
        $config['smtp_pass'] 	= '@anisa123';  
        $config['smtp_port'] 	= 465;
        $config['mailtype'] 	= 'html';    
        $config['charset'] 		= 'utf-8'; 
        $config['newline'] 		= "\r\n";  

        $this->email->initialize($config);  

        $this->email->from('anisaflorasidoarjo@gmail.com', 'Anisa Flora Sidoarjo');
        $this->email->to($this->input->post('email'));
        if($type == 'forgot_password'){
        	$this->email->subject('Reset Password');
        	$this->email->message('Klik link untuk reset password : <a href="' . base_url() . 'Auth/reset_password?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"> Reset Password </a>');
        }

        if($this->email->send())
        {
            return true;
        }else{

	        echo $this->email->print_debugger();
	        die;
        }
    }

    public function reset_password()
    {
    	$email = $this->input->get('email');
    	$token = $this->input->get('token');

    	$user  = $this->db->get_where('loginuser', ['email' => $email])->row_array();

    	if($user)
    	{
    		$token  = $this->db->get_where('loginuser_token', ['token' => $token])->row_array();
    		if($token)
    		{
    			$this->session->set_userdata('reset_email', $email);
    			$this->change_password();

    		}else{
    			$this->session->set_flashdata('gagal','<div class="alert alert-danger" style="max-width: 380px; width: 100%" role="alert">
    			Reset password gagal. Token salah! </div>');
    			redirect('Auth');
    		}

    	}else{

    		$this->session->set_flashdata('gagal','<div class="alert alert-danger" style="max-width: 380px; width: 100%" role="alert">
    		Reset password gagal. Email salah! </div>');
    		redirect('Auth');
    	}
    }

    public function change_password()
    {
    	if(!$this->session->userdata('reset_email')){
    		redirect('Auth');
    	}

    	$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|max_length[8]|matches[password2]',[
            'required' 	 => '<i>*Password tidak boleh kosong</i>',
            'matches'	 => '<i>*Password tidak cocok</i>',
            'min_length' =>	'<i>*Password min 3 karakter</i>',
            'max_length' =>	'<i>*Password max 8 karakter</i>',
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|max_length[8]|matches[password1]',[
        	'required' 	 => '<i>*Konfirmasi password tidak boleh kosong</i>',
        	'matches'	 => '<i>*Password tidak cocok</i>',
            'min_length' =>	'<i>*Password min 3 karakter</i>',
            'max_length' =>	'<i>*Password max 8 karakter</i>',
        ]);

        if($this->form_validation->run() == FALSE){

        	$data['title'] = "Lupa password";
        	$data['kategori'] 	= $this->Kategori_m->tampil_kategori();

        	$this->load->view('user/template/header', $data);
        	$this->load->view('user/change_password');
        	$this->load->view('user/template/footer');
        }else{

        	$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
        	$email 	  = $this->session->userdata('reset_email');

        	$this->db->set('password', $password);
        	$this->db->where('email', $email);
        	$this->db->update('loginuser');

        	$this->session->unset_userdata('reset_email'); 

        	$this->session->set_flashdata('success','<div class="alert alert-success" style="max-width: 380px; width: 100%" role="alert">
        	Password berhasil diubah. Silahkan login!</div>');
        	redirect('Auth');
        }
    }
}
