<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Find_id extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('member/Find_id_model');
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
    } 
    public function index() {
        $this->form_validation->set_rules('username', '이름', 'required', array('required' => '이름을 입력해주세요.'));
        $this->form_validation->set_rules('email', '이메일', 'required|valid_email',array('required' => '이메일을 입력해주세요.'));
        $this->form_validation->set_error_delimiters('<div class="ml-1 mb-1 text-red-500">', '</div>');
    
        $data = [];

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('member/findByid_view');
        }else{
        
            if($this->input->post()){
                $username = $this->input->post('username');
                $email = $this->input->post('email');
        
                $findId = $this->Find_id_model->findById($username, $email);
                
                if ($findId) {
                    $data['findId'] = $findId;
                } else {
                    $data['error_message'] = "입력하신 이름과 이메일에 해당하는 아이디가 없습니다.";
                }
            }
    
            $this->load->view('member/findByid_view', $data);
        }
    }


}
?>
