<?php $this->load->view('layout/header'); ?>
<body class="">
<div class="hero min-h-screen bg-base-200 ">
<img src="/application/views/images/city.jpg" class="h-screen w-screen" alt="">
  <div class="hero-content flex-col lg:flex-row-reverse w-5/6">    
    <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-gray-700 ">

    <form id="findByPassword_form" class="card-body" method="post" action="" >
    <div class="form-control">
    <div class="flex justify-center mt-2 mb-4"><span class="text-white">비밀번호찾기</span></div>

    <?php if (isset($userExists) && $userExists): ?>

            <!-- 사용자가 존재하면 새 비밀번호 필드만 표시 -->
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            
            <label for="newPassword1" class="label">
                <span class="label-text text-white">새 비밀번호</span>        
            </label>
            <input type="password" name="newPassword1" id="newPassword1" placeholder="새 비밀번호" class="input input-bordered bg-gray-600 text-white"  value="<?php echo set_value('newPassword1');?>"/>  
            
            <label for="password2" class="label">
                <span class="label-text text-white">새 비밀번호 확인</span>        
            </label>
            <input type="password" name="newPassword2" id="newPassword2" placeholder="새 비밀번호 확인" class="input input-bordered bg-gray-600 text-white"  value="<?php echo set_value('newPassword2');?>" />
            <span id="password_error" class="text-red-500 font-bold mt-1 ml-2 text-sm"><?php echo form_error('newPassword2'); ?></span>


            <button type="button" onclick="handleChangePassword()" class="btn btn-primary bg-blue-600 mt-6">비밀번호 변경</button>

    <?php else: ?>
            <input type="hidden" name="form_action" id="form_action" value="">
            <label class="label">
            <span class="label-text text-white">이름</span>        
            </label>
            <input type="name" name="username" id="username" placeholder="이름" class="input input-bordered bg-gray-600 text-white"  value="<?php echo set_value('username');?>" />  
            <span id="username_error" class="text-red-500 font-bold mt-1 ml-2 text-sm"><?php echo form_error('username'); ?></span>


            <label class="label">
                <span class="label-text text-white">아이디</span>        
            </label>
            <input type="userid" name="userid" id="userid" placeholder="아이디" class="input input-bordered bg-gray-600 text-white"  value="<?php echo set_value('userid');?>" />  
            <span id="userid_error" class="text-red-500 font-bold mt-1 ml-2 text-sm"><?php echo form_error('userid'); ?></span>
                
            <label class="label">
            <span class="label-text text-white">이메일</span>
            </label>
            <input type="email" name="email" id="email" placeholder="example@example.com" class="input input-bordered bg-gray-600 text-white"  value="<?php echo set_value('email');?>"  />
            <span id="email_error" class="text-red-500 font-bold mt-1 ml-2 text-sm"><?php echo form_error('email'); ?></span>
            <p id="emailStatus_success" class="text-green-500 text-right text-sm mt-0.5 mr-1 font-bold"></p>
            <p id="emailStatus_failed" class="text-red-500 text-right text-sm mt-0.5 mr-1 font-bold"></p>

            <div class="flex justify-between">
            <div>
            <a href="/member/findByid" class="label-text-alt link link-hover text-white hover:text-blue-500">아이디 찾기</a>
            </div>
            <div>
            <a href="/login" class="label-text-alt link link-hover text-white hover:text-blue-500">로그인하러가기</a>
            </div>
            </div>

            <div class="flex justify-center items-center m-4">
                <?php if (isset($userNotFound) && $userNotFound): ?>
                    <div class="text-red-500">사용자를 찾을 수 없습니다.</div>
                <?php endif; ?>
            </div>
            
         

            <div class="form-control mt-6">
                <button onclick="handleFindPassword()" type="button" class="btn btn-primary bg-blue-600">비밀번호찾기</button>
            </div>
          

    <?php endif; ?>

 

        </div>
    </form>


    </div>
    <div class="text-center lg:text-left text-white">
      
      <h1 class="text-6xl font-bold">Welcome Cafe Masigo!</h1>
      <p class="py-6">Provident qwer voluptatem et in. Quaerat qwer ut assumenda excepturi exercitationem quasi. In deleniti eaque aut repudiandae et a id nisi. 
      Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem quasi. In deleniti eaque aut repudiandae et a id nisi.

      </p>
    </div>
  </div>
</div>
</body>

<script>
function handleFindPassword() {
    var form = document.getElementById('findByPassword_form');
    form.action = '/member/findPassword';
    form.submit();
}

function handleChangePassword() {
    var form = document.getElementById('findByPassword_form');
    form.action = '/member/changePassword';
    form.submit();
}


</script>


