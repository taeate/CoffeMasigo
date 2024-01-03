<?php $this->load->view('layout/header') ?>

<body>

    <div class="flex flex-col bg-gray-200 h-auto">
    <img src="/application/views/images/car.jpg" class="z-0 absolute h-[500px] w-screen object-cover" alt="">
        <!-- Header -->
        <header class="bg-gray-800 text-white text-center">
           
        </header>

        <!-- Body -->
        <div class="flex flex-1 mt-[350px] gap-4 mx-[300px] z-10 relative">
            <!-- Sidebar -->
            <aside class="w-84">
                <?php $this->load->view('layout/sidebar'); ?>
            </aside>
            <!-- Content -->
            <main class="flex-1">
                <div id="content" class="flex flex-col contentbox z-10">
                    <div name="top-box" class="flex flex-col ">
                        <div name="search-nav" class="searchbox z-30 h-auto bg-white place-items-center shadow-md">

                            <div class="m-4">
                                <div class="flex justify-between w-full">
                                    <div class="flex">
                                        <div class="text-xl font-bold">
                                        <?php 
                                        $is_notice = $this->uri->segment(3); // URL의 세 번째 세그먼트를 가져옴 (예: 'is_notice')

                                        if (isset($channel_name)) {
                                            echo "<h1>" . htmlspecialchars($channel_name) . "</h1>";
                                        } elseif ($is_notice === 'is_notice') { // URL에서 'is_notice' 값을 확인
                                            echo "<h1>공지사항</h1>";
                                        } else {
                                            echo "<h1>전체글</h1>";
                                        }
                                        ?>


                                        </div>
                                    </div>
                                    <div>
                                        <div class="mt-2 mb-2 mr-2">
                                            <button onclick="redirectToURL()"><i
                                                    class="text-blue-600 fa-solid fa-pen fa-xl"></i></button>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="m-4 flex justify-between items-center">

                                <div name="order-by">
                                    <div class="flex">
                                        <div>
                                            <button class="btn btn-sm btn-accent hover:text-white"
                                                onclick="LatestOrderBy(getChannelIdFromUrl())">
                                                <i class="fa-solid fa-clock-rotate-left"></i>최신</button>
                                        </div>
                                        <div class="ml-4">
                                            <button class="btn btn-sm btn-accent hover:text-white"
                                                onclick="ThumbOrderBy(getChannelIdFromUrl())">
                                                <i class="fa-solid fa-thumbs-up"></i>추천수</button>
                                        </div>
                                        <div class="ml-4">
                                            <button class="btn btn-sm btn-accent hover:text-white"
                                                onclick="ViewsOrderBy(getChannelIdFromUrl())">
                                                <i class="fa-solid fa-eye"></i>조회수</button>
                                        </div>
                                        <div class="ml-4">
                                            <label class="btn btn-sm btn-accent hover:text-white">
                                                
                                                <input type="checkbox" id="toggleNoticesCheckbox" onchange="hideNotices();">

                                                 공지숨기기
                                            </label>
                                        </div>


                                    </div>
                                </div>




                                <div name="" class="w-68 ml-4">

                                    <form onsubmit="return searchPosts();" action="" method="get">
                                        <div class="flex gap-4">

                                            <div name="select-box" class="ml-auto">
                                                <select id="search-past"
                                                    class="w-28 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                    <option selected>전체</option>
                                                    <option value="last_day">지난 1일</option>
                                                    <option value="last_week">지난 1주일</option>
                                                    <option value="last_month">지난 1개월</option>
                                                    <option value="last_year">지난 1년</option>
                                                </select>
                                            </div>
                                            <!-- Label for Email (hidden for screen readers) -->
                                            <label for="location-search"
                                                class="mb-2 text-sm font-medium text-gray-900 sr-only">Your
                                                Email</label>

                                            <!-- Select Dropdown for Search Options -->
                                            <div name="select-box" class="ml-auto">
                                                <select id="search-options"
                                                    class="w-28 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                    <option value="title-content" selected>제목+내용</option>
                                                    <option value="title">제목</option>
                                                    <option value="content">내용</option>
                                                    <option value="author">작성자</option>
                                                </select>
                                            </div>

                                            <!-- Search Input -->
                                            <div class="relative w-full">
                                                
                                                <!-- 현재 채널 ID를 숨겨진 필드로 추가 -->
                                                <input type="hidden" id="channel-id" name="channel-id" value="<?php echo $this->uri->segment(3); ?>">

                                                <input type="text" name="search" id="search"
                                                    class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg  border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
                                                    placeholder="검색" required>
                                                <button type="submit"
                                                    class="absolute top-0 end-0 h-full p-2.5 text-sm font-medium text-black rounded-e-lg border border-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                                    <svg class="w-4 h-4" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
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
                        <div name="rankingbar" class="flex shadow mt-4 bg-white">
                            <!--랭킹바 -->

                            <div class="stat border-r">
                                <div class="stat-figure text-primary">
                                    <i class="fa-solid fa-pen-nib fa-xl"></i>
                                </div>
                                <div class="stat-title">글을 가장 많이 쓴사람</div>
                                <div class="text-primary font-bold text-xl"><?php echo htmlspecialchars($top_poster->user_id) ?></div>
                                <div class="stat-desc mt-1">누적 게시글수: <?php echo htmlspecialchars($top_poster->post_count) ?></div>
                                <!-- 게시글 수 표시 -->
                            </div>

                            <div class="stat border-r">
                                <div class="stat-figure text-secondary">
                                    <i class="fa-solid fa-comment fa-xl"></i>
                                </div>
                                <div class="stat-title">댓글을 가장 많이 쓴 사람</div>
                                <div class=" text-secondary font-bold text-xl"><?php echo htmlspecialchars($top_commenter->user_id) ?>
                                </div>
                                <div class="stat-desc mt-1">누적 댓글수: <?php echo htmlspecialchars($top_commenter->comment_count) ?></div>
                                <!-- 댓글 수 표시 -->
                            </div>

                            <div class="stat">
                                <div class="stat-figure text-secondary">
                                    <i class="fa-solid fa-thumbs-up fa-xl"></i>
                                </div>
                                <div class="stat-title ">추천수를 제일 많이 받은사람</div>
                                <div class="font-bold text-xl"><?php echo htmlspecialchars($top_thumb->user_id) ?></div>
                                <div class="stat-desc mt-1">누적 추천수: <?php echo htmlspecialchars($top_thumb->thumb_count) ?></div>
                                <!-- 추천 수 표시 -->
                            </div>

                        </div>
                    </div>

                    <!-- 두번째 리스트 컨텐츠 이게 메인 -->
                    <div class="">
                        <div class="bg-white mt-4">

                            <div class="overflow-x-auto shadow-md">

                            <div id="notices-container" style="display: none;">
                                        
                            </div>
                                <!-- 메인 글 -->
                                <?php if(isset($get_list)): ?>
                                   
                                <div id="posts-container">
                                    <?php foreach($get_list as $post): ?>
                                    <?php if($post->is_notice == 1): ?>
                                    <div
                                        class="flex flex-col border-b answer-row <?= $post->is_notice == 1 ? 'notice-post' : '' ?>">
                                        <div class="flex flex-1 p-2 border-b border-gray-300 bg-blue-100 cursor-pointer "
                                             onclick="window.location.href='/posts/free/<?= htmlspecialchars(urlencode($post->post_id)) ?>'">

                                            <div class="ml-4 flex-[1] flex flex-col items-center ">
                                                <div class="m-auto">
                                                    <div class="text-red-500 bg-red-200 rounded-lg">공지</div>
                                                </div>
                                                <div class=""></div>
                                            </div>
                                            <div class="flex-[4] m-auto">
                                                <div class="flex">
                                                    <div class="text-blue-500 font-bold"><?php echo htmlspecialchars($post->title); ?>
                                                    </div>
                                                    <div class="ml-1 text-red-500">[<?php echo htmlspecialchars($post->comment_count); ?>]
                                                    </div>
                                                    <?php if($post->file_count > 0): ?>
                                                    <div>[파일있음]</div>
                                                    <?php endif; ?>

                                                </div>
                                                <div class="flex">
                                                    <div class="font-base text-gray-500">
                                                        <?php echo htmlspecialchars($post->channel_name) ?>
                                                    </div>

                                                    <!-- 답글이 있을 때만 버튼이 보임 -->
                                                    <?php if($post->replies > 1): ?>
                                                    <a href="#"
                                                        class="view-replies ml-2 text-red-500 hover:text-blue-800"
                                                        onclick="event.stopPropagation(); loadReplies(<?= htmlspecialchars(urlencode($post->post_id))?>); return false;">답글보기</a>
                                                    <?php endif; ?>


                                                </div>
                                            </div>
                                            <div class="flex-[2] m-auto text-blue-500 font-bold">
                                                <?php echo htmlspecialchars($post->user_id) ?></div>
                                            <div class="flex-1 m-auto">
                                                <i class="fa-solid fa-eye"></i>
                                                <?php echo htmlspecialchars($post->views) ?>
                                            </div>
                                            <div class="flex-[2] m-auto"><i
                                                    class="fa-regular fa-clock mr-2"></i><?php echo htmlspecialchars($post->create_date)?>
                                            </div>

                                        </div>
                                        <div id="replies-container-<?= htmlspecialchars(urlencode($post->post_id))?>" style="display: none;"></div>

                                        <?php else: ?>
                                        <div class="flex flex-col border-b answer-row">
                                            <div class="flex flex-1 p-2 hover:bg-gray-200 cursor-pointer "
                                                onclick="window.location.href='/posts/free/<?=$post->post_id?>'">
                                                <div class="ml-4 flex-[1] flex flex-col items-center ">
                                                    <div><i class="fa-solid fa-caret-up fa-xl text-gray-400"></i></div>
                                                    <div class=""><?php echo $post->thumb; ?></div>
                                                </div>
                                                <div class="flex-[4] m-auto">
                                                    <div class="flex">
                                                        <div><?php echo $post->title; ?></div>
                                                        <?php if ($post->comment_count > 0): ?>
                                                            <div class="ml-2 text-red-500">
                                                                [<?php echo $post->comment_count; ?>]
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php if($post->file_count > 0): ?>
                                                        <div class="ml-2 text-blue-500"><i
                                                                class="fa-solid fa-paperclip"></i></div>
                                                        <?php endif; ?>
                                                        <?php
                                                        $decoded_content = htmlspecialchars_decode($post->content);
                                                        if ($decoded_content && preg_match('/<img\s+[^>]*src="[^"]+"/', $decoded_content)): ?>
                                                            <div class="ml-1 text-green-500"><i class="fa-solid fa-image"></i></div>
                                                        <?php endif; ?>

                                                        
                                                        <!-- <div class="ml-1 text-red-500"><i class="fa-regular fa-n"></i></div> -->

                                                    </div>
                                                    <div class="flex">
                                                        <div class="font-base text-gray-500">
                                                            <?php if(isset($post->channel_name)):?>
                                                            <?php echo $post->channel_name; ?>
                                                            <?php else: ?>
                                                            <div>자유</div>
                                                            <?php endif; ?>
                                                        </div>

                                                        <!-- 답글이 있을 때만 버튼이 보임 -->
                                                        <?php if($post->replies > 0): ?>
                                                        <a href="#"
                                                            class="view-replies ml-2 text-red-500 hover:text-blue-800"
                                                            onclick="event.stopPropagation(); loadReplies(<?=$post->post_id?>); return false;">답글보기[<?= $post->replies ?>]</a>
                                                        <?php endif; ?>


                                                    </div>
                                                </div>
                                                <div class="flex-[2] m-auto "><?php echo $post->user_id ?></div>
                                                <div class="flex-1 m-auto">
                                                    <i class="fa-solid fa-eye"></i>
                                                    <?php echo $post->views ?>
                                                </div>
                                                <div class="flex-[2] m-auto"><i
                                                        class="fa-regular fa-clock mr-2"></i><?php echo $post->create_date?>
                                                </div>

                                            </div>
                                            <div id="replies-container-<?=$post->post_id?>" style="display: none;">
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php endforeach; ?>

                                    </div>
                                    <?php endif; ?>
                                    <!-- 메인 글 끝-->


                                    <!-- 검색 결과 -->
                                    <?php if(!empty($search_data)): ?>
                                    <?php foreach($search_data as $post): ?>
                                    <div class="flex flex-col border-b ">
                                        <div class="flex flex-1 p-2 ">
                                            <div class="ml-4 flex-[0.8] flex items-center">
                                                <div>
                                                    <i class='fa-solid fa-caret-up fa-xl text-gray-400'></i>
                                                    <div><?php echo $post['thumb'] ?></div>
                                                </div>
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
                                        <div class="p-4 bg-red-400" id="replies-container-<?=$post['post_id']?>"></div>

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
                        </div>


                    </div>
                    <button id="scrollTopBtn"
                        class="w-24 fixed hover:bg-green-500 bottom-16 right-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        위로<i class="fa-solid fa-arrow-up"></i>
                    </button>
                    <button id="scrollBottomBtn"
                        class="w-24 fixed bottom-4 right-4 bg-blue-500 hover:bg-green-500 text-white font-bold py-2 px-4 rounded">
                        아래로<i class="fa-solid fa-arrow-down"></i>
                    </button>


            </main>

            <!-- Rightbar -->
            <aside class="w-84">
                <?php $this->load->view('layout/rightbar'); ?>
            </aside>
        </div>


    </div>

