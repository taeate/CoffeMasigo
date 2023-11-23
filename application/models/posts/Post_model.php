<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model {

    public function get_posts($start,$limit){
      
        $this->db->select('*');
        $this->db->where('delete_status', FALSE);
        $this->db->where('parent_post_id', null);
        $this->db->limit($limit, $start);
        $query = $this->db->get('post');
        return $query->result();


    }
    

    public function find_detail($post_id){

        $query = $this->db->get_where('post', array('post_id'=> $post_id));

        return $query->row();
    }

    public function get_replies($post_id) {
        $this->db->select('post.*, parent.title as parent_title, (SELECT COUNT(*) FROM post as subpost WHERE subpost.parent_post_id = post.post_id AND subpost.delete_status IS NULL) as replies_count');
        $this->db->from('post');
        $this->db->join('post as parent', 'post.parent_post_id = parent.post_id', 'left');
        $this->db->where('post.parent_post_id', $post_id);
        $this->db->where('post.delete_status', NULL);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_replies_count($post_id){
        $this->db->from('post');
        $this->db->where('parent_post_id', $post_id);
        return $this->db->count_all_results();
    }
    
    public function get_answer_posts() {

        $this->db->select('post.*, parent.title as parent_title');
        $this->db->from('post');
        $this->db->join('post as parent', 'post.parent_post_id = parent.post_id', 'left');
        $this->db->where('post.parent_post_id !=', NULL);
        $query = $this->db->get();
        return $query->result();
    }

    


    public function create_comment($parent_comment_id, $post_id, $comment_content, $user_id) {
        
        $ref = null;
        $re_step = 0;
        $re_level = 0;
    
        
    
        if ($parent_comment_id !== NULL) {

            // 부모 댓글 조회
            $parent_comment = $this->db->get_where('comment', array('comment_id' => $parent_comment_id))->row();
            $ref = $parent_comment->ref ? $parent_comment->ref : $parent_comment_id;
            $re_level = $parent_comment->re_level + 1;

            // re_step 값 계산
            $this->db->select_max('re_step');
            $this->db->where('ref', $ref);
            $this->db->where('re_level', $re_level);
            $max_re_step = $this->db->get('comment')->row()->re_step;
            $re_step = $max_re_step + 1;

        }
        else{
            $ref = null; // ref는 최상위 댓글의 ID로 설정
        }
    
        $data = array(
            'comment_content' => $comment_content,
            'user_id' => $user_id,
            'post_id' => $post_id,
            'create_date' => date('Y-m-d H:i:s'),
            'parent_comment_id' => $parent_comment_id,
            'ref' => $ref,
            're_step' => $re_step,
            're_level' => $re_level

        );
    
        $this->db->insert('comment', $data);

        // 최상위 댓글인 경우 ref 업데이트
        if ($parent_comment_id === null) {
            $comment_id = $this->db->insert_id();
            $this->db->update('comment', array('ref' => $comment_id), array('comment_id' => $comment_id));
        }
    }

    public function get_comment($post_id){

        $this->db->select('*');
        $this->db->from('comment');
        $this->db->where('post_id', $post_id);
        $this->db->order_by('ref', 'ASC');
        $this->db->order_by('re_step', 'ASC');
    
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function count_comment($post_id){
        $this->db->where('post_id', $post_id);
        $this->db->from('comment');;
        return $this->db->count_all_results();
    }

    public function count_posts(){
        
        $this->db->select('*');
        $this->db->where('delete_status', FALSE);
        $this->db->where('parent_post_id', null);
        return $this->db->count_all_results('post');
    }

    public function search($search_info,$start, $limit){
        $this->db->select('*');
        $this->db->from('post');
        $this->db->like('title', $search_info);
        $this->db->or_like('content', $search_info);
        $this->db->limit($limit,$start);
        $query = $this->db->get();
         
        return $query->result_array();
    }


}