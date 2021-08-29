<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_m extends CI_Model
{
    function tampil_data()
    {
       $hsl = $this->db->query("SELECT * FROM produk ORDER BY id_produk DESC");
        return $hsl->result();
    }
    
    function tampil_kategori()
    {
        $hsl = $this->db->query("SELECT * FROM kategori ORDER BY id_kategori DESC");
        return $hsl->result();
    }

    function tambahkategori($kat,$gambar)
    {
       $hsl = $this->db->query("INSERT INTO kategori (nama_kategori,gambar) VALUES ('$kat','$gambar')");
        return $hsl;
    }

    function update_kategori($id_kat,$kat,$gambar)
    {
        $hsl = $this->db->query("UPDATE kategori SET nama_kategori='$kat',gambar='$gambar' WHERE id_kategori='$id_kat'");
        return $hsl;
    }

     function hapus_kategori($id)
    {
        $this->db->where('id_kategori', $id);
        $this->db->delete('kategori');
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

    function joinlimit()
    {
        $this->db->select('*');
        $this->db->from('blog');
        $this->db->join('kategori','kategori.id_kategori=blog.id_kategori');
        $this->db->order_by('id_blog', 'DESC');
        $this->db->limit(3);
        $query = $this->db->get();
        return $query->result();
    }

    function add_data($judul, $isi, $kategori, $gambar1, $gambar2, $gambar3)
    {
        $hsl = $this->db->query("INSERT INTO blog (judul,isi,id_kategori,gambar1,gambar2,gambar3) VALUES ('$judul','$isi','$kategori','$gambar1','$gambar2','$gambar3')");
        return $hsl;
    }

    function edit_get($kode)
    {
        $this->db->select('*');
        $this->db->from('blog');
        $this->db->join('kategori','kategori.id_kategori=blog.id_kategori');
        $this->db->where('id_blog', $kode);
        $query = $this->db->get();
        return $query->result();
    }

    function update_blog($id_blog, $judul, $isi, $kategori, $gambar1, $gambar2, $gambar3)
    {
        $hsl = $this->db->query("UPDATE blog SET judul='$judul',isi='$isi',id_kategori='$kategori',gambar1='$gambar1',gambar2='$gambar2',gambar3='$gambar3' WHERE id_blog='$id_blog'");
        return $hsl;
    }

    function detail_get($kode)
    {
        $this->db->select('*');
        $this->db->from('blog');
        $this->db->join('kategori','kategori.id_kategori=blog.id_kategori');
        $this->db->where('id_blog', $kode);
        $query = $this->db->get();
        return $query->result();
    }

    function hapus($id)
    {
        $this->db->where('id_blog', $id);
        $this->db->delete('blog');
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

    function pagination()
    {
       return $this->db->get('produk')->num_rows();
    }

    var $table = 'kategori';
    var $column_order = array(null, 'nama_kategori', 'gambar'); //mengatur database kolom kolom untuk urutan data yang dapat dipesan
    var $column_search = array('nama_kategori'); //mengatur database kolom kolom untuk dapat dicari datanya hanya nama depan, nama belakang, alamat dapat dicari
    var $order = array('id_kategori' => 'desc'); // pesanan default 
 
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
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
        $this->db->where('id_kategori',$id);
        $query = $this->db->get();
 
        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
 
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function get_id_delete($id)
    {
        $this->db->from($this->table);
        $this->db->where('id_kategori',$id);
        $query = $this->db->get();
 
        return $query->result_array();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id_kategori', $id);
        $this->db->delete($this->table);
    }
    
    //jika kategori dihapus maka produk dengan kategori yg sama dihapus
    public function get_by_id_produk($id)
    {
        $this->db->from('produk');
        $this->db->where('id_kategori',$id);
        $query = $this->db->get();

        return $query->result_array();
    }
    public function delete_produk_by_id($id)
    {
        $this->db->where('id_kategori', $id);
        $this->db->delete('produk');
    } 
}