</body>

</html>




<script>

    document.addEventListener('DOMContentLoaded', function() {
        const scrollTopBtn = document.getElementById('scrollTopBtn');
        const scrollBottomBtn = document.getElementById('scrollBottomBtn');

        function toggleScrollButtons() {
            if (window.scrollY > 200) {
                scrollTopBtn.classList.remove('hidden');
            } else {
                scrollTopBtn.classList.add('hidden');
            }

            if (window.innerHeight + window.scrollY < document.body.offsetHeight - 200) {
                scrollBottomBtn.classList.remove('hidden');
            } else {
                scrollBottomBtn.classList.add('hidden');
            }
        }

        // 페이지 로드 시 초기 스크롤 위치에 따라 버튼 표시 여부 결정
        toggleScrollButtons();

        // 스크롤 이벤트 리스너 추가
        window.addEventListener('scroll', toggleScrollButtons);

        // 최상단 버튼 클릭 이벤트 리스너
        scrollTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // 최하단 버튼 클릭 이벤트 리스너
        scrollBottomBtn.addEventListener('click', function() {
            window.scrollTo({
                top: document.body.scrollHeight,
                behavior: 'smooth'
            });
        });
    });



function createPostHtml(post) {

    var postStyle = post.is_notice == 1 ? "bg-blue-100 border-b border-gray-300" :
        "hover:bg-gray-200"; // 공지사항인 경우 다른 배경 적용
    var titleStyle = post.is_notice == 1 ? " text-blue-500 font-bold" : "";
    var headerStyle = post.is_notice == 1 ?
        "<div class='m-auto'><div class='text-red-500 bg-red-200 rounded-lg'>공지</div></div>" :
        "<div><i class='fa-solid fa-caret-up fa-xl text-gray-400'></i></div>";
    var thumbhide = post.is_notice == 1 ? " " : "";


    var postHtml = '<div class="flex flex-col border-b answer-row ' + postStyle + '">';
    postHtml +=
        '    <div class="flex flex-1 p-2  hover:bg-gray-200 cursor-pointer" onclick="window.location.href=\'/posts/free/' +
        post.post_id + '\'">';
    postHtml += '        <div class="ml-4 flex-[1] flex flex-col items-center ">';
    postHtml += '            ' + headerStyle + '';

    if (post.is_notice != 1) {
        postHtml += '        <div>' + post.thumb + '</div>';
    }

    postHtml += '        </div>';
    postHtml += '        <div class="flex-[4] m-auto">';
    postHtml += '            <div class="flex">';
    postHtml += '                <div class="' + titleStyle + '">' + post.title + '</div>';
    if (post.comment_count > 0) {
    postHtml += '<div class="ml-2 text-red-500">[' + post.comment_count + ']</div>';
}
    if (post.file_count > 0) {
        postHtml += '<div class="ml-2 text-blue-500"><i class="fa-solid fa-paperclip"></i></div>';
    }
    if (post.content && /!\[.*\]\(http.*\)/.test(post.content)) {
        postHtml += '<div class="ml-1 text-green-500"><i class="fa-solid fa-image"></i></div>';
    }
    postHtml += '            </div>';
    postHtml += '            <div class="flex">';
    postHtml += '                <div class="font-base text-gray-500">' + post.channel_name + '</div>';
    if (post.replies > 1) {
        postHtml +=
            '    <a href="#" class="view-replies ml-2 text-red-500 hover:text-blue-800" onclick="event.stopPropagation(); loadReplies(' +
            post.post_id + '); return false;">답글보기[' + post.replies + ']</a>';
    }
    postHtml += '            </div>';
    postHtml += '        </div>';
    postHtml += '        <div class="flex-[2] m-auto ' + titleStyle + ' ">' + post
        .user_id + '</div>';
    postHtml += '        <div class="flex-1 m-auto"><i class="fa-solid fa-eye mr-2"></i>' + post.views + '</div>';
    postHtml += '        <div class="flex-[2] m-auto"><i class="fa-regular fa-clock mr-2"></i>' + post.create_date +
        '</div>';
    postHtml += '    </div>';
    postHtml += '    <div id="replies-container-' + post.post_id + '" style="display: none;"></div>';
    postHtml += '</div>';

    return postHtml;
}



