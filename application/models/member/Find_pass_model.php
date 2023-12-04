<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Find_pass_model extends CI_Model {


    public function findByUserId($username, $userid, $email) {
        $this->db->select('user_id'); 
        $this->db->where('username', $username);
        $this->db->where('user_id', $userid);
        $this->db->where('email', $email);
        $query = $this->db->get('user');
    
        return ($query->num_rows() > 0) ? $query->row()->user_id : null;
    }

    public function passwordUpdate($user_id, $hashedPassword){
        // 데이터 배열 준비
        $data = array('password_hash' => $hashedPassword);

        // user_id에 해당하는 레코드를 찾아 비밀번호(hash)를 업데이트
        $this->db->where('user_id', $user_id);
        return $this->db->update('user', $data);
    }
    
}


?>