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
                    <?php $channel_name = $detail_info->channel_name; ?>

                    <div class="text-2xl flex gap-4">
                        <?php if($detail_info->is_notice == 1): ?>
                        <div class="text-red-500 bg-red-200 rounded-lg">공지</div>
                        <?php endif; ?>
                        <div><?php echo $title ?></div><br>
                    </div>
                    <div class="lg:flex grid grid-cols-2 whitespace-nowrap place-items-center gap-5">
                        <div class="flex flex-none gap-3">
                            <div class=""><?php echo $channel_name ?></div>
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

                    <?php if (!empty($files)): ?>
                    <?php foreach ($files as $file): ?>
                    <a href="<?php echo $file->file_path; ?>"><?php echo $file->file_name; ?></a>
                    <a class="text-blue-500"
                        href="<?php echo '/posts/write/downloadFile/' . $file->file_name; ?>">다운로드</a><br>
                    <?php endforeach; ?>
                    <?php endif; ?>

                    
                    <div class="m-12 w-full">
                        
                        <?php echo $content ?>
                    </div>
                </div>

                <hr class="mr-12 ml-12">
                <div name="button-area">
                    <div name="delete-update-btn" class="flex justify-end mr-12 mt-4">
                        <?php 
                        $user_id = $this->session->userdata('user_id');
                        if ($user_id && $user_id == $author_id): // 로그인한 사용자가 글의 작성자인 경우
                        ?>
                        <button class="btn bg-gray-500 text-white w-16 h-8 mr-2"
                            onclick="window.location.href='/posts/edit/<?=$post_id?>'">수정</button>
                        <button class="post-delete-btn btn bg-gray-500 text-white w-16 h-8"
                            data-postid="<?=$post_id?>">삭제</button>


                        <?php else: ?>
                        <?php endif; ?>
                    </div>
                    <div name="like-btn" class="flex justify-center">
                        <button data-post-id="<?php echo $post_id ?>" id="post-container" onclick="thumbUp()"
                            class="btn bg-gray-500 text-white w-28 h-12">추천 <?php echo $count_thumb; ?></button>
                    </div>

                    <div name="answer-btn" class="flex justify-between ml-12 mr-12 mt-4 mb-4">
                        <div class="">
                            <a href="javascript:void(0);" onclick="history.back();"
                             class="btn bg-gray-500 text-white w-28 h-12">목록으로</a>
                            <a href="/posts/write/answer_post/<?= $post_id ?>" onclick="checkLoginBeforeWrite()"
                            class="btn bg-gray-500 text-white w-28 h-12">답글쓰기</a>
                        </div>
                        <div class="">
                            <button id="shareButton" class="btn bg-gray-500 text-white w-28 h-12">공유하기</button>
                        </div>
                    </div>
                </div>
            </div>



            <div class="flex flex-col w-full mt-4 ">
                <div name="commnet-name" class="h-auto card bg-base-100">
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
                            <div
                                class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                                    <label for="comment" class="sr-only">Your comment</label>
                                    <textarea id="comment" name="comment" rows="4"
                                        class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                        placeholder="댓글은 여기에 작성해주세요" required></textarea>
                                </div>
                                <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                                    <button type="submit"
                                        class="inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                        작성
                                    </button>

                                </div>
                            </div>
                        </form>
                        <?php else: ?>
                        <div class="w-96 m-auto">
                            <p class="text-red-500 font-bold text-base ml-16 mt-12 mb-12">댓글을 작성하려면 <a
                                    href="/login">로그인</a>해주세요.</p>
                        </div>
                        <?php endif; ?>


                        <div class="flex ml-8 mb-4">
                            <button id="comment_orderBy_create" class="hover:text-blue-500">
                                
                            </button>
                            <button id="comment_orderBy_last" class="ml-2 hover:text-blue-500">
                                
                            </button>
                        </div>
                    </div>

                    <div id="commentsContainer">
                        <?php foreach($comment_info as $comment) : ?>
                        <?php $comment_id = $comment->comment_id; ?>
                        <?php $user_id = $comment->user_id; ?>
                        <?php $post_id = $comment->post_id; ?>
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
                                    <img src="/uploads/<?php echo $comment->profile_image; ?>" alt="Profile Image"
                                        class="w-full h-full object-cover">
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
                                            <button class="reply-btn ml-2 text-sm text-red-500"
                                                data-comment-id="<?= $comment_id ?>">댓글쓰기</button>
                                            <?php if ($this->session->userdata('user_id') == $user_id): ?>
                                            <button class="reply-modify-btn text-sm"
                                                data-post-id="<?= $comment->post_id ?>"
                                                data-comment-id="<?= $comment->comment_id ?>"
                                                data-comment-content="<?= htmlspecialchars($comment->comment_content) ?>">수정하기</button>
                                            <button class="delete-comment-btn text-sm"
                                                data-comment-id="<?= $comment->comment_id ?>">삭제하기</button>
                                            <?php endif; ?>
                                        </div>

                                    </div>

                                    <div class="text-sm" data-comment-content=<?= $content?>><?php echo $content; ?><br>
                                    </div>

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
    html += '<button class="reply-btn ml-2 text-sm text-red-500" data-comment-id="' + comment.comment_id +
        '">댓글쓰기</button>';
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



