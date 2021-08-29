<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Produk_m extends CI_Model
{
    //Fungsi ambil gambar untuk cart diheader
    function ambil_gambar($id)
    {
        $this->db->select('*');
        $this->db->from('produk');
        $this->db->join('kategori','kategori.id_kategori=produk.id_kategori');
        $this->db->where('id_produk', $id);
        $query = $this->db->get();
        return $query->row();
    }
    //End fungsi ambil gambar

    function tampil_data()
    {
        $this->db->where('stok >=', '1');
        $hsl = $this->db->get('produk');
        return $hsl->result();
    }

    function katalog_produk()
    {
        $this->db->where('stok >=', '1');
        $this->db->limit(8);
        $hsl = $this->db->get('produk');
        return $hsl->result();
    }

    function get_cart($id_user)
    {
        $this->db->select('*');
        $this->db->from('cart');
        $this->db->join('produk','produk.id_produk=cart.id_produk');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get();
        return $query->result();
    }

    function notif_cart($id_user = "")
    {   
        $this->db->select('*');
        $this->db->from('cart');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get(); 
        return $query->num_rows();
    }

    function pagination()
    {
       return $this->db->get('produk')->num_rows();
    }
    
    function tampil_produk_limit($number, $offset)
    {
        $this->db->select('*');
        $this->db->from('produk');
        $this->db->order_by('id_produk', 'DESC');
        $this->db->where('stok >=', '1');
        $this->db->limit($number, $offset);
        $hsl = $this->db->get();
        return $hsl->result();
    }
    
    function produkDetail($id)
    {
        $this->db->select('*');
        $this->db->from('produk');
        $this->db->join('kategori','kategori.id_kategori=produk.id_kategori');
        $this->db->where('id_produk', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function pagination_search($keyword = '')
    {
        if($keyword)
        {
            $this->db->like('nama_produk', urldecode($keyword)); //pencarian dengan spasi + ganti config
            $this->db->or_like('nama_kategori', urldecode($keyword)); //pencarian dengan spasi + ganti config
        }
        $this->db->join('kategori', 'kategori.id_kategori=produk.id_kategori');
        $this->db->where('stok >=', '1');
        $query = $this->db->get('produk');
        return $query->num_rows();
    }

    function hasil_search($sampai, $from, $keyword = ''){

        if($keyword)
        {
            $this->db->like('nama_produk', urldecode($keyword)); //pencarian dengan spasi + ganti config
            $this->db->or_like('nama_kategori', urldecode($keyword)); //pencarian dengan spasi + ganti config
        }

        $this->db->join('kategori', 'kategori.id_kategori=produk.id_kategori');
        $this->db->where('stok >=', '1');
        $query = $this->db->get('produk',$sampai,$from);
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

    // Filter sale, new, asc, desc, low dan high 
    function sortSale($sort = '')
    {
        if($sort == 'sale')
        {
            $this->db->where('diskon_harga !=', null);
            $this->db->where('diskon_harga !=', '0');
        }elseif($sort == 'new'){

            $tgl = date('Y-m-d');
            $this->db->where('tanggal', $tgl);
            $this->db->where('diskon_harga', NULL, FALSE);
        
        }elseif($sort == 'low'){

            $this->db->order_by('harga', 'ASC');

        }elseif($sort == 'high'){

            $this->db->order_by('harga', 'DESC');

        }else{
             $this->db->order_by('id_produk', $sort);//if ASC dan DESC
        }

        $this->db->where('stok >=', '1');
        $this->db->join('kategori', 'kategori.id_kategori=produk.id_kategori');
        $query = $this->db->get('produk');
        return $query->num_rows();
    }

    function sortSaleNew($sampai, $from, $sort = '')
    {
        if($sort == 'sale'){

            $this->db->where('diskon_harga !=', null);
            $this->db->where('diskon_harga !=', '0');

        }elseif($sort == 'new'){

            $tgl = date('Y-m-d');
            $this->db->where('tanggal', $tgl);
            $this->db->where('diskon_harga', NULL, FALSE);
            
        }elseif($sort == 'low'){

            $this->db->order_by('harga', 'ASC');

        }elseif($sort == 'high'){

            $this->db->order_by('harga', 'DESC');
        }else{
           $this->db->order_by('id_produk', $sort); //if ASC dan DESC
        }

        $this->db->select('*');
        $this->db->from('produk');
        $this->db->where('stok >=', '1');
        $this->db->limit($sampai, $from);
        $hsl = $this->db->get();
        return $hsl->result();
    }
    //End filter

    //Filter min harga dan max harga
     function minMax($min = '', $max = '', $kat= '')
    {
        if($min || $max)
        {
            $this->db->where('harga >=', $min);
            $this->db->where('harga <=', $max);
        }

        if($kat)
        {
            $this->db->where('produk.id_kategori', $kat);
        }

        $this->db->where('stok >=', '1');
        $this->db->order_by('id_produk', 'DESC');
        $this->db->join('kategori', 'kategori.id_kategori=produk.id_kategori');
        $query = $this->db->get('produk');
        return $query->num_rows();
    }

    function filterMinMax($sampai, $from, $min = '', $max= '', $kat= '')
    {
        if($min || $max){
            $this->db->where('harga >=', $min);
            $this->db->where('harga <=', $max);
        }

        if($kat)
        {
            $this->db->where('produk.id_kategori', $kat);
        }

        $this->db->select('*');
        $this->db->from('produk');
        $this->db->where('stok >=', '1');
        $this->db->order_by('id_produk', 'DESC');
        $this->db->limit($sampai, $from);
        $hsl = $this->db->get();
        return $hsl->result();
    }
    //End filter min harga dan max harga

    //Filter berdasarkan kategori
    function filterKat($kategori = '')
    {
        if($kategori)
        {
            $this->db->where('produk.id_kategori', $kategori);
        }

        $this->db->where('stok >=', '1');
        $this->db->join('kategori', 'kategori.id_kategori=produk.id_kategori');
        $query = $this->db->get('produk');
        return $query->num_rows();
    }

    function filterKategori($sampai, $from, $kategori = '')
    {
       if($kategori)
        {
            $this->db->where('produk.id_kategori', $kategori);
        }

        $this->db->select('*');
        $this->db->from('produk');
        $this->db->where('stok >=', '1');
        $this->db->limit($sampai, $from);
        $hsl = $this->db->get();
        return $hsl->result();   
    }
    //End filter kategori

    var $table = 'produk';
    var $column_order = array(null,'nama_produk', 'berat', 'diskon_harga', 'harga', 'tanggal', 'nama_kategori', 'gambar1'); //mengatur database kolom kolom untuk urutan data yang dapat dipesan
    var $column_search = array('nama_produk', 'tanggal', 'nama_kategori'); //mengatur database kolom kolom untuk dapat dicari datanya hanya nama depan, nama belakang, alamat dapat dicari
    var $order = array('id_produk' => 'desc'); // pesanan default 
 
    private function _get_datatables_query()
    {
         
        $this->db->select('*');
        $this->db->from('produk');
        $this->db->join('kategori','kategori.id_kategori=produk.id_kategori');
 
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
        $this->db->where('id_produk',$id);
        $query = $this->db->get();
 
        return $query->result_array();
    }
 
    public function save($nama, $berat, $stok, $diskon, $harga, $isi, $kat, $dataInfo=array())
    {
        $data = array(
            'nama_produk'   => $nama,
            'diskon_harga'  => !empty($diskon) ? $diskon : null,
            'harga'         => $harga,
            'isi_produk'    => $isi,
            'stok'          => $stok,
            'berat'         => $berat,
            'id_kategori'   => $kat,
            'gambar1'       => $dataInfo[0]['file_name'] ? $dataInfo[0]['file_name'] : null,
            'gambar2'       => !empty($dataInfo[1]['file_name']) ? $dataInfo[1]['file_name'] : null, // cek if else ada atau tidak
            'gambar3'       => !empty($dataInfo[2]['file_name']) ? $dataInfo[2]['file_name'] : null,
            'gambar4'       => !empty($dataInfo[3]['file_name']) ? $dataInfo[3]['file_name'] : null,
            'gambar5'       => !empty($dataInfo[4]['file_name']) ? $dataInfo[4]['file_name'] : null,        
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
        $this->db->where('id_produk', $id);
        $this->db->delete($this->table);
    }
 
}
