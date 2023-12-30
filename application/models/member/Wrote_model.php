<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Wrote_model extends CI_Model {


    public function get_wrote_post($userid, $start = 0, $limit = 15) {
        $this->db->select('post.*, channel.name as channel_name, 
        (SELECT COUNT(*) FROM uploadfile WHERE uploadfile.post_id = post.post_id) AS file_count,
        (SELECT COUNT(*) FROM comment WHERE comment.post_id = post.post_id AND comment.delete_status = 0) AS comment_count');
    
        // channel 테이블과 조인
        $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left');
    
        $this->db->from('post');
        $this->db->where('user_id', $userid);
        $this->db->where('delete_status', FALSE);
        $this->db->order_by('create_date', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
    
        $posts = $query->result_array();
    
        // 날짜 형식 변경
        foreach ($posts as &$post) {
            if (isset($post['create_date'])) {
                $post['create_date'] = (new DateTime($post['create_date']))->format('Y.m.d H:i');
            }
        }
    
        return $posts;
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
        $this->db->where('COMMENT.delete_status', 0);
        $this->db->limit($limit, $start);
    
        $query = $this->db->get();

        $comments = $query->result_array();

        // 날짜 형식 변경
        foreach ($comments as &$comment) {
            if (isset($comment['create_date'])) {
                $comment['create_date'] = (new DateTime($comment['create_date']))->format('Y.m.d H:i');
            }
        }
    
        return $comments;
    }

    public function count_wrote_comment($userid) {
        $this->db->where('user_id', $userid);
        return $this->db->count_all_results('comment');
    }

    public function get_user_data($user_id) {
        
        $query = $this->db->get_where('user', array('user_id' => $user_id));
    
        $user_data = $query->row();

        if ($user_data) {
            return $user_data;
        } else {
            return null; 
        }
    }



    public function get_wrote_thumb_post($userid, $start = 0, $limit = 15) {
        $this->db->select('post.*, channel.name AS channel_name, COUNT(uploadfile.post_id) AS file_count, (SELECT COUNT(comment_id) FROM comment WHERE comment.post_id = post.post_id AND comment.delete_status = 0) AS comment_count');
        $this->db->from('post_thumb');
        $this->db->join('post', 'post_thumb.post_id = post.post_id');
        $this->db->join('channel', 'post.channel_id = channel.channel_id', 'left');
        $this->db->join('uploadfile', 'post.post_id = uploadfile.post_id', 'left');
        $this->db->where('post_thumb.user_id', $userid);
        $this->db->where('delete_status', FALSE);
        $this->db->order_by('create_date', 'DESC');
        $this->db->group_by('post.post_id');
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();

        $thumbs = $query->result_array();

        // 날짜 형식 변경
        foreach ($thumbs as &$thumb) {
            if (isset($thumb['create_date'])) {
                $thumb['create_date'] = (new DateTime($thumb['create_date']))->format('Y.m.d H:i');
            }
        }
    
        return $thumbs;
        
    }

    public function count_wrote_thumb_post($userid) {
        
        $this->db->from('post_thumb');
        $this->db->join('post', 'post_thumb.post_id = post.post_id', 'inner');
        $this->db->where('post.delete_status', 0);
        $this->db->where('post_thumb.user_id', $userid);
    
        
        return $this->db->count_all_results();
    }
    
    
    
    
    
    
    

   
    


    
    
}


?>