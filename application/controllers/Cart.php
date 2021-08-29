<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->model('Produk_m');
		$this->load->model('Blog_m');
		$this->load->model('Kategori_m');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] 		= 'Keranjang';
		$data['kategori']	= $this->Kategori_m->tampil_kategori();
		
		$data['user'] 		= $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		if(isset($_SESSION['id_user'])){
			$data['notifcart'] 	= $this->Produk_m->notif_cart($data['user']['id_user']);
		}

		$this->load->view('user/template/header', $data);
		$this->load->view('user/cart', $data);
		$this->load->view('user/template/footer');
		$this->load->view('user/ajax/ajaxCart');
	}

	public function tambah_keranjang()
	{
		if(isset($_SESSION['email'])){
			$user 	= $_SESSION["id_user"];
			$id 	= $this->input->post('id_produk');
			$cek = $this->db->query("SELECT * FROM cart WHERE id_user = '$user' AND id_produk = '$id'");
			if($cek->num_rows() > 0){
				$get = $this->db->query("SELECT * FROM cart WHERE id_user = '$user' AND id_produk = '$id'")->result();
				foreach ($get as $value) {
					$this->db->set('qty', $value->qty+1);
					$this->db->where('id_produk', $id);
					$this->db->update('cart');
				}

				$data['tambahqty'] = true;
				$this->output->set_content_type('application/json')->set_output(json_encode($data));
			}else{
				$data = array(
					'id_user'	=> $user,
					'id_produk' => $this->input->post('id_produk'),
					'nama' 	 	=> $this->input->post('nama_produk'),
					'harga' 	=> $this->input->post('harga'),
					'qty'   	=> $this->input->post('qty'),
					'gambar'   	=> $this->input->post('gambar'),
				);
				$this->db->insert('cart', $data);
				echo $this->Produk_m->notif_cart($user);
			}
		}
	}

	public function get_cart()
	{
		$output = '';
		$data['user'] = $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		$get = $this->Produk_m->get_cart($data['user']['id_user']);
		if(!empty($get)){
			$no = 0;
			$output .= '<ul class="header-cart-wrapitem app">';
			foreach ($get as $items) {
				$total[] = $items->qty*$items->harga;
				$no++;
				$output .='
						<li class="header-cart-item">
							<div class="header-cart-item-img">
								<img src="'.base_url() . 'assets_admin/img/produk/' . $items->gambar.'" alt="IMG">
							</div>

							<div class="header-cart-item-txt">
								<a href="#" class="header-cart-item-name namaproduk">
									'.$items->nama.'
								</a>

								<span class="header-cart-item-info">
									'.$items->qty.' x '.number_format($items->harga).'
								</span>
							</div>
						</li>';
			}
			$output .= '</ul>';
			$output .= '<div class="header-cart-total">
							Total : '.'Rp '.number_format(array_sum($total)).'
						</div>';
			$output .= '<div class="header-cart-buttons">
							<div class="header-cart-wrapbtn">
								<a href="'.base_url() . 'Cart'.'" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
									View Cart
								</a>
							</div>

							<div class="header-cart-wrapbtn">
								<a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
									Check Out
								</a>
							</div>
						</div>';
		}else{
			$output .= '<div class="s-text3" style="text-align: center;">
							Tidak ada produk dikeranjang
						</div>';
		}

		echo $output;
	}

	public function cart_table()
	{

		$cart_table = '';
		$data['user'] = $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		$get = $this->Produk_m->get_cart($data['user']['id_user']);
		if(!empty($get)){
			$cart_table .='
				<div class="wrap-table-shopping-cart bgwhite" id="cart_table">
					<table class="table-shopping-cart">
					<thead>
					<tr class="table-head">
						<th class="column-1">Gambar</th>
						<th class="column-2">Produk</th>
						<th class="column-3">Harga</th>
						<th class="column-3">Kuantitas</th>
						<th class="column-5">Total</th>
						<th class="column-6">Status</th>
						<th class="column-6">Hapus</th>
					</tr>
					</thead>
				<tbody>';
			$no = 0;
			foreach ($get as $value) {
				$no++;
				$total = $value->qty*$value->harga;
				$cart_table .='
						<tr class="table-row">';
						$cart_table .='<td class="column-1">
								<div class="cart-img-product b-rad-4 o-f-hidden">
									<img src="'.base_url() . 'assets_admin/img/produk/' . $value->gambar.'" alt="IMG-PRODUCT">
								</div>
							</td>
							<td class="column-2">'.$value->nama.'</td>';

							if($value->stok == 0){
								$cart_table .='<td class="column-3">Rp. 0</td>
								<td class="column-3">
								<div class="flex-w bo5 of-hidden w-size17">
									<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2" disabled>
										<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
									</button>
									<input class="size8 m-text18 t-center num-product" type="number" name="num-product1" idupdate="'.$value->id_produk.'" value="0" nama="'.$value->nama.'">
									<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2" disabled>
										<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
									</button>
								</div>
							</td>
							<td class="column-5">Rp. 0</td>
							<td class="column-6"><p class="flex-c-m bg10 bo-rad-23 hov1 s-text24 trans-0-4" style="width:100%;">Habis</p></td>';
							}elseif($value->qty > $value->stok){
								$total1 = $value->stok*$value->harga;
								$cart_table .='<td class="column-3">Rp. '.number_format($value->harga).'</td>
							<td class="column-3">
								<div class="flex-w bo5 of-hidden w-size17">
									<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2" iduser="'.$data['user']['id_user'].'" idupdate="'.$value->id_produk.'" 
										nama="'.$value->nama.'">
										<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
									</button>
									<input class="size8 m-text18 t-center num-product" type="number" name="num-product1" idupdate="'.$value->id_produk.'" value="'.$value->stok.'" nama="'.$value->nama.'">
									<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2" disabled>
										<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
									</button>
								</div>
							</td>
							<td class="column-5">Rp. '.number_format($total1).'</td>
							<td class="column-6"><p class="flex-c-m bg11 bo-rad-23 hov1 s-text24 trans-0-4" style="width:100%;">Sisa '.$value->stok.'</p></td>';
							}else{
								$cart_table .='<td class="column-3">Rp. '.number_format($value->harga).'</td>
							<td class="column-3">
								<div class="flex-w bo5 of-hidden w-size17">
									<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2" iduser="'.$data['user']['id_user'].'" idupdate="'.$value->id_produk.'" nama="'.$value->nama.'">
										<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
									</button>
									<input class="size8 m-text18 t-center num-product" type="number" name="num-product1" iduser="'.$data['user']['id_user'].'" idupdate="'.$value->id_produk.'" value="'.$value->qty.'" nama="'.$value->nama.'">
									<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2" iduser="'.$data['user']['id_user'].'" idupdate="'.$value->id_produk.'" nama="'.$value->nama.'">
										<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
									</button>
								</div>
							</td>
							<td class="column-5">Rp. '.number_format($total).'</td>
							<td class="column-6"><p class="flex-c-m bg9 bo-rad-23 hov1 s-text24 trans-0-4" style="width:100%;">Ready</p></td>';
							}

							$cart_table .= '<td class="column-6">
								<button class="hapuscart" type="button" iduser="'.$data['user']['id_user'].'" idproduk="'.$value->id_produk.'" nama="'.$value->nama.'"><i class="fa fa-trash fa-1x" style="color: #f0111a;"></i>
									</button>
								</td>
						</tr>';
			}
			$cart_table .= '</tbody>
						</table>
					</div>';
		}else{
			$cart_table .= '<div class="alert alert-warning" role="alert">
								Keranjang masih kosong... <a href="'.base_url(). 'Product' .'" class="alert-link"> Lanjutkan</a> shooping ?
						</div>';
		}

		echo $cart_table;
	}

	public function cart_total()
	{
		$cart_total = '';
		$data['user'] = $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();
		$get = $this->Produk_m->get_cart($data['user']['id_user']);
		foreach ($get as $key => $a) {
				if($a->stok == 0){
					$harga[] = 0;
				}elseif($a->qty > $a->stok){
					$harga[] = $a->stok*$a->harga;
				}else{
					$harga[] = $a->qty*$a->harga;
				}
		}
		$cart_total .='
			<h5 class="m-text20 p-b-24">
				Total semua produk kecuali produk yang berstatus habis
			</h5>

			<div class="flex-w flex-sb-m p-b-12">
				<span class="s-text18 w-size19 w-full-sm">
					Subtotal:
				</span>

				<span class="m-text21 w-size20 w-full-sm">';
				if(!empty($harga)){
					$cart_total .=	'Rp. '.number_format(array_sum($harga)).'';
				}
				$cart_total .=	'</span>
								</div>
				<div class="flex-w flex-sb bocustom p-t-15 p-b-20">
					<span class="s-text18 w-size19 w-full-sm">
						Total:
					</span>

				<div class="w-size20 w-full-sm">
					<div class="size14 trans-0-4 m-b-10">
						<span class="m-text21 w-size20 w-full-sm">';
						
						if(!empty($harga)){
							$cart_total .='Rp. '.number_format(array_sum($harga)).'';
						}
					$cart_total .='</span>
						</div>
					</div>
				</div>

				<div class="size15 trans-0-4">
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
						Proceed to Checkout
					</button>
				</div>
				<div class="size15 trans-0-4 m-t-20">
					<button class="clearcart flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" iduser="'.$data['user']['id_user'].'">
						Kosongkan Keranjang
					</button>
				</div>';
		
		echo $cart_total;
	}

	public function hapus_keranjang()
	{	
		$iduser   = $this->input->post('iduser');
		$idproduk = $this->input->post('idproduk');

		$this->db->where('id_user', $iduser);
		$this->db->where('id_produk', $idproduk);
		$this->db->delete('cart');

		echo $this->Produk_m->notif_cart($iduser);
	}

	public function clear_keranjang()
	{
		$iduser   = $this->input->post('iduser');

		$this->db->where('id_user', $iduser);
		$this->db->delete('cart');	
		echo $this->Produk_m->notif_cart($iduser);
	}

	public function update_cart()
	{
		if(isset($_SESSION['email'])){
			$id_user    = $_SESSION['id_user'];
			$id_produk 	= $this->input->post('id_produk');
			$qty		= $this->input->post('qty');
			
			$this->db->set('qty', $qty);
			$this->db->where('id_user', $id_user);
			$this->db->where('id_produk', $id_produk);
			$this->db->update('cart');
			
			echo $this->Produk_m->notif_cart($id_user);
		}
	}

}