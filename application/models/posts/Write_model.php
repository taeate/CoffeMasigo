<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Write_model extends CI_Model {

    public function set_article($title, $content, $user_id, $is_notice) {

        $data = array(
            'title'=> $title,
            'content'=> $content,
            'user_id' => $user_id,
            'ref' => null,
            're_step' => 0,
            're_level' => 0,
            'delete_status' => FALSE,
            'is_notice' => $is_notice
        );

        $this->db->insert('post', $data);

         // 새로 삽입된 게시글의 ID 가져오기
        $new_post_id = $this->db->insert_id();

        // 최상위 게시글인 경우 ref 업데이트
        $this->db->update('post', array('ref' => $new_post_id), array('post_id' => $new_post_id));
    }

    public function get_post($post_id) {

        $query = $this->db->get_where('post',array('post_id'=> $post_id));

       return $query->row();
    }


    public function save_answer_post($title, $content, $user_id, $post_id) {
         
        $ref = null;
        $re_step = 0;
        $re_level =0;

        $parent_post_id = $post_id;

        if ($parent_post_id !== NULL) {
            // 부모 답글 조회
            $parent_post = $this->db->get_where('post', array('post_id' => $parent_post_id))->row();
            $ref = $parent_post->ref ? $parent_post->ref : $parent_post_id;
            $re_level = $parent_post->re_level + 1;
    
            // re_step 값 계산
            $this->db->select_max('re_step');
            $this->db->where('ref', $ref);
            $this->db->where('re_level', $re_level);
            $max_re_step = $this->db->get('post')->row()->re_step;
            $re_step = $max_re_step + 1;
            
        } else {
            // 최상위 답글의 경우
            $ref = null;
            $re_level = 0;
            $re_step = 0; // 최상위 답글은 항상 re_step = 0
        }


        $data = array(

            'title' => $title,
            'content' => $content,
            'user_id' => $user_id,
            'parent_post_id' => $parent_post_id,
            'create_date' => date('Y-m-d H:i:s'),
            'ref' => $ref,
            're_step' => $re_step,
            're_level' => $re_level,
          
        );

        $this->db->insert('post', $data);

        // 최상위 댓글인 경우 ref 업데이트
        if ($parent_post_id === null) {
            $post_id = $this->db->insert_id();
            $this->db->update('post', array('ref' => $post_id), array('post_id' => $post_id));
        }
    }

    public function get_post_author_id($post_id){        
        $this->db->select('user_id');
        $this->db->from('post');
        $this->db->where('post_id', $post_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->user_id; // 작성자 반환
        } else {
            return null;
        }

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

    public function saveFileData($post_id, $file_name, $file_path, $file_type, $file_size, $user_id) {
        // 파일 이름을 안전하게 만들기
        $file_name = $this->sanitizeFileName($file_name);

        // 파일 데이터 배열 생성
        $data = array(
            'post_id' => $post_id,
            'file_name' => $file_name,
            'file_path' => $file_path,
            'file_type' => $file_type,
            'file_size' => $file_size,
            'upload_date' => date('Y-m-d H:i:s'), // 현재 시간을 업로드 날짜로 설정
            'user_id' => $user_id,
            'status' => 1 // 파일 상태, 예: 1 = 활성화
        );

        // 데이터베이스에 데이터 삽입
        $this->db->insert('uploadfile', $data);

        // 삽입된 데이터의 ID 반환 (선택적)
        return $this->db->insert_id();
    }

    private function sanitizeFileName($fileName) {
        // 파일 이름에서 불필요하거나 위험한 문자 제거
        $fileName = str_replace(" ", "-", $fileName);
        $fileName = preg_replace("/[^a-zA-Z0-9\-\.]/", "", $fileName);

        return $fileName;
    }

   
    
}