
<div class=" bg-base-100 h-auto w-auto rounded sidebarbox">
    <div name="sidebar-container" class="rounded w-[300px]">

        <div class="p-2">
            <div class="flex flex-col p-2">
            <?php if ($this->session->userdata('user_id')): ?>
                <div class="flex">
                    <div name="profile-image" class="">
                        <?php if ($this->session->userdata('profile_image')): ?>
                            <label tabindex="0" class="btn btn-ghost btn-circle avatar w-20 h-12">
                                <div class="w-500 rounded-full border-t border-b border-l border-r">
                                    <a href="/mypage"><img src="<?php echo '/uploads/' . $this->session->userdata('profile_image'); ?>" /></a>
                                </div>
                            </label>
                        <?php endif;?>
                    </div>
                    <div class="mt-1 ml-2 w-full">
                       <div class="flex text-xl font-bold">
                           
                                    <?php echo $this->session->userdata('user_id'); ?>
                         
                       </div>
                       <div>    
                            <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-blue-700 dark:text-white">레벨 <?php echo $exp_level_info['level'] ?></span>
                            <span class="text-sm font-medium text-blue-700 dark:text-white"><?php echo round($exp_level_info['progress_percentage']); ?>%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?php echo $exp_level_info['progress_percentage']; ?>%"></div>
                            <span class="text-sm font-medium text-blue-700 dark:text-white">point <?php echo $exp_level_info['exp_point'] ?></span>
                            </div>
                       </div>
                       
                    </div>
                </div>
                <div class="w-full mt-4">
                    <div class="flex flex-cols-2 gap-2 w-full">
                        <a href="/member/wrote/post" class="text-sm text-white rounded-lg bg-blue-500 w-full h-12 flex items-center justify-center">내가 쓴글</a>
                        <a href="/member/wrote/comment" class="text-sm text-white rounded-lg bg-blue-500 w-full h-12 flex items-center justify-center">내가 쓴 댓글</a>
                    </div>
                    <div class="mt-2 flex flex-cols-2 gap-2 w-full">
                        <a href="/member/wrote/thumb_post" class="text-sm text-white rounded-lg bg-blue-500 w-full h-12 flex items-center justify-center">내가 추천한 글</a>
                        <a href="/mypage" class="text-sm text-white rounded-lg bg-blue-500 w-full h-12 flex items-center justify-center">마이페이지</a>
                    </div>
                   
                </div>
                    <div class="mt-2">
                        <a href="/posts/write" class="text-white rounded-lg bg-blue-500 w-full h-12 flex items-center justify-center">글작성</a>
                    </div>
                <?php else:?>
                    <div class="mt-2">
                        <a href="/login" class="text-white rounded-lg bg-blue-500 w-full h-12 flex items-center justify-center">로그인</a>
                    </div>
                <?php endif;?>
            </div>
        </div>
       

        <hr class="mt-2">
        

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
