<?php $this->load->view('layout/header'); ?>
<body class="">
<div class="hero min-h-screen bg-black ">
<!-- <img src="/application/views/images/car.jpg" class="h-screen w-screen" alt=""> -->
<video class="w-full h-full -mt-[100px]" autoplay muted loop>
        <source src="/application/views/images/2024mustang.mp4" type="video/mp4">
    </video>
  <div class="hero-content flex-col lg:flex-row-reverse w-5/6">    
    
    <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-gray-700 ">

    
      

      <form id="findByid_form" class="card-body" method="post" action="" >
        <div class="form-control">
        <div class="flex justify-center mt-2 mb-4"><span class="text-white">아이디찾기</span></div>


          <label class="label">
            <span class="label-text text-white">이름</span>        
          </label>
          <input type="name" name="username" id="username" placeholder="이름" class="input input-bordered bg-gray-600 text-white"  value="<?php echo set_value('username');?>" />  
          <span id="username_error" class="text-red-500 font-bold mt-1 ml-2 text-sm"><?php echo form_error('username'); ?></span>


              
              
            <label class="label">
            <span class="label-text text-white">이메일</span>
            </label>
              <input type="email" name="email" id="email" placeholder="example@example.com" class="input input-bordered bg-gray-600 text-white"  value="<?php echo set_value('email');?>"  />
              <span id="email_error" class="text-red-500 font-bold mt-1 ml-2 text-sm"><?php echo form_error('email'); ?></span>
              <p id="emailStatus_success" class="text-green-500 text-right text-sm mt-0.5 mr-1 font-bold"></p>
              <p id="emailStatus_failed" class="text-red-500 text-right text-sm mt-0.5 mr-1 font-bold"></p>
              
        </div>
  
        <?php if(isset($findId) && $findId): ?>
          
          <div class="flex gap-2 text-white break-words break-all">
            <div>당신의 아이디는</div>
            <div class="text-blue-400">"<?php echo $findId; ?>"</div>
            <div>입니다.</div>
          </div>
            <!-- 아이디를 찾은 경우: 로그인 버튼 표시 -->
            <div>
          <a href="/member/findPassword" class="label-text-alt link link-hover text-white hover:text-blue-500">비밀번호 찾기</a>
          </div>
          
          <div class="form-control mt-6">
              <a href="/login" class="btn btn-primary bg-blue-600">로그인하러가기</a>
          </div>
        <?php else: ?>
          <?php if (isset($error_message)): ?>
            <div class="text-red-500  mt-2 ml-2 ">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
          <div class="flex justify-between">
            <div>
            <a href="/member/findPassword" class="label-text-alt link link-hover text-white hover:text-blue-500">비밀번호 찾기</a>
            </div>
            <div>
            <a href="/login" class="label-text-alt link link-hover text-white hover:text-blue-500">로그인하러가기</a>
            </div>
        </div>
        <div class="form-control mt-6">
          <button type="submit" class="btn btn-primary bg-blue-600">아이디찾기</button>
        </div>
        <?php endif; ?>

        
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


</script>


