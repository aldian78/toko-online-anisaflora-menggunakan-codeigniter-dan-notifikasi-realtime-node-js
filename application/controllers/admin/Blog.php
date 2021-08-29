<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Blog extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->model('blog_m');

    }

    public function index()
    {
        $user['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->load->view('admin/template/header', $user);
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/blog');
        $this->load->view('admin/template/footer');
    }

    public function page_create()
    {
        $user['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['kategori'] = $this->blog_m->tampil_kategori();

        $this->load->view('admin/template/header', $user);
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/crudAjax/blog/create', $data);
        $this->load->view('admin/template/footer');
    }
 
    public function ajax_list()
    {
        $list = $this->blog_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $blog) {
            $no++;
            $row = array();
            $row[] = $blog->gambar1 != null ? '<img src="'.base_url('assets_admin/img/blog/'.$blog->gambar1).'" class="img" style="width:70px; height: 70px">' : null;
            $row[] = $blog->judul;
            $row[] = $blog->tanggal;
            $row[] = $blog->nama_kategori;
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-gradient-info" title="Edit" href="'.base_url('admin/Blog/page_update/'.$blog->id_blog).'"><i class="mdi mdi-lead-pencil"></i></a>
                  <a class="btn btn-sm btn-gradient-danger" href="javascript:void(0)" title="Hapus" onclick="delete_blog('."'".$blog->id_blog."'".')"><i class="mdi mdi-delete"></i></a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => @$_POST['draw'],
                        "recordsTotal" => $this->blog_m->count_all(),
                        "recordsFiltered" => $this->blog_m->count_filtered(),
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
            $config['upload_path'] = './assets_admin/img/blog/'; //path folder
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = '5000'; // max_size in kb
            $config['file_name'] = $_FILES['files']['name'][$i];

            $this->upload->initialize($config);
  
                if($this->upload->do_upload('file')){
                    $imgBlog = $this->upload->data();
                    $this->_create($imgBlog['file_name']);
                    $dataInfo[] = $this->upload->data();
                }
            }
        }

        $judul  = $this->input->post('judul');
        $isi    = $this->input->post('isi');
        $kat    = $this->input->post('kategori');

        $insert = $this->blog_m->save($judul, $isi, $kat, $dataInfo);

        $data['success'] = TRUE;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
        
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('judul') == '')
        {
            $data['inputerror'][] = 'judul';
            $data['error_string'][] = '*Judul tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if($this->input->post('isi') == '')
        {
            $data['inputerror'][] = 'isi';
            $data['error_string'][] = '*Deskripsi tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if($this->input->post('kategori') == '')
        {
            $data['inputerror'][] = 'kategori';
            $data['error_string'][] = '*Kategori tidak boleh kosong';
            $data['status'] = FALSE;
        }
        if(empty($_FILES['files']['name']))
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

    function check_default($post_string)
    {
      return $post_string == '0' ? FALSE : TRUE;
    }

    // RESIZE IMAGE
    function _create($file_name)
    {
        //Compress Image
        $config['image_library']    ='gd2';
        $config['source_image']     ='./assets_admin/img/blog/' . $file_name;
        $config['maintain_ratio']   = FALSE;
        $config['width']            = 820;
        $config['height']           = 481;
        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();
    }

    public function page_update($id)
    {

        $user['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['kategori'] = $this->blog_m->tampil_kategori();
        $data['blog'] = $this->blog_m->get_by_id($id);

        $this->load->view('admin/template/header', $user);
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/crudAjax/blog/update', $data);
        $this->load->view('admin/template/footer');
    }
 
    public function ajax_update()
    {
        $data = array();
        $data['status'] = TRUE;

        $this->form_validation->set_rules("judul", "Judul", "trim|required",[
            'required' => '*Judul tidak boleh kosong'
        ]);
        $this->form_validation->set_rules("isi", "Isi", "trim|required",[
            'required' => '*Deskripsi tidak boleh kosong'
        ]);
        $this->form_validation->set_rules("kategori", "Kategori", 'trim|required|callback_check_default',[
            'required'  => '*Kategori tidak boleh kosong'
        ]);

        $this->form_validation->set_error_delimiters('', '');

        if($this->form_validation->run() == FALSE ){

            $data['inputerror'][] = 'judul';
            $data['error_string'][] = form_error('judul');

            $data['inputerror'][] = 'isi';
            $data['error_string'][] = form_error('isi');

            $data['inputerror'][] = 'kategori';
            $data['error_string'][] = form_error('kategori');            
            $data['status'] = FALSE;

            echo json_encode($data);

        }else{

            $dataInfo = array();
            $data = array(
                'judul'       => $this->input->post('judul'),
                'isi'         => $this->input->post('isi'),
                'id_kategori' => $this->input->post('kategori'),
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
                    $config['upload_path'] = './assets_admin/img/blog/'; //path folder
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['max_size'] = '5000'; // max_size in kb
                    $config['file_name'] = $_FILES['files']['name'][$i];

                    $this->upload->initialize($config);
          
                        if($this->upload->do_upload('file')){
                            $imgBlog = $this->upload->data();
                            $this->_create($imgBlog['file_name']);
                            $dataInfo[] = $this->upload->data();
                           
                        }
                    }
                }

                $image = $this->blog_m->get_by_id($this->input->post('id_blog'));
                if(!empty($image)){  
                    foreach($image as $img){  
                        $file1 = $img['gambar1'];
                        $file2 = $img['gambar2'];
                        $file3 = $img['gambar3'];

                        @unlink('assets_admin/img/blog/'.$file1);
                        @unlink('assets_admin/img/blog/'.$file2);
                        @unlink('assets_admin/img/blog/'.$file3);  
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
            } 
           
            $insert = $this->blog_m->update(array('id_blog' => $this->input->post('id_blog')), $data);

            $data['success'] = TRUE;

            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
 
    public function ajax_delete($id)
    {
        $image = $this->blog_m->get_by_id($id);

        if(!empty($image)){  
            foreach($image as $img){  
                $file1 = $img['gambar1'];
                $file2 = $img['gambar2'];
                $file3 = $img['gambar3'];

                @unlink('assets_admin/img/blog/'.$file1);
                @unlink('assets_admin/img/blog/'.$file2);
                @unlink('assets_admin/img/blog/'.$file3); 
            }  
        }  
        
        $this->blog_m->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
}