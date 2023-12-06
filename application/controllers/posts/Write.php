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
        $this->load->library('form_validation');
    }
    


    public function index(){


        $this->form_validation->set_rules('title', '제목', 'required', array('required' => '제목을 입력해주세요.'));
        $this->form_validation->set_rules('content', '내용', 'required', array('required' => '내용을 입력해주세요.'));
        $this->form_validation->set_error_delimiters('<div class="ml-1 mb-1 text-red-500">', '</div>');

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

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('message', validation_errors());
                $data['post_data'] = null;
                $data['user_role'] = $user_role;
                $this->load->view('posts/post_write_view', $data);

            } else{
                    
                $title = $this->input->post('title');
                $content = $this->input->post('content');
                $is_notice = $this->input->post('is_notice') && $user_role == 'admin' ? 1 : 0;
                $this->Write_model->set_article($title, $content, $user_id,$is_notice);
                redirect('/posts');

            }
           
         } else {
             // 폼이 처음 로드될 때
            $data['post_data'] = null;
            $data['user_role'] = $user_role;
            $this->load->view('posts/post_write_view', $data);
         
         }
            

    }

    

    public function answer_post($post_id) {
        // 폼 유효성 검사 규칙 설정
        $this->form_validation->set_rules('title', '제목', 'required', array('required' => '제목을 입력해주세요.'));
        $this->form_validation->set_rules('content', '내용', 'required', array('required' => '내용을 입력해주세요.'));
        $this->form_validation->set_error_delimiters('<div class="ml-1 mb-1 text-red-500">', '</div>');
    
        $user_id = $this->session->userdata('user_id');
    
        if (!$user_id) {
            // 비회원일 경우 로그인 페이지로 리디렉션
            $this->session->set_flashdata('message', '로그인 후 이용 가능합니다.');
            redirect('login');
        }
    
        if (!empty($post_id)) {
            if ($this->input->post()) {
                // 폼 유효성 검사 실행
                if ($this->form_validation->run() == FALSE) {
                    // 검사 실패: 오류 메시지를 플래시 데이터로 저장
                    $this->session->set_flashdata('message', validation_errors());
    
                    // 필요한 경우 다른 데이터를 뷰에 전달
                    $data['post_data'] = $this->Write_model->get_post($post_id);
                    $this->load->view('posts/post_write_view', $data);
                } else {
                    // 검사 성공: 답글 저장 로직
                    $title = $this->input->post('title');
                    $content = $this->input->post('content');
                    $this->Write_model->save_answer_post($title, $content, $user_id, $post_id);
                    redirect('/posts/all');
                }
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
            
        }
    }

  


    public function saveImage(){
        
        if (isset($_FILES['upload'])) {
            // 이미지 파일 처리
            $file = $_FILES['upload']['tmp_name'];
            $fileName = $_FILES['upload']['name'];

            // 이미지 파일을 서버에 저장하는 로직
            $savedImageUrl = $this->Write_model->saveImageFile($file, $fileName);

            // CKEditor에 반환할 JSON 응답
            $response = [
                "uploaded" => 1,
                "fileName" => $fileName,
                'url' => base_url($savedImageUrl) // 저장된 이미지의 URL
            ];
            echo json_encode($response);
            return;
    }

    }   

    // public function upload_files() {

    //     $config['upload_path'] = './uploads/'; // 서버에 파일을 저장할 경로
    //     $config['allowed_types'] = 'jpg|jpeg|png|gif|doc|docx|pdf|xls|xlsx|ppt|pptx|txt';
    //     $config['max_size'] = 5000; // 최대 파일 크기 (KB)
    
    //     $this->load->library('upload', $config);
    
    //     if (!$this->upload->do_upload('file')) {
    //         // 업로드 실패
    //         $error = array('error' => $this->upload->display_errors());
    //         echo json_encode($error);
    //     } else {
    //         // 업로드 성공
    //         $data = $this->upload->data();
    //         echo json_encode(['success' => true, 'file_name' => $data['file_name']]);
    //     }
    // }
}
?>