var currentSearchQuery = "";

function searchPosts() {

    var channel_id = document.getElementById('channel-id').value; 

    

    console.log(channel_id);
    

    var selectedPast = document.getElementById('search-past').value;

    var selectedOption = document.getElementById('search-options').value;

    var searchQuery = document.getElementById('search').value;

    currentSearchQuery = searchQuery;

    $.ajax({
        url: '/posts/post/search',
        type: 'GET',
        dataType: 'json',
        data: {
            search: searchQuery,
            option: selectedOption,
            filter: selectedPast,
            channel_id: channel_id 
        }, 
        success: function(data) {
            if (data.search_data.length) {
                var postsHtml = '';
                data.search_data.forEach(function(post) {

                    postsHtml += createPostHtml(post);
                });

                 // 기존 페이지네이션 링크 제거
                $('.pagination').remove();

                // 페이지네이션 링크를 postsHtml에 추가
                postsHtml +=
                    '<div class="mt-6 mb-6"><div class="flex justify-center"><div class="pagination mb-4"><div class="pagination">' +
                    data.link + '</div></div></div></div>';
                console.log(data.paginationLinks);
                $('#posts-container').html(postsHtml);

            } else {
                $('#posts-container').html('<div class="flex justify-center m-4 font-bold text-lg">' + data
                    .no_results + '</div>');

            }
        }

    });

    $(document).off('click', '.pagination a').on('click', '.pagination a', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        console.log('다음페이지주소:', href); // 디버깅을 위한 로그

        var urlParams = new URLSearchParams(href.split('?')[1]);
        var page = urlParams.get('page');

        console.log('번호추출', page);
        loadPage(page, 'search'); // 추출된 페이지 번호와 검색 정렬 방식 전달
    });


    return false;
}



