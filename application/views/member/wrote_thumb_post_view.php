<?php $this->load->view('layout/header'); ?>

<body>
<div class="flex flex-col bg-gray-300 h-auto text-black">
    <img src="/application/views/images/car.jpg" class="z-0 absolute h-[300px] w-screen object-cover" alt="">
    <div class="flex flex-1 pt-[250px] gap-4 px-[200px] z-10 relative text-black">
        <!-- Sidebar -->
        <aside class="w-84">
            <?php $this->load->view('layout/sidebar'); ?>
        </aside>
        <main class="flex-1">
            <!-- 리스트 페이지 컨텐츠 -->
            <div>
                <div
                    class="flex bg-white text-base font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 mb-2 justify-between">
                    <ul class="flex flex-wrap -mb-px">
                        <li class="me-2">
                            <a href="/member/wrote/post" 
                                class="inline-block p-4 border-b-2 rounded-t-lg active dark:text-blue-500 dark:border-blue-500">
                                <span>내가 쓴 글</span>
                                <div></div>
                            </a>
                        </li>
                        <li class="me-2">
                            <a href="/member/wrote/comment" 
                            
                                class="inline-block p-4 border-b-2 rounded-t-lg active dark:text-blue-500 dark:border-blue-500"
                                aria-current="page">
                                <span>내가 쓴 댓글</span>
                                <div></div>
                            </a>
                        </li>
                        <li class="me-2">
                            <a href="/member/wrote/thumb_post" 
                            
                                class="flex gap-2 inline-block p-4 text-blue-600 border-blue-600 active border-b-2  rounded-t-lg dark:hover:text-gray-300"
                                aria-current="page">
                                <span>내가 추천한 글</span>
                                <div></div>
                            </a>
                        </li>
                    </ul>

                    <!-- <ul class="p-4">
                        <div class="">
                            <input type="checkbox">
                            <span>전체선택</span>
                        </div>
                    </ul> -->
                </div>


                <!-- 초기로드 -->
                <div id="dynamic-content" class="bg-white">
                    <!-- 초기 로드된 콘텐츠 컨테이너 -->
                    <div id="initial-wrote-container">
                        <?php if(isset($wrote_thumb_post) && !empty($wrote_thumb_post)): ?>
                        <?php foreach ($wrote_thumb_post as $thumb_post): ?>
                        <!-- 리스트 페이지의 내용 -->
                        <div class="bg-white">
                            <div class="flex flex-col border-b hover:bg-blue-100">
                                <a href="/posts/free/<?php echo $thumb_post['post_id']; ?>">
                                    <div class="flex flex-1 p-2 border-b border-gray-300 cursor-pointer">

                                        <!-- 콘텐츠 내용 -->
                                        <div class="flex-[0.4] flex flex-col items-center ">
                                            <div class="m-auto"><i class='fa-solid fa-caret-up fa-xl text-gray-400'></i>
                                            </div>
                                            <div class=""><?php echo $thumb_post['thumb']; ?></div>
                                        </div>
                                        <div class="flex-[2] m-auto">
                                            <div class="flex">

                                                <div class="text-base font-medium">

                                                    <?php echo $thumb_post['title']; ?>
                                                    

                                                </div>
                                                <?php if($thumb_post['comment_count'] > 0): ?>
                                                    <div class="ml-1 text-red-500">[<?php echo $thumb_post['comment_count'] ?>]</div>
                                                <?php endif; ?>
                                                <?php if($thumb_post['content'] && strpos($thumb_post['content'], '<img') !== false): ?>
                                                <div class="ml-1 text-green-500"><i class="fa-solid fa-image"></i></div>
                                                <?php endif; ?>


                                                <?php if($thumb_post['file_count'] > 0): ?>
                                                <div class="ml-2 text-blue-500"><i class="fa-solid fa-paperclip"></i></div>
                                                <?php endif; ?>


                                            </div>
                                            <div class="flex">
                                                <div class="font-base text-gray-500"><?php echo $thumb_post['channel_name'] ?>
                                                </div>
                                                <!-- 답글이 있을 때만 버튼이 보임 -->
                                                <!-- <?php if($post->replies > 1): ?>
                                                            <a href="#" class="view-replies ml-2 text-red-500 hover:text-blue-800" onclick="event.stopPropagation(); loadReplies(<?=$post->post_id?>); return false;">답글보기</a>
                                                        <?php endif; ?> -->
                                            </div>
                                        </div>
                                        <!-- <div class="flex-[2] m-auto">
                                            <i class="fa-solid fa-user mr-2"></i>
                                            <div><?php echo $thumb_post['user_id']; ?></div>
                                            </div> -->
                                        <div class="flex-1 m-auto">
                                            <i class="fa-solid fa-eye"></i>
                                            <?php echo $thumb_post['views']; ?>
                                        </div>

                                        <div class="flex-[1] m-auto"><i class="fa-regular fa-clock mr-2"></i>
                                            <?php echo $thumb_post['create_date']; ?>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                
                        <div class="shadow-md">
                            <!-- 내용이 없을 때의 메시지 -->
                            <div class="flex flex-col border-b">
                                <div class="flex flex-1 p-2 bg-base-100 border-gray-300 cursor-pointer justify-center">
                                    <div class="p-4">추천된 글이 없습니다.</div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <div class="mt-6 mb-6">
                            <div class="flex justify-center">
                                <div class="pagination mb-4">
                                    <?php echo $link; ?>                 
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- AJAX로 로드될 콘텐츠 컨테이너 -->
                    <div id="dynamic-wrote-container"></div>
                </div>


            </div>
        </main>
        <!-- Rightbar -->
        <aside class="w-64 ">
            <?php $this->load->view('layout/rightbar'); ?>
        </aside>
    </div>
</div>

</body>
<!-- <?php $this->load->view('layout/footer'); ?> -->


<script>

</script>