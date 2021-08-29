<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login_m extends CI_Model {
	
	function login($post)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email', $post['email']);
		$this->db->where('password', sha1($post['password']));
		$query = $this->db->get();
		return $query;

	}

	function forgot ()
	{
		$this->db->select('*');
		$this->db->from('user_token');
		$this->db->join('user', 'user.email = user_token.email');
		$query = $this->db->get();
		return $query;
	}

    function change_password($where, $data, $table)
    {
    	$this->db->where($where);
    	$this->db->update($table, $data);
    }

    // EDIT PROFILE USER 
    function edit_profil_user($data, $where)
    {
    	$this->db->where($where);
    	return $this->db->update('loginuser', $data);	
    }
    // END EDIT PROFILE USER 
}