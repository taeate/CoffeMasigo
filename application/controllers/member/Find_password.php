<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Find_password extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('member/Find_pass_model');
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
    } 


    public function index() {
      
    }

    public function findPassword() {
        // 폼 유효성 검사 규칙 설정
        $this->form_validation->set_rules('userid', '아이디', 'required', array('required' => '아이디를 입력해주세요.'));
        $this->form_validation->set_rules('username', '이름', 'required', array('required' => '이름을 입력해주세요.'));
        $this->form_validation->set_rules(
            'email',
            '이메일',
            'required|valid_email',
            array(
                'required' => '이메일을 입력해주세요.',
                'valid_email' => '유효한 이메일 형식이 아닙니다.'
            )
        );
        
    
        $data = [];
    
        if ($this->form_validation->run()) {
            $username = $this->input->post('username');
            $userid = $this->input->post('userid');
            $email = $this->input->post('email');
    
            $user_id = $this->Find_pass_model->findByUserId($username, $userid, $email);
    
            if ($user_id) {
                $data['userExists'] = true;
                $data['user_id'] = $user_id;
            } else {
                $data['userNotFound'] = true;
            }
        }
    
        $this->load->view('member/findBypassword_view', $data);
    }
    

    public function changePassword() {
        $this->form_validation->set_rules('newPassword1', '새비밀번호', 'required', array('required' => '비밀번호를 입력해주세요.'));
        $this->form_validation->set_rules(
            'newPassword2', 
            '새비밀번호확인', 
            'required|min_length[4]|regex_match[/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/]|matches[newPassword1]', 
            array(
                'required' => '비밀번호를 입력해주세요.',
                'min_length' => '비밀번호는 최소 4자 이상이어야 합니다.',
                'regex_match' => '비밀번호는 영문과 숫자를 조합하여야 합니다.',
                'matches' => '비밀번호가 일치하지 않습니다.'
            )
        );
        
    
        if ($this->form_validation->run() == FALSE) {
            // 유효성 검사 실패 시, 에러 메시지와 함께 현재 뷰를 다시 로드
            $data['userExists'] = true; // 유저가 존재하는 상태를 유지
            $data['user_id'] = $this->input->post('user_id'); 
            $this->load->view('member/findBypassword_view', $data);
        } else {
            // 유효성 검사 성공 시, 비밀번호 변경 로직 실행
            $user_id = $this->input->post('user_id');
            $newPassword = $this->input->post('newPassword1');
    
            if ($user_id && $newPassword) {
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                $this->Find_pass_model->passwordUpdate($user_id, $hashedPassword);
                $this->session->set_flashdata('password_changed', '비밀번호가 성공적으로 변경되었습니다.');
                redirect('/login');
            } else {
                // 필요한 데이터가 누락된 경우 다시 현재 뷰 로드
                $data['userExists'] = true; 
                $data['user_id'] = $this->input->post('user_id'); 
                $this->load->view('member/findBypassword_view', $data);
            }
        }
    }
    
    

}
?>