function loadPage(page, sort, channelId) {


    console.log('페이지:', page, '정렬:', sort, '채널아이디:', channelId);

    var url = '/posts/all/page/' + page;

    // 먼저 channelId가 있는 경우 처리
    if (channelId) {
        url = '/posts/channel_id/' + channelId + '/page/' + page;
    }

    // 그 다음 sort에 따라 URL 조정
    if (sort === 'newest') {
        if (channelId) {
            // 특정 채널의 'newest' 정렬된 페이지 URL
            url = '/posts/post/LatestOrderBy_Channel/' + channelId + '/page/' + page;

        } else {
            url = '/posts/all/newest/page/' + page;
        }

    } else if (sort === 'thumb') {
        if (channelId) {
            url = '/posts/post/ThumbOrderBy_Channel/' + channelId + '/page/' + page;
        } else {
            url = '/posts/all/thumb/page/' + page;
        }

    } else if (sort === 'views') {
        if (channelId) {
            url = '/posts/post/ViewsOrderBy_Channel/' + channelId + '/page/' + page;
        } else {
            url = '/posts/all/views/page/' + page;
        }

    } else if (sort === 'search') {
        url = '/posts/search?search=' + encodeURIComponent(currentSearchQuery) + '&page=' + page;
    }

    console.log(url);


    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var postsHtml = '';

            var postsArray = sort === 'search' ? data.search_data : data.posts;
            if (postsArray && Array.isArray(postsArray)) {
                postsArray.forEach(function(post) {
                    postsHtml += createPostHtml(post);
                });
            } else if (data.get_list && Array.isArray(data.get_list)) {
                data.get_list.forEach(function(post) {
                    postsHtml += createPostHtml(post);
                });


            } else {
                console.error("Invalid data format or empty array");
            }


            // 기존 페이지네이션 링크 제거
            $('.pagination').remove();

            // 새 페이지네이션 링크 추가
            if (data.link) {
                postsHtml +=
                    '<div class="mt-6 mb-6"><div class="flex justify-center"><div class="pagination mb-4">' +
                    data.link + '</div></div></div>';
            }

            $('#posts-container').html(postsHtml);



        },
        error: function(error) {
            console.error('Error:', error);
        }

    });
}


