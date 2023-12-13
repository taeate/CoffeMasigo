<?php $this->load->view('layout/header'); ?>
<body class="">
<div class="hero min-h-screen bg-base-200 ">
<img src="/application/views/images/car.jpg" class="h-screen w-screen" alt="">
  <div class="hero-content flex-col lg:flex-row-reverse">

<!-- 비밀번호 변경 성공후  로그인 페이지에서 Alert 표시 -->
<?php if ($this->session->flashdata('password_changed')): ?>
<script>
    alert('<?php echo $this->session->flashdata('password_changed'); ?>');
</script>
<?php endif; ?>
    
    <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-gray-700">
      

    <form class="card-body" method="post" action="/login">

    <div class="form-control">
        <label class="label">
            <span class="label-text text-white">ID</span>
        </label>
        <input type="text" name="user_id" placeholder="아이디" class="input input-bordered bg-gray-600 text-white" value="<?php echo $this->session->flashdata('input_user_id') ?: set_value('user_id'); ?>"/>
        <span id="user_id_error" class="text-red-500  mt-1  text-base"><?php echo form_error('user_id'); ?></span>


    </div>
    <div class="form-control">
        <label class="label">
            <span class="label-text text-white">Password</span>
        </label>
        <input type="password" name="password" placeholder="비밀번호" class="input input-bordered bg-gray-600 text-white" value="<?php echo set_value('password'); ?>" />
        <span id="password_error" class="text-red-500 mt-1 text-base"><?php echo form_error('password'); ?></span>
    </div>
    <?php if($this->session->flashdata('error')): ?>
    <p class="text-red-500 mt-1 text-base"><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>
    <div class="form-control mt-6">
        <label class="label mb-3">
            <a href="/member/findByid" class="label-text-alt link link-hover text-white">아이디 찾기</a>
            <a href="/member/findPassword" class="label-text-alt link link-hover text-white">비밀번호 찾기</a>
            <a href="<?php echo site_url('join'); ?>" class="label-text-alt link link-hover text-white">회원가입</a>
        </label>
        <button type="submit" class="btn btn-primary bg-blue-600">로그인</button>
    </div>
</form>
    

    </div>
    <div class="text-center lg:text-left text-white">
      
      <h1 class="text-6xl font-bold">Welcome Ford Mustang!</h1>
      <p class="py-6">The Ford Mustang, an American icon and a symbol of automotive freedom, debuted in 1964 and revolutionized the muscle car industry with its captivating blend of power, style, and performance. With a heritage rooted in American culture, it has become a ontinues to captivate with its unique combination of performance, style, and legacy.
      
      </p>
    </div>
  </div>
</div>
</body>