<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Write_model extends CI_Model {

    public function set_article($title, $content, $user_id, $is_notice, $channel_id) {

        date_default_timezone_set('Asia/Seoul');

        $content = htmlspecialchars($content);

        $data = array(
            'title'=> $title,
            'content'=> $content,
            'user_id' => $user_id,
            'ref' => null,
            're_step' => 0,
            're_level' => 0,
            'delete_status' => 0,
            'is_notice' => $is_notice,
            'channel_id' => $channel_id
        );

        $this->db->insert('post', $data);

         // 새로 삽입된 게시글의 ID 가져오기
        $new_post_id = $this->db->insert_id();

        // 최상위 게시글인 경우 ref 업데이트
        $this->db->update('post', array('ref' => $new_post_id), array('post_id' => $new_post_id));

         // 새로운 게시글의 ID 반환
        return $new_post_id;
    }


    public function update_experience_points($user_id, $points) {
        // 현재 사용자의 경험치와 레벨 가져오기
        $this->db->select('exp_point, level');
        $this->db->where('user_id', $user_id);
        $user = $this->db->get('user')->row();
    
        // 새로운 경험치 계산
        $new_points = $user->exp_point + $points;
    
        // 레벨별로 필요한 경험치 계산
        $level_up_points = $user->level * 100;
    
        // 레벨 업 체크
        if ($new_points >= $level_up_points) {
            $new_level = $user->level + 1;

             // 음수 값을 방지하기 위해 새로운 경험치를 음수 값으로 설정하지 않도록 검사
            $new_points = max(0, $new_points - $level_up_points);
    
            // 레벨과 경험치 업데이트 (경험치를 0으로 초기화)
            $this->db->update('user', array('level' => $new_level, 'exp_point' => 0), array('user_id' => $user_id));
        } else {
            // 경험치만 업데이트
            $this->db->update('user', array('exp_point' => $new_points), array('user_id' => $user_id));
        }
    }
    
    

    public function get_post($post_id) {

        $query = $this->db->get_where('post',array('post_id'=> $post_id));

       return $query->row();
    }


    public function get_post_by_id($post_id) {
        $this->db->from('post'); 
        $this->db->where('post_id', $post_id); 
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null; 
        }
    }


    public function post_exists($post_id) {
        
        $query = $this->db->where('post_id', $post_id)
                          ->get('post');
    
        
        return $query->num_rows() > 0;
    }
    


    public function save_answer_post($title, $content, $user_id, $parent_post_id, $channel_id) {

    $content = htmlspecialchars($content);

    date_default_timezone_set('Asia/Seoul');
    
    $ref = null;
    $re_step = 0;
    $re_level = 0;

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
        'delete_status' => 0,
        'ref' => $ref,
        're_step' => $re_step,
        're_level' => $re_level,
        'channel_id' => $channel_id
    );

    $this->db->insert('post', $data);

    // 새로 생성된 글의 post_id를 가져오기
    $new_post_id = $this->db->insert_id();

    // 최상위 댓글인 경우 ref 업데이트
    if ($parent_post_id === null) {
        $this->db->update('post', array('ref' => $new_post_id), array('post_id' => $new_post_id));
    }

    return $new_post_id; // 새로 생성된 글의 post_id 반환
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
        $this->db->select('post.*, channel.name as channel_name');
        $this->db->from('post');
        $this->db->join('channel', 'post.channel_id = channel.channel_id');
        $this->db->where('post_id', $post_id);
        $post_info = $this->db->get()->row();
    
        $this->db->select('file_name, file_path, file_id');
        $this->db->where('post_id', $post_id);
        $files = $this->db->get('uploadfile')->result();
    
        return [
            'post_info' => $post_info,
            'files' => $files
        ];
    }
    

    public function delete_file($file_id, $post_id){
        $this->db->where('file_id', $file_id);
        $this->db->where('post_id', $post_id); 
        return $this->db->delete('uploadfile');
        
    }
    
    

    public function edit_post($post_id, $title, $content, $channel_id){

        $content = htmlspecialchars($content);

        $this->db->where('post_id', $post_id);

        $data = array(
            'title'=> $title,
            'content'=> $content,
            'channel_id' => $channel_id
            );

        $this->db->update('post', $data);
        
    } 
    
     public function delete_post($post_id){

        $data = array('delete_status' => TRUE);

        $this->db->where('post_id', $post_id);
        $this->db->update('post', $data);
      
        
    }

    public function saveFileData($post_id, $file_name, $file_path, $file_type, $file_size, $user_id) {
  

        // 파일 데이터 배열 생성
        $data = array(
            'post_id' => $post_id,
            'file_name' => $file_name,
            'file_path' => $file_path,
            'file_type' => $file_type,
            'file_size' => $file_size,
            'upload_date' => date('Y-m-d H:i:s'), // 현재 시간을 업로드 날짜로 설정
            'user_id' => $user_id,
            'status' => 1 // 파일 상태, 1 = 활성화
        );

        // 데이터베이스에 데이터 삽입
        $this->db->insert('uploadfile', $data);

        // 삽입된 데이터의 ID 반환 (선택적)
        return $this->db->insert_id();
    }



    public function saveImageFile($file, $fileName) {
        // 파일 저장 디렉토리 설정
        $uploadDir = 'uploads/'; 
        
        // 안전한 파일 이름 생성 (옵션)
        $safeFileName = $this->generateSafeFileName($fileName);
    
        // 파일 저장 경로
        $uploadPath = $uploadDir . $safeFileName;
    
        // 파일 이동
        if (move_uploaded_file($file, $uploadPath)) {
            return $uploadPath; // 파일 저장 성공시 저장 경로 반환
        } else {
            return false; // 파일 저장 실패시 false 반환
        }
    }
    
    private function generateSafeFileName($fileName) {
        // 파일 이름에서 확장자 분리
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    
        // 안전한 이름 생성 (예: 타임스탬프)
        $nameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);
        $safeName = $nameWithoutExt . '_' . time() . '.' . $ext;
    
        return $safeName;
    }
    



   
    
}