<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model {

    public function get_posts($start = 0, $limit = 15){

        date_default_timezone_set('Asia/Seoul');
    
        // 일반 글 가져오기
        $this->db->select('post.*, channel.name as channel_name, (SELECT COUNT(*) FROM uploadfile WHERE uploadfile.post_id = post.post_id) AS file_count');
        $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left');
        $this->db->where('delete_status', FALSE);
        $this->db->where('parent_post_id', null);
        $this->db->where('is_notice', FALSE);
        $this->db->order_by('create_date', 'DESC');
        $this->db->limit($limit, $start);
        $posts = $this->db->get('post')->result();
    
        // 날짜 형식 변경
        foreach ($posts as $post) {
            $post->create_date = (new DateTime($post->create_date))->format('Y.m.d H:i');
        }
        
        return $posts;
    }
    
 
        
    public function find_detail($post_id) {
        // 게시물 정보와 채널 정보를 가져오기
        $this->db->select('post.*, channel.name as channel_name');
        $this->db->from('post');
        $this->db->where('post.post_id', $post_id);
        $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left');
        $post_info = $this->db->get()->row();
    
        // 날짜 형식 변경
        if ($post_info && $post_info->create_date) {
            $post_info->create_date = (new DateTime($post_info->create_date))->format('Y.m.d H:i');
        }
    
        // 파일 정보 가져오기
        $this->db->select('file_name, file_path');
        $this->db->where('post_id', $post_id);
        $files = $this->db->get('uploadfile')->result();

         // 파일 개수 계산
        $file_count = count($files);

    
        // 게시물 정보와 파일 정보를 함께 반환
        return [
            'post_info' => $post_info,
            'files' => $files,
            'file_count' => $file_count
        ];
    }
    

    
    

    public function get_replies($post_id) {
        $this->db->select('post.*, parent.title as parent_title, (SELECT COUNT(*) FROM post as subpost WHERE subpost.parent_post_id = post.post_id AND subpost.delete_status = 0) as replies_count');
        $this->db->from('post');
        $this->db->join('post as parent', 'post.parent_post_id = parent.post_id', 'left');
        $this->db->where('post.parent_post_id', $post_id);
        $this->db->where('post.delete_status', 0);
        $query = $this->db->get();
        $replies = $query->result();

         // 날짜 형식 변경
        foreach ($replies as $reply) {
            $reply->create_date = (new DateTime($reply->create_date))->format('Y.m.d H:i');
        }
        return $query->result();
    }

    public function get_reply_to_post($post_id) {
        $this->db->select('post.*, channel.name as channel_name, (SELECT COUNT(*) FROM uploadfile WHERE uploadfile.post_id = post.post_id) AS file_count');
        $this->db->from('post');
        $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left'); 
        $this->db->where('ref', $post_id);
        $this->db->where('post_id !=', $post_id); // 원본 게시물 제외
        $this->db->where('delete_status', 0);
        $this->db->order_by('ref', 'ASC');
        $this->db->order_by('re_step', 'ASC');
        $this->db->order_by('re_level', 'ASC');
        $query = $this->db->get();
        $replies = $query->result();

        // 날짜 형식 변경
        foreach ($replies as $reply) {
            $reply->create_date = (new DateTime($reply->create_date))->format('Y.m.d H:i');
        }

        return $query->result();
    }
    
    

    public function get_reply_to_post_count($post_id){
        $this->db->from('post');
        $this->db->where('ref', $post_id);
        $this->db->where('post_id !=', $post_id); 
        $this->db->where('delete_status', 0); 
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

        date_default_timezone_set('Asia/Seoul');

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
            'delete_status' => 0,
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
    

    public function get_comment($post_id) {
        $this->db->select('comment.*, user.profile_image');
        $this->db->from('comment');
        $this->db->join('user', 'user.user_id = comment.user_id');
        $this->db->where('comment.post_id', $post_id);
        $this->db->order_by('ref', 'ASC');
        $this->db->order_by('re_step', 'ASC');
    
        $query = $this->db->get();
        $comments = $query->result();
    
        foreach ($comments as $comment) {
            // 날짜 형식 변경
            $comment->create_date = (new DateTime($comment->create_date))->format('Y.m.d H:i');
    
            // 삭제된 댓글 처리
            if ($comment->delete_status) {
                $comment->comment_content = "삭제된 댓글";
                
                
                // 예: $comment->user_id = null; $comment->profile_image = null; 등
            }
        }
    
        return $comments;
    }
    

    public function count_comment($post_id){
        $this->db->where('post_id', $post_id);
        $this->db->where('delete_status', 0);
        $this->db->from('comment');;
        return $this->db->count_all_results();
    }

    public function count_posts(){
        
        $this->db->select('*');
        $this->db->where('delete_status', FALSE);
        $this->db->where('parent_post_id', null);
        return $this->db->count_all_results('post');
    }

    public function increment_views($post_id, $user_ip) {
        // 현재 시간
        $current_time = time();
    
        // 'post_views' 테이블에서 마지막 조회 정보 가져오기
        $this->db->select('view_time');
        $this->db->where('post_id', $post_id);
        $this->db->where('user_ip', $user_ip);
        $query = $this->db->get('post_views');
        $last_view = $query->row_array();
    
        // 마지막 조회 시간이 없거나 30분 이상 지난 경우에만 조회수를 증가
        if (!$last_view || ($current_time - strtotime($last_view['view_time'])) >= 1800) {
            // 'post' 테이블의 조회수 업데이트
            $this->db->set('views', 'views+1', FALSE);
            $this->db->where('post_id', $post_id);
            $this->db->update('post');
    
            // 'post_views' 테이블에 조회 정보 업데이트 또는 삽입
            if ($last_view) {
                // 기존 레코드 업데이트
                $this->db->set('view_time', date('Y-m-d H:i:s', $current_time));
                $this->db->where('post_id', $post_id);
                $this->db->where('user_ip', $user_ip);
                $this->db->update('post_views');
            } else {
                // 새 레코드 삽입
                $this->db->insert('post_views', array(
                    'post_id' => $post_id,
                    'user_ip' => $user_ip,
                    'view_time' => date('Y-m-d H:i:s', $current_time)
                ));
            }
        }
    }
    
    
    



    public function count_search_posts($search_query) {
        $this->db->like('title', $search_query);
        $this->db->or_like('content', $search_query);
        $this->db->from('post');
        return $this->db->count_all_results();
    }

    public function search($search_query, $search_option, $selectedPast, $start, $limit) {

        // HTML 이스케이프 처리
        $search_query = htmlspecialchars($search_query);

         // 'channel.name'을 select 절에 포함
        $this->db->select('post.*, channel.name as channel_name, (SELECT COUNT(*) FROM uploadfile WHERE uploadfile.post_id = post.post_id) AS file_count');

        // 'channel' 테이블과 조인
        $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left');

        // 기존의 from 절 유지
        $this->db->from('post');

        $this->db->where('post.delete_status', 0);
    
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
                    $this->db->where('post.create_date >=', date('Y-m-d H:i:s', strtotime('-1 day')));
                    break;
                case 'last_week':
                    $this->db->where('post.create_date >=', date('Y-m-d H:i:s', strtotime('-1 week')));
                    break;
                case 'last_month':
                    $this->db->where('post.create_date >=', date('Y-m-d H:i:s', strtotime('-1 month')));
                    break;
                case 'last_year':
                    $this->db->where('post.create_date >=', date('Y-m-d H:i:s', strtotime('-1 year')));
                    break;
            }
        }
    
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

    public function decrementThumb($post_id) {
        $this->db->set('thumb', 'thumb-1', FALSE);
        $this->db->where('post_id', $post_id);
        $this->db->update('post');
    }


    public function removeThumbRecord($post_id, $user_id) {
        $this->db->where('post_id', $post_id);
        $this->db->where('user_id', $user_id);
        $this->db->delete('post_thumb');
    }

    public function addThumbRecord($post_id, $user_id) {
        $data = array(
            'post_id'=> $post_id,
            'user_id'=> $user_id
        );
        $this->db->insert('post_thumb', $data);
    }
    
    public function getPostUserId($post_id){
        $this->db->select('user_id');
        $this->db->from('post');
        $this->db->where('post_id', $post_id);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->row()->user_id;
        } else {
            return null; 
        }
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

    public function count_posts_for_channel($channel_id) {
        $this->db->where('delete_status', FALSE);
        $this->db->where('parent_post_id', null);
        $this->db->where('channel_id', $channel_id); 
        $this->db->from('post');
        return $this->db->count_all_results();
    }
    


    public function get_posts_ordered_by_latest_for_channel($channel_id, $start = 0, $limit = 10) {
      
        date_default_timezone_set('Asia/Seoul');
    
        // 일반 글 
        $this->db->select('post.*, channel.name as channel_name, (SELECT COUNT(*) FROM uploadfile WHERE uploadfile.post_id = post.post_id) AS file_count');
        $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left');
        $this->db->where('delete_status', FALSE);
        $this->db->where('parent_post_id', null);
        $this->db->where('is_notice', FALSE);
        $this->db->where('channel.channel_id', $channel_id); 
        $this->db->order_by('create_date', 'DESC');
        $posts = $this->db->get('post')->result();

        // 날짜 형식 변경
        foreach ($posts as $post) {
            $post->create_date = (new DateTime($post->create_date))->format('Y.m.d H:i');
        }
    
      
        return $posts;
    }
    
    

    public function get_posts_ordered_by_latest($start = 0, $limit = 20) {

    date_default_timezone_set('Asia/Seoul');

     // 일반 글만 조회
     $this->db->select('post.*, channel.name as channel_name, (SELECT COUNT(*) FROM uploadfile WHERE uploadfile.post_id = post.post_id) AS file_count');
     $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left');
     $this->db->where('delete_status', FALSE);
     $this->db->where('parent_post_id', null);
     $this->db->where('is_notice', FALSE); // 공지사항 제외
     $this->db->limit($limit, $start);
     $this->db->order_by('create_date', 'DESC');
     $posts = $this->db->get('post')->result();
 
     // 날짜 형식 변경
     foreach ($posts as $post) {
         $post->create_date = (new DateTime($post->create_date))->format('Y.m.d H:i');
     }
 
     // 일반 글만 반환
     return $posts;
}



public function get_posts_ordered_by_thumb_for_channel($channel_id, $start = 0, $limit = 10) {

    date_default_timezone_set('Asia/Seoul');

    $this->db->select('post.*, channel.name as channel_name, (SELECT COUNT(*) FROM uploadfile WHERE uploadfile.post_id = post.post_id) AS file_count');
    $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left');
    $this->db->where('delete_status', FALSE);
    $this->db->where('parent_post_id', null);
    $this->db->where('is_notice', FALSE);
    $this->db->where('channel.channel_id', $channel_id); 
    $this->db->order_by('thumb', 'DESC');
    $posts = $this->db->get('post')->result();

    // 날짜 형식 변경
    foreach ($posts as $post) {
        $post->create_date = (new DateTime($post->create_date))->format('Y.m.d H:i');
    }

    
    return $posts;
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

        date_default_timezone_set('Asia/Seoul');

        
   
        $this->db->select('post.*, channel.name as channel_name, (SELECT COUNT(*) FROM uploadfile WHERE uploadfile.post_id = post.post_id) AS file_count');
        $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left');
        $this->db->where('delete_status', FALSE);
        $this->db->where('parent_post_id', null);
        $this->db->where('is_notice', FALSE); // 공지사항 제외
        $this->db->order_by('thumb', 'DESC');
        $this->db->limit($limit, $start);
        $posts = $this->db->get('post')->result();

        // 날짜 형식 변경
        foreach ($posts as $post) {
            $post->create_date = (new DateTime($post->create_date))->format('Y.m.d H:i');
        }

        // 일반 글만 반환
        return $posts;
    }




    public function get_posts_ordered_by_views_for_channel($channel_id, $start = 0, $limit = 10) {

        date_default_timezone_set('Asia/Seoul');

        $this->db->select('post.*, channel.name as channel_name, (SELECT COUNT(*) FROM uploadfile WHERE uploadfile.post_id = post.post_id) AS file_count');
        $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left');
        $this->db->where('delete_status', FALSE);
        $this->db->where('parent_post_id', null);
        $this->db->where('is_notice', FALSE);
        $this->db->where('channel.channel_id', $channel_id); 
        $this->db->order_by('views', 'DESC');
        $posts = $this->db->get('post')->result();

        // 날짜 형식 변경
        foreach ($posts as $post) {
            $post->create_date = (new DateTime($post->create_date))->format('Y.m.d H:i');
        }
    
      
        return $posts;
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

        
        date_default_timezone_set('Asia/Seoul');

  
        $this->db->select('post.*, channel.name as channel_name, (SELECT COUNT(*) FROM uploadfile WHERE uploadfile.post_id = post.post_id) AS file_count');
        $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left');
        $this->db->where('delete_status', FALSE);
        $this->db->where('parent_post_id', null);
        $this->db->where('is_notice', FALSE); // 공지사항 제외
        $this->db->order_by('views', 'DESC');
        $this->db->limit($limit, $start);
        $posts = $this->db->get('post')->result();

        // 날짜 형식 변경
        foreach ($posts as $post) {
            $post->create_date = (new DateTime($post->create_date))->format('Y.m.d H:i');
        }

        // 일반 글만 반환
        return $posts;
        
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
        
        $data = array('delete_status' => 1);
        
        $this->db->where('comment_id', $comment_id);
        $this->db->update('comment', $data);
    }
    

    public function get_comment_user_id($comment_id) {
        $this->db->select('user_id');
        $this->db->from('comment');
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->row()->user_id;
        } else {
            return false;
        }
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
        $this->db->where('delete_status', 0);
        return $this->db->count_all_results('post');
    }
    
    public function count_wrote_comments_sidebar($userid) {
        $this->db->where('user_id', $userid);
        $this->db->where('delete_status', 0);
        return $this->db->count_all_results('comment');
    }

    

    public function get_posts_by_channel($channel_id, $start, $limit = 10) {

        
        $this->db->select('post.*, channel.name as channel_name, (SELECT COUNT(*) FROM uploadfile WHERE uploadfile.post_id = post.post_id) AS file_count');
        $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left');
        $this->db->where('post.channel_id', $channel_id);
        $this->db->where('post.delete_status', FALSE);
        $this->db->where('post.parent_post_id', null);
        $this->db->where('post.is_notice', FALSE);
        
        if ($start == 0) {
            $this->db->limit($limit);
        } else {
            $this->db->limit($limit, $start);
        }
        
        $this->db->order_by('post.create_date', 'DESC');
        $posts = $this->db->get('post')->result();
    
        // 날짜 형식 변경
        foreach ($posts as $post) {
            $post->create_date = (new DateTime($post->create_date))->format('Y.m.d H:i');
        }
    
        return $posts;
    }
    


    
    
    public function count_channel_posts($channel_id) {
        // 채널 ID에 해당하는 일반 게시물(공지사항 제외)의 수 계산
        $this->db->where('channel_id', $channel_id);
        $this->db->where('delete_status', FALSE);
        $this->db->where('parent_post_id', null);
        $this->db->from('post');
        return $this->db->count_all_results();
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

    public function get_posts_is_notice($start, $limit) {
        // file_count를 계산하고 channel_name을 포함하기 위한 서브쿼리와 조인
        $this->db->select('post.*, channel.name as channel_name, (SELECT COUNT(*) FROM uploadfile WHERE uploadfile.post_id = post.post_id) AS file_count');
        
        // channel 테이블과 조인
        $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left');
    
        // is_notice가 1인 게시물만 선택
        $this->db->from('post');
        $this->db->where('is_notice', 1);
        
        // 정렬 및 기타 조건 설정
        $this->db->order_by('create_date', 'DESC');
        $this->db->limit($limit, $start);
    
        // 쿼리 실행 및 결과 반환
        $query = $this->db->get();
        $posts = $query->result();
    
        // 날짜 형식 변경
        foreach ($posts as $post) {
            $post->create_date = (new DateTime($post->create_date))->format('Y.m.d H:i');
        }
    
        return $posts;
    }
    
    
    public function count_is_notice_posts(){
        $this->db->select('*');
        $this->db->from('post');
        $this->db->where('is_notice', true);
        $this->db->where('delete_status', false);
        return $this->db->count_all_results();
    }
    
    
    
    public function get_top_poster() {

        $this->db->select('user_id');
        $this->db->select('COUNT(*) as post_count', FALSE);
        $this->db->from('post');
        $this->db->group_by('user_id');
        $this->db->order_by('post_count', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->row();

    }
    
    public function get_top_commenter() {

        $this->db->select('user_id');
        $this->db->select('COUNT(*) as comment_count', FALSE);
        $this->db->from('comment');
        $this->db->group_by('user_id');
        $this->db->order_by('comment_count', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->row();

    }
    
    public function get_top_thumb() {

        $this->db->select('user_id');
        $this->db->select('SUM(thumb) as thumb_count', FALSE);
        $this->db->from('post');
        $this->db->group_by('user_id');
        $this->db->order_by('thumb_count', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->row();

    }


    public function get_exp_level_info($user_id) {
        $this->db->select('exp_point, level');
        $this->db->from('user');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
    
        // 결과 반환
        if ($query->num_rows() > 0) {
            $exp_level_info = $query->row_array();
    
            // 다음 레벨까지 필요한 총 경험치 계산
            $total_exp_for_next_level = $exp_level_info['level'] * 100;
    
            // 현재 경험치를 기반으로 진행률 계산
            $progress_percentage = ($total_exp_for_next_level != 0) ? ($exp_level_info['exp_point'] / $total_exp_for_next_level) * 100 : 0;

    
            // 진행률을 100%를 초과하지 않도록 제한
            $exp_level_info['progress_percentage'] = min($progress_percentage, 100);
    
            return $exp_level_info;
        } else {
            return null;
        }
    }

    public function get_hot_posts($limit = 40) {
        $this->db->select('p.post_id, p.title, p.content, p.create_date, p.views, COUNT(c.comment_id) AS comment_count, p.thumb AS thumb_count, (COUNT(c.comment_id) + p.thumb) AS total_score, ch.name AS channel_name');
        $this->db->from('post AS p');
        $this->db->join('comment AS c', 'p.post_id = c.post_id', 'LEFT');
        $this->db->join('channel AS ch', 'p.channel_id = ch.channel_id', 'LEFT');
        $this->db->where('p.delete_status', 0); 
        $this->db->group_by('p.post_id, p.title, p.content, p.create_date, p.views, p.thumb, ch.name');
        $this->db->order_by('total_score', 'DESC');
        $this->db->limit($limit);
    
        $query = $this->db->get();
        return $query->result_array();
    }
    

    public function get_notice() {
        $this->db->select('post.post_id, post.title, post.content, post.create_date, post.views, post.thumb, post.user_id, post.channel_id, channel.name as channel_name, (SELECT COUNT(*) FROM comment WHERE comment.post_id = post.post_id) as comment_count');
        $this->db->from('post');
        $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left');
        $this->db->where('post.is_notice', 1); 
        $this->db->where('post.delete_status', 0);
        $this->db->order_by('post.create_date', 'DESC');
    
        $query = $this->db->get();
        $notices = $query->result();
    
        // 날짜 형식 변경 및 답글 수 추가
        foreach ($notices as $notice) {
        $notice->create_date = (new DateTime($notice->create_date))->format('Y.m.d H:i');

        // 각 공지사항에 대한 답글 수
        $replies = $this->get_reply_to_post($notice->post_id);
        $notice->reply_count = count($replies);
    }
    
        return $notices;
    }
    
    
    
    public function get_notice_by_channel($channelId) {
        $this->db->select('post.post_id, post.title, post.content, post.create_date, post.views, post.thumb, post.user_id, post.channel_id, channel.name as channel_name, (SELECT COUNT(*) FROM comment WHERE comment.post_id = post.post_id) as comment_count');
        $this->db->from('post');
        $this->db->join('channel', 'channel.channel_id = post.channel_id', 'left');
        $this->db->where('post.channel_id', $channelId);
        $this->db->where('post.is_notice', 1);
        $this->db->where('post.delete_status', 0);
        $this->db->order_by('post.create_date', 'DESC');
        
        $query = $this->db->get();
        $notices = $query->result();
    
        // 날짜 형식 변경
        foreach ($notices as $notice) {

        $notice->create_date = (new DateTime($notice->create_date))->format('Y.m.d H:i');

        // 각 공지사항에 대한 답글 수
        $replies = $this->get_reply_to_post($notice->post_id);
        $notice->reply_count = count($replies);

        }
    
        return $notices;
    }
    
    
    

 
    
    
 


    
   
    
    
    
    


    


}