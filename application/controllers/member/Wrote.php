<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wrote extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('posts/Post_model');
        $this->load->model('member/Wrote_model');
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('pagination'); // 페이지네이션 로드

    }  
    public function index() {
        $userid = $this->session->userdata('user_id');
        $data['wrote_post'] = $this->Wrote_model->get_wrote_post($userid);
        $data['wrote_count'] = $this->Wrote_model->count_wrote_posts($userid);

        
         //사이드바 정보
         $data['post_count'] = $this->Post_model->count_wrote_posts_sidebar($userid);
         $data['comment_count'] = $this->Post_model->count_wrote_comments_sidebar($userid);
         $data['exp_level_info'] = $this->Post_model->get_exp_level_info($userid);
    
        $this->load->view('member/wrote_view', $data);
    }

    public function wrote_post(){

        $userid = $this->session->userdata('user_id'); 

        //페이지네이션 설정
        $config = array();
        $config['base_url'] = site_url('member/wrote/post/');
        $config['first_url'] = site_url('member/wrote/post/page/1');
        $config['total_rows'] = $this->Wrote_model->count_wrote_posts($userid); // 총 게시물수
        $config['per_page'] = 15; // 페이지당 게시물수
        $config['use_page_numbers'] = TRUE;
        $config['last_link'] = TRUE;
        $config['first_link'] = TRUE;
        $config['display_pages'] = TRUE;
        // $config['num_links'] = 2;

        $config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="inline-flex -space-x-px text-sm">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = '첫페이지';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['first_url'] = ''; // 첫 페이지 URL 설정
        $config['last_link'] = '마지막페이지';

        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li><a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white');

        
        

        //초기화
        $this->pagination->initialize($config);

        //현재페이지 번호 계싼
        $page = $this->uri->segment(4) ? $this->uri->segment(4) : 1;


        //오프셋계산
        $start = ($page - 1) * $config['per_page'];


        // 페이지네이션 링크 생성
        $data['link'] = $this->pagination->create_links();
        
        // 사이드바 정보
        $data['post_count'] = $this->Post_model->count_wrote_posts_sidebar($userid);
        $data['comment_count'] = $this->Post_model->count_wrote_comments_sidebar($userid);
        $data['wrote_thumb_post_count'] = $this->Wrote_model->count_wrote_thumb_post($userid);
        $data['exp_level_info'] = $this->Post_model->get_exp_level_info($userid);

        $data['wrote_post'] = $this->Wrote_model->get_wrote_post($userid,$start,$config['per_page']);
        $data['wrote_count'] = $this->Wrote_model->count_wrote_posts($userid);

        
  
        
        if ($this->input->is_ajax_request()) {
            $response = [
                'wrote_post' => $data['wrote_post'],
                'wrote_count' => $data['wrote_count'],
                'no_results' => empty($data['wrote_post']) ? "작성된 글이 없습니다" : ""
            ];
            echo json_encode($response);
            return; 
        }else {
            // HTML 뷰 로드
            $this->load->view('member/wrote_post_view', $data);
        }
    }

    public function wrote_comment(){
        $userid = $this->session->userdata('user_id'); 


        //페이지네이션 설정
        $config = array();
        $config['base_url'] = site_url('member/wrote/comment/');
        $config['first_url'] = site_url('member/wrote/comment/page/1');
        $config['total_rows'] = $this->Wrote_model->count_wrote_comment($userid); // 총 게시물수
        $config['per_page'] = 15; // 페이지당 게시물수
        $config['use_page_numbers'] = TRUE;
        $config['last_link'] = TRUE;
        $config['first_link'] = TRUE;
        $config['display_pages'] = TRUE;
        $config['num_links'] = 2;

        $config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="inline-flex -space-x-px text-sm">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = '첫페이지';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['first_url'] = ''; // 첫 페이지 URL 설정
        $config['last_link'] = '마지막페이지';

        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li><a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white');

        
        

        //초기화
        $this->pagination->initialize($config);

        //현재페이지 번호 계싼
        $page = $this->uri->segment(4) ? $this->uri->segment(4) : 1;


        //오프셋계산
        $start = ($page - 1) * $config['per_page'];


        // 페이지네이션 링크 생성
        $data['link'] = $this->pagination->create_links();

        // 사이드바 정보
        $data['post_count'] = $this->Post_model->count_wrote_posts_sidebar($userid);
        $data['comment_count'] = $this->Post_model->count_wrote_comments_sidebar($userid);
        $data['wrote_thumb_post_count'] = $this->Wrote_model->count_wrote_thumb_post($userid);
        $data['exp_level_info'] = $this->Post_model->get_exp_level_info($userid);

        $data['wrote_comment'] = $this->Wrote_model->get_wrote_comment($userid,$start,$config['per_page']);
        $data['wrote_comment_count'] = $this->Wrote_model->count_wrote_comment($userid);


        if ($this->input->is_ajax_request()) {
            $response = [
                'wrote_comment' => $data['wrote_comment'],
                'wrote_comment_count' => $data['wrote_comment_count'], 
                'no_results' => empty($data['wrote_comment']) ? "작성된 댓글이 없습니다" : ""
            ];
            echo json_encode($response);
            return; 
        }else {
            // HTML 뷰 로드
            $this->load->view('member/wrote_comment_view', $data);
        }
    }




    public function wrote_thumb_post(){

        $userid = $this->session->userdata('user_id'); 

        //페이지네이션 설정
        $config = array();
        $config['base_url'] = site_url('member/wrote/thumb_post/');
        $config['first_url'] = site_url('member/wrote/thumb_post/page/1');
        $config['total_rows'] = $this->Wrote_model->count_wrote_thumb_post($userid); // 총 게시물수
        $config['per_page'] = 15; // 페이지당 게시물수
        $config['use_page_numbers'] = TRUE;
        $config['last_link'] = TRUE;
        $config['first_link'] = TRUE;
        $config['display_pages'] = TRUE;
        $config['num_links'] = 2;

        $config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="inline-flex -space-x-px text-sm">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = '첫페이지';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['first_url'] = ''; // 첫 페이지 URL 설정
        $config['last_link'] = '마지막페이지';

        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li><a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white');

        
        
        //초기화
        $this->pagination->initialize($config);


        //현재페이지 번호 계싼
        $page = $this->uri->segment(4) ? $this->uri->segment(4) : 1;


        //오프셋계산
        $start = ($page - 1) * $config['per_page'];


        // 페이지네이션 링크 생성
        $data['link'] = $this->pagination->create_links();

        // 사이드바 정보
        $data['post_count'] = $this->Post_model->count_wrote_posts_sidebar($userid);
        $data['comment_count'] = $this->Post_model->count_wrote_comments_sidebar($userid);
        $data['wrote_thumb_post_count'] = $this->Wrote_model->count_wrote_thumb_post($userid);
        $data['exp_level_info'] = $this->Post_model->get_exp_level_info($userid);


        $data['wrote_thumb_post'] = $this->Wrote_model->get_wrote_thumb_post($userid,$start,$config['per_page']);
       
       
        $this->load->view('member/wrote_thumb_post_view', $data);
        
    }


    
    





}