// 전체글 페이지네이션 링크
// http://localhost/posts/all/page/2
// http://localhost/posts/channel_id/6/page/2
$(document).off('click', '.pagination a').on('click', '.pagination a', function(e) {
    console.log('클릭됨');
    e.preventDefault();
    var page = $(this).attr('href').split('page/')[1];

    var channelId = null;
    if (window.location.pathname.includes('/channel_id/')) {
        channelId = window.location.pathname.split('/channel_id/')[1].split('/')[0];
    }

    loadPage(page, 'sort', channelId);
});




var currentChannelId = null;

$(document).ready(function() {
    $('.grid a').on('click', function(e) {
        e.preventDefault(); // 기본 동작 방지
        var channelId = $(this).data('channel-id');
        window.location.href = '/posts/channel_id/' + channelId;
        Channel(channelId);
    });
});


function Channel(channelId) {

    console.log('채널 함수들어옴');

    currentChannelId = channelId;

    console.log(currentChannelId);

    var url = '/posts/channel_id/' + currentChannelId + '/page/1'; // 'page/1'로 초기 페이지 설정

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var postsHtml = '';
            data.get_list.forEach(function(post) {
                postsHtml += createPostHtml(post);
            });


            document.getElementById('posts-container').innerHTML = postsHtml;


        },
        error: function(error) {
            console.error('Error:', error);
        }
    });

    // 페이지네이션 링크 클릭 이벤트 설정
    $(document).off('click', '.pagination a').on('click', '.pagination a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page/')[1];
        loadPage(page, 'sortType', currentChannelId); // 현재 채널 ID를 사용하여 loadPage 호출
    });
}



function getChannelIdFromUrl() {
    var pathSegments = window.location.pathname.split('/');
    // URL의 경로 부분을 '/' 기준으로 나누어 배열로 만들기
    // 예: "http://localhost/posts/channel_id/6" -> ["", "posts", "channel_id", "6"]

    var channelIdIndex = pathSegments.indexOf('channel_id');
    // 'channel_id' 문자열이 있는 인덱스를 찾기

    if (channelIdIndex > -1 && channelIdIndex < pathSegments.length - 1) {
        return pathSegments[channelIdIndex + 1];
        // 'channel_id' 다음 세그먼트가 실제 ID 값
    }

    return null; // 'channel_id'가 URL에 없는 경우
}



