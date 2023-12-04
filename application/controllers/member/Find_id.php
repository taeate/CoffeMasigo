<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Find_id extends CI_Controller {
    public function __construct(){
        parent::__construct();
        // $this->load->model('member/Find_id_model');
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
    } 
    public function index() {

        
        $this->form_validation->set_rules('username', '이름', 'required', array('required' => '이름을 입력해주세요.'));
        $this->form_validation->set_rules('email', '이메일', 'required|valid_email|callback_checkEmail');
        $this->form_validation->set_error_delimiters('<div class="ml-1 mb-1 text-red-500">', '</div>');

        if($this->input->post()){
            $username = $this->input->post('username');
            $email = $this->input->post('email');

             
            $findId = $this->Find_id_model->findById($username,$email);
          
        }


        $this->load->view('member/findByid_view');


	
}

public function checkEmail() {

    $email = $this->input->post('email');
    $result = $this->Find_id_model->get_email($email);
    $response = ["status" => "available"];

    if (!empty($result)){
        if($this->input->is_ajax_request()){
            $response = ["status"=> "unavailable"];
            $this->output->set_content_type("application/json")
                        ->set_output(json_encode($response));
        } else {
            $this->form_validation->set_message("checkEmail", "이미 사용중인 이메일 입니다.");
            return FALSE;
        }

    } else {
        if ($this->input->is_ajax_request()) {
            // AJAX 요청에 대해서는 JSON 응답을 반환합니다.
            $this->output->set_content_type('application/json')
                         ->set_output(json_encode($response));
        }
        // AJAX 요청이 아니면, 여기서는 아무것도 반환하지 않습니다.
    }
    
}
}
?>
