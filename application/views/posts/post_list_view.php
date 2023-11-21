<?php $this->load->view('layout/header'); ?>

<div class="flex-container" style="display: flex; margin-left: 400px; margin-right: 400px; margin-top: 320px;">

<!-- 사이드바 -->
<div class="w-80">
    <?php $this->load->view('layout/sidebar'); ?>
</div>
    
    <!-- 리스트 페이지 컨텐츠 -->
    <div id="content" class="contentbox ml-8 z-10" style="flex: 3;" >

        <div name="top-box" class="flex flex-col w-full">
            <div name="search-nav" class="searchbox z-30 h-auto bg-base-100 place-items-center shadow-md">

                <div class="m-4">
                    <div class="flex justify-between w-full">
                        <div class="flex">
                            <div class="text-xl font-bold">전체글</div>
                        </div>
                        <div>
                            <div>글작성</div>
                        </div>
                    </div>
                </div>


                <div class="m-4 flex justify-between items-center">

                    <div name="order-by">
                        <div class="flex">
                            <div>최신</div>
                            <div class="ml-4">추천수</div>
                            <div class="ml-4">조회수</div>
                        </div>
                    </div>

                    <div name="select-box" class="ml-auto">
                        <select id="countries" class="w-28 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>지난 1일</option>
                        <option value="US">지난 1주일</option>
                        <option value="CA">지난 1개월</option>
                        <option value="FR">지난 1년</option>
                        </select>
                    </div>


                    <div name="" class="w-68 ml-4">
                  
                            <form  action="<?php echo base_url('posts/search'); ?>" method="get">
                                <div class="flex">
                                    <label for="location-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your Email</label>
                                    <button id="dropdown-button-2" data-dropdown-toggle="dropdown-search-city" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-500 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">
                                        제목+내용 <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg></button>
                                    <div id="dropdown-search-city" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button-2">
                                            <li>
                                                <button type="button" class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                                                    <div class="inline-flex items-center">
                                                        <svg aria-hidden="true" class="h-3.5 w-3.5 rounded-full me-2" xmlns="http://www.w3.org/2000/svg" id="flag-icon-css-us" viewBox="0 0 512 512"><g fill-rule="evenodd"><g stroke-width="1pt"><path fill="#bd3d44" d="M0 0h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0z" transform="scale(3.9385)"/><path fill="#fff" d="M0 10h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0z" transform="scale(3.9385)"/></g><path fill="#192f5d" d="M0 0h98.8v70H0z" transform="scale(3.9385)"/><path fill="#fff" d="M8.2 3l1 2.8H12L9.7 7.5l.9 2.7-2.4-1.7L6 10.2l.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7L74 8.5l-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 7.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 24.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 21.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 38.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 35.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 52.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 49.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 66.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 63.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9z" transform="scale(3.9385)"/></g></svg>              
                                                        United States
                                                    </div>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                                                    <div class="inline-flex items-center">
                                                        <svg aria-hidden="true" class="h-3.5 w-3.5 rounded-full me-2" xmlns="http://www.w3.org/2000/svg" id="flag-icon-css-de" viewBox="0 0 512 512"><path fill="#ffce00" d="M0 341.3h512V512H0z"/><path d="M0 0h512v170.7H0z"/><path fill="#d00" d="M0 170.7h512v170.6H0z"/></svg>
                                                        Germany
                                                    </div>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                                                    <div class="inline-flex items-center">
                                                        <svg aria-hidden="true" class="h-3.5 w-3.5 rounded-full me-2" xmlns="http://www.w3.org/2000/svg" id="flag-icon-css-it" viewBox="0 0 512 512"><g fill-rule="evenodd" stroke-width="1pt"><path fill="#fff" d="M0 0h512v512H0z"/><path fill="#009246" d="M0 0h170.7v512H0z"/><path fill="#ce2b37" d="M341.3 0H512v512H341.3z"/></g></svg>              
                                                        Italy
                                                    </div>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                                                    <div class="inline-flex items-center">
                                                        <svg aria-hidden="true" class="h-3.5 w-3.5 rounded-full me-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="flag-icon-css-cn" viewBox="0 0 512 512"><defs><path id="a" fill="#ffde00" d="M1-.3L-.7.8 0-1 .6.8-1-.3z"/></defs><path fill="#de2910" d="M0 0h512v512H0z"/><use width="30" height="20" transform="matrix(76.8 0 0 76.8 128 128)" xlink:href="#a"/><use width="30" height="20" transform="rotate(-121 142.6 -47) scale(25.5827)" xlink:href="#a"/><use width="30" height="20" transform="rotate(-98.1 198 -82) scale(25.6)" xlink:href="#a"/><use width="30" height="20" transform="rotate(-74 272.4 -114) scale(25.6137)" xlink:href="#a"/><use width="30" height="20" transform="matrix(16 -19.968 19.968 16 256 230.4)" xlink:href="#a"/></svg>
                                                        China
                                                    </div>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="relative w-full">
                                       
                                        <input type="text" name="search" id="search"  class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="검색" required>
                                        <button type="submit" class="absolute top-0 end-0 h-full p-2.5 text-sm font-medium text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                            </svg>
                                            <span class="sr-only">Search</span>
                                        </button>
                                     
                                    </div>
                                </div>
                            </form>



                    </div>

                </div>

            </div> 

        <!-- <div class="grid h-20 card bg-base-300 rounded-box place-items-center mt-4">랭킹</div> -->
        <div name="rankingbar" class="flex shadow mt-4 bg-base-100"> <!--랭킹바 -->
  
            <div class="stat border-r">
                <div class="stat-figure text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </div>
                <div class="stat-title">1위</div>
                <div class="stat-value text-primary text-xl">admin</div>
                <!-- <div class="stat-desc">21% more than last month</div> -->
            </div>
            
            <div class="stat border-r">
                <div class="stat-figure text-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div class="stat-title">2위</div>
                <div class="stat-value text-secondary text-xl">tjdwls3144</div>
                <!-- <div class="stat-desc">21% more than last month</div> -->
            </div>
            
            <div class="stat">
                <div class="stat-title ">3위</div>
                <div class="stat-value text-xl">starbuck</div>

                <!-- <div class="stat-desc text-secondary">31 tasks remaining</div> -->
            </div>
            
        </div>
    </div>
                <body class="bg-base-300">
                <!-- 리스트 페이지의 내용 -->
                <div class="bg-base-100 mt-4">
                    <div class="overflow-x-auto shadow-md">

                        <!-- 메인 글 -->
                        <?php foreach($get_list as $post): ?>
                            <div class="flex flex-col border-b answer-row">
                                <div class="flex flex-1 p-4 space-x-2 hover:bg-gray-200 cursor-pointer" onclick="window.location.href='/posts/free/<?=$post->post_id?>'">
                                    <div class="ml-4 flex-[0.8] flex items-center">
                                        <div>▲ 12</div>
                                    </div>
                                    <div class="flex-[6] font-bold">
                                        <?php echo $post->title; ?>
                                        <div class="flex">
                                            <div class="font-base">자유</div>

                                            <!-- 답글이 있을때만 버튼 보임 -->
                                            <?php if($post->replies_count > 0): ?>
                                            <a href="#" class="view-replies ml-2 text-red-500 hover:text-blue-800" onclick="loadReplies(<?=$post->post_id?>); return false;">답글보기</a>
                                            <?php endif; ?>
                                            
                                        </div>
                                    </div>
                                    <div class="flex-1"><?php echo $post->user_id ?></div>
                                    <div class="flex-1"><?php echo $post->views ?>조회 23</div>
                                    <div class="flex-1"><?php echo $post->create_date?></div>
                                </div>
                                
                                <div id="replies-container-<?=$post->post_id?>"></div> 
                            </div>
                        <?php endforeach; ?>
                        <!-- 메인 글 끝-->


                        <!-- 검색 결과 -->
                        <?php if(!empty($search_data)): ?>
                            <?php foreach($search_data as $post): ?>
                                <div class="flex flex-col border-b ">
                                    <div class="flex flex-1 p-4 space-x-2 space-y-2">
                                        <div class="ml-4 flex-[0.8] flex items-center">
                                            <div>▲ 12</div>
                                        </div>
                                        <div class="flex-[6]">
                                            <?php echo $post['title']; ?> [5]
                                            <div class="flex">
                                                <div>자유</div>
                                                <!-- <span class="ml-2 text-red-500">답글보기</span> -->
                                            </div>
                                        </div>
                                        <div class="flex-1"><?php echo $post['user_id']; ?></div>
                                        <div class="flex-1"><?php echo $post['views']; ?>조회 23</div>
                                        <div class="flex-1"><?php echo $post['create_date']; ?></div>
                                    </div>
                                    <div id="replies-container-<?=$post['post_id']?>"></div> 
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <?php if(isset($no_results)): ?>
                                <div class="flex justify-center m-4 font-bold text-lg">
                                    <?php echo $no_results; ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <!-- 검색 결과 끝 -->

                    </div>
                    
                        
                        <div class="mt-6 mb-6">
                            <div class="flex justify-center">
                                                    
                                <div class="pagination mb-4">
                                <?php echo $link; ?>

                                                    
                                </div>
                                                    
                            </div>
                        </div>
                    
                </div>
            </body>
            
           

    </div>
