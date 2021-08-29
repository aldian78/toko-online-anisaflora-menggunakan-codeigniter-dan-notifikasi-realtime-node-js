<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Wishlist_m extends CI_Model
{
	  function wishlist($id)
    {   
      $usrid = isset($_SESSION["id_user"]) ? $_SESSION["id_user"] : 0;
      $this->db->where("id_produk",$id);
      $this->db->where("id_user",$usrid);
      $res = $this->db->get("wishlist");

      if($res->num_rows() > 0){
        return true;
      }else{
        return false;
      }
    }

    function cek($id, $id_produk, $nama_produk, $harga, $gambar)
    {   

      $this->db->where("id_produk",$id_produk);
      $this->db->where("id_user",$id);
      $res = $this->db->get("wishlist");

      if($res->num_rows() > 0){
        return false;
      }else{
        $data = array(
         'id_user'   => $id,
         'id_produk'   => $id_produk,
         'nama_produk' => $nama_produk,
         'harga'     => $harga,
         'gambar'    => $gambar,
       );
        $this->db->insert('wishlist', $data);
        return true;
      }
    }

    function get_wishlist()
    {
        $this->db->join('produk','produk.id_produk=wishlist.id_produk');
        $hsl = $this->db->get('wishlist');
        return $hsl->row();
    }

    // Select total records
  	public function total() 
  	{

  		$this->db->select('count(*) as allcount');
  		$this->db->from('wishlist');
  		$query = $this->db->get();
  		$result = $query->result_array();

  		return $result[0]['allcount'];
  	}

  	public function getData($rowno,$rowperpage) 
  	{
      $this->db->select('*');
      $this->db->from('wishlist');
      $this->db->join('produk','produk.id_produk=wishlist.id_produk');
      $this->db->limit($rowperpage, $rowno);  
      $query = $this->db->get();

      return $query->result_array();
    }

    function pagination()
    {
     return $this->db->get('wishlist')->num_rows();
    }

    var $table = 'wishlist';
    var $column_order = array(null, 'w.gambar','w.id_produk','w.nama_produk','p.stok','w.harga','w.tgl'); //set column field database for datatable orderable
    var $column_search = array('w.nama_produk','w.harga','w.tgl'); //set column field database for datatable searchable 
    var $order = array('w.id_produk' => 'desc'); // default order 

    public function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    private function _get_datatables_query()
    {
       $data['user'] = $this->db->get_where('loginuser', ['email' => $this->session->userdata('email')])->row_array();

       $this->db->select('*');
       $this->db->from('wishlist as w');
       $this->db->join('produk as p', 'p.id_produk = w.id_produk');
       $this->db->where('w.id_user', $data['user']['id_user']);

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
}