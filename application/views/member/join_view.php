<?php $this->load->view('layout/header'); ?>
<body class="">
<div class="hero min-h-screen bg-base-200 ">
<img src="/application/views/images/city.jpg" class="h-screen w-screen" alt="">
  <div class="hero-content flex-col lg:flex-row-reverse w-5/6">    
    
    <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-gray-700 ">

    
      

      <form id="join_form" class="card-body" method="post" action="<?php echo site_url('member/join'); ?>">
        <div class="form-control">
        <label class="label">
            <span class="label-text text-white">이름</span>        
          </label>
          <input type="name" name="username" id="username" placeholder="이름" class="input input-bordered bg-gray-600 text-white"  value="<?php echo set_value('username');?>" />  
          <span id="username_error" class="text-red-500 font-bold mt-1 ml-2 text-sm"><?php echo form_error('username'); ?></span>

          <label class="label">
            <span class="label-text text-white">아이디</span>        
            <span>
                <button title="아이디중복확인" id="check_login_id" class="btn btn-primary bg-blue-600 btn-xs text-xs text-white">중복확인</button>
                
            </span>
          </label>
          <input type="id" name="userid" id="userid" placeholder="아이디" class="input input-bordered bg-gray-600 text-white"  value="<?php echo set_value('userid');?>"  />
              <span id="userid_error" class="text-red-500 font-bold mt-1 ml-2 text-sm"><?php echo form_error('userid'); ?></span>
              <p id="useridStatus_success" class="text-green-500 text-right text-sm mt-0.5 mr-1 font-bold"></p>
              <p id="useridStatus_failed" class="text-red-500 text-right text-sm mt-0.5 mr-1 font-bold"></p>
              
              
            <label class="label">
            <span class="label-text text-white">이메일</span>
            <span>
            <button title="이메일 중복확인" id="checkEmail" class="btn btn-primary bg-blue-600 btn-xs text-xs text-white">중복확인</button>
            </span>
            </label>
              <input type="email" name="email" id="email" placeholder="qwer@gmail.com" class="input input-bordered bg-gray-600 text-white"  value="<?php echo set_value('email');?>"  />
              <span id="email_error" class="text-red-500 font-bold mt-1 ml-2 text-sm"><?php echo form_error('email'); ?></span>
              <p id="emailStatus_success" class="text-green-500 text-right text-sm mt-0.5 mr-1 font-bold"></p>
              <p id="emailStatus_failed" class="text-red-500 text-right text-sm mt-0.5 mr-1 font-bold"></p>
              

            <label class="label">
            <span class="label-text text-white">비밀번호</span>
            </label>
              <input type="password" name="password1" id="password1" placeholder="비밀번호를 입력해주세요." class="input input-bordered bg-gray-600 text-white"  value="<?php echo set_value('password1'); ?>" />
              <span id="password1_error"class="text-red-500 font-bold mt-1 ml-2 text-sm"><?php echo form_error('password1'); ?></span>

              <label class="label">
            <span class="label-text text-white">비밀번호확인</span>
            </label>
              <input type="password" name="password2" id="password2" placeholder="비밀번호를 입력해주세요." class="input input-bordered bg-gray-600 text-white"  />
              <span id="password2_error" class="text-red-500 font-bold mt-1 ml-2 text-sm"><?php echo form_error('password2'); ?></span>
        </div>
        
        
        <div class="form-control mt-6">
          <button type="submit" id="join" class="btn btn-primary bg-blue-600">회원가입</button>
        </div>
      </form>
    </div>
    <div class="text-center lg:text-left text-white">
      
      <h1 class="text-6xl font-bold">Welcome Cafe Masigo!</h1>
      <p class="py-6">Provident qwer voluptatem et in. Quaerat qwer ut assumenda excepturi exercitationem quasi. In deleniti eaque aut repudiandae et a id nisi. 
      Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem quasi. In deleniti eaque aut repudiandae et a id nisi.
      zzzzzzzz
      </p>
    </div>
  </div>
</div>
</body>

<script>
 
