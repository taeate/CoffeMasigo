<?php $this->load->view('layout/header'); ?>
<body class="">
<div class="hero min-h-screen bg-base-200 ">
<img src="/application/views/images/city.jpg" class="h-screen w-screen" alt="">
  <div class="hero-content flex-col lg:flex-row-reverse w-5/6">    
    
    <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-gray-700 ">

    
      

      <form id="findByid_form" class="card-body" method="post" action="findByid" >
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
        
        
        <div class="form-control mt-6">
          <button type="submit" class="btn btn-primary bg-blue-600">아이디찾기</button>
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


</script>


