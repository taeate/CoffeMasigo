<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Join extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('member/Join_model');
        $this->load->database();
        $this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');

    }

	public function index(){

		$this->form_validation->set_rules(
			'username', 
			'이름', 
			'required|regex_match[/^[가-힣]+$/]', 
			array(
				'required' => '이름을 입력해주세요.',
				'regex_match' => '한글만 입력 가능합니다.'
			)
		);

		$this->form_validation->set_rules('userid', '아이디', 'required|alpha_numeric|max_length[12]|callback_checkUserId');

		 
		 $this->form_validation->set_rules(
			'password1', 
			'비밀번호', 
			'required|min_length[4]|regex_match[/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/]', 
			array(
				'required' => '비밀번호를 입력해주세요.',
				'min_length' => '비밀번호는 최소 4자 이상이어야 합니다.',
				'regex_match' => '비밀번호는 영문과 숫자를 조합하여야 합니다.'
			)
		);
	
		// 비밀번호 확인 유효성 검증
		$this->form_validation->set_rules(
			'password2', 
			'비밀번호 확인', 
			'required|matches[password1]',
			array(
				'required' => '비밀번호 확인을 입력해주세요.',
				'matches' => '비밀번호가 일치하지 않습니다.'
			)
		);
		

		$this->form_validation->set_rules('email', '이메일', 'required|valid_email|callback_checkEmail');

		$this->form_validation->set_rules(
            'intro', 
            '소개글', 
            'required|max_length[30]', 
            array(
                'required' => '내용을 입력해주세요.',
                'max_length' => '변경할 소개글 내용은 최대 30자 이하로 작성해주세요.',
            )
        );
		



			if ($this->form_validation->run() === FALSE) {
			
				$this->load->view('member/join_view');
			}
			else {
				// 검증성공

				$config['upload_path'] = __DIR__ . '../../../../uploads';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2048; // 최대 2MB
				$config['encrypt_name'] = TRUE; // 파일 이름 암호화

				$this->load->library('upload', $config);

				if (!isset($_FILES['profile_image']['name']) || $_FILES['profile_image']['name'] == '') {
					// 사용자가 파일을 업로드하지 않은 경우, 기본 이미지 경로 설정
					$profile_image_path = 'profile.PNG';
				} else {
					// 사용자가 파일을 업로드한 경우, 파일 업로드 처리
					if (!$this->upload->do_upload('profile_image')) {
						// 파일 업로드에 실패한 경우, 에러 처리 또는 기본 이미지 설정
						$profile_image_path = 'profile.PNG';
					} else {
						// 파일 업로드 성공, 업로드된 파일 경로 설정
						$upload_data = $this->upload->data();
						$profile_image_path = $upload_data['file_name'];
					}
				}


				// 비밀번호 해싱
				$password = $this->input->post('password1');
				$hashed_password = password_hash($password, PASSWORD_BCRYPT);

		

				//데이터베이스에 저장
				$data = [
					'username' => $this->input->post('username'),
					'user_id' => $this->input->post('userid'),
					'email' => $this->input->post('email'),
					'password_hash' => $hashed_password,
					'profile_image' => $profile_image_path,
					'introduction' => $this->input->post('intro'),
				];

				

				$this->Join_model->create_user($data);

				$this->output
				->set_content_type('application/json')
				->set_output(json_encode(['success' => TRUE]));

				
			}

		
		}
	

	public function check_korean($str) {
		if (!preg_match("/^[가-힣]+$/", $str)) {
			$this->form_validation->set_message('check_korean', '{field}은 한글만 가능합니다.');
			return FALSE;
		}
		return TRUE;
	}

	public function checkUserId() {

		$userid = $this->input->post('userid');
		$result = $this->Join_model->get_user_id($userid);
		$response = ["status" => "available"]; // 변수 초기화
	
		if (!empty($result)){
			if ($this->input->is_ajax_request()) {
				// AJAX 요청에 대해서는 JSON 응답을 반환
				$response = ["status" => "unavailable"];
				$this->output->set_content_type('application/json')
							 ->set_output(json_encode($response));
			} else {
				// AJAX 요청이 아닌 경우에는 폼 검증 메시지를 설정
				$this->form_validation->set_message('checkUserId', '이미 사용중인 아이디 입니다.');
				return FALSE; // 폼 검증 실패
			}
		} else {
			if ($this->input->is_ajax_request()) {
				// AJAX 요청에 대해서는 JSON 응답을 반환
				$this->output->set_content_type('application/json')
							 ->set_output(json_encode($response));
			}
			// AJAX 요청이 아니면, 여기서는 아무것도 반환하지 않는다.
		}
	}
	
	public function checkEmail() {

		$email = $this->input->post('email');
		$result = $this->Join_model->get_email($email);
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

	


	