document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('nav');
    const sidebar = document.querySelector('.sidebarbox');

    // 원래 sidebar의 너비 계산
    const originalSidebarWidth = sidebar.offsetWidth + 'px';

    if (navbar && sidebar) {

        const navbarHeight = navbar.offsetHeight;
        const sidebarTop = sidebar.getBoundingClientRect().top + window.scrollY - navbarHeight;

        window.addEventListener('scroll', function() {
            if (window.scrollY >= sidebarTop) {
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


var activeCommentForm = null; // 활성화된 댓글 폼 추적
var activeButton = null; // 현재 활성화된 버튼 추적

document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('.reply-btn').forEach(button => {
        button.addEventListener('click', function() {
            var commentId = this.getAttribute('data-comment-id');
            var commentContainer = this.closest('[name="comment-answer-area"]');

            // 현재 버튼이 이미 활성화된 상태라면 폼을 닫고 초기화
            if (activeButton === this) {
                if (activeCommentForm) {
                    activeCommentForm.remove();
                    activeCommentForm = null;
                    activeButton = null;
                }
                return;
            }

            // 다른 버튼이 클릭되었을 때의 로직
            // 이전 활성화된 폼 제거
            if (activeCommentForm) {
                activeCommentForm.remove();
                activeCommentForm = null;
            }

            // 새로운 폼 생성 및 활성화
            var originalCommentForm = document.querySelector('.comment-form');
            activeCommentForm = originalCommentForm.cloneNode(true);
            commentContainer.after(activeCommentForm);
            activeCommentForm.classList.remove('hidden');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'parent_comment_id');
            hiddenInput.value = commentId;
            activeCommentForm.appendChild(hiddenInput);

            // 현재 버튼 참조 업데이트
            activeButton = this;
        });
    });

    document.querySelectorAll('.reply-modify-btn').forEach(button => {
        button.addEventListener('click', function() {
            var commentId = this.getAttribute('data-comment-id');
            var postId = this.getAttribute('data-post-id');
            console.log(postId);
            var commentContent = this.getAttribute('data-comment-content'); // 댓글 내용 가져오기
            var commentContainer = this.closest('[name="comment-answer-area"]');

            // 현재 버튼이 이미 활성화된 상태라면 폼을 닫고 초기화
            if (activeButton === this) {
                if (activeCommentForm) {
                    activeCommentForm.remove();
                    activeCommentForm = null;
                    activeButton = null;
                }
                return;
            }

            // 다른 버튼이 클릭되었을 때의 로직
            if (activeCommentForm) {
                activeCommentForm.remove();
                activeCommentForm = null;
            }

            var originalCommentForm = document.querySelector('.comment-form');
            activeCommentForm = originalCommentForm.cloneNode(true);
            commentContainer.after(activeCommentForm);
            activeCommentForm.classList.remove('hidden');

            var hiddenCommentIdInput = document.createElement('input');
            hiddenCommentIdInput.setAttribute('type', 'hidden');
            hiddenCommentIdInput.setAttribute('name', 'comment_id');
            hiddenCommentIdInput.value = commentId;
            activeCommentForm.appendChild(hiddenCommentIdInput);

            // 포스트 ID를 폼에 추가
            var hiddenPostIdInput = document.createElement('input');
            hiddenPostIdInput.setAttribute('type', 'hidden');
            hiddenPostIdInput.setAttribute('name', 'post_id');
            hiddenPostIdInput.value = postId;
            activeCommentForm.appendChild(hiddenPostIdInput);

            // 댓글 내용을 폼에 넣기
            var commentTextarea = activeCommentForm.querySelector('#comment');
            commentTextarea.value = commentContent;

            // '작성' 버튼을 '수정'으로 변경
            var submitButton = activeCommentForm.querySelector('button[type="submit"]');
            submitButton.textContent = '수정';
            activeCommentForm.action = "/posts/post/comment_modify";

            // 현재 버튼 참조 업데이트
            activeButton = this;
        });
    });

    document.querySelectorAll('.delete-comment-btn').forEach(button => {
        button.addEventListener('click', function() {
            var commentId = this.getAttribute('data-comment-id');
            if (confirm('정말 삭제하시겠습니까?')) {
                // AJAX를 사용하여 서버에 삭제 요청
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/posts/post/comment_delete', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // 성공적으로 삭제되면 페이지 새로고침 또는 다른 처리
                        location.reload(); // 예시로 페이지 새로고침
                    }
                };
                xhr.send('comment_id=' + commentId);
            }
        });
    });



});



$(document).ready(function() {
    $(".post-delete-btn").click(function() {
        var post_id = $(this).data("postid");
        console.log(post_id);
        if (confirm('정말 삭제하시겠습니까?')) {
            $.ajax({
                type: "POST",
                url: "/posts/delete/" + post_id,
                success: function(response) {
                    alert("글이 삭제되었습니다.");
                    location.href = '/posts'
                },
                error: function() {
                    // 삭제 중 오류가 발생한 경우에 대한 처리
                    alert('삭제 중 오류가 발생했습니다.');
                }
            });
        }
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
            if (response.status === 'already_thumbed') {
                alert('이미 추천한 글입니다.');
                window.location.href = '/posts/free/' + postId;
            } if (response.status === 'self_thumb_not_allowed') {
                alert('본인의 글은 추천이 불가능합니다.');
                window.location.href = '/posts/free/' + postId;
            }
            else if (response.status === 'success') {
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