function LatestOrderBy(channelId) {

    var url = '/posts/post/LatestOrderBy';
    if (channelId) {
        url = '/posts/post/LatestOrderBy_Channel/' + channelId;
    }


    console.log(url);

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data);
            var postsHtml = '';
            data.posts.forEach(function(post) {
                postsHtml += createPostHtml(post);
            });

            // 기존 페이지네이션 링크 제거
            $('.pagination').remove();
            // 페이지네이션 링크를 postsHtml에 추가
            postsHtml +=
                '<div class="mt-6 mb-6"><div class="flex justify-center"><div class="pagination mb-4"><div class="pagination">' +
                data.link + '</div></div></div></div>';

            // 게시글 목록과 페이지네이션 링크 업데이트
            document.getElementById('posts-container').innerHTML = postsHtml;


        },
        error: function(error) {
            console.error('Error:', error);
        }
    });

    // 페이지네이션 링크 클릭 이벤트 설정
    $(document).off('click', '.pagination a').on('click', '.pagination a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page/')[1];
        var channelId = null;
        if (window.location.pathname.includes('/channel_id/')) {
            channelId = window.location.pathname.split('/channel_id/')[1].split('/')[0];
        }
        loadPage(page, 'newest', channelId);
    });
}



function ThumbOrderBy(channelId) {

    var url = '/posts/post/ThumbOrderBy';
    if (channelId) {
        url = '/posts/post/ThumbOrderBy_Channel/' + channelId;
    }

    console.log(url);

    // AJAX 요청을 통해 서버에 최신순 정렬 요청
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var postsHtml = '';
            data.posts.forEach(function(post) {
                postsHtml += createPostHtml(post);
            });

            // 기존 페이지네이션 링크 제거
            $('.pagination').remove();

            postsHtml +=
                '<div class="mt-6 mb-6"><div class="flex justify-center"><div class="pagination mb-4"><div class="pagination">' +
                data.link + '</div></div></div></div>';

            // 기존 목록을 새 목록으로 대체
            document.getElementById('posts-container').innerHTML = postsHtml;
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });

    // 페이지네이션 링크 클릭 이벤트 설정
    $(document).off('click', '.pagination a').on('click', '.pagination a', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        console.log('다음페이지주소:', href);
        var page = $(this).attr('href').split('page/')[1];

        var channelId = null;
        if (window.location.pathname.includes('/channel_id/')) {
            channelId = window.location.pathname.split('/channel_id/')[1].split('/')[0];
        }
        loadPage(page, 'thumb', channelId);
    });


}




function ViewsOrderBy(channelId) {

    var url = '/posts/post/ViewsOrderBy';
    if (channelId) {
        url = '/posts/post/ViewsOrderBy_Channel/' + channelId;
    }

    console.log(url);


    // AJAX 요청을 통해 서버에 최신순 정렬 요청
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var postsHtml = '';
            data.posts.forEach(function(post) {
                postsHtml += createPostHtml(post);
            });

            // 기존 페이지네이션 링크 제거
            $('.pagination').remove();

            postsHtml +=
                '<div class="mt-6 mb-6"><div class="flex justify-center"><div class="pagination mb-4"><div class="pagination">' +
                data.link + '</div></div></div></div>';

            // 기존 목록을 새 목록으로 대체
            document.getElementById('posts-container').innerHTML = postsHtml;
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });

    // 페이지네이션 링크 클릭 이벤트 설정
    $(document).off('click', '.pagination a').on('click', '.pagination a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page/')[1];
        var channelId = null;
        if (window.location.pathname.includes('/channel_id/')) {
            channelId = window.location.pathname.split('/channel_id/')[1].split('/')[0];
        }
        loadPage(page, 'views', channelId);
    });
}


$(document).ready(function() {
    var isNoticesHidden = localStorage.getItem('noticesHidden') === 'true';
    $('#toggleNoticesCheckbox').prop('checked', isNoticesHidden);
    hideNotices(); 
    loadNotices();
});



function hideNotices() {
    var noticesContainer = $('#notices-container');
    var isNoticesHidden = $('#toggleNoticesCheckbox').is(':checked');

    if (isNoticesHidden) {
        noticesContainer.hide();
    } else {
        noticesContainer.show();
    }

    localStorage.setItem('noticesHidden', isNoticesHidden.toString());

    
}


function toggleNoticesVisibility() {
    var noticesContainer = $('#notices-container');
    var isNoticesHidden = $('#toggleNoticesCheckbox').is(':checked');

    if (isNoticesHidden) {
        noticesContainer.hide();
    } else {
        noticesContainer.show();
    }
}



