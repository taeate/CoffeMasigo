<!DOCTYPE html>
<html lang="en" class="bg-base-300">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe Masigo</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- toast ui editor -->
    <!-- <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" /> -->
    <!-- <script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script> -->

    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>

    <!-- 폰트어썸 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    

</head>
<nav class="flex fixed top-0 w-full z-50 headerbox">
<div class="navbar bg-gray-700 h-16 relative">
    <div class="navbar-start">
        <div class="dropdown">
        <label tabindex="0" class="btn btn-ghost btn-circle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" class="bg-white" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
        </label>
        <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-white rounded-box w-52">
            <li>
                <a href="/posts">전체 글보기</a>
            </li>
            <li><a>랭킹</a></li>
            <li><a>글작성</a></li>
        </ul>
        </div>
    </div>
    <div class="navbar-center">
        <a href="/posts" class="btn btn-ghost normal-case text-2xl text-white">Cafe Masigo</a>
    </div>
    <div class="navbar-end">
    <div class="flex text-white mr-4">
    
        <?php if ($this->session->userdata('is_logged_in')): ?>
            <p><?php echo $this->session->userdata('username'); ?></p>
        <?php else: ?>
           <div>
            <button class="mr-2 btn btn-primary w-18 h-4 rounded-lg">
                <a class="hover-underline" href="/login">로그인</a>
                </button>   
           </div>
        <?php endif; ?>
    


    </div>
    
        <div class="dropdown dropdown-bottom dropdown-end">
        
        <label tabindex="0" class="btn btn-ghost btn-circle avatar w-10 h-20 mr-4">
            <div class="w-500 rounded-full">
            <img src="/application/views/images/sho.jpg" />
            </div>
            
        </label>
        <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 x-[1] p-2 shadow bg-gray-700 text-white rounded-box w-52">
            <li><a>프로필 변경</a></li>
            <li><a>설정</a></li>
            <?php if ($this->session->userdata('is_logged_in')): ?>
            <li><a href="<?php echo site_url('member/login/logout'); ?>">로그아웃</a></li>
            <?php else: ?>
            <li><a href="<?php echo site_url('login'); ?>">로그인</a></li>
        <?php endif; ?>
        </ul>
        </div>
    
    </div>
    </div>
</nav>
</html>

