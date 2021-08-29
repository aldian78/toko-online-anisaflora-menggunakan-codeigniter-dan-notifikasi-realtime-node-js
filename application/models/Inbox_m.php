<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inbox_m extends CI_Model
{
	function tampil_kategori()
    {
        return $this->db->get('kategori');
    }

	function get_notif(){
        $query = $this->db->get('inbox');
        return $query;
    }

	function simpan($nama,$nohp,$email,$pesan){
	 	
		$data = array(
			'nama' 		=> $nama,
            'nohp' 		=> $nohp,
            'email' 	=> $email,
            'pesan' 	=> $pesan,
            'status' 	=> '1',
		);
		$result=$this->db->insert('inbox',$data);
		return $result;
	}

	function update_notif($id_inbox){
       
       $data = array(
            'status' 	=> '0',
		);
        
        $this->db->where('id_inbox', $id_inbox);
		$this->db->update('inbox',$data);
    }

    function status_where()
    {
        $this->db->where('status', '1');
        $this->db->order_by('id_inbox', 'desc');
         $query = $this->db->get('inbox');
         return $query;
    }
}