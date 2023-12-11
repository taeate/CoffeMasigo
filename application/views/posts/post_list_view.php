<?php $this->load->view('layout/header'); ?>

<body>

<div class="flex flex-col lg:flex-row flex-container ml-[350px] mr-[350px] mt-[200px] mb-[200px]">


    <!-- 사이드바 -->
    <div class="w-80">
        <?php $this->load->view('layout/sidebar'); ?>
    </div>

    
    <!-- 리스트 페이지 컨텐츠 -->
    <div id="content" class="flex w-3/4 flex-col contentbox ml-4 z-10">

        <div name="top-box" class="flex flex-col w-full">
            <div name="search-nav" class="searchbox z-30 h-auto bg-base-100 place-items-center shadow-md">

                <div class="m-4">
                    <div class="flex justify-between w-full">
                        <div class="flex">
                            <div class="text-xl font-bold">전체글</div>
                        </div>
                        <div>
                            <div class="mt-2 mb-2 mr-2">
                                <button onclick="redirectToURL()"><i class="text-blue-600 fa-solid fa-pen fa-xl"></i></button>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="m-4 flex justify-between items-center">

                    <div name="order-by">
                        <div class="flex">
                            <div>
                                <button class="btn btn-sm btn-accent hover:text-white" onclick="LatestOrderBy()">
                                <i class="fa-solid fa-clock-rotate-left"></i>최신</button>
                            </div>
                            <div class="ml-4">
                                <button class="btn btn-sm btn-accent hover:text-white" onclick="ThumbOrderBy()">
                                <i class="fa-solid fa-thumbs-up"></i>추천수</button>
                            </div>
                            <div class="ml-4">
                                <button class="btn btn-sm btn-accent hover:text-white" onclick="ViewsOrderBy()">
                                <i class="fa-solid fa-eye"></i>조회수</button>
                            </div>
                            <!-- <div class="ml-4">
                                <button class="btn btn-sm btn-accent hover:text-white"  onclick="toggleNotices()">공지숨기기</button>
                            </div> -->
                            
                        </div>
                    </div>
                        
                    


                    <div name="" class="w-68 ml-4">
                  
                    <form onsubmit="return searchPosts();" action="" method="get">
                        <div class="flex">

                        <div name="select-box" class="ml-auto">
                        <select id="search-past" class="w-28 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>전체</option>
                        <option value="last_day">지난 1일</option>
                        <option value="last_week">지난 1주일</option>
                        <option value="last_month">지난 1개월</option>
                        <option value="last_year">지난 1년</option>
                        </select>
                        </div>
                            <!-- Label for Email (hidden for screen readers) -->
                            <label for="location-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your Email</label>
                            
                            <!-- Select Dropdown for Search Options -->
                            <div name="select-box" class="ml-auto">
                                <select id="search-options" class="w-28 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="title-content" selected>제목+내용</option>
                                    <option value="title">제목</option>
                                    <option value="content">내용</option>
                                    <option value="author">작성자</option>
                                </select>
                            </div>

                            <!-- Search Input -->
                            <div class="relative w-full">
                                <input type="text" name="search" id="search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="검색" required>
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

                <!-- <div class="stat-desc text-secondary">31 tasks remaining</div>   $data['user_role'] = $user_role;-->
            </div>
            
        </div>
    </div>
            <body class="bg-base-300">
                    
                <!-- 리스트 페이지의 내용 -->
                <div class="bg-base-100 mt-4">

                    <div class="overflow-x-auto shadow-md">
                        <!-- 메인 글 -->
                        <?php if(isset($get_list)): ?>
                        <div id="posts-container">
                        <?php foreach($get_list as $post): ?>
                            <?php if($post->is_notice == 1): ?>
                                <div  class="flex flex-col border-b answer-row" >
                                <div class="flex flex-1 p-2 border-b border-gray-300 bg-blue-100 cursor-pointer "onclick="window.location.href='/posts/free/<?=$post->post_id?>'">
                                    <div class="ml-4 flex-[1] flex flex-col items-center ">
                                        <div class="m-auto"><i class="fa-solid fa-flag fa-xl text-blue-400"></i></div>
                                        <div class=""></div>
                                    </div>
                                    <div class="flex-[4] m-auto">
                                        <div class="flex">
                                            <div class="text-blue-500 font-bold"><?php echo $post->title; ?></div>
                                            <div class="ml-1 text-red-500">[<?php echo $post->comment_count; ?>]</div>
                                            <?php if($post->file_count > 0): ?>
                                                <div>[파일있음]</div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex">
                                            <div class="font-base text-gray-500">자유</div>

                                                <!-- 답글이 있을 때만 버튼이 보임 -->
                                                <?php if($post->replies > 1): ?>
                                                    <a href="#" class="view-replies ml-2 text-red-500 hover:text-blue-800" onclick="event.stopPropagation(); loadReplies(<?=$post->post_id?>); return false;">답글보기</a>
                                                <?php endif; ?>

                                             
                                        </div>
                                    </div>
                                    <div class="flex-[2] m-auto text-blue-500 font-bold"><?php echo $post->user_id ?></div>
                                    <div class="flex-1 m-auto">
                                    <i class="fa-solid fa-eye"></i>
                                    <?php echo $post->views ?>
                                    </div>
                                    <div class="flex-[2] m-auto"><i class="fa-regular fa-clock mr-2"></i><?php echo $post->create_date?></div>
                                    
                                </div>
                                <div id="replies-container-<?=$post->post_id?>" style="display: none;"></div>
                                
                            <?php else: ?>
                          
                            <div  class="flex flex-col border-b answer-row" >
                                <div class="flex flex-1 p-2 hover:bg-gray-200 cursor-pointer "onclick="window.location.href='/posts/free/<?=$post->post_id?>'">
                                    <div class="ml-4 flex-[1] flex flex-col items-center ">
                                        <div><i class="fa-solid fa-caret-up fa-xl text-gray-400"></i></div>
                                        <div class=""><?php echo $post->thumb; ?></div>
                                    </div>
                                    <div class="flex-[4] m-auto">
                                        <div class="flex">
                                            <div><?php echo $post->title; ?></div>
                                            <div class="ml-2 text-red-500">[<?php echo $post->comment_count; ?>]</div>
                                            <?php if($post->file_count > 0): ?>
                                                <div  class="ml-2 text-blue-500"><i class="fa-solid fa-paperclip"></i></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex">
                                            <div class="font-base text-gray-500">자유</div>

                                                <!-- 답글이 있을 때만 버튼이 보임 -->
                                                <?php if($post->replies > 1): ?>
                                                    <a href="#" class="view-replies ml-2 text-red-500 hover:text-blue-800" onclick="event.stopPropagation(); loadReplies(<?=$post->post_id?>); return false;">답글보기</a>
                                                <?php endif; ?>

                                             
                                        </div>
                                    </div>
                                    <div class="flex-[2] m-auto "><?php echo $post->user_id ?></div>
                                    <div class="flex-1 m-auto">
                                    <i class="fa-solid fa-eye"></i>
                                    <?php echo $post->views ?>
                                    </div>
                                    <div class="flex-[2] m-auto"><i class="fa-regular fa-clock mr-2"></i><?php echo $post->create_date?></div>
                                    
                                </div>
                                <div id="replies-container-<?=$post->post_id?>" style="display: none;"></div>
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
        
    <!-- <div class="" >
    <?php $this->load->view('layout/rightbar'); ?>
    </div> -->
    <div></div>

  