</div>

<script>



function loadReplies(postId, parentContainerId = null) {
    let repliesContainer;
    if (parentContainerId) {
        // 중첩된 답글을 로드하는 경우
        repliesContainer = document.getElementById(parentContainerId);
    } else {
        // 최상위 답글을 로드하는 경우
        repliesContainer = document.getElementById(`replies-container-${postId}`);
    }
    repliesContainer.innerHTML = ''; // 기존 내용 초기화

    fetch(`posts/post/fetch_replies/${postId}`)
    .then(response => response.json())
    .then(replies => {
        replies.forEach(reply => {
            const replyElement = document.createElement('div');
            replyElement.className = 'flex flex-col border-t';
            replyElement.innerHTML = `
                <div class="flex flex-1 p-4 space-x-2 hover:bg-gray-200" onclick="window.location.href='/posts/free/${reply.post_id}'">
            
                    <div class="ml-4 flex-[0.8] flex items-center hover:gray-300">
                        <div>└</div>
                    </div>
                    <div class="flex-[6]">
                        <div class="font-bold text-gray-400">${reply.parent_title} 에 대한 답변</div>
                        <div class="font-bold mt-1">${reply.title}</div>
                        <a href="#" class="view-replies text-red-500 hover:text-blue-500 hover:font-bold hover:cursor-pointer" onclick="loadReplies(${reply.post_id}, 'nested-replies-container-${reply.post_id}')">답글보기</a>
                    </div>
                    <div class="flex-1">${reply.user_id}</div>
                    <div class="flex-1">21</div>
                    <div class="flex-1">${reply.create_date}</div>
                </div>
            `;

            // 중첩된 답글을 위한 컨테이너 추가
            const nestedRepliesContainer = document.createElement('div');
            nestedRepliesContainer.id = `nested-replies-container-${reply.post_id}`;
            nestedRepliesContainer.className = 'nested-replies';
            
            replyElement.appendChild(nestedRepliesContainer);
            repliesContainer.appendChild(replyElement);
        });
    })
    .catch(error => console.error('Error:', error));
}






    
    document.addEventListener('DOMContentLoaded', function () {
    
    const viewRepliesButtons = document.querySelectorAll('.view-replies'); // 답글보기 class

    viewRepliesButtons.forEach(function (button) {

        button.addEventListener('click', function (event) {

            event.stopPropagation();
            
            const postId = this.getAttribute('data-post-id');

            const answerRows = document.querySelectorAll(`.answer-row[data-parent-post-id="${postId}"]`);
            
            answerRows.forEach(row => {
                row.classList.toggle('hidden');
            });
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.querySelector('nav');
    const search = document.querySelector('.searchbox');
    const sidebar = document.querySelector('.sidebarbox');

    // 원래 sidebar의 너비 계산
    const originalSidebarWidth = sidebar.offsetWidth + 'px';
    const originalSearchWidth = search.offsetWidth + 'px';

    if (navbar && content && sidebar) {

        const navbarHeight = navbar.offsetHeight;
        const contentTop = content.getBoundingClientRect().top + window.scrollY - navbarHeight;

        window.addEventListener('scroll', function(){
            if(window.scrollY >= contentTop){
                sidebar.classList.add('fixed');
                search.classList.add('fixed');
                sidebar.style.top = `${navbarHeight}px`;
                search.style.top = `${navbarHeight}px`;

                sidebar.style.width = originalSidebarWidth; 
                search.style.width = originalSearchWidth; // 고정 상태에서 원래 너비 적용
            } else {
                sidebar.classList.remove('fixed');
                sidebar.style.top = '';
                sidebar.style.width = ''; // 너비 스타일 제거

                 // searchbox 스타일 초기화
                search.classList.remove('fixed');
                search.style.top = '';
                search.style.width = '';
                search.style.zIndex = '50';
                search.style.backgroundColor = '';
            }
        });
    } 
});
</script>