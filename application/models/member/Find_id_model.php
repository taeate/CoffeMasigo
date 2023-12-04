<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Find_id_model extends CI_Model {


    public function findById($username, $email) {
        $this->db->select('user_id');
        $this->db->where('username', $username);
        $this->db->where('email', $email);
        $query = $this->db->get('user'); 
    
        if ($query->num_rows() > 0) {
            return $query->row()->user_id; 
        } else {
            return null; 
        }
    }
    
}


?>