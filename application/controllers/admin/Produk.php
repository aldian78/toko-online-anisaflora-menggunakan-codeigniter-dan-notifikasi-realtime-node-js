<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Produk extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->model('Produk_m');
        $this->load->model('Kategori_m');

    }

    public function index()
    {
        $user['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('admin/template/header', $user);
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/produk');
        $this->load->view('admin/template/footer');
    }

    public function page_create()
    {
        $user['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['kategori'] = $this->Kategori_m->tampil_kategori();

        $this->load->view('admin/template/header', $user);
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/crudAjax/produk/create', $data);
        $this->load->view('admin/template/footer');
    }
 
    public function ajax_list()
    {
        $list = $this->Produk_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $produk) {
            $no++;
            $row = array();
            $row[] = $produk->gambar1 != null ? '<img src="'.base_url('assets_admin/img/produk/'.$produk->gambar1).'" class="img" style="width:70px; height: 70px">' : null;
            $row[] = word_limiter($produk->nama_produk, 2);
            $row[] = $produk->tanggal;
            if($produk->diskon_harga == null || $produk->diskon_harga == 0 ){
                $row[] = 'Tidak ada diskon';
            }else{
                $row[] = 'Rp.'. rupiah($produk->diskon_harga) . ',-';
            }   
            $row[] = 'Rp.'. rupiah($produk->harga) . ',-';
            $row[] = $produk->berat;
            $row[] = $produk->stok;
            $row[] = $produk->nama_kategori;
            if($produk->stok >= 1){
                $row[] = '<label class="badge badge-gradient-success">Ready</label>';
            }else{
                $row[] = '<label class="badge badge-gradient-danger">Habis</label>';
            }
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-gradient-info" title="Edit" href="'.base_url('admin/Produk/page_update/'.$produk->id_produk).'"><i class="mdi mdi-lead-pencil"></i></a>
                  <a class="btn btn-sm btn-gradient-danger" href="javascript:void(0)" title="Hapus" onclick="delete_produk('."'".$produk->id_produk."'".')"><i class="mdi mdi-delete"></i></a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => @$_POST['draw'],
                        "recordsTotal" => $this->Produk_m->count_all(),
                        "recordsFiltered" => $this->Produk_m->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
 
    public function ajax_create()
    {

        $this->_validate();

        $dataInfo = array();

        $countfiles = count($_FILES['files']['name']);
  
        for($i=0;$i < $countfiles;$i++){
            if(!empty($_FILES['files']['name'][$i])){

            // Define new $_FILES array - $_FILES['file']
            $_FILES['file']['name'] = $_FILES['files']['name'][$i];
            $_FILES['file']['type'] = $_FILES['files']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
            $_FILES['file']['error'] = $_FILES['files']['error'][$i];
            $_FILES['file']['size'] = $_FILES['files']['size'][$i];
 
            // Set preference
            $config['upload_path'] = './assets_admin/img/produk/'; //path folder
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = '5000'; // max_size in kb
            $config['file_name'] = $_FILES['files']['name'][$i];

            $this->upload->initialize($config);
  
                if($this->upload->do_upload('file')){
                    $img = $this->upload->data();
                    $this->_create($img['file_name']);
                    $dataInfo[] = $this->upload->data();
                }
            }
        }

        $nama   = $this->input->post('nama');
        $berat  = $this->input->post('berat');
        $stok  = $this->input->post('stok');
        $diskon = str_replace(".", "", $this->input->post('diskon_harga'));
        $harga  = str_replace(".", "", $this->input->post('harga'));
        $isi    = $this->input->post('isi');
        $kat    = $this->input->post('kategori');

        $insert = $this->Produk_m->save($nama, $berat, $stok, $diskon, $harga, $isi, $kat, $dataInfo);

        $data['success'] = TRUE;

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
        
    }

    // RESIZE IMAGE
    function _create($file_name)
    {
        //Compress Image
        $config['image_library']    ='gd2';
        $config['source_image']     ='./assets_admin/img/produk/' . $file_name;
        $config['maintain_ratio']   = FALSE;
        $config['width']            = 720;
        $config['height']           = 960;
        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nama') == '')
        {
            $data['inputerror'][]   = 'nama';
            $data['error_string'][] = '*Nama produk tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if($this->input->post('berat') == '')
        {
            $data['inputerror'][]   = 'berat';
            $data['error_string'][] = '*Berat tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('stok') == '')
        {
            $data['inputerror'][]   = 'stok';
            $data['error_string'][] = '*Stok tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('harga') == '')
        {
            $data['inputerror'][]   = 'harga';
            $data['error_string'][] = '*Harga tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('isi') == '')
        {
            $data['inputerror'][]   = 'isi';
            $data['error_string'][] = '*Deskripsi tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('kategori') == '')
        {
            $data['inputerror'][]   = 'kategori';
            $data['error_string'][] = '*Kategori tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if(empty($_FILES['files']['name']))
        {
            $data['inputerror'][]   = 'gambar';
            $data['error_string'][] = '*Gambar tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    function check_default($post_string)
    {
      return $post_string == '0' ? FALSE : TRUE;
    }

    public function page_update($id)
    {

        $user['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['kategori'] = $this->Kategori_m->tampil_kategori();
        $data['produk'] = $this->Produk_m->get_by_id($id);

        $this->load->view('admin/template/header', $user);
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/crudAjax/produk/update', $data);
        $this->load->view('admin/template/footer');
    }
 
    public function ajax_update()
    {
        $data = array();
        $data['status'] = TRUE;

        $this->form_validation->set_rules("nama", "Nama", "trim|required",[
            'required' => '<p><i>*Nama produk tidak boleh kosong !</i></p>'
        ]);
        $this->form_validation->set_rules("berat", "Berat", "trim|required",[
            'required' => '<p><i>*Berat tidak boleh kosong !</i></p>'
        ]);
        $this->form_validation->set_rules("harga", "Harga", "trim|required",[
            'required' => '<p><i>*Harga tidak boleh kosong !</i></p>'
        ]);
        $this->form_validation->set_rules("stok", "Stok", "trim|required",[
            'required' => '<p><i>*Stok tidak boleh kosong !</i></p>'
        ]);
        $this->form_validation->set_rules("isi", "Deskripsi", "trim|required",[
            'required' => '<p><i>*Deskripsi tidak boleh kosong !</i></p>'
        ]);
        $this->form_validation->set_rules("kategori", "Kategori", 'trim|required|callback_check_default',[
            'required'  => '<p><i>*Kategori tidak boleh kosong !</i></p>'
        ]);

        $this->form_validation->set_error_delimiters('', '');

        if($this->form_validation->run() == FALSE ){

            $data['inputerror'][]   = 'nama';
            $data['error_string'][] = form_error('nama');

            $data['inputerror'][]   = 'berat';
            $data['error_string'][] = form_error('berat');

            $data['inputerror'][]   = 'harga';
            $data['error_string'][] = form_error('harga');

             $data['inputerror'][]   = 'stok';
            $data['error_string'][] = form_error('stok');

            $data['inputerror'][]   = 'isi';
            $data['error_string'][] = form_error('isi');

            $data['inputerror'][]   = 'kategori';
            $data['error_string'][] = form_error('kategori');  

            $data['status'] = FALSE;

            echo json_encode($data);

        }else{

        $dataInfo = array();

        $data = array(
            'nama_produk'   => $this->input->post('nama'),
            'berat'         => $this->input->post('berat'),
            'stok'          => $this->input->post('stok'),
            'diskon_harga'  => !empty(str_replace(".", "", $this->input->post('diskon_harga'))) ? $this->input->post('diskon_harga') : null,
            'harga'         => str_replace(".", "", $this->input->post('harga')),
            'isi_produk'    => $this->input->post('isi'),
            'id_kategori'   => $this->input->post('kategori'),            
        );

        if (!empty($_FILES['files']['name'])) {
            $countfiles = count($_FILES['files']['name']);
      
            for($i=0;$i < $countfiles;$i++){
                if(!empty($_FILES['files']['name'][$i])){

                // Define new $_FILES array - $_FILES['file']
                $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                $_FILES['file']['size'] = $_FILES['files']['size'][$i];
     
                // Set preference
                $config['upload_path'] = './assets_admin/img/produk/'; //path folder
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '5000'; // max_size in kb
                $config['file_name'] = $_FILES['files']['name'][$i];

                $this->upload->initialize($config);
      
                    if($this->upload->do_upload('file')){
                        $img = $this->upload->data();
                        $this->_create($img['file_name']);
                        $dataInfo[] = $this->upload->data();
                       
                    }
                }
            }

            $image = $this->Produk_m->get_by_id($this->input->post('id_produk'));

            if(!empty($image)){  
                foreach($image as $img){  
                    $file1 = $img['gambar1'];
                    $file2 = $img['gambar2'];
                    $file3 = $img['gambar3'];
                    $file4 = $img['gambar4'];
                    $file5 = $img['gambar5'];

                    @unlink('assets_admin/img/produk/'.$file1);
                    @unlink('assets_admin/img/produk/'.$file2);
                    @unlink('assets_admin/img/produk/'.$file3); 
                    @unlink('assets_admin/img/produk/'.$file4);
                    @unlink('assets_admin/img/produk/'.$file5);  
                }  
            }  

            $data['gambar1'] = $dataInfo[0]['file_name'];
            if(!empty($dataInfo[1])){
                $data['gambar2'] = $dataInfo[1]['file_name']; //Jika gambar ke 2 tidak diisi maka kosong
            }else{
                $data['gambar2'] = null;
            }
            if(!empty($dataInfo[2])){
                $data['gambar3'] = $dataInfo[2]['file_name']; //Jika gambar ke 2 tidak diisi maka kosong
            }else{
                $data['gambar3'] = null;
            }
            if(!empty($dataInfo[3])){
                $data['gambar4'] = $dataInfo[3]['file_name']; //Jika gambar ke 2 tidak diisi maka kosong
            }else{
                $data['gambar4'] = null;
            }
            if(!empty($dataInfo[4])){
                $data['gambar5'] = $dataInfo[4]['file_name']; //Jika gambar ke 2 tidak diisi maka kosong
            }else{
                $data['gambar5'] = null;
            }
        }

        $insert = $this->Produk_m->update(array('id_produk' => $this->input->post('id_produk')), $data);

        $data['success'] = TRUE;

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
 
    public function ajax_delete($id)
    {
        $data  = $this->Produk_m->get_by_id($id);
        if(!empty($data)){  
            foreach($data as $img){  
                $file1 = $img['gambar1'];
                $file2 = $img['gambar2'];
                $file3 = $img['gambar3'];
                $file4 = $img['gambar4'];
                $file5 = $img['gambar5'];

                @unlink('assets_admin/img/produk/'.$file1);
                @unlink('assets_admin/img/produk/'.$file2);
                @unlink('assets_admin/img/produk/'.$file3);
                @unlink('assets_admin/img/produk/'.$file4); 
                @unlink('assets_admin/img/produk/'.$file5);  
            }  
        }  
        $this->Produk_m->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
}