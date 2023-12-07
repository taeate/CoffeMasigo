<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mypage_model extends CI_Model {


    // 사용자 정보 가져오기
    public function get_user($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user'); 
        return $query->row();
    }

    // 비밀번호 업데이트
    public function update_password($user_id, $new_password_hash) {
        $this->db->where('user_id', $user_id);
        $this->db->update('user', array('password_hash' => $new_password_hash));
    }

    public function change_image_save($upload_data, $user_id) {
        // 업로드된 파일의 이름을 사용하여 업데이트 데이터 설정
        $update_data = array('profile_image' => $upload_data['file_name']);
    
        // user_id에 해당하는 행 찾기
        $this->db->where('user_id', $user_id);
    
        // 데이터 업데이트
        $this->db->update('user', $update_data);
    
        // 세션 변수 업데이트
        $this->session->set_userdata('profile_image', $upload_data['file_name']);
    }
    

    
}