<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Write extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('posts/Post_model');
        $this->load->model('posts/Write_model');
        $this->load->model('member/Wrote_model');
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('alert');
        $this->load->library('session'); // 세션 라이브러리 로드
        $this->load->library('form_validation');
    }
    


    public function index(){

        $this->form_validation->set_rules('title', '제목', 'required', array('required' => '제목을 입력해주세요.'));
        $this->form_validation->set_rules('content', '내용', 'required', array('required' => '내용을 입력해주세요.'));
    
        $user_id = $this->session->userdata('user_id');
        
        if (!$user_id) {
            // AJAX 요청에 대한 응답으로 JSON 반환
            echo json_encode(['success' => false, 'message' => '로그인 후 이용 가능합니다.']);
            return; 
        }
    
        $user_role = $this->db->select('role')
        ->where('user_id', $user_id)
        ->get('user')
        ->row()
        ->role;
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($this->form_validation->run() == FALSE) {
                // AJAX 요청에 대한 응답으로 JSON 반환
                echo json_encode(['success' => false, 'message' => strip_tags(validation_errors())]);
                return; 

            } else {

                $title = $this->input->post('title');
                $content = $this->input->post('content');
                $channel_id = $this->input->post('channel_id'); 
                $is_notice = $this->input->post('is_notice') && $user_role == 'admin' ? 1 : 0;
                
                // 글 저장 후 생성된 post_id 획득
                $post_id = $this->Write_model->set_article($title, $content, $user_id, $is_notice, $channel_id);


                // 경험치 업데이트
                $this->Write_model->update_experience_points($user_id, 5);
                
                echo json_encode(['success' => true, 'redirect' => '/posts']);

                // 파일 업로드 로직
                $this->upload_files($post_id, $user_id);
    
              
                
                return; 
            }
        } else {

              //사이드바 정보
            $userid = $this->session->userdata('user_id');
            $data['post_count'] = $this->Post_model->count_wrote_posts_sidebar($userid);
            $data['comment_count'] = $this->Post_model->count_wrote_comments_sidebar($userid);
            $data['wrote_thumb_post_count'] = $this->Wrote_model->count_wrote_thumb_post($userid);
            $data['exp_level_info'] = $this->Post_model->get_exp_level_info($user_id);
            $data['hot_posts'] = $this->Post_model->get_hot_posts();

            // AJAX 요청이 아닐 경우 기존의 로직 수행
            $data['post_data'] = null;
            $data['user_role'] = $user_role;
            $this->load->view('posts/post_write_view', $data);
        }
    }
    


    public function upload_files($post_id, $user_id){
        

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 500; // 정수로 설정
        // $config['encrypt_name'] = TRUE; // 파일명을 암호화하여 무작위 생성
        // $config['file_ext_tolower'] = TRUE; // 파일 확장자를 소문자로 변환
        $config['remove_spaces'] = FALSE; // 파일 이름에서 공백 제거
        // $config['xss_clean'] = TRUE; // XSS 필터링 적용

        $this->load->library('upload', $config);

        if (!empty($_FILES['file']['name'][0])) {
            $files = $_FILES['file'];

            foreach ($files['name'] as $key => $name) {
                
                $_FILES['single_file'] = array(
                    'name' => $files['name'][$key],
                    'type' => $files['type'][$key],
                    'tmp_name' => $files['tmp_name'][$key],
                    'error' => $files['error'][$key],
                    'size' => $files['size'][$key]
                );

                if ($this->upload->do_upload('single_file')) {

                    $uploadData = $this->upload->data();
                    
                    $this->Write_model->saveFileData($post_id, $uploadData['file_name'], $uploadData['full_path'], $uploadData['file_type'], $uploadData['file_size'], $user_id);
                } else {
                    $error = $this->upload->display_errors();
               
                }
            }

        }else{

        }
    }


    public function downloadFile($file_name) {
       // URL 디코딩 적용
    $decoded_file_name = urldecode($file_name);
    
    // 파일 경로 설정
    $file_path = './uploads/' . $decoded_file_name; 

    
        if (file_exists($file_path)) {
            // 파일 확장자에 따른 Content-Type 설정
            $file_extension = strtolower(pathinfo($decoded_file_name, PATHINFO_EXTENSION));
            switch ($file_extension) {
                case 'jpg':
                case 'jpeg':
                    $content_type = 'image/jpeg';
                    break;
                case 'png':
                    $content_type = 'image/png';
                    break;
                default:
                    $content_type = 'application/octet-stream';
            }
    
            header('Content-Description: File Transfer');
            header('Content-Type: ' . $content_type);
            header('Content-Disposition: attachment; filename="' . rawurlencode(basename($decoded_file_name)) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_path));
            
            readfile($file_path);
            exit;
        } else {
            echo '파일이 존재하지 않습니다.';
        }
    }
    
    
    
    
    

    

    public function answer_post($post_id) {

        // 폼 유효성 검사 규칙 설정
        $this->form_validation->set_rules('title', '제목', 'required', array('required' => '제목을 입력해주세요.'));
        $this->form_validation->set_rules('content', '내용', 'required', array('required' => '내용을 입력해주세요.'));
    
        $user_id = $this->session->userdata('user_id');
    
        if (!$user_id) {
            // 비회원일 경우 로그인 페이지로 리디렉션
            $this->session->set_flashdata('message', '로그인 후 이용 가능합니다.');
            redirect('login');
        }
    
        if (!empty($post_id)) {

            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // 폼 유효성 검사 실행
                if ($this->form_validation->run() == FALSE) {
                    $errors = $this->form_validation->error_array();
                    echo json_encode(['success' => false, 'errors' => $errors]);
                    return;
                }else{
                    // 필요한 경우 다른 데이터를 뷰에 전달
                    $data['post_data'] = $this->Write_model->get_post($post_id);
                    $this->load->view('posts/post_write_view', $data);
            
                    // 검사 성공: 답글 저장 로직
                    $title = $this->input->post('title');
                    $content = $this->input->post('content');
                    $channel_id = $this->input->post('channel_id'); 
                    $new_post_id =$this->Write_model->save_answer_post($title, $content, $user_id, $post_id, $channel_id );

                    $this->upload_files($new_post_id, $user_id);
                          
                    echo json_encode(['success' => true, 'new_post_id' => $new_post_id, 'message' => '성공']);

                    exit();
                }
            } else {
                
                //사이드바 정보
                $userid = $this->session->userdata('user_id');
                $data['post_count'] = $this->Post_model->count_wrote_posts_sidebar($userid);
                $data['comment_count'] = $this->Post_model->count_wrote_comments_sidebar($userid);
                $data['wrote_thumb_post_count'] = $this->Wrote_model->count_wrote_thumb_post($userid);
                $data['exp_level_info'] = $this->Post_model->get_exp_level_info($userid);
                $data['hot_posts'] = $this->Post_model->get_hot_posts();

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
    
    
    public function delete_file($file_id, $post_id) {

    $user_id = $this->session->userdata('user_id');
    if (!$user_id) {
        // 사용자가 로그인하지 않은 경우
        echo json_encode(['status' => false, 'message' => '로그인이 필요합니다.']);
        return;
    }

     $result = $this->Write_model->delete_file($file_id, $post_id);

    if ($result) {
        echo json_encode(['status' => true, 'message' => '파일이 삭제되었습니다.']);
    } else {
        echo json_encode(['status' => false, 'message' => '파일 삭제에 실패했습니다.']);
    }
}

    public function post_edit($post_id){

        $this->form_validation->set_rules('title', '제목', 'required', array('required' => '제목을 입력해주세요.'));
        $this->form_validation->set_rules('content', '내용', 'required', array('required' => '내용을 입력해주세요.'));


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


        if (!empty($post_id)){

            $author_id = $this->Write_model->get_post_author_id($post_id);

            if ($user_id !== $author_id){
                $this->session->set_flashdata('message','수정권한이 없습니다');
                redirect('posts/free/'.$post_id);
            }

            $data['before_data'] = $this->Write_model->get_before_post($post_id);
            $data['user_role'] = $user_role;

            
            //사이드바 정보
            $userid = $this->session->userdata('user_id');
            $data['post_count'] = $this->Post_model->count_wrote_posts_sidebar($userid);
            $data['comment_count'] = $this->Post_model->count_wrote_comments_sidebar($userid);
            $data['wrote_thumb_post_count'] = $this->Wrote_model->count_wrote_thumb_post($userid);
            $data['exp_level_info'] = $this->Post_model->get_exp_level_info($userid);
            $data['hot_posts'] = $this->Post_model->get_hot_posts();

            $this->load->view('posts/post_edit_view', $data);
        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($this->form_validation->run() == FALSE) {
                $errors = $this->form_validation->error_array();
                echo json_encode(['success' => false, 'errors' => $errors]);
                return;
            }else{

            $title = $this->input->post('title');
            $content = $this->input->post('content');
            $channel_id = $this->input->post('channel_id'); 
  
            $this->Write_model->edit_post($post_id, $title, $content, $channel_id);

            $this->upload_files($post_id, $user_id);

            
            }
        }

        // $this->load->view("posts/post_edit_view");
    }

    public function post_delete($post_id){

        $user_id = $this->session->userdata('user_id');
        
        if (!empty($post_id)) {

            $this->Write_model->update_experience_points($user_id, -2);

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

}
?>