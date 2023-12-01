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
        $this->db->where('user_id', $user_id);
        $this->db->update('profile_image', $upload_data);
    }

    
}