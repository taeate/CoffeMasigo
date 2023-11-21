<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Write extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('posts/Write_model');
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session'); // 세션 라이브러리 로드
    }
    
    public function index(){

        if ($this->input->post()) {

            $title = $this->input->post('title');
            $content = $this->input->post('content');

            $user_id = $this->session->userdata('user_id');

            $this->Write_model->set_article($title, $content, $user_id);

            redirect('/posts');
        }

        $data['post_data'] = null;

        $this->load->view('posts/post_write_view',$data);
    
    }

    public function answer_post($post_id) {

        if (!empty($post_id)) {

            // 폼에서 데이터가 전송되었는지 확인
            if ($this->input->post()) {

                $title = $this->input->post('title');
                $content = $this->input->post('content');
                $user_id = $this->session->userdata('user_id'); // 세션에서 사용자 ID 가져오기
    
                  
                
                $this->Write_model->save_reply($title, $content, $user_id, $post_id);
    
                
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

        if (!empty($post_id)){

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