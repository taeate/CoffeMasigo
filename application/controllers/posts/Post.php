<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('posts/Post_model');
        $this->load->model('posts/Write_model');
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session'); // 세션 라이브러리 로드
        $this->load->library('pagination'); // 페이지네이션 로드

    }
    
    public function index() {

        //페이지네이션 설정
        $config = array();
        $config['base_url'] = site_url('posts/all/page/');
        $config['first_url'] = site_url('posts/all/page/1');
        $config['total_rows'] = $this->Post_model->count_posts(); // 총 게시물수
        $config['per_page'] = 20; // 페이지당 게시물수
        $config['num_links'] = FALSE;
        $config['use_page_numbers'] = TRUE;
        $config['prev_link'] = '<button class="bg-gray-600 text-white w-20 h-10 rounded-lg mr-2">이전</button>';
        $config['next_link'] = '<button class="bg-gray-600 text-white w-20 h-10 rounded-lg ml-2">다음</button>';
        $config['last_link'] = FALSE;
        $config['first_link'] = FALSE;
        $config['display_pages'] = FALSE;
        

        //초기화
        $this->pagination->initialize($config);

        //현재페이지 번호 계싼
        $page = $this->uri->segment(4) ? $this->uri->segment(4) : 1;


        //오프셋계산
        $start = ($page - 1) * $config['per_page'];

    
    
        //게시물 목록 가져오기      
        $data['get_list'] = $this->Post_model->get_posts($start,$config['per_page']);


        foreach ($data['get_list'] as $post) {
            $post->comment_count = $this->Post_model->count_comment($post->post_id);
            $post->replies = $this->Post_model->get_reply_to_post_count($post->post_id);
            $post->thumb = $this->Post_model->count_thumb($post->post_id);
        }
 

         // 페이지네이션 링크 생성
        $data['link'] = $this->pagination->create_links();

        $data['get_answer_list'] = $this->Post_model->get_answer_posts();


        if ($this->input->is_ajax_request()) {
  
            $response = [
                'posts' => $data['get_list'],
                'paginationLinks' => $this->pagination->create_links()
            ];
    
            echo json_encode($response);

        } else {
         
            $this->load->view('posts/post_list_view', $data);
        }
    
    
    }
    

    public function detail($post_id) {
        
        $data = array();
    
        if (!empty($post_id)) {

            // 댓글수
            $data['comments_count'] = $this->Post_model->count_comment($post_id);

            $data['count_thumb'] = $this->Post_model->count_thumb($post_id);

            // 게시물 세부 정보 가져오기
            $detail_info  = $this->Post_model->find_detail($post_id);
            
            // 조회수 증가
            $this->Post_model->increment_views($post_id);

            if ($detail_info) {

                $data['detail_info'] = $detail_info;


            } else {
                echo "찾지 못함";
                return; 
            }
    
            // 댓글 정보 가져오기
            $comments = $this->Post_model->get_comment($post_id);
            $data['comment_info'] = $comments;
        }
        
        
        // 댓글 저장
        if ($this->input->post()) {

            $comment_content = $this->input->post('comment');
            $user_id = $this->session->userdata('user_id');
            $parent_comment_id = $this->input->post('parent_comment_id'); // 대댓글 ID를 받음


            // 대댓글 id 가 있으면 대댓글로 , 없으면 일반 댓글로
            if (!empty($parent_comment_id)) {
                $this->Post_model->create_comment($parent_comment_id, $post_id, $comment_content, $user_id);
            } else {
                $this->Post_model->create_comment(NULL, $post_id, $comment_content, $user_id); // NULL을 첫 번째 인자로 전달
            }
    
            // 페이지 새로고침 또는 리디렉트
            redirect('posts/free/'.$post_id); // 상세 페이지로 리디렉트하여 새 댓글 표시
        }

        // 작성자 확인

        $author_id = $this->Write_model->get_post_author_id($post_id);
        $data['author_id'] = $author_id;
    
    
        // 최종적으로 단일 뷰 로드
        $this->load->view('posts/post_detail_view', $data);
    }
    


    public function search() {

         // URL 매개변수에서 검색어와 검색 대상 가져오기
         $search_info = $this->input->get('search');
         $page = $this->input->get('page') ? $this->input->get('page') : 1;
         

         //페이지네이션 설정
         $config = array();
         $config['base_url'] = site_url('posts/search?search=' . $search_info);
         $config['first_url'] = site_url('posts/search?search='. $search_info);
         $config['total_rows'] = $this->Post_model->count_posts($search_info); // 총 게시물수
         $config['per_page'] = 30; // 페이지당 게시물수
         $config['num_links'] = FALSE;
         $config['use_page_numbers'] = TRUE;
         $config['prev_link'] = '<button class="bg-gray-600 text-white w-20 h-10 rounded-lg mr-2">이전</button>';
         $config['next_link'] = '<button class="bg-gray-600 text-white w-20 h-10 rounded-lg ml-2">다음</button>';
         $config['last_link'] = FALSE;
         $config['first_link'] = FALSE;
         $config['display_pages'] = FALSE;
         
         $config['page_query_string'] = TRUE;
         $config['query_string_segment'] = 'page';
         
 
         //초기화
         $this->pagination->initialize($config);
 
         
         //현재페이지 번호 계싼
         $page = $this->input->get('page') ? $this->input->get('page') : 1;
 
 
         //오프셋계산
         $start = ($page - 1) * $config['per_page'];

        

        // $search_target = $this->input->get('search_target');

        
        
         // 페이지네이션 링크 없음
        $data['link'] = $this->pagination->create_links();
        

        // 검색 결과 가져오기
        $data['search_data'] = $this->Post_model->search($search_info, $start, $config['per_page']);


        if (empty($data['search_data'])) {
            $data['no_results'] = "검색결과가 없습니다";
        }

         // 검색 결과가 없으면 빈 배열로 초기화
        $data['get_list'] = array();
    
        $this->load->view('posts/post_list_view', $data);
    }



    public function get_replies() {
        $post_id = $this->input->get('post_id');
        $replies = $this->Post_model->get_reply_to_post($post_id);
        echo json_encode([ 'status' => TRUE, 'data' =>$replies]);
    }

    public function thumbUp(){
        
        $user_id = $this->session->userdata('user_id');

        if (!$user_id) {
            // 비회원일 경우 로그인 페이지로 리디렉션하기 전에 메시지 설정
            $this->session->set_flashdata('message', '로그인 후 이용 가능합니다.');
            redirect('/');
        }

        $post_id = $this->input->post('postId');
        $user_id = $this->session->userdata('user_id');

        if(!$this->Post_model->hasUserAlreadyThumb($post_id, $user_id)){
            
            // 사용자가 추천안했다면 증가
            $this->Post_model->incrementThumb($post_id);

            // 추천 기록추가
            $this->Post_model->addThumbRecord($post_id, $user_id);

            echo json_encode(array('status' => 'success'));
        }else{

            echo json_encode(array('status' => 'already_thumbed'));
        }

    }


    public function LatestOrderBy(){
        
         //페이지네이션 설정
         $config = array();
         $config['base_url'] = site_url('posts/all/newest/page/');
         $config['first_url'] = site_url('posts/all/newest/page/1');    
         $config['total_rows'] = $this->Post_model->count_posts_ordered_by_latest(); // 총 게시물수
         $config['per_page'] = 20; // 페이지당 게시물수
         $config['num_links'] = FALSE;
         $config['use_page_numbers'] = TRUE;
         $config['prev_link'] = '<button class="bg-gray-600 text-white w-20 h-10 rounded-lg mr-2">이전</button>';
         $config['next_link'] = '<button class="bg-gray-600 text-white w-20 h-10 rounded-lg ml-2">다음</button>';
         $config['last_link'] = FALSE;
         $config['first_link'] = FALSE;
         $config['display_pages'] = FALSE;
         
 
         //초기화
         $this->pagination->initialize($config);
 
         //현재페이지 번호 계싼
         $page = $this->uri->segment(5) ? $this->uri->segment(5) : 1;
 
 
         //오프셋계산
         $start = ($page - 1) * $config['per_page'];
 
 
          // 페이지네이션 링크 생성
         $data['link'] = $this->pagination->create_links();
        

        $data['get_list'] = $this->Post_model->get_posts_ordered_by_latest($start,$config['per_page']);
        
        foreach ($data['get_list'] as &$post) {
        $post->comment_count = $this->Post_model->count_comment($post->post_id);
        $post->replies = $this->Post_model->get_reply_to_post_count($post->post_id);
    }

        if ($this->input->is_ajax_request()) {
    
            $response = [
                'posts' => $data['get_list'],
                'paginationLinks' => $this->pagination->create_links()
            ];

            echo json_encode($response);

        } 
    }


    public function ThumbOrderBy(){

         //페이지네이션 설정
         $config = array();
         $config['base_url'] = site_url('posts/all/thumb/page/');
         $config['first_url'] = site_url('posts/all/thumb/page/1');    
         $config['total_rows'] = $this->Post_model->count_posts_ordered_by_thumb(); // 총 게시물수
         $config['per_page'] = 20; // 페이지당 게시물수
         $config['num_links'] = FALSE;
         $config['use_page_numbers'] = TRUE;
         $config['prev_link'] = '<button class="bg-gray-600 text-white w-20 h-10 rounded-lg mr-2">이전</button>';
         $config['next_link'] = '<button class="bg-gray-600 text-white w-20 h-10 rounded-lg ml-2">다음</button>';
         $config['last_link'] = FALSE;
         $config['first_link'] = FALSE;
         $config['display_pages'] = FALSE;
         
 
         //초기화
         $this->pagination->initialize($config);
 
         //현재페이지 번호 계싼
         $page = $this->uri->segment(5) ? $this->uri->segment(5) : 1;
 
 
         //오프셋계산
         $start = ($page - 1) * $config['per_page'];
 
 
          // 페이지네이션 링크 생성
         $data['link'] = $this->pagination->create_links();
        


        $data['get_list'] = $this->Post_model->get_posts_ordered_by_thumb($start,$config['per_page']);
        
        foreach ($data['get_list'] as &$post) {
        $post->comment_count = $this->Post_model->count_comment($post->post_id);
        $post->replies = $this->Post_model->get_reply_to_post_count($post->post_id);
    }
    
        if ($this->input->is_ajax_request()) {
    
        $response = [
            'posts' => $data['get_list'],
            'paginationLinks' => $this->pagination->create_links()
        ];

        echo json_encode($response);

    } 
        
        
    }

    public function ViewsOrderBy(){

         //페이지네이션 설정
         $config = array();
         $config['base_url'] = site_url('posts/all/views/page/');
         $config['first_url'] = site_url('posts/all/views/page/1');    
         $config['total_rows'] = $this->Post_model->count_posts_ordered_by_views(); // 총 게시물수
         $config['per_page'] = 20; // 페이지당 게시물수
         $config['num_links'] = FALSE;
         $config['use_page_numbers'] = TRUE;
         $config['prev_link'] = '<button class="bg-gray-600 text-white w-20 h-10 rounded-lg mr-2">이전</button>';
         $config['next_link'] = '<button class="bg-gray-600 text-white w-20 h-10 rounded-lg ml-2">다음</button>';
         $config['last_link'] = FALSE;
         $config['first_link'] = FALSE;
         $config['display_pages'] = FALSE;
         
 
         //초기화
         $this->pagination->initialize($config);
 
         //현재페이지 번호 계싼
         $page = $this->uri->segment(5) ? $this->uri->segment(5) : 1;
 
 
         //오프셋계산
         $start = ($page - 1) * $config['per_page'];
 
 
          // 페이지네이션 링크 생성
         $data['link'] = $this->pagination->create_links();


        $data['get_list'] = $this->Post_model->get_posts_ordered_by_views($start,$config['per_page']);
        
        
        foreach ($data['get_list'] as &$post) {
        $post->comment_count = $this->Post_model->count_comment($post->post_id);
        $post->replies = $this->Post_model->get_reply_to_post_count($post->post_id);
    }

        if ($this->input->is_ajax_request()) {
        
            $response = [
                'posts' => $data['get_list'],
                'paginationLinks' => $this->pagination->create_links()
            ];

            echo json_encode($response);
            
        }
    }

    
    public function is_notice_hidden() {


        $data['get_list'] = $this->Post_model->get_posts_not_notice();

        foreach ($data['get_list'] as &$post) {
            $post->comment_count = $this->Post_model->count_comment($post->post_id);
            $post->replies = $this->Post_model->get_reply_to_post_count($post->post_id);
        }
        echo json_encode($data);
    }


    public function get_posts_json() {
  
    
        $data['get_list'] = $this->Post_model->get_posts();

        foreach ($data['get_list'] as &$post) {
            $post->comment_count = $this->Post_model->count_comment($post->post_id);
            $post->replies = $this->Post_model->get_reply_to_post_count($post->post_id);
        }

        echo json_encode($data);
    }


    public function comment_orderBy_create() {

        $post_id = $this->input->post('post_id');
        $order = $this->input->post('order'); // 'ASC' 또는 'DESC'
    
        $result = $this->Post_model->comment_orderby_created($post_id, $order);
    
        // 결과를 JSON 형식으로 출력
        echo json_encode($result);

 
    }
    
}
?>