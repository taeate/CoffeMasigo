
<div class=" bg-base-100 h-auto w-auto rounded sidebarbox">
    <div name="sidebar-container" class="rounded">
        <div class=" bg-base-100 h-auto flex">
            <?php if ($this->session->userdata('profile_image')): ?>
            <div class="flex mt-12 ml-8">
                <div name="profile-image" class="">
                    <label tabindex="0" class="btn btn-ghost btn-circle avatar w-32 h-20 mr-4">
                        <div class="w-500 rounded-full">
                            <img src="<?php echo '/uploads/' . $this->session->userdata('profile_image'); ?>" />
                        </div>
                    </label>
                </div>
                <?php endif;?>
                <?php if ($this->session->userdata('user_id')): ?>
                <div name="flex justify-center sidebar-text" class="flex flex-col justify-center h-full"> 
                    <div class="text-xl font-bold mb-2">
                        <?php echo $this->session->userdata('user_id'); ?>
                    </div>
                    <?php endif;?>
                
                    <div class="text-sm">
                        <a href="/member/wrote/post" class="hover:text-blue-500">내가 쓴 글  <?php echo $post_count; ?>개</a>
                    </div>
                   
                    <div class="text-sm mt-1">
                       <a href="/member/wrote/comment"> 내가 쓴 댓글  <?php echo $comment_count; ?>개</a>
                    </div>
                    <div class="text-sm mt-1">
                        <a href="/mypage" class="hover:text-blue-500">마이페이지</a>
                    </div>
                </div>
             

            </div>
            
        </div>
        <div>
        <div name="login-write-but" class="flex justify-center mt-8">
            <?php if ($this->session->userdata('user_id')): ?>
                <!-- 로그인한 사용자에게는 글작성 버튼 표시 -->
                <a href="/posts/write" class="btn btn-primary w-40 h-12 rounded-lg">글작성하기</a>
            <?php else: ?>
                <!-- 비로그인 사용자에게는 로그인 버튼 표시 -->
                <a href="/login"  class="btn btn-primary w-40 h-12 rounded-lg">로그인</a>
            <?php endif; ?>
        </div>

        </div>

        <hr class="mt-8">
        

        <div name="sec-side-box" class="mt-4 ml-8">
            <div >
                
                <button  class="hover:bg-base-200">
                    <a href="">전체글보기</a>
                </button>
                
            </div>
        </div>
            
        <hr class="mt-4">


        <div name="sec-side-box" class="mt-4 ml-8">
            <div >
                <div>공지사항</div>
                <button  class="hover:bg-base-200">
                    <a href="">자유</a>
                </button>
                <div>가입인사</div>
                <div>사건사고</div>
                <div>QNA</div>
            </div>
        </div>
            
        <hr class="mt-4">
    </div>

</div>

<script>
function checkLoginBeforeWrite() {

    <?php if(!$this->session->userdata('user_id')): ?>
        alert('로그인이 필요한 기능입니다.');
    <?php else: ?>
        window.location.href = '/posts/write'; // 로그인한 경우 글 작성 페이지로 이동
    <?php endif; ?>
}
</script>
