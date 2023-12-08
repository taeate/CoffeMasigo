<?php
class MY_Controller extends CI_Controller {
    
    protected $data = array();

    public function __construct() {
        parent::__construct();
          // 모델 로드
        $this->load->model('posts/Post_model');
        $this->load_common_data();
      
    }

    private function load_common_data() {
        $userid = $this->session->userdata('user_id');
        $this->data['post_count'] = $this->Post_model->count_wrote_posts_sidebar($userid);
        $this->data['comment_count'] = $this->Post_model->count_wrote_comments_sidebar($userid);
    }

    protected function render($view) {
        $this->load->view('layout/header');
        $this->load->view($view, $this->data);
        $this->load->view('layout/sidebar', $this->data);
    }
}
