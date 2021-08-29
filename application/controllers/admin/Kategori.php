<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Kategori extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->model('Kategori_m');

    }

    public function index()
    {
        $user['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('admin/template/header', $user);
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/kategori');
        $this->load->view('admin/template/footer');
    }

    public function page_create()
    {
        $user['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['kategori'] = $this->Kategori_m->tampil_kategori()->result();

        $this->load->view('admin/template/header', $user);
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/crudAjax/produk/create', $data);
        $this->load->view('admin/template/footer');
    }
 
    public function ajax_list()
    {
        $list = $this->Kategori_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $kat) {
            $no++;
            $row = array();
            $row[] = $kat->gambar != null ? '<img src="'.base_url('assets_admin/img/kategori/'.$kat->gambar).'" class="img" style="width:70px; height: 70px">' : null;
            $row[] = $kat->nama_kategori;
            
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-gradient-info" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$kat->id_kategori."'".')"><i class="mdi mdi-lead-pencil"></i></a>
                  <a class="btn btn-sm btn-gradient-danger" href="javascript:void(0)" title="Hapus" onclick="delete_produk('."'".$kat->id_kategori."'".')"><i class="mdi mdi-delete"></i></a>';
 
            $data[] = $row;
        }

        $output = array(
                        "draw" => @$_POST['draw'],
                        "recordsTotal" => $this->Kategori_m->count_all(),
                        "recordsFiltered" => $this->Kategori_m->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
 
   public function ajax_add()
    {

        $this->_validate(); //Panggil fungsi validate
        $data = array(
            'nama_kategori' => $this->input->post('nama_kategori'),
        ); 

        if(!empty($_FILES['gambar']['name']))
        {
            $upload = $this->_do_upload($_FILES['gambar']['name']);
            $data['gambar'] = $upload;
        }

        $insert = $this->Kategori_m->save($data);
        echo json_encode(array("status" => TRUE));
        
    }

    public function ajax_edit($id)
    {
        $data = $this->Kategori_m->get_by_id($id);
        echo json_encode($data);
    }
    
    public function ajax_update()
    {
        $data = array();
        $data['status'] = TRUE;

        $this->form_validation->set_rules("nama_kategori", "Nama kategori", "trim|required",[
            'required' => '*Nama kategori tidak boleh kosong !'
        ]);

        $this->form_validation->set_error_delimiters('', '');

        if($this->form_validation->run() == FALSE ){

            $data['inputerror'][] = 'nama_kategori';
            $data['error_string'][] = form_error('nama_kategori');
            $data['status'] = FALSE;

            echo json_encode($data);

        }else{
            $data = array(
                'nama_kategori' => $this->input->post('nama_kategori'),
            );
     
            if(!empty($_FILES['gambar']['name']))
            {
                $upload = $this->_do_upload($_FILES['gambar']['name']); //Panggil funsi upload image

                //delete file
                $data1 = $this->Kategori_m->get_by_id($this->input->post('id'));
                $filename = 'assets_admin/img/kategori/' . $data1->gambar;
                if(file_exists($filename) && $filename) //periksa apakah ada filenya ?
                    unlink($filename);
     
                $data['gambar'] = $upload;
            }
     
            $this->Kategori_m->update(array('id_kategori' => $this->input->post('id')), $data);
            echo json_encode(array("status" => TRUE));
        }
    }

    public function ajax_delete($id)
    {
        $data  = $this->Kategori_m->get_id_delete($id);
        
       if(!empty($data)){  
            foreach($data as $img){  
                $file = $img['gambar'];
                @unlink('assets_admin/img/kategori/'.$file);
            }  
        }  

        $deleteProduk = $this->Kategori_m->get_by_id_produk($id); 
        if(!empty($deleteProduk)){  
            foreach($deleteProduk as $img){  
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

        $this->Kategori_m->delete_by_id($id);
        $this->Kategori_m->delete_produk_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    // UPLOAD IMAGE
    private function _do_upload($file_name)
    {
        $config['upload_path']          = './assets_admin/img/kategori/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp';
        $config['encrypt_name']         = 'file_name'; //just milisecond timestamp fot unique name
 
        $this->upload->initialize($config);
 
        if(!$this->upload->do_upload('gambar')) //upload and validate
        {
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }

        $img = $this->upload->data();
        $this->_create($img['file_name']);
        return $img['file_name'];
    }

    // RESIZE IMAGE
    function _create($file_name)
    {
        //Compress Image
        $config['image_library']    ='gd2';
        $config['source_image']     ='./assets_admin/img/kategori/' . $file_name;
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
 
        if($this->input->post('nama_kategori') == '')
        {
            $data['inputerror'][] = 'nama_kategori';
            $data['error_string'][] = '*Nama kategori tidak boleh kosong';
            $data['status'] = FALSE;
        }
 
        if(empty($_FILES['gambar']['name']))
        {
            $data['inputerror'][] = 'gambar';
            $data['error_string'][] = '*Gambar tidak boleh kosong';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}