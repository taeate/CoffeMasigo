<!-- 헤더 -->
<?php $this->load->view('layout/header'); ?>


<!-- 컨텐츠영역 -->
<div class="flex flex-container xl:mx-[400px] gap-10">

    <!-- 사이드바 -->
    <div class="w-80 hidden md:block">
        <?php $this->load->view('layout/sidebar'); ?>
    </div>

    <div class="bg-base-100 p-10 w-full">
        <div class="">
            <div class="">
                <div name="title" class="flex flex-col gap-3">
                    
                   
                    <?php if ($detail_info) : ?>
                        <?php $post_id = $detail_info->post_id; ?>
                        <?php $title = $detail_info->title; ?>
                        <?php $content = $detail_info->content; ?>
                        <?php $views = $detail_info->views; ?>
                        <?php $createdate = $detail_info->create_date; ?>
                        <?php $user_id = $detail_info->user_id; ?>
                        
                        
                        

                        <div class="text-2xl">
                            <?php echo $title ?><br>
                        </div>
                        <div class="lg:flex grid grid-cols-2 whitespace-nowrap place-items-center gap-5">
                            <div class="flex flex-none gap-3">
                                <div class="">자유</div>
                                <div class=""> <?php echo $createdate ?></div>
                                <div class=""><?php echo $user_id ?></div>
                            </div>
                            <div class="grow"></div>
                            <div class="flex flex-none gap-3">
                                <div class="">조회: <?php echo $views ?></div>
                         
                                <div class="">댓글: <?php echo $comments_count; ?> </div>
                             
                                <div class="">추천: <?php echo $count_thumb; ?></div>
                            </div>
                        </div>
                        
                    <?php endif; ?>
                </div>
                <hr class="mr-12 ml-12">
                <div name="content " class="">
                    <div class="m-12">
                        
                        <?php echo $content ?>
                        
                       
                    </div>
                </div>
                <hr class="mr-12 ml-12">
                <div name="button-area" >
                    <div name="delete-update-btn" class="flex justify-end mr-12 mt-4">
                        <?php 
                        $user_id = $this->session->userdata('user_id');
                        if ($user_id && $user_id == $author_id): // 로그인한 사용자가 글의 작성자인 경우
                        ?>
                        <button class="btn bg-gray-500 text-white w-16 h-8 mr-2" onclick="window.location.href='/posts/edit/<?=$post_id?>'">수정</button>
                        <button class="btn bg-gray-500 text-white w-16 h-8" onclick="window.location.href='/posts/delete/<?=$post_id?>'">삭제</button>
                        <?php else: ?>
                            <?php endif; ?>
                    </div>
                    <div name="like-btn" class="flex justify-center">
                        <button data-post-id="<?php echo $post_id ?>" id="post-container" onclick="thumbUp()" class="btn bg-gray-500 text-white w-28 h-12">추천  <?php echo $count_thumb; ?></button>
                    </div>
                    
                    <div name="answer-btn" class="flex justify-between ml-12 mr-12 mt-4 mb-4">
                        <div class="">
                            <a href="/posts/write/answer_post/<?= $post_id ?>" onclick="checkLoginBeforeWrite()" class="btn bg-gray-500 text-white w-28 h-12">답글쓰기</a>
                        </div>
                        <div class="">
                        <button id="shareButton" class="btn bg-gray-500 text-white w-28 h-12">공유하기</button>
                        </div>
                    </div>
                </div>
            </div>

               

            <div class="flex flex-col w-full mt-4 ">
                <div name="commnet-name"class="h-auto card bg-base-100">
                    <div class="bg-base-200 ">
                        <div class="flex ml-8 mt-4 text-lg">
                            <div class="">
                                댓글
                                
                            </div>
                            <!-- 해당 post_id 의 댓글의 개수표시 -->
                            <?php if(isset($comments_count)): ?>
                                <div class="flex items-center justify-center text-sm ml-2">
                                    총 <?php echo $comments_count; ?>개
                                </div>
                            <?php endif; ?>
                        
                        </div>

                        <?php if ($this->session->userdata('user_id')): ?>
                        <!-- 댓글 작성 폼 -->
                        <form class="comment-form ml-8 mr-8 mt-2" method="post" id="">
                            <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                                    <label for="comment" class="sr-only">Your comment</label>
                                    <textarea id="comment" name="comment" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="댓글은 여기에 작성해주세요" required></textarea>
                                </div>
                                <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                                    <button type="submit" class="inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                        작성
                                    </button>
                                   
                                </div>
                            </div>
                        </form>
                        <?php else: ?>
                            <div class="w-96 m-auto">
                                <p class="text-red-500 font-bold text-base ml-16 mt-12 mb-12">댓글을 작성하려면 <a href="/login">로그인</a>해주세요.</p>
                            </div>
                        <?php endif; ?>
                        

                        <div class="flex ml-8 mb-4">
                            <button id="comment_orderBy_create" class="hover:text-blue-500">
                                등록순
                            </button>
                            <button id="comment_orderBy_last" class="ml-2 hover:text-blue-500">
                                최신순
                            </button>
                        </div>
                    </div>
                         
                    <div id="commentsContainer">
                    <?php foreach($comment_info as $comment) : ?>
                        <?php $comment_id = $comment->comment_id; ?>
                        <?php $user_id = $comment->user_id; ?>
                        <?php $content = $comment->comment_content; ?>
                        <?php $createdate = $comment->create_date; ?>
             
                        
                        <div name="comment-answer-area" class="<?= 'ml-' . ($comment->re_level * 8) ?>">

                            <div name="title" class="flex m-3 ml-12 mt-2 mb-2">
                                <?php if ($comment->re_level >= 1): ?>
                                        <div class="mt-3 mr-2"> ↳</div>
                                    <?php else:?>
                                        <div class="mt-3 mr-2"> </div>
                                    <?php endif; ?>
                                    
                                <div class="flex-none w-14 h-14 bg-red-500 rounded-full overflow-hidden">
                                    <img src="/uploads/<?php echo $comment->profile_image; ?>" alt="Profile Image" class="w-full h-full object-cover">
                                </div>

                                <div class="flex-grow ml-3">
                                    <div class="flex">
                                  

                                    <div class="font-bold">
                                        <?php if($user_id == !null) :?>
                                        <?php echo $user_id; ?>
                                        <?php else: ?>
                                        <div>Guest</div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="ml-2"><?php echo $createdate; ?></div>
                                    <div>
                                        <button class="reply-btn ml-2 text-sm text-red-500" data-comment-id="<?= $comment_id ?>">댓글쓰기</button> 
                                    </div>
                                    </div>
                             
                                    <div class="text-sm"><?php echo $content; ?><br></div>                  
                                </div>
                                
                            </div>

                        </div>

                     
                    <hr>


              
                    <?php endforeach; ?>
                    </div>

                    


                </div>
                
            </div>
            
        </div>
        <body class="mt-96">
        </body>
        
    </div>

    <!-- <div class="w-80 ml-4">
    <?php $this->load->view('layout/rightbar'); ?>
    </div> -->
