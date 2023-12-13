<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model {

    public function get_posts($start = 0, $limit = 15){
        $this->db->select('post.*, channel.name as channel_name, (SELECT COUNT(*) FROM uploadfile WHERE uploadfile.post_id = post.post_id) AS file_count');
    
        // channel 테이블과 조인
        $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left');
    
        // 기존의 조건들을 그대로 유지
        $this->db->where('delete_status', FALSE);
        $this->db->where('parent_post_id', null);
        $this->db->order_by('is_notice', 'DESC');
        $this->db->order_by('create_date', 'DESC');
        $this->db->limit($limit, $start);
    
        // 쿼리 실행 및 결과 반환
        $query = $this->db->get('post');
        return $query->result();
    }
    

    

    public function get_posts_not_notice($start = 0, $limit = 5){
      
        $this->db->select('*');
        $this->db->where('delete_status', FALSE);
        $this->db->where('parent_post_id', null);
        $this->db->where('is_notice', 0);
        $this->db->limit($limit, $start);
        $query = $this->db->get('post');
        return $query->result();


    }
    
public function find_detail($post_id) {
    // 게시물 정보와 채널 정보를 가져오기
    $this->db->select('post.*, channel.name as channel_name');
    $this->db->from('post');
    $this->db->where('post.post_id', $post_id);
    $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left'); // 채널 정보를 조인

    $post_info = $this->db->get()->row();

    // 파일 정보 가져오기
    $this->db->select('file_name, file_path');
    $this->db->where('post_id', $post_id);
    $files = $this->db->get('uploadfile')->result();

    // 게시물 정보와 파일 정보를 함께 반환
    return [
        'post_info' => $post_info,
        'files' => $files
    ];
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

    public function get_reply_to_post($post_id) {
        $this->db->select('post.*, channel.name as channel_name, (SELECT COUNT(*) FROM uploadfile WHERE uploadfile.post_id = post.post_id) AS file_count');
        $this->db->from('post');
        $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left'); 
        $this->db->where('ref', $post_id);
        $this->db->where('post_id !=', $post_id); // 원본 게시물 제외
        $this->db->order_by('ref', 'ASC');
        $this->db->order_by('re_step', 'ASC');
        $this->db->order_by('re_level', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    
    

    public function get_reply_to_post_count($post_id){
        $this->db->from('post');
        $this->db->where('ref', $post_id);
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
        // 초기화
        $ref = null;
        $re_step = 0;
        $re_level = 0;
    
        if ($parent_comment_id !== NULL) {
            // 부모 댓글 조회
            $parent_comment = $this->db->get_where('comment', array('comment_id' => $parent_comment_id))->row();
            $ref = $parent_comment->ref ? $parent_comment->ref : $parent_comment_id;
            $re_level = $parent_comment->re_level + 1;
    
            // 부모 댓글의 re_step 값 찾기
            $parent_re_step = $parent_comment->re_step;

            // 새 댓글의 re_step 값 계산
            $re_step = $parent_re_step + 1;
    
            // 기존 댓글의 re_step 업데이트
            $this->db->set('re_step', 're_step + 1', FALSE);
            $this->db->where('ref', $ref);
            $this->db->where('re_step >=', $re_step);
            $this->db->update('comment');
        } else {
            // 최상위 댓글의 경우
            $ref = null;
            $re_level = 0;
            $re_step = 0; // 최상위 댓글은 항상 re_step = 0
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

        $this->db->select('comment.*, user.profile_image');
        $this->db->from('comment');
        $this->db->join('user','user.user_id = comment.user_id');
        $this->db->where('comment.post_id', $post_id);
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

    public function increment_views($post_id) {
        $this->db->set('views', 'views+1', FALSE);
        $this->db->where('post_id', $post_id);
        $this->db->update('post');
    }

    public function count_search_posts($search_query) {
        $this->db->like('title', $search_query);
        $this->db->or_like('content', $search_query);
        $this->db->from('post');
        return $this->db->count_all_results();
    }

    public function search($search_query, $search_option, $selectedPast, $start, $limit) {
        $this->db->select('post.*, (SELECT COUNT(*) FROM uploadfile WHERE uploadfile.post_id = post.post_id) AS file_count');
        $this->db->from('post');
    
        // 검색 옵션에 따른 검색 조건 설정
        switch($search_option) {
            case 'title':
                $this->db->like('title', $search_query);
                break;
            case 'content':
                $this->db->like('content', $search_query);
                break;
            case 'author':
                $this->db->like('user_id', $search_query);
                break;
            case 'title-content':
            default:
                $this->db->group_start();
                $this->db->like('title', $search_query);
                $this->db->or_like('content', $search_query);
                $this->db->group_end();
                break;
        }
    
        // 시간 필터 처리
        if (!empty($selectedPast)) {
            switch($selectedPast) {
                case 'last_day':
                    $this->db->where('create_date >=', date('Y-m-d H:i:s', strtotime('-1 day')));
                    break;
                case 'last_week':
                    $this->db->where('create_date >=', date('Y-m-d H:i:s', strtotime('-1 week')));
                    break;
                case 'last_month':
                    $this->db->where('create_date >=', date('Y-m-d H:i:s', strtotime('-1 month')));
                    break;
                case 'last_year':
                    $this->db->where('create_date >=', date('Y-m-d H:i:s', strtotime('-1 year')));
                    break;
            }
        }
    
        $this->db->limit($limit, $start);
        $query = $this->db->get();
    
        return $query->result_array();
    }
    
    
    

    public function hasUserAlreadyThumb($post_id, $user_id) {

        $this->db->where( 'post_id', $post_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('post_thumb');

        return $query->num_rows() > 0;
    }

    public function incrementThumb($post_id) {
        $this->db->set('thumb', 'thumb+1', FALSE);
        $this->db->where('post_id', $post_id);
        $this->db->update('post');
       
    }
    

    public function addThumbRecord($post_id, $user_id) {
        $data = array(
            'post_id'=> $post_id,
            'user_id'=> $user_id
        );
        $this->db->insert('post_thumb', $data);
    }

    public function count_thumb($post_id){
        $this->db->select('thumb');
        $this->db->from('post');
        $this->db->where('post_id', $post_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->thumb;
        }else {
            return 0;
        }
    }


    public function count_posts_ordered_by_latest(){
        $this->db->where('delete_status', FALSE);
        $this->db->where('parent_post_id', null);
        $this->db->order_by('is_notice','DESC');
        $this->db->order_by('create_date', 'DESC');
        $this->db->from('post');
        return $this->db->count_all_results();
    }



    public function get_posts_ordered_by_latest($start = 0, $limit = 20) {

        $this->db->select('post.*, channel.name as channel_name, (SELECT COUNT(*) FROM uploadfile WHERE uploadfile.post_id = post.post_id) AS file_count');

        // channel 테이블과 조인
        $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left');

        $this->db->where('delete_status', FALSE);
        $this->db->where('parent_post_id',null);
        $this->db->order_by('is_notice','DESC');
        $this->db->order_by('create_date', 'DESC');
        $this->db->limit($limit,$start);
        $query = $this->db->get('post');
        return $query->result(); // 모든 게시글을 반환
    }

    public function count_posts_ordered_by_thumb(){
        $this->db->where('delete_status', FALSE);
        $this->db->where('parent_post_id', null);
        $this->db->order_by('is_notice','DESC');
        $this->db->order_by('thumb', 'DESC');
        $this->db->from('post');
        return $this->db->count_all_results();
    }
    

    public function get_posts_ordered_by_thumb($start = 0, $limit = 20) {
        $this->db->select('post.*, channel.name as channel_name, (SELECT COUNT(*) FROM uploadfile WHERE uploadfile.post_id = post.post_id) AS file_count');

        // channel 테이블과 조인
        $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left');

        $this->db->where('delete_status', FALSE);
        $this->db->where('parent_post_id', null);
        $this->db->order_by('is_notice','DESC');
        $this->db->order_by('thumb', 'DESC');
        $this->db->limit($limit,$start);
        $query = $this->db->get('post');
        return $query->result(); 
    }



    public function count_posts_ordered_by_views(){
        $this->db->where('delete_status', FALSE);
        $this->db->where('parent_post_id', null);
        $this->db->order_by('is_notice','DESC');
        $this->db->order_by('views', 'DESC');
        $this->db->from('post');
        return $this->db->count_all_results();
    }

    public function get_posts_ordered_by_views($start = 0, $limit = 20) {
        $this->db->select('post.*, channel.name as channel_name, (SELECT COUNT(*) FROM uploadfile WHERE uploadfile.post_id = post.post_id) AS file_count');
        
        // channel 테이블과 조인
        $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left');
        
        $this->db->where('post.delete_status', FALSE);
        $this->db->where('post.parent_post_id', null);
        $this->db->order_by('post.is_notice', 'DESC');
        $this->db->order_by('post.views', 'DESC');
        $this->db->limit($limit, $start);
        
        $query = $this->db->get('post');
        return $query->result(); 
    }
    

    public function comment_orderby_created($post_id,$order)  {
        $this->db->select('COMMENT.*, USER.profile_image');
        $this->db->from('COMMENT');
        $this->db->join('USER', 'USER.user_id = COMMENT.user_id', 'left');
        $this->db->where('COMMENT.post_id', $post_id);
        $this->db->order_by('COMMENT.create_date', $order);

        $query = $this->db->get();
    
        return $query->result();
    }


    
    public function update_comment($comment_id, $comment_content, $user_id){
        $this->db->where('comment_id', $comment_id);
        $this->db->where('user_id', $user_id); 
    
        $data = array(
            'comment_content' => $comment_content,
            'update_date' => date('Y-m-d H:i:s') 
        );
        $this->db->update('comment', $data);
    
        if ($this->db->affected_rows() > 0) {
            // 업데이트 성공
            return true;
        } else {
            // 업데이트 실패
            return false;
        }
    }

    public function delete_comment($comment_id) {
        $this->db->where('comment_id', $comment_id);
        $this->db->delete('comment');
    }

    public function get_files($post_id) {
        $this->db->select('*');
        $this->db->from('uploadfile');
        $this->db->where('post_id', $post_id); 
    
        $query = $this->db->get(); 
    
        if ($query->num_rows() > 0) {
            return $query->result(); 
        } else {
            return array(); 
        }
    }
    
    public function count_wrote_posts_sidebar($userid) {
        $this->db->where('user_id', $userid);
        return $this->db->count_all_results('post');
    }
    
    public function count_wrote_comments_sidebar($userid) {
        $this->db->where('user_id', $userid);
        return $this->db->count_all_results('comment');
    }

    public function get_posts_by_channel($channel_id) {
        $this->db->select('post.*, channel.name as channel_name, (SELECT COUNT(*) FROM uploadfile WHERE uploadfile.post_id = post.post_id) AS file_count');
        
        $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left');
        
        $this->db->where('post.channel_id', $channel_id);
        $this->db->where('post.delete_status', FALSE);
        $this->db->where('post.parent_post_id', null);
        $this->db->order_by('post.is_notice', 'DESC');
        $this->db->order_by('post.create_date', 'DESC');
        
        $query = $this->db->get('post');
        return $query->result();
    }

    
    public function get_channel_name($channel_id) {
        $this->db->select('name');
        $this->db->where('channel_id', $channel_id);
        $query = $this->db->get('channel');  
        if ($query->num_rows() > 0) {
            return $query->row()->name;
        } else {
            return null; // 채널이 존재하지 않는 경우
        }
    }
    
    
    
 


    
   
    
    
    
    


    


}