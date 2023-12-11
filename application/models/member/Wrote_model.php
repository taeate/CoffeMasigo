<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Wrote_model extends CI_Model {


    public function get_wrote_post($userid) {
        $this->db->select('*');
        $this->db->from('post');
        $this->db->where('user_id',$userid);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function count_wrote_posts($userid) {
        $this->db->where('user_id', $userid);
        $this->db->order_by('create_date','desc');
        return $this->db->count_all_results('post');
    }




    public function get_wrote_comment($userid) {
        $this->db->select('COMMENT.*, POST.title');
        $this->db->from('comment as COMMENT');
        $this->db->join('post as POST', 'COMMENT.post_id = POST.post_id', 'left');
        $this->db->where('COMMENT.user_id', $userid);
        $this->db->limit(1000);
    
        $query = $this->db->get();
    
        return $query->result_array();
    }

    public function count_wrote_comment($userid) {
        $this->db->where('user_id', $userid);
        return $this->db->count_all_results('comment');
    }
    
    
}


?>