</div>

<script>


// post_id 설정
var postId = document.getElementById('post-container').getAttribute('data-post-id'); 

// 등록순 버튼 클릭 이벤트
document.getElementById('comment_orderBy_create').addEventListener('click', function() {
    fetchComments('ASC');
});

// 최신순 버튼 클릭 이벤트
document.getElementById('comment_orderBy_last').addEventListener('click', function() {
    fetchComments('DESC');
});

function fetchComments(order) {
    $.ajax({
        url: '/posts/post/comment_orderBy_create', 
        type: 'post',
        dataType: 'json',
        data: {
            post_id: postId,
            order: order
        },
        success: function(response) {
            console.log(response)
            var commentsHtml = '';
            response.forEach(function(comment){
                commentsHtml += createCommentHtml(comment);
            });

            $('#commentsContainer').html(commentsHtml);
            
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
}




function createCommentHtml(comment) {
    var html = '';

    html += '<div class="comment-answer-area border-b ml-' + (comment.re_level * 6) + '">';
    html += '<div name="title" class="flex m-3 ml-12 mt-4 mb-4">';
    html += '<div class="flex-none w-14 h-14 bg-red-500 rounded-full overflow-hidden">';
    html += '<img src="/uploads/' + comment.profile_image + '" alt="Profile Image" class="w-full h-full object-cover">';
    html += '</div>';
    html += '<div class="flex-grow ml-3">';
    html += '<div class="flex">';

    if (comment.re_level >= 1) {
        html += '<div class=""></div>';
    }

    html += '<div class="font-bold">';
    if (comment.user_id) {
        html += comment.user_id;
    } else {
        html += '<div>Guest</div>';
    }
    html += '</div>';

    html += '<div class="ml-2">' + comment.create_date + '</div>';
    html += '<div>';
    html += '<button class="reply-btn ml-2 text-sm text-red-500" data-comment-id="' + comment.comment_id + '">댓글쓰기</button>';
    html += '</div>';
    html += '</div>';

    html += '<div class="">' + comment.comment_content + '<br></div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';

    return html;
}



document.addEventListener('DOMContentLoaded', (event) => {
    const shareButton = document.getElementById('shareButton');

    shareButton.addEventListener('click', function() {
        // 현재 페이지의 URL을 복사
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(() => {
            // 복사 성공 시 알림 표시
            alert('URL이 복사되었습니다.');
        }).catch(err => {
            // 복사 실패 시 오류 처리
            console.error('URL 복사에 실패했습니다.', err);
        });
    });
});


    
document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.querySelector('nav');
    const sidebar = document.querySelector('.sidebarbox');

    // 원래 sidebar의 너비 계산
    const originalSidebarWidth = sidebar.offsetWidth + 'px';

    if (navbar && sidebar) {

        const navbarHeight = navbar.offsetHeight;
        const sidebarTop = sidebar.getBoundingClientRect().top + window.scrollY - navbarHeight;

        window.addEventListener('scroll', function(){
            if(window.scrollY >= sidebarTop){
                sidebar.classList.add('fixed');
                sidebar.style.top = `${navbarHeight}px`;
                sidebar.style.width = originalSidebarWidth; // 고정 상태에서 원래 너비 적용
            } else {
                sidebar.classList.remove('fixed');
                sidebar.style.top = '';
                sidebar.style.width = ''; // 너비 스타일 제거
            }
        });
    } 
});


document.addEventListener('DOMContentLoaded', (event) => {
    var activeCommentForm = null; // 활성화된 댓글 폼을 추적
    
    document.querySelectorAll('.reply-btn').forEach(button => {
        button.addEventListener('click', function() {
            
            
            
            var commentId = this.getAttribute('data-comment-id'); // 댓글 ID를 옴

            // 현재 댓글 컨테이너를 찾기
            var commentContainer = this.closest('[name="comment-answer-area"]');

            // 활성화된 폼이 있고, 현재 댓글 컨테이너에 속하지 않는 경우, 제거
            if (activeCommentForm && activeCommentForm.closest('[name="comment-answer-area"]') !== commentContainer) {
                activeCommentForm.remove();
                activeCommentForm = null;
            }

        

            if (!activeCommentForm) {
            var originalCommentForm = document.querySelector('.comment-form');
            activeCommentForm = originalCommentForm.cloneNode(true);
            commentContainer.after(activeCommentForm);
            activeCommentForm.classList.remove('hidden');

            // 폼에 숨겨진 입력 필드 추가
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'parent_comment_id');
            hiddenInput.value = commentId;
            activeCommentForm.appendChild(hiddenInput);

        }

            
        });
    });
});



function thumbUp() {

    <?php if(!$this->session->userdata('user_id')): ?>
        alert('로그인이 필요한 기능입니다.');
    <?php endif; ?>

    var postId = document.getElementById('post-container').getAttribute('data-post-id');
    

    // AJAX 요청을 통해 서버에 추천 처리 요청
    $.ajax({
        url: '/posts/post/thumbUp', 
        type: 'POST',
        dataType: 'json',
        data: {
            postId: postId,
        },
        success: function(response) {
            if (response.status === 'already_thumbed'){
                alert('이미 추천한 글입니다.');
                window.location.href = '/posts/free/' + postId;
            }else if(response.status === 'success'){
                alert('글을 추천하셨습니다.');
                window.location.href = '/posts/free/' + postId;

            }
        },
        error: function(error) {
             console.error('Error:', error);
        }
    });
}
</script>

<!-- <?php $this->load->view('layout/footer'); ?> -->


