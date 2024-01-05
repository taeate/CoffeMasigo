<?php $this->load->view('layout/header'); ?>

<body>
    <div class="flex flex-col bg-gray-300 h-auto text-black">
    <img src="/application/views/images/car.jpg" class="z-0 absolute h-[500px] w-screen object-cover" alt="">
    <div class="flex flex-1 pt-[250px] gap-4 px-[100px] z-10 relative text-black justify-center">
             <!-- Sidebar -->
            <aside class="w-84">
                <?php $this->load->view('layout/sidebar'); ?>
            </aside>
            <main class="w-full">
                <!-- 리스트 페이지 컨텐츠 -->
                <div class="">
                    <div class="flex bg-white text-base font-medium text-center text-gray-500 border-b border-gray-100  mb-2 justify-between">
                        <ul class="flex flex-wrap -mb-px">
                            <li class="p-2">
                                <a href="/member/wrote/post" 
                                    class="flex gap-2 inline-block p-2 text-blue-600 border-blue-600 active border-b-2  rounded-t-lg ">
                                    <span>내가 쓴 글</span>
                                    <div></div>
                                </a>
                            </li>
                            <li class="p-2">
                                <a href="/member/wrote/comment" 
                                
                                    class="inline-block p-2 border-b-2 rounded-t-lg active text-gray-400 "
                                    aria-current="page">
                                    <span>내가 쓴 댓글</span>
                                    <div></div>
                                </a>
                            </li>
                            <li class="p-2">
                                <a href="/member/wrote/thumb_post" 
                                
                                class="inline-block p-2 border-b-2 rounded-t-lg active text-gray-400 "
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
                    <div id="dynamic-content" class="bg-gray-200">
                        <!-- 초기 로드된 콘텐츠 컨테이너 -->
                        <div id="initial-wrote-container">
                            <?php if(isset($wrote_post) && !empty($wrote_post)): ?>
                            <?php foreach ($wrote_post as $post): ?>
                            <!-- 리스트 페이지의 내용 -->
                            <div class="bg-white">
                                <div class="flex flex-col  hover:bg-blue-100">
                                    <a href="/posts/free/<?php echo $post['post_id']; ?>">
                                        <div class="flex flex-1 p-2 border-b border-gray-200 cursor-pointer">

                                            <!-- 콘텐츠 내용 -->
                                            <div class="flex-[0.4] flex flex-col items-center ">
                                                <div class="m-auto"><i class='fa-solid fa-caret-up fa-xl text-gray-400'></i>
                                                </div>
                                                <div class=""><?php echo $post['thumb']; ?></div>
                                            </div>
                                            <div class="flex-[2] m-auto">
                                                <div class="flex">

                                                    <div class="text-base font-medium">

                                                        <?php echo $post['title']; ?>

                                                    </div>
                                                    <?php if($post['comment_count'] > 0): ?>
                                                        <div class="ml-1 text-red-500">[<?php echo $post['comment_count'] ?>]</div>
                                                    <?php endif; ?>
                                                    <?php if($post['content'] && strpos($post['content'], '<img') !== false): ?>
                                                    <div class="ml-1 text-green-500"><i class="fa-solid fa-image"></i></div>
                                                    <?php endif; ?>


                                                    <?php if($post['file_count'] > 0): ?>
                                                    <div class="ml-2 text-blue-500"><i class="fa-solid fa-paperclip"></i></div>
                                                    <?php endif; ?>


                                                </div>
                                                <div class="flex">
                                                    <div class="font-base text-gray-500"><?php echo $post['channel_name'] ?>
                                                    </div>
                                                    <!-- 답글이 있을 때만 버튼이 보임 -->
                                                    <!-- <?php if($post->replies > 1): ?>
                                                                <a href="#" class="view-replies ml-2 text-red-500 hover:text-blue-800" onclick="event.stopPropagation(); loadReplies(<?=$post->post_id?>); return false;">답글보기</a>
                                                            <?php endif; ?> -->
                                                </div>
                                            </div>
                                            <!-- <div class="flex-[2] m-auto">
                                                <i class="fa-solid fa-user mr-2"></i>
                                                <div><?php echo $post['user_id']; ?></div>
                                                </div> -->
                                            <div class="flex-1 m-auto">
                                                <i class="fa-solid fa-eye"></i>
                                                <?php echo $post['views']; ?>
                                            </div>

                                            <div class="flex-[1] m-auto"><i class="fa-regular fa-clock mr-2"></i>
                                                <?php echo $post['create_date']; ?>
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
                                    <div class="flex flex-1 p-2 bg-white border-gray-100 cursor-pointer justify-center">
                                        <div class="p-4">작성된 글이 없습니다.</div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <div class="p-6 bg-white">
                                <div class="flex justify-center dark:bg-white">
                                    <div class="pagination mb-4 dark:bg-white">
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
