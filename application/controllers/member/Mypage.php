<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mypage extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('posts/Post_model');
        $this->load->model('member/Mypage_model');
        $this->load->model('member/Wrote_model');
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
    }  
    public function index() {

         // 기존 비밀번호 검증
            $this->form_validation->set_rules(
                'password0', 
                '현재 비밀번호', 
                'required|callback_password_check', 
                array('required' => '현재 비밀번호를 입력해주세요.')
            );

            // 새로운 비밀번호 검증
            $this->form_validation->set_rules(
                'password1', 
                '변경할 비밀번호', 
                'required|min_length[4]|regex_match[/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/]', 
                array(
                    'required' => '변경할 비밀번호를 입력해주세요.',
                    'min_length' => '변경할 비밀번호는 최소 4자 이상이어야 합니다.',
                    'regex_match' => '변경할 비밀번호는 영문과 숫자를 조합하여야 합니다.'
                )
            );

            // 비밀번호 확인 검증
            $this->form_validation->set_rules(
                'password2', 
                '비밀번호 확인', 
                'required|matches[password1]', 
                array(
                    'required' => '비밀번호 확인을 입력해주세요.',
                    'matches' => '비밀번호가 일치하지 않습니다.'
                )
            );
    
        $user_id = $this->session->userdata('user_id');
    
        if (!$user_id) {
            // 비회원일 경우 로그인 페이지로 리디렉션
            $this->session->set_flashdata('message', '로그인 후 이용 가능합니다.');
            redirect('login');
        }
    
        if ($this->input->post()) {
            if ($this->form_validation->run() == FALSE) {
                // 검증 실패 시 처리
                if($this->input->is_ajax_request()){
                    $errors = [
                        'password_error_0' => form_error('password0'),
                        'password_error_1' => form_error('password1'),
                        'password_error_2' => form_error('password2')
                    ];
                    echo json_encode(['error' => true, 'errors' => $errors]);
                } else {
                    $this->load->view('member/mypage_view');
                }        
            } else {
                // 성공시, 새 비밀번호 업데이트
                $new_password = $this->input->post('password1');
                $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $this->Mypage_model->update_password($user_id, $new_password_hash);
    
                // 성공 메시지 설정
                if($this->input->is_ajax_request()){
                    echo json_encode(['error' => false, 'message' => '비밀번호 변경 성공']);
                } else {  
                    $this->session->set_flashdata('message', '비밀번호가 변경되었습니다.');
                    redirect('/mypage');
                }
            }
        } else {

            //사이드바 정보
            $userid = $this->session->userdata('user_id');
            $data['post_count'] = $this->Post_model->count_wrote_posts_sidebar($userid);
            $data['comment_count'] = $this->Post_model->count_wrote_comments_sidebar($userid);
            $data['wrote_thumb_post_count'] = $this->Wrote_model->count_wrote_thumb_post($userid);
            $data['user_data'] = $this->Wrote_model->get_user_data($user_id);
            $data['exp_level_info'] = $this->Post_model->get_exp_level_info($userid);
            $data['hot_posts'] = $this->Post_model->get_hot_posts();
            

   
            $this->load->view('member/mypage_view',$data);
        }
    }
    

    public function change_intro() {

        $this->form_validation->set_rules(
            'intro', 
            '소개글', 
            'required|max_length[30]', 
            array(
                'required' => '내용을 입력해주세요.',
                'max_length' => '변경할 소개글 내용은 최대 30자 이하로 작성해주세요.',
            )
        );

        // AJAX 요청인 경우만 처리
        if ($this->input->is_ajax_request()) {

            if ($this->form_validation->run() == FALSE) {
                $errors = [
                    'intro_error' => form_error('intro'),
                ];
                echo json_encode(['error' => true, 'errors' => $errors]);
                
            }else{

            $intro = $this->input->post('intro');
            $user_id = $this->session->userdata('user_id'); // 세션에서 사용자 ID 가져오기 또는 사용자 식별 방법에 따라 변경
        
            // 데이터베이스에서 사용자 소개글 업데이트
            $data = array(
                'introduction' => $intro
            );
        
            $this->db->where('user_id', $user_id);
            $this->db->update('user', $data);
        
            $response = array();
        
            if ($this->db->affected_rows() > 0) {
                // 업데이트가 성공했을 때
                $response['error'] = false;
                $response['message'] = '소개글이 변경되었습니다.';
            } else {
                // 업데이트가 실패했을 때
                $response['error'] = true;
                $response['errors']['intro_error'] = '소개글 업데이트에 실패했습니다.';
            }
        
            // JSON 응답 반환
            echo json_encode($response);

            }
            
        }
    }
    
    

public function password_check($password) {
    $user_id = $this->session->userdata('user_id');
    $user = $this->Mypage_model->get_user($user_id);

    if ($user && password_verify($password, $user->password_hash)) {
        return TRUE;
    } else {
        $this->form_validation->set_message('password_check', '비밀번호가 일치하지 않습니다.');
        return FALSE;
    }
}

public function no_previous_password($new_password){
    $user_id = $this->session->userdata('user_id');
    $user = $this->Mypage_model->get_user($user_id);

    if (!password_verify($new_password, $user->password_hash)) {
        return TRUE; // 새 비밀번호가 기존 비밀번호와 다르면 TRUE
    } else {
        $this->form_validation->set_message('no_previous_password', '기존 비밀번호랑 다르게 입력해주세요.');
        return FALSE; // 새 비밀번호가 기존 비밀번호와 같으면 FALSE
    }
}

public function change_image(){

    $user_id = $this->session->userdata('user_id');
    
    if($this->input->is_ajax_request()){

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 2048; // 최대 2MB
        // $config['encrypt_name'] = TRUE; // 파일 이름 암호화

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('profile_image')) {
            echo json_encode(['success' => false, 'error' => $this->upload->display_errors()]);
            exit;
        
        } else {
            // 파일 업로드 성공, 업로드된 파일 저장
            $upload_data = $this->upload->data();
            
            $this->Mypage_model->change_image_save($upload_data, $user_id );
            
            echo json_encode(['success' => true]);
            exit; // 함수 실행 중단

        }
    

    }
}



}
