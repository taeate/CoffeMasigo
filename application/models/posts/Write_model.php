<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Write_model extends CI_Model {

    public function set_article($title, $content, $user_id) {

        $data = array(
            'title'=> $title,
            'content'=> $content,
            'user_id' => $user_id,
            'depth' => 0,
            'delete_status' => FALSE
        );

        $this->db->insert('post', $data);
    }

    public function get_post($post_id) {

        $query = $this->db->get_where('post',array('post_id'=> $post_id));

       return $query->row();
    }

    private function get_depth($post_id) {

        $this->db->select('depth');
        $this->db->from('post');
        $this->db->where('post_id', $post_id);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->row()->depth;
        } else {
            return 0; // 기본값, 원본 게시물인 경우
        }
    }

    public function save_reply($title, $content, $user_id, $post_id) {

        $depth = $this->get_depth($post_id);

        $data = array(

            'title' => $title,
            'content' => $content,
            'user_id' => $user_id,
            'parent_post_id' => $post_id,
            'create_date' => date('Y-m-d H:i:s'),
            'depth' => $depth + 1,
          
        );

        $this->db->insert('post', $data);
    }

    public function get_before_post($post_id) {
        $query = $this->db->get_where('post', array('post_id' => $post_id));
        
        return $query->row();
    }

    public function edit_post($post_id, $title, $content){

        $this->db->where('post_id', $post_id);

        $data = array(
            'title'=> $title,
            'content'=> $content
            );

        $this->db->update('post', $data);
        
    } 
     public function delete_post($post_id){

        $data = array('delete_status' => TRUE);

        $this->db->where('post_id', $post_id);
        $this->db->update('post', $data);
      
        
    }

   
    
}