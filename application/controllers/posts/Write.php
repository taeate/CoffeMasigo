<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Write extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('posts/Write_model');
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('alert');
        $this->load->library('session'); // 세션 라이브러리 로드
    }
    

    public function index(){

        $user_id = $this->session->userdata('user_id');
        

        if (!$user_id) {
            // 비회원일 경우 로그인 페이지로 리디렉션하기 전에 메시지 설정
            $this->session->set_flashdata('message', '로그인 후 이용 가능합니다.');
            redirect('login');
        }

        $user_role = $this->db->select('role')
        ->where('user_id', $user_id)
        ->get('user')
        ->row()
        ->role;
    
        // 글 작성 로직
        if ($this->input->post()) {
            
            $title = $this->input->post('title');
            $content = $this->input->post('content');
            $is_notice = $this->input->post('is_notice') && $user_role == 'admin' ? 1 : 0;
            $this->Write_model->set_article($title, $content, $user_id,$is_notice);
            redirect('/posts');
        }
    
        $data['post_data'] = null;
        $data['user_role'] = $user_role;
        $this->load->view('posts/post_write_view', $data);
    }

    

    public function answer_post($post_id) {

        $user_id = $this->session->userdata('user_id');
        
        if (!$user_id) {
            // 비회원일 경우 로그인 페이지로 리디렉션하기 전에 메시지 설정
            $this->session->set_flashdata('message', '로그인 후 이용 가능합니다.');
            redirect('login');
        }

        if (!empty($post_id)) {

            // 폼에서 데이터가 전송되었는지 확인
            if ($this->input->post()) {

                $title = $this->input->post('title');
                $content = $this->input->post('content');
                $user_id = $this->session->userdata('user_id'); // 세션에서 사용자 ID 가져오기
    
                  
                
                $this->Write_model->save_answer_post($title, $content, $user_id, $post_id);
    
                
                redirect('/posts/all');

            } else {

                // 폼에서 데이터가 전송되지 않았을 경우
                $post_info = $this->Write_model->get_post($post_id);
    
                if ($post_info) {
                    $data['post_data'] = $post_info;
                    $this->load->view('posts/post_write_view', $data);
                } else {
                    echo "찾지못함";
                }
            }
        }

    
    }
    public function post_edit($post_id){


        $user_id = $this->session->userdata('user_id');
        
        if (!$user_id) {
            // 비회원일 경우 로그인 페이지로 리디렉션하기 전에 메시지 설정
            $this->session->set_flashdata('message', '로그인 후 이용 가능합니다.');
            redirect('login');
        }


        if (!empty($post_id)){

            $author_id = $this->Write_model->get_post_author_id($post_id);

            if ($user_id !== $author_id){
                $this->session->set_flashdata('message','수정권한이 없습니다');
                redirect('posts/free/'.$post_id);
            }

            $data['before_data'] = $this->Write_model->get_before_post($post_id);

            $this->load->view('posts/post_edit_view', $data);
        }

        if($this->input->post()){

            $title = $this->input->post('title');
            $content = $this->input->post('content');

            $this->Write_model->edit_post($post_id, $title, $content);

            redirect('/posts/free/'.$post_id);
        
        }

        // $this->load->view("posts/post_edit_view");
    }

    public function post_delete($post_id){
        
        if (!empty($post_id)) {
            $this->Write_model->delete_post($post_id);
            redirect('posts');
        }
    }






    
}
?>