function loadNotices() {

    var url = window.location.pathname;
    var isChannelPage = url.includes('/channel_id/');
    var apiUrl = '/posts/post/get_notices';

    if (isChannelPage) {
        var channelId = url.split('/channel_id/')[1];
        apiUrl += '/channel/' + channelId; // 채널별 API 경로 조정
    }
    
    console.log(apiUrl);

    $.ajax({
        url: apiUrl,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            var noticesHtml = '';
            if (response && response.data && Array.isArray(response.data)) {
                var noticesHtml = '';
                response.data.forEach(function(notice) {
                    noticesHtml += '<div class="flex flex-col border-b answer-row ' + (notice.is_notice == 1 ? 'notice-post' : '') + '">';
                    noticesHtml += '    <div class="flex flex-1 p-2 border-b border-gray-300 bg-blue-100 cursor-pointer" onclick="window.location.href=\'/posts/free/' + encodeURIComponent(notice.post_id) + '\'">';
                    noticesHtml += '        <div class="ml-4 flex-[1] flex flex-col items-center ">';
                    noticesHtml += '            <div class="m-auto">';
                    noticesHtml += '                <div class="text-red-500 bg-red-200 rounded-lg">공지</div>';
                    noticesHtml += '            </div>';
                    noticesHtml += '        </div>';
                    noticesHtml += '        <div class="flex-[4] m-auto">';
                    noticesHtml += '            <div class="flex">';
                    noticesHtml += '                <div class="text-blue-500 font-bold">' + notice.title + '</div>';
                    if (notice.comment_count > 0) {
                        noticesHtml += '<div class="ml-1 text-red-500">[' + notice.comment_count + ']</div>';
                    }
                    if (notice.file_count > 0) {
                        noticesHtml += '            <div>[파일있음]</div>';
                    }
                    noticesHtml += '            </div>';
                    noticesHtml += '            <div class="flex">';
                    noticesHtml += '                <div class="font-base text-gray-500">' + notice.channel_name + '</div>';
                    if (notice.reply_count > 0) {
                        noticesHtml += '            <a href="#" class="view-replies ml-2 text-red-500 hover:text-blue-800" onclick="event.stopPropagation(); loadReplies(' + encodeURIComponent(notice.post_id) + '); return false;">답글보기</a>';
                    }
                    noticesHtml += '            </div>';
                    noticesHtml += '        </div>';
                    noticesHtml += '        <div class="flex-[2] m-auto text-blue-500 font-bold">' + notice.user_id + '</div>';
                    noticesHtml += '        <div class="flex-1 m-auto"><i class="fa-solid fa-eye mr-1"></i>' + notice.views + '</div>';
                    noticesHtml += '        <div class="flex-[2] m-auto"><i class="fa-regular fa-clock mr-2"></i>' + notice.create_date + '</div>';
                    noticesHtml += '    </div>';
                    noticesHtml += '    <div id="replies-container-' + encodeURIComponent(notice.post_id) + '" style="display: none;"></div>';
                    noticesHtml += '</div>';
                });

                $('#notices-container').html(noticesHtml).show();
            }
            else {
                console.error("Invalid response format");
            }
            $('#notices-container').html(noticesHtml);
            toggleNoticesVisibility();
        },

        error: function() {
            // 에러 처리
        }
    });
}