</div>

</body>

<!-- <?php $this->load->view('layout/footer'); ?> -->
<script>





var currentSearchQuery = ""; 

function searchPosts() {

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
                filter: selectedPast
            }, // 검색어를 서버로 전송
            success: function(data) {
            if (data.search_data.length) {
                var postsHtml = '';
                data.search_data.forEach(function(post) {
                 
                    postsHtml += createPostHtml(post); 
                });
                
                // 페이지네이션 링크를 postsHtml에 추가
                postsHtml += '<div class="mt-6 mb-6"><div class="flex justify-center"><div class="pagination mb-4"><div class="pagination">' + data.paginationLinks + '</div></div></div></div>';
                console.log(data.paginationLinks);
                $('#posts-container').html(postsHtml); 
                
            } else {
                $('#posts-container').html('<div class="flex justify-center m-4 font-bold text-lg">' + data.no_results + '</div>');
                
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



function loadPage(page, sort) {
    console.log(page,sort);



    var url = '/posts/all/page/' +page

    if (sort === 'thumb') {
        url = '/posts/all/thumb/page/' + page;
    }

    if (sort === 'newest') {
        url = '/posts/all/newest/page/' + page;
    }

    if (sort === 'views') {
        url = '/posts/all/views/page/' + page;
    }

      if (sort === 'search') {

        url = '/posts/search?search=' + encodeURIComponent(currentSearchQuery) + '&page=' + page;
  
    } 
    


 


    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data);
            var postsHtml = '';

            var postsArray = sort === 'search' ? data.search_data : data.posts;
                if (postsArray && Array.isArray(postsArray)) {
                    postsArray.forEach(function(post) {
                        postsHtml += createPostHtml(post);
                    });
                } else {
                console.error("Invalid data format or empty array");
            }

            // 페이지네이션 링크를 postsHtml에 추가
            postsHtml += '<div class="mt-6 mb-6"><div class="flex justify-center"><div class="pagination mb-4"><div class="">' + data.paginationLinks + '</div></div></div></div>';

            // postsHtml에 게시글 목록과 페이지네이션 링크를 모두 포함시킨 후 #posts-container에 적용
            $('#posts-container').html(postsHtml);
        },
        error: function(error) {
            console.error('Error:', error);
        }
        
    });
}

