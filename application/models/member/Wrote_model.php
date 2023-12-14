<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Wrote_model extends CI_Model {


    public function get_wrote_post($userid, $start = 0, $limit = 15) {
        
        $this->db->select('post.*, channel.name as channel_name, (SELECT COUNT(*) FROM uploadfile WHERE uploadfile.post_id = post.post_id) AS file_count');

        // channel 테이블과 조인
        $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left');

        $this->db->from('post');
        $this->db->where('user_id',$userid);
        $this->db->where('delete_status', FALSE);
        $this->db->order_by('create_date', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function count_wrote_posts($userid) {
        $this->db->where('user_id', $userid);
        $this->db->where('delete_status', FALSE); 
        $this->db->order_by('create_date','desc');
        return $this->db->count_all_results('post');
    }




    public function get_wrote_comment($userid, $start = 0, $limit = 15) {
        $this->db->select('COMMENT.*, POST.title');
        $this->db->from('comment as COMMENT');
        $this->db->join('post as POST', 'COMMENT.post_id = POST.post_id', 'left');
        $this->db->where('COMMENT.user_id', $userid);
        $this->db->limit($limit, $start);
    
        $query = $this->db->get();
    
        return $query->result_array();
    }

    public function count_wrote_comment($userid) {
        $this->db->where('user_id', $userid);
        return $this->db->count_all_results('comment');
    }
    
    
}


?>