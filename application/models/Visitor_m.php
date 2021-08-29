<?php
class Visitor_m extends CI_Model
{
     function grafik(){
        $query = $this->db->query("SELECT MONTH(date) AS bulan, COUNT(*) AS ip FROM visitor GROUP BY MONTH(date);");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    function grafikphi(){
        $query = $this->db->query("SELECT DAY(date) AS day, COUNT(*) AS ip FROM visitor WHERE DAY(date);");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    function grafikpo(){
        $query = $this->db->query("SELECT DAY(date) AS day, COUNT(*) AS ip FROM visitor WHERE DAY(date);");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
     function get(){
        $this->db->select('*');
        $this->db->from('blog');
        $this->db_>where('id_blog');
        $this->db->order_by('id_blog');
        $query = $this->db->get();
        return $query->num_rows();
    }


}