// 전체글 페이지네이션 링크
$(document).on('click', '.pagination a', function(e) {
    console.log('클릭됨');
    e.preventDefault();
    var page = $(this).attr('href').split('page/')[1];
        loadPage(page);
    
});

function createPostHtml(post) {
    
    var postStyle = post.is_notice == 1 ? "bg-blue-100 border-b border-gray-300"  : "hover:bg-gray-200"; // 공지사항인 경우 다른 배경 적용
    var titleStyle = post.is_notice == 1 ? " text-blue-500 font-bold" : "";
    var headerStyle = post.is_notice == 1 ? "<div class='m-auto'><i class='fa-solid fa-flag fa-xl text-blue-400'></i></div>" : "<div><i class='fa-solid fa-caret-up fa-xl text-gray-400'></i></div>";
    var thumbhide = post.is_notice == 1 ? " " : "";

    
    var postHtml = '<div class="flex flex-col border-b answer-row ' + postStyle + '">';
    postHtml += '    <div class="flex flex-1 p-2  hover:bg-gray-200 cursor-pointer" onclick="window.location.href=\'/posts/free/' + post.post_id + '\'">';
    postHtml += '        <div class="ml-4 flex-[1] flex flex-col items-center ">';
    postHtml += '            '+headerStyle+'';

    if (post.is_notice != 1) {
        postHtml += '        <div>' + post.thumb + '</div>';
    }
    
    postHtml += '        </div>';
    postHtml += '        <div class="flex-[4] m-auto">';
    postHtml += '            <div class="flex">';
    postHtml += '                <div class="'+titleStyle+'">' + post.title + '</div>';
    postHtml += '                <div class="ml-2 text-red-500">[' + post.comment_count + ']</div>';
    if (post.file_count > 0) {
    postHtml += '<div class="ml-2 text-blue-500"><i class="fa-solid fa-paperclip"></i></div>';
}
    postHtml += '            </div>';
    postHtml += '            <div class="flex">';
    postHtml += '                <div class="font-base text-gray-500">자유</div>';
    if (post.replies > 1) {
        postHtml += '    <a href="#" class="view-replies ml-2 text-red-500 hover:text-blue-800" onclick="event.stopPropagation(); loadReplies(' + post.post_id + '); return false;">답글보기</a>';
    }
    postHtml += '            </div>';
    postHtml += '        </div>';
    postHtml += '        <div class="flex-[2] m-auto '+titleStyle+' "><i class="fa-solid fa-user mr-2"></i>' + post.user_id + '</div>';
    postHtml += '        <div class="flex-1 m-auto"><i class="fa-solid fa-eye mr-2"></i>' + post.views + '</div>';
    postHtml += '        <div class="flex-[2] m-auto"><i class="fa-regular fa-clock mr-2"></i>' + post.create_date + '</div>';
    postHtml += '    </div>';
    postHtml += '    <div id="replies-container-' + post.post_id + '" style="display: none;"></div>';
    postHtml += '</div>';

    return postHtml;
}

