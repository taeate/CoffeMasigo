
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
                       <a href="/member/wrote/comment"> 내가 추천한 글  ? 개</a>
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
        

        <div name="sec-side-box" class="mt-4 ml-8 flex flex-col gap-2">
            <div class="">
                
                <button  class="hover:bg-base-200">
                    <a href="/posts" data-channel-id="1">전체글보기</a>
                </button> 
            </div>
            <div>
                <button  class="hover:bg-base-200">
                    <a href="/posts/channel_id/is_notice">공지사항</a>
                </button>
            </div>
            <div>
                <button  class="hover:bg-base-200">
                    <a href="/posts/channel_id/3">자유게시판</a>
                </button>
            </div>
        </div>
            
        <hr class="mt-4">


        <div name="sec-side-box" class="mt-4 ml-8">
            <div class="grid grid-cols gap-3">
                <a class="hover:text-blue-500" href="/posts/channel_id/4" data-channel-id="4">7세대 머스탱</a>
                <a class="hover:text-blue-500" href="/posts/channel_id/5" data-channel-id="5">머스탱 5.0</a>
                <a class="hover:text-blue-500" href="/posts/channel_id/6" data-channel-id="6">머스탱 2.3 에코부스터</a>
                <a class="hover:text-blue-500" href="/posts/channel_id/7" data-channel-id="7">머스탱은 OOO 이다</a>
                <a class="hover:text-blue-500" href="/posts/channel_id/8" data-channel-id="8">머스탱 시승기 공유</a>
                <a class="hover:text-blue-500" href="/posts/channel_id/9" data-channel-id="9">머스탱 연비 공유</a>
                <a class="hover:text-blue-500" href="/posts/channel_id/10" data-channel-id="10">머스탱 부품 공유</a>
                <a class="hover:text-blue-500" href="/posts/channel_id/11" data-channel-id="11">맛집/여행/드라이브</a>
                <a class="hover:text-blue-500" href="/posts/channel_id/12" data-channel-id="12">리스/승계</a>
                <a class="hover:text-blue-500" href="/posts/channel_id/13" data-channel-id="13">사건사고</a>
                <a class="hover:text-blue-500" href="/posts/channel_id/14" data-channel-id="14">QNA</a>
                <a class="hover:text-blue-500" href="/posts/channel_id/16" data-channel-id="16">서울</a>
                <a class="hover:text-blue-500" href="/posts/channel_id/17" data-channel-id="17">대전</a>
                <a class="hover:text-blue-500" href="/posts/channel_id/18" data-channel-id="18">대구</a>
                <a class="hover:text-blue-500" href="/posts/channel_id/19" data-channel-id="19">부산</a>
                <a class="hover:text-blue-500" href="/posts/channel_id/20" data-channel-id="20">제주</a>
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
