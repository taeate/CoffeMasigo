<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Join_model extends CI_Model {

    public function save_data($userId) {

        $data = array(
            'user_id'=> $userId,
         
        );

        $this->db->insert('user', $data);
    }

    public function get_user_id($userid) {

        $this->db->where('user_id', $userid);
        $query = $this->db->get('user');

        if ($query->num_rows() > 0) {
            return $query->result();

        } else {
            return false;
        }
    }

    public function create_user($data) {

        $this->db->insert('user', $data);

        
    }
    
    public function get_email($email){

        $this->db->where('email', $email);
        $query = $this->db->get('user');

        return $query->row();
    }


    
}