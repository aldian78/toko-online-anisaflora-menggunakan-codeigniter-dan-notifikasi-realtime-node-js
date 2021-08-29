<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blog_m extends CI_Model
{
    function tampil_blog()
    {
        $this->db->join('kategori', 'kategori.id_kategori=blog.id_kategori');
        $this->db->order_by('id_blog', 'DESC');
        $hsl = $this->db->get('blog');
        return $hsl->result();
    }

    function pagination()
    {

       return $this->db->get('blog')->num_rows();
    }

    function tampil_blog_limit($number, $offset)
    {
       $this->db->select('*, COUNT(komentar_blog.id_blog) as komen, blog.id_blog as id');
       $this->db->from('blog');
       $this->db->join('kategori','kategori.id_kategori=blog.id_kategori');
       $this->db->join('komentar_blog','komentar_blog.id_blog=blog.id_blog', 'left');
       $this->db->group_by('blog.id_blog');
       $this->db->order_by('id', 'DESC');
       $this->db->limit($number, $offset);
       $hsl = $this->db->get();
       return $hsl->result();
    }

    function joinproduk()
    {
        $this->db->select('*');
        $this->db->from('produk');
        $this->db->join('kategori','kategori.id_kategori=produk.id_kategori');
        $this->db->order_by('id_produk', 'DESC');
        $this->db->limit(8);
        $query = $this->db->get();
        return $query->result();
    }

    function join()
    {
        $this->db->select('*');
        $this->db->from('blog');
        $this->db->join('kategori','kategori.id_kategori=blog.id_kategori');
        $this->db->order_by('id_blog', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    
    function blogHome()
    {
        $this->db->select('*');
        $this->db->from('blog');
        $this->db->join('kategori','kategori.id_kategori=blog.id_kategori');
        $this->db->order_by('id_blog', 'DESC');
        $this->db->limit(3);
        $query = $this->db->get();
        return $query->result();
    }

    function blog_detail($kode)
    {
        $this->db->select('*, COUNT(komentar_blog.id_blog) as komen');
        $this->db->from('blog');
        $this->db->join('kategori','kategori.id_kategori=blog.id_kategori');
        $this->db->join('komentar_blog','komentar_blog.id_blog=blog.id_blog', 'left');
        $this->db->group_by('blog.id_blog');
        $this->db->where('blog.id_blog', $kode);
        $query = $this->db->get();
        return $query->result();
    }

    //pagination
    function get_blog($limit, $start)
    {
       
        $this->db->select('*');
        $this->db->join('kategori','kategori.id_kategori=blog.id_kategori');
        $this->db->order_by('id_blog');
        $query = $this->db->get('blog');
        return $query->result_array();
    }

    //SEARCH BLOG
    function pagination_search_blog($keyword = '')
    {
        if($keyword)
        {
            $this->db->like('judul', urldecode($keyword)); //pencarian dengan spasi + ganti config
        }

        $this->db->join('kategori', 'kategori.id_kategori=blog.id_kategori');
        $query = $this->db->get('blog');
        return $query->num_rows();
    }

    function hasil_search_blog($sampai, $from, $keyword = ''){

        if($keyword)
        {
            $this->db->like('judul', urldecode($keyword)); //pencarian dengan spasi + ganti config
        }

        $this->db->select('*, COUNT(komentar_blog.id_blog) as komen, blog.id_blog as id');
        $this->db->from('blog');
        $this->db->join('kategori','kategori.id_kategori=blog.id_kategori');
        $this->db->join('komentar_blog','komentar_blog.id_blog=blog.id_blog', 'left');
        $this->db->group_by('blog.id_blog');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($sampai,$from);
        $query = $this->db->get();
        return $query->result();
    } 
    //END SEARCH

    //FILTER BLOG SESUAI KATEGORI
    function filter_blog_by_id($kat= '')
    {

        if($kat)
        {
            $this->db->where('blog.id_kategori', $kat);
        }

        $this->db->order_by('id_blog', 'DESC');
        $this->db->join('kategori', 'kategori.id_kategori=blog.id_kategori');
        $query = $this->db->get('blog');
        return $query->num_rows();
    }

    function filterBlog($sampai, $from, $kat= '')
    {
        if($kat)
        {
            $this->db->where('blog.id_kategori', $kat);
        }

        $this->db->select('*, COUNT(komentar_blog.id_blog) as komen, blog.id_blog as id');
        $this->db->from('blog');
        $this->db->join('kategori','kategori.id_kategori=blog.id_kategori');
        $this->db->join('komentar_blog','komentar_blog.id_blog=blog.id_blog', 'left');
        $this->db->group_by('blog.id_blog');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($sampai, $from);
        $hsl = $this->db->get();
        return $hsl->result();
    }
    //END FILTER BLOG

    //ARSIP BLOG
    function arsip_blog()
    {
        $this->db->select('tanggal, COUNT(DATE(tanggal)) as tgl');
        $this->db->group_by('DATE(tanggal)'); 
        $this->db->order_by('tgl', 'desc'); 
        $query = $this->db->get('blog');
        return $query->result();
    }

    function getArsip($tgl= '')
    {
        if($tgl)
        {
            $this->db->where('tanggal >=', $tgl);
            $this->db->where('tanggal <=', $tgl);
        }

        $this->db->order_by('id_blog', 'DESC');
        $this->db->join('kategori', 'kategori.id_kategori=blog.id_kategori');
        $query = $this->db->get('blog');
        return $query->num_rows();
    }

    function arsipBytgl($sampai, $from, $tgl= '')
    {
        if($tgl)
        {
           $this->db->where('tanggal >=', $tgl);
           $this->db->where('tanggal <=', $tgl);
        }

        $this->db->select('*, COUNT(komentar_blog.id_blog) as komen, blog.id_blog as id');
        $this->db->from('blog');
        $this->db->join('kategori','kategori.id_kategori=blog.id_kategori');
        $this->db->join('komentar_blog','komentar_blog.id_blog=blog.id_blog', 'left');
        $this->db->group_by('blog.id_blog');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($sampai, $from);
        $hsl = $this->db->get();
        return $hsl->result();   
    }
    //END ARSIP BLOG

    //KOMENTAR
    function comment($kode)
    {
        if($kode)
        {
            $this->db->where('id_blog', $kode);
        }

        $query = $this->db->get('komentar_blog');
        return $query->result();
    }

    function send_comment($data)
    {
      
        $insert = $this->db->insert('komentar_blog', $data);
        return $insert;
    }
    //END KOMENTAR

    var $table = 'blog';
    var $column_order = array(null,'judul', 'tanggal', 'nama_kategori', 'gambar1'); //mengatur database kolom kolom untuk urutan data yang dapat dipesan
    var $column_search = array('judul', 'tanggal', 'nama_kategori'); //mengatur database kolom kolom untuk dapat dicari datanya hanya nama depan, nama belakang, alamat dapat dicari
    var $order = array('id_blog' => 'desc'); // pesanan default 
 
    private function _get_datatables_query()
    {
         
        $this->db->select('*');
        $this->db->from('blog');
        $this->db->join('kategori','kategori.id_kategori=blog.id_kategori');
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if(@$_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
 
    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id_blog',$id);
        $query = $this->db->get();
 
        return $query->result_array();
    }

    public function save($judul, $isi, $kat, $dataInfo=array())
    {
        $data = array(
            'judul'         => $judul,
            'isi'           => $isi,
            'id_kategori'   => $kat,
            'gambar1'       => $dataInfo[0]['file_name'] ? $dataInfo[0]['file_name'] : null,
            'gambar2'       => !empty($dataInfo[1]['file_name']) ? $dataInfo[1]['file_name'] : null, // cek if else ada atau tidak
            'gambar3'       => !empty($dataInfo[2]['file_name']) ? $dataInfo[2]['file_name'] : null,        
        );

        $result = $this->db->insert($this->table, $data);
        return $result;
    }
 
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id($id)
    {
        $this->db->where('id_blog', $id);
        $this->db->delete($this->table);
    }
 
}
