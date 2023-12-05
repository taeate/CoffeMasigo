<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wrote extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('member/Wrote_model');
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
    }  
    public function index() {
        $userid = $this->session->userdata('user_id');
        $data['wrote_post'] = $this->Wrote_model->get_wrote_post($userid);
        $data['wrote_count'] = $this->Wrote_model->count_wrote_posts($userid);
    
        $this->load->view('member/wrote_view', $data);
    }

    public function wrote_post(){
        $userid = $this->session->userdata('user_id');      

        $data['wrote_post'] = $this->Wrote_model->get_wrote_post($userid);
        $data['wrote_count'] = $this->Wrote_model->count_wrote_posts($userid);
  
        
        if ($this->input->is_ajax_request()) {
            $response = [
                'wrote_post' => $data['wrote_post'],
                'wrote_count' => $data['wrote_count'], 
                'no_results' => empty($data['wrote_post']) ? "작성된 글이 없습니다" : ""
            ];
            echo json_encode($response);
            return; 
        }
    }

    public function wrote_comment(){
        $userid = $this->session->userdata('user_id'); 

        $data['wrote_comment'] = $this->Wrote_model->get_wrote_comment($userid);
        $data['wrote_comment_count'] = $this->Wrote_model->count_wrote_posts($userid);


        if ($this->input->is_ajax_request()) {
            $response = [
                'wrote_comment' => $data['wrote_comment'],
                'wrote_comment_count' => $data['wrote_comment_count'], 
                'no_results' => empty($data['wrote_comment']) ? "작성된 댓글이 없습니다" : ""
            ];
            echo json_encode($response);
            return; 
        }
    }
    





}