function LatestOrderBy() {
    $.ajax({
        url: '/posts/post/LatestOrderBy',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data);
            var postsHtml = '';
            data.posts.forEach(function(post) {
               postsHtml += createPostHtml(post);
            });

             // 페이지네이션 링크를 postsHtml에 추가
             postsHtml += '<div class="mt-6 mb-6"><div class="flex justify-center"><div class="pagination mb-4"><div class="pagination">' + data.paginationLinks + '</div></div></div></div>';

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
        loadPage(page, 'newest');
    });
}



function ThumbOrderBy() {


// AJAX 요청을 통해 서버에 최신순 정렬 요청
$.ajax({
    url: '/posts/post/ThumbOrderBy',
    type: 'GET',
    dataType: 'json',
    success: function(data) {
        var postsHtml = '';
        data.posts.forEach(function(post) {
            postsHtml +=createPostHtml(post);
        });

        postsHtml += '<div class="mt-6 mb-6"><div class="flex justify-center"><div class="pagination mb-4"><div class="pagination">' + data.paginationLinks + '</div></div></div></div>';

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
    loadPage(page, 'thumb');
});


}




function ViewsOrderBy() {


// AJAX 요청을 통해 서버에 최신순 정렬 요청
$.ajax({
    url: '/posts/post/ViewsOrderBy',
    type: 'GET',
    dataType: 'json',
    success: function(data) {
        var postsHtml = '';
        data.posts.forEach(function(post) {
            postsHtml +=createPostHtml(post);
        });

        postsHtml += '<div class="mt-6 mb-6"><div class="flex justify-center"><div class="pagination mb-4"><div class="pagination">' + data.paginationLinks + '</div></div></div></div>';

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
            loadPage(page, 'views');
    });
}


var showNotices = true; // 초기 상태는 공지사항을 보여주는 것으로 설정

function toggleNotices() {
    showNotices = !showNotices; // 상태 토글
    is_notice_hidden(showNotices); // 변경된 상태로 함수 호출
}

function is_notice_hidden(showNotices) {

    var url = showNotices ? '/posts/post/get_posts_json' : '/posts/post/is_notice_hidden'; 

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
        error: function(xhr, status, error) {
    console.error('AJAX Error:', xhr.status, xhr.responseText);
}
    });
}





function loadReplies(postId) {


    $.ajax({
        url:'/posts/post/get_replies',
        data: {post_id: postId},
        dataType: 'json',
        success: function(response) {
            
            if(response.status) {
                var repliesHtml = '';
                response.data.forEach(function(reply) {
                repliesHtml +=   '<div class="overflow-x-auto shadow-md">'
                repliesHtml += '    <div class="flex flex-col border-b bg-base-200 ">';
                repliesHtml += '    <div class="flex flex-1 p-1 ml-36 mt-2 mb-2">';
                repliesHtml += '        <div class="ml-' + (reply.re_level * 12) + ' flex-[0.1] flex items-center">';
                repliesHtml += '            <div>↳</div>'; // 들여쓰기 표시
                repliesHtml += '        </div>';
                repliesHtml += '        <div class="flex-[3] hover:text-red-500">';
                repliesHtml += '            ' + reply.title + ''; // 답글 제목
                repliesHtml += '            <div class="flex">';
                repliesHtml += '                <div>자유</div>'; 
                repliesHtml += '        <div class="ml-2">' + reply.user_id + '</div>';
                repliesHtml += '        <div class="ml-2">조회 ' + reply.views + '</div>'; // 조회수
                repliesHtml += '        <div class="ml-2 text-gray-400">' + reply.create_date + '</div>';
                repliesHtml += '            </div>';
                repliesHtml += '        </div>';
                repliesHtml += '    </div>';
                repliesHtml += '</div>';
                repliesHtml += '</div>';
            });


                $('#replies-container-' + postId).html(repliesHtml).show();
            } else {
                // 오류 처리
            }
        }
    });
    
   
}



function redirectToURL() {

    <?php if(!$this->session->userdata('user_id')): ?>
        alert('로그인이 필요한 기능입니다.');
        window.location.href = '/login';
    <?php else: ?>
        window.location.href = '/posts/write';
    <?php endif; ?>

    
}




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