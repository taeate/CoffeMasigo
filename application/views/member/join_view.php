<?php $this->load->view('layout/header'); ?>
<body class="">
<div class="hero min-h-screen bg-base-200 ">
  
<img src="/application/views/images/car.jpg" class="h-screen w-screen" alt="">
  <div class="hero-content flex-col lg:flex-row-reverse w-5/6">    
 
    <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-gray-700 ">
  

      <form id="join_form" class="card-body" method="post" action="<?php echo site_url('member/join'); ?>" enctype="multipart/form-data">
        <div class="form-control">
        <div class="flex flex-col items-center justify-center mt-2 mb-4">
          <span class="text-white">프로필이미지</span>
          
        </div>
        <div class="flex flex-col avatar justify-center items-center group">
          <label for="file-upload" class="btn btn-ghost btn-circle w-28 h-28 rounded-full ring ring-offset-base-100 ring-offset-2 hover:bg-gray-500" style="display: flex; justify-content: center; align-items: center; cursor: pointer;">
          
            <div class="w-full h-full rounded-full overflow-hidden">
              
              <img id="image-preview" src="" alt="미리보기 이미지" class="w-full h-full object-cover" style="display: none;">
              
            </div>
            
            
            <input id="file-upload" type="file" name="profile_image" style="display: none;" onchange="previewImage(this)">
          </label>
          <span class="text-white text-xs mt-4 mb-4">프로필을 설정하지 않으면 기본 이미지로 대체됩니다.</span>
        </div>

      


          <label class="label">
            <span class="label-text text-white">이름</span>        
          </label>
          <input type="name" name="username" id="username" placeholder="이름" class="input input-bordered bg-gray-600 text-white"  value="<?php echo set_value('username');?>" />  
          <span id="username_error" class="text-red-500 font-bold mt-1 ml-2 text-sm"><?php echo form_error('username'); ?></span>

         <div class="flex justify-between">
          <label class="label">
              <span class="label-text text-white">아이디</span>  
            </label>      
            <span class="flex items-center">
                <button title="아이디중복확인" id="check_login_id" class="btn btn-primary bg-blue-600 btn-xs text-xs text-white">중복확인</button>             
            </span>
         </div>

          <input type="id" name="userid" id="userid" placeholder="아이디" class="input input-bordered bg-gray-600 text-white"  value="<?php echo set_value('userid');?>"  />
              <span id="userid_error" class="text-red-500 font-bold mt-1 ml-2 text-sm"><?php echo form_error('userid'); ?></span>
              <p id="useridStatus_success" class="text-green-500 text-right text-sm mt-0.5 mr-1 font-bold"></p>
              <p id="useridStatus_failed" class="text-red-500 text-right text-sm mt-0.5 mr-1 font-bold"></p>
              
              
              <div class="flex justify-between">
              <label class="label">
              <span class="label-text text-white">이메일</span>
              </label>
              <span class="flex items-center">      
              <button title="이메일 중복확인" id="checkEmail" class="btn btn-primary bg-blue-600 btn-xs text-xs text-white">중복확인</button>
              </span>
              </div>
         
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

              <label class="label">
              <span class="label-text text-white">소개글</span>
              </label>
              <input type="text" name="intro" id="intro" placeholder="소개글을 작성해주세요." class="input input-bordered bg-gray-600 text-white"  />
              <span id="intro_error" class="text-red-500 font-bold mt-1 ml-2 text-sm"><?php echo form_error('intro'); ?></span>
        </div>
        
        
        <div class="form-control mt-6">
          <button type="submit" id="join" class="btn btn-primary bg-blue-600">회원가입</button>
        </div>
      </form>
    </div>
    <div class="text-center lg:text-left text-white">
      
      <h1 class="text-6xl font-bold">Welcome Ford Mustang!</h1>
      <p class="py-6">The Ford Mustang, an American icon and a symbol of automotive freedom, debuted in 1964
                  and revolutionized the muscle car industry with its captivating blend of power, style, and
                  performance. With a heritage rooted in American culture, it has become a ontinues to captivate with
                  its unique combination of performance, style, and legacy.

      </p>
    </div>
  </div>
</div>
</body>

<script>