function loadReplies(postId) {

    var repliesContainer = $('#replies-container-' + postId);
    

    // 답글이 이미 표시되어 있으면 숨김
    if (repliesContainer.is(":visible")) {
        repliesContainer.hide();
        
    } else {

        repliesContainer.addClass(' bg-gray-200'); 
        $.ajax({
        url: '/posts/post/get_replies',
        data: {
            post_id: postId
        },
        dataType: 'json',
        success: function(response) {

            if (response.status) {
                var repliesHtml = '';
                response.data.forEach(function(reply) {

                    if (reply.delete_status == 0 ){
                  
                    repliesHtml += '<div class="overflow-x-auto shadow-md">'
                    repliesHtml += '    <div class="flex flex-col border-b bg-white ">';
                    
                    repliesHtml += '    <div class="flex flex-1 p-1 ml-36 mt-2 mb-2">';
                    
                    repliesHtml += '        <div class="ml-' + (reply.re_level * 12) +
                        ' flex-[0.1] flex items-center">';
                    repliesHtml += '            <div>↳</div>'; // 들여쓰기 표시
                    repliesHtml += '        </div>';
                    repliesHtml +=
                        '        <div class="flex-[3] hover:text-red-500 cursor-pointer" onclick="redirectToPost(' +
                        reply.post_id + ');">';
                    repliesHtml += '         <div class="flex">';
                    repliesHtml += '           <div>' + reply.title + '</div>';
                  
                    if (reply.file_count > 0) {
                        repliesHtml +=
                            '<div class="ml-2 text-blue-500"><i class="fa-solid fa-paperclip"></i></div>';
                    }
                    
                    if (reply.content && /<img\s+[^>]*src="[^"]+"/.test(reply.content)) {
                        repliesHtml += '<div class="ml-1 text-green-500"><i class="fa-solid fa-image"></i></div>';
                    }


                    repliesHtml += '        </div>';
                    repliesHtml += '        <div class="flex">';
                    repliesHtml += '           <div>' + reply.channel_name + '</div>';
                    repliesHtml += '           <div class="ml-2">' + reply.user_id + '</div>';
                    repliesHtml += '           <div class="ml-2">조회 ' + reply.views +
                        '</div>'; // 조회수
                    repliesHtml += '               <div class="ml-2 text-gray-400">' + reply
                        .create_date + '</div>';
                    repliesHtml += '           </div>';
                    repliesHtml += '        </div>';
                    repliesHtml += '    </div>';
                    repliesHtml += '</div>';
                    repliesHtml += '</div>';

                }else{
                    repliesHtml += '<div class="overflow-x-auto shadow-md">'
                    repliesHtml += '    <div class="flex flex-col border-b bg-white ">';
                    
                    repliesHtml += '    <div class="flex flex-1 p-1 ml-36 mt-2 mb-2">';
                    
                    repliesHtml += '        <div class="ml-' + (reply.re_level * 12) +
                        ' flex-[0.1] flex items-center">';
                    repliesHtml += '            <div>↳</div>'; // 들여쓰기 표시
                    repliesHtml += '        </div>';
                    repliesHtml +=
                        '        <div class="flex-[3]">';
                    repliesHtml += '         <div class="flex">';
                    repliesHtml += '           <div class="text-red-500"> 삭제된 게시글 입니다.</div>';
                  
                    if (reply.file_count > 0) {
                        repliesHtml +=
                            '<div class="ml-2 text-blue-500"><i class="fa-solid fa-paperclip"></i></div>';
                    }

                    if (reply.content && /!\[.*\]\(http.*\)/.test(reply.content)) {
                        repliesHtml +=
                            '<div class="ml-1 text-green-500"><i class="fa-solid fa-image"></i></div>';
                    }

                    repliesHtml += '        </div>';
                    repliesHtml += '        <div class="flex">';
         
      
             
                        '</div>'; // 조회수
               
                    repliesHtml += '           </div>';
                    repliesHtml += '        </div>';
                    repliesHtml += '    </div>';
                    repliesHtml += '</div>';
                    repliesHtml += '</div>';
                }
                });


                $('#replies-container-' + postId).html(repliesHtml).show();
            } else {
                // 오류 처리
            }
        }
    });
    }


    


}

function redirectToPost(postId) {

    window.location.href = '/posts/free/' + postId;
}

$(document).ready(function() {
    $('.flex-[3].hover:text-red-500').on('click', function() {
        var postId = $(this).data('post-id');
        redirectToPost(postId);
    });
});


function redirectToURL() {

    <?php if(!$this->session->userdata('user_id')): ?>
    alert('로그인이 필요한 기능입니다.');
    window.location.href = '/login';
    <?php else: ?>
    window.location.href = '/posts/write';
    <?php endif; ?>


}




// document.addEventListener('DOMContentLoaded', function () {
//     const navbar = document.querySelector('nav');
//     const search = document.querySelector('.searchbox');
//     const sidebar = document.querySelector('.sidebarbox');



//     // 원래 sidebar의 너비 계산
//     const originalSidebarWidth = sidebar.offsetWidth + 'px';
//     const originalSearchWidth = search.offsetWidth + 'px';

//     if (navbar && content && sidebar) {

//         const navbarHeight = navbar.offsetHeight;
//         const contentTop = content.getBoundingClientRect().top + window.scrollY - navbarHeight;

//         window.addEventListener('scroll', function(){
//             if(window.scrollY >= contentTop){
//                 sidebar.classList.add('fixed');
//                 search.classList.add('fixed');
//                 sidebar.style.top = `${navbarHeight}px`;
//                 search.style.top = `${navbarHeight}px`;

//                 sidebar.style.width = originalSidebarWidth; 
//                 search.style.width = originalSearchWidth; // 고정 상태에서 원래 너비 적용
//             } else {
//                 sidebar.classList.remove('fixed');
//                 sidebar.style.top = '';
//                 sidebar.style.width = ''; // 너비 스타일 제거

//                  // searchbox 스타일 초기화
//                 search.classList.remove('fixed');
//                 search.style.top = '';
//                 search.style.width = '';
//                 search.style.zIndex = '50';
//                 search.style.backgroundColor = '';
//             }
//         });
//     } 
// });
</script>