<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('member/Login_model');
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
    } 


	public function index()
	{
		if ($this->session->userdata('is_logged_in')) {
            redirect('/posts'); 
        }
		$this->load->view('member/login_view');
	}
}