function previewImage(input) {
    const preview = document.getElementById('image-preview');
    if (input.files && input.files[0]) {
      const reader = new FileReader();

      reader.onload = function(e) {
        preview.style.display = 'block';
        preview.src = e.target.result;
      };

      reader.readAsDataURL(input.files[0]);
    }
  }
 
$(document).ready(function(){

             // 중복 확인 플래그
            var isUserIdAvailable = false;
            var isEmailAvailable = false;

            // 아이디 , 이메일 중복확인 버튼을클릭 하여 "사용가능" , "사용불가능" 체크
            // input 데이터랑  db 에 있는 데이터랑 일치한다면 " 사용 불가능 "
            // input 데이터랑  db 에 있는 데이터랑 일치하지않는다면 " 사용 가능 "

            // 이름 입력 필드에 대한 실시간 유효성 검사
            $('#username').on('input', function() {
                var username = $(this).val();
                var usernamePattern = /^[가-힣]+$/;

                var usernameError = $('#username_error');

                if (usernamePattern.test(username)) {
                    // 입력된 값이 정규식과 일치하면 오류 메시지를 지우고 유효성 플래그를 true로 설정
                    usernameError.text('');
                } else {
                    // 입력된 값이 정규식과 일치하지 않으면 오류 메시지를 표시하고 유효성 플래그를 false로 설정
                    $('#useridStatus_failed').text('');
                    usernameError.text('한글만 입력 가능합니다.');
                }
            });

            // 아이디 입력 필드에 대한 실시간 유효성 검사
            $('#userid').on('input', function() {
                var userid = $(this).val();
                var useridPattern = /^[a-z0-9]{4,12}$/; // 영어 소문자와 숫자만 허용하며, 최소 4자, 최대 12자
                var useridError = $('#userid_error');

                if (userid === '') {
                    // 아이디 필드가 비어있을 때
                    $('#useridStatus_failed').text('');
                    $('#useridStatus_success').text('');
                    useridError.text('작성필수');
                    isUserIdAvailable = false;
                } else if (!useridPattern.test(userid)) {
                    // 아이디 패턴과 일치하지 않을 때
                    if(userid.length < 4) {
                      $('#useridStatus_failed').text('');
                        useridError.text('아이디는 최소 4글자 이상이어야 합니다.');
                    } else if(userid.length > 12) {
                      $('#useridStatus_failed').text('');
                        useridError.text('아이디는 최대 12글자를 초과할 수 없습니다.');
                    } else {
                      $('#useridStatus_failed').text('');
                        useridError.text('아이디는 영어 소문자와 숫자로만 작성해주세요.');
                    }
                    isUserIdAvailable = false;
                } else {
                    // 유효한 아이디일 때
                    useridError.text('');
                    isUserIdAvailable = false;
                }
            });

            // 이메일 입력 필드에 대한 실시간 유효성 검사
            $('#email').on('input', function() {
                var email = $(this).val();
                var emailPattern = /^[a-zA-Z0-9._]+@(?!-)[a-zA-Z0-9.-]+(?<!-)\.[a-zA-Z]{2,}$/;
                var emailError = $('#email_error');

                if (emailPattern.test(email)) {
                    // 이메일 형식이 유효하면 오류 메시지를 지우고
                    emailError.text('');
                } else if(email === ''){
                  $('#emailStatus_success').text('');
                    $('#emailStatus_failed').text('');
                    emailError.text('작성필수');
                }else {
                    // 이메일 형식이 유효하지 않으면 오류 메시지를 표시
                    $('#emailStatus_success').text('');
                    $('#emailStatus_failed').text('');
                    emailError.text('유효한 이메일 주소를 입력해주세요.');
                }
                // 이메일이 변경되었으므로 중복 확인을 다시 해야 함
                isEmailAvailable = false;
            });


             // 비밀번호 입력 필드에 대한 실시간 유효성 검사
            $('#password1').on('input', function() {
                var password = $(this).val();
                var passwordPattern = /^(?=.*[a-zA-Z])(?=.*[0-9]).{4,}$/; // 최소 4자, 영문과 숫자 포함
                var passwordError = $('#password1_error');

                if (!passwordPattern.test(password)) {
                    // 비밀번호 패턴과 일치하지 않을 때
                    passwordError.text('비밀번호는 최소 4자 이상이며, 영문과 숫자를 모두 포함해야 합니다.');
                } else {
                    // 유효한 비밀번호일 때
                    passwordError.text('');
                }
            });

            // 비밀번호 확인 입력 필드에 대한 실시간 유효성 검사
            $('#password2').on('input', function() {
                var password = $('#password1').val();
                var confirmPassword = $(this).val();
                var confirmPasswordError = $('#password2_error');

                if (password !== confirmPassword) {
                    // 비밀번호와 비밀번호 확인이 일치하지 않을 때
                    confirmPasswordError.text('비밀번호가 일치하지 않습니다.');
                } else {
                    // 비밀번호가 일치할 때
                    confirmPasswordError.text('');
                }
            });


             // 소개글 입력 필드에 대한 실시간 유효성 검사
             $('#intro').on('input', function() {
                var intro = $(this).val();
                var introPattern = /^.{1,30}$/;
                var introError = $('#intro_error');

                if (introPattern.test(intro)) {
                    // 입력된 값이 정규식과 일치하면 오류 메시지를 지우고 유효성 플래그를 true로 설정
                    introError.text('');
                } else if(intro === ""){
                    introError.text('내용을 입력해주세요.');
                }
                else {
                    // 입력된 값이 정규식과 일치하지 않으면 오류 메시지를 표시하고 유효성 플래그를 false로 설정
                    introError.text('소개글 내용은 최대 30자 이하로 작성해주세요.');
                }
            });


             // 아이디 중복확인
             $('#check_login_id').click(function(e) {
                e.preventDefault();
                  var userid = $('#userid').val();
                  var useridPattern = /^[a-z0-9]{4,}$/; // 영어 소문자와 숫자만 허용하며, 최소 4글자 이상

                  // 중복 확인 버튼을 눌렀을 때 에러 메시지 초기화
                  $('#userid_error').text('');

                  if(useridPattern.test(userid)) {
                      $.ajax({
                          url: '/member/join/checkUserId', 
                          type: 'POST',
                          data: {'userid': userid},
                          dataType: 'json',
                          success: function(response) {
                            
                              if(response.status === 'unavailable' ) {
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
                  } else {
                    // 형식이 올바르지 않은 경우
                    $('#useridStatus_failed').text('아이디는 영어 소문자와 숫자로만 작성해주세요. 최소 4글자 이상이어야 합니다.');
                    $('#useridStatus_success').text('');
                    isUserIdAvailable = false;
                  }
              });


              // 이메일 중복확인
              $('#checkEmail').click(function(e) {
                      e.preventDefault();
                      var email = $('#email').val();
                      $('#email_error').text('');

                      if (!isValidEmail(email)) {
                          $('#emailStatus_failed').text('불가능한 이메일입니다.');
                          $('#emailStatus_success').text('');
                          isEmailAvailable = false;
                          return;
                      }

                      if(email) {
                          $.ajax({
                              url: '/member/join/checkEmail', 
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
              var pattern = /^[a-zA-Z0-9._]+@(?!-)[a-zA-Z0-9.-]+(?<!-)\.[a-zA-Z]{2,}$/;
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
         

           // 필드 값 가져오기
          var username = $('#username').val();
          var userid = $('#userid').val();
          var email = $('#email').val();
          var password1 = $('#password1').val();
          var password2 = $('#password2').val();

          var isValid = true; // 유효성 검사 플래그

     
          // 이름 유효성 검사 (한글만 허용)
          if (!/^[가-힣]+$/.test(username)) {
              isValid = false;
              $('#username_error').text('한글만 입력 가능합니다.');
          }

      

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
                $('#useridStatus_failed').text('');
                $('#useridStatus_success').text('');
                $('#userid_error').text('아이디 중복 확인을 해주세요.');
            }
            if (!isEmailAvailable) {
                $('#emailStatus_failed').text('');
                $('#emailStatus_success').text('');
                $('#email_error').text('이메일 중복 확인을 해주세요.');
            }
            return false; 
            }
       
           
                


          // 모든 유효성 검사를 통과했을 때만 서버에 요청
          if (isValid) {
            $('#emailStatus_success').text('');
            $('#useridStatus_success').text('');
            var formData = new FormData($('#join_form')[0]);
              $.ajax({
                  type: 'POST',
                  url: 'member/Join',
                  data: formData,
                  processData: false,  // FormData를 사용할 때 필요
                  contentType: false, // FormData를 사용할 때 필요
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