$(document).ready(function(){

             // 중복 확인 플래그
            var isUserIdAvailable = false;
            var isEmailAvailable = false;

            // 아이디 , 이메일 중복확인 버튼을클릭 하여 "사용가능" , "사용불가능" 체크
            // input 데이터랑  db 에 있는 데이터랑 일치한다면 " 사용 불가능 "
            // input 데이터랑  db 에 있는 데이터랑 일치하지않는다면 " 사용 가능 "


             // 아이디 중복확인
              $('#check_login_id').click(function(e) {
                e.preventDefault();
                  var userid = $('#userid').val();
                  if(userid) {
                      $.ajax({
                          url: '/member/join/checkUserId', // Controller 경로를 확인하세요.
                          type: 'POST',
                          data: {'userid': userid},
                          dataType: 'json',
                          success: function(response) {
                            
                              if(response.status === 'unavailable') {
                                  $('#useridStatus_failed').text('사용 불가능');
                                  $('#useridStatus_success').text('');
                                  isUserIdAvailable = false;
                              } else {
                                  $('#useridStatus_success').text('사용 가능');
                                  $('#useridStatus_failed').text('');
                                  isUserIdAvailable = true;
                              }
                              
                          },
                          
                      });
                  }
              });


              // 이메일 중복확인
              $('#checkEmail').click(function(e) {
                  e.preventDefault();
                  var email = $('#email').val();
                  if(email) {
                      $.ajax({
                          url: 'member/join/checkEmail', // Controller 경로를 확인하세요.
                          type: 'POST',
                          data: {'email': email},
                          dataType: 'json',
                          success: function(response) {
                              if(response.status === 'unavailable') {
                                  $('#emailStatus_failed').text('사용 불가능');
                                  $('#emailStatus_success').text('');
                                  isEmailAvailable = false;
                              } else {
                                  $('#emailStatus_success').text('사용 가능');
                                  $('#emailStatus_failed').text('');
                                  isEmailAvailable = true;
                              }
                          }
                      });
                  }
              });

            function isValidEmail(email) {
            var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return pattern.test(email);
            }


        $('#join_form').on('submit', function(e) {

          e.preventDefault(); // 기본 이벤트를 중지

          // 사용자 ID 입력 필드에 입력이 있을 때마다 상태 메시지를 초기화

          $("#username").on('input', function() {
          $("#username_error").text("");
          });
          $("#userid").on('input', function() {
          $("#userid_error").text("");
          });
          $("#email").on('input', function() {
          $("#email_error").text("");
          });
          $("#password1").on('input', function() {
          $("#password1_error").text("");
          });
          $("#password2").on('input', function() {
          $("#password2_error").text("");
          });


          // 클라이언트 측 유효성 검사
          var username = $('#username').val();
          var userid = $('#userid').val();
          var email = $('#email').val();
          var password1 = $('#password1').val();
          var password2 = $('#password2').val();
          var isValid = true; // 유효성 검사 플래그



          // 아이디가 비어있지 않고 알파벳 소문자 및 숫자로만 구성되었는지 확인
          if (!userid || !userid.match(/^[a-z0-9]+$/)) {
              isValid = false;
              $('#userid_error').text('아이디는 영어 소문자와 숫자로만 작성해주세요.');
          }else{
            isValid = true;
          }

          // 이메일 형식이 유효한지 확인
          if (!isValidEmail(email)) {
              isValid = false;
              $('#email_error').text('유효한 이메일 주소를 입력해주세요.');
          }

          // 이름이 비어있는지
          if (username == ""){
            isValid = false;
              $('#username_error').text('작성필수');
          }else{
            isValid = true;
          }
          // 아이디가 비어있는지
          if (userid == ""){
            isValid = false;
              $('#userid_error').text('작성필수');
          }
          // 이메일이 비어있는지
          if (email == ""){
            isValid = false;
              $('#email_error').text('작성필수');
          }
          // 비밀번호가 비어있는지
          if (password1 == ""){
            isValid = false;
              $('#password1_error').text('작성필수');
          }
          // 비밀번호2가 비어있는지
          if (password2 == ""){
            isValid = false;
              $('#password2_error').text('작성필수');
          }

          // 비밀번호와 비밀번호 확인이 일치하는지 확인
          if (password1 !== password2) {
              isValid = false;
              $('#password2_error').text('비밀번호가 일치하지 않습니다.');
          }


           

            // 중복 확인을 하지 않았거나 중복 확인에서 사용 불가능한 경우
          if (!isUserIdAvailable || !isEmailAvailable) {

            e.preventDefault();

            if (!isUserIdAvailable) {
                $('#userid_error').text('아이디 중복 확인을 해주세요.');
            }
            if (!isEmailAvailable) {
                $('#email_error').text('이메일 중복 확인을 해주세요.');
            }
            return false; 
            }
            // 중복 확인이 모두 성공했다면 폼 제출을 계속합니다.
           
                


          // 모든 유효성 검사를 통과했을 때만 서버에 요청
          if (isValid) {
              $.ajax({
                  type: 'POST',
                  url: 'member/Join',
                  data: $(this).serialize(),
                  dataType: 'json',
                  success: function(response) {

                  if(response.success) {
                      // 성공적으로 처리되었을 때의 로직
                      alert('회원가입이 완료되었습니다. 로그인페이지에서 로그인을 해주세요.');
                      window.location.href = '/login'; // 로그인 페이지로 리다이렉트
                  } else {
                      // 오류 메시지를 각 필드 아래에 표시
                      for(var key in response.errors) {
                          $('#' + key).addClass('is-invalid'); // 부트스트랩의 유효하지 않은 입력 표시
                          $('#' + key + '_error').text(response.errors[key]); // 오류 메시지 표시
                      }
                  }
                  }
              });
          }
          });


})


</script>


