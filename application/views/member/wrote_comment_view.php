<?php $this->load->view('layout/header'); ?>

<body>
<div class="flex flex-col bg-gray-300 h-auto text-black">
    <img src="/application/views/images/car.jpg" class="z-0 absolute h-[500px] w-screen object-cover" alt="">
    <div class="flex flex-1 pt-[250px] gap-4 px-[200px] z-10 relative text-black justify-center">
             <!-- Sidebar -->
            <aside class="w-84">
                <?php $this->load->view('layout/sidebar'); ?>
            </aside>
            <main class="w-full">
                <!-- 리스트 페이지 컨텐츠 -->
                <div>
                    <div class="flex bg-white text-base font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 mb-2 justify-between">
                        <ul class="flex flex-wrap">
                            <li class="p-2">
                                <a href="/member/wrote/post"
                                class="inline-block p-2 border-b-2 rounded-t-lg active text-gray-400 ">
                                    
                                    <span>내가 쓴 글</span>
                                    <div></div>
                                </a>
                            </li>
                            <li class="p-2">
                                <a href="/member/wrote/comment"  class="flex gap-2 inline-block p-2 text-blue-600 border-blue-600 active border-b-2  rounded-t-lg dark:hover:text-gray-300"
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
                            <?php if(isset($wrote_comment) && !empty($wrote_comment)): ?>
                                <?php foreach ($wrote_comment as $comment): ?>
                                    <!-- 리스트 페이지의 내용 -->
                                    <div class="bg-white">
                                        <div class="flex flex-col border-b hover:bg-blue-100">
                                        <a href="/posts/free/<?php echo $comment['post_id']; ?>">
                                            <div class="flex flex-1 p-2 border-gray-300 cursor-pointer">
                                                <!-- 콘텐츠 내용 -->
                                                <div class="flex-[0.4] flex flex-col items-center ">
                                                    <!-- <div class="m-auto"><i class='fa-solid fa-caret-up fa-xl text-gray-400'></i></div> -->
                                                    <!-- <div class=""><?php echo $post['thumb']; ?></div> -->
                                                </div>
                                                <div class="flex-[2] m-auto">
                                                    <div class="flex">

                                                        <div class="text-base font-medium break-words break-all">
                                                            <div>
                                                            <!-- <?php echo htmlspecialchars(mb_strimwidth($hot_post['title'], 0, 50, "...")); ?> -->
                                                                    <?php echo htmlspecialchars(mb_strimwidth($comment['comment_content'], 0 , 50, "...")); ?>
                                                        
                                                            </div>
                                                            <div>
                                                                <div class="font-base text-gray-500">
                                                                    "<?php echo $comment['title']; ?>" 글에 대한 댓글
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="ml-1 text-red-500">[33]</div> -->

                                                    </div>
                                                </div>
                                                <!-- <div class="flex-[2] m-auto">
                                                <i class="fa-solid fa-user mr-2"></i>
                                                <div><?php echo $comment['user_id']; ?></div>
                                                </div> -->
                                                <div class="flex-1 m-auto">
                                                <!-- <i class="fa-solid fa-eye"></i> -->
                                                <!-- <?php echo $post['views']; ?> -->
                                                </div>

                                                <div class="flex-[1] m-auto"><i class="fa-regular fa-clock mr-2"></i>
                                                <?php echo $comment['create_date']; ?>
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
                                        <div class="flex flex-1 p-2 bg-white border-gray-300 cursor-pointer justify-center">
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
<!-- <?php $this->load->view('layout/footer'); ?> -->


<!-- <script>
$(document).ready(function(){
    // '내가 쓴 글' 탭 클릭 이벤트
 
    $("#posts-tab").click(function(e){
        $("#initial-wrote-container").hide();
        e.preventDefault();
     

        
        
         // '내가 쓴 댓글' 탭에 투명 밑줄 적용
         $("#comments-tab").removeClass("border-blue-600 text-blue-600").addClass("border-transparent");

        // '내가 쓴 댓글' 탭에 파란색 밑줄 적용
        $(this).removeClass("border-transparent").addClass("border-blue-600 text-blue-600");

        console.log('내가쓴글 탭 스타일적용');

        $.ajax({
            url: "/member/Wrote/wrote_post",
            type: "GET",
            dataType:"json",
            success: function(response){        

            var html = '';
            if (response.wrote_post && response.wrote_post.length > 0) {
                $.each(response.wrote_post, function(index, post){
                    html += 
                    '<div class="bg-base-100">'+
                    '<div class="flex flex-col border-b ">' +
                    '<a href="/posts/free/' + post.post_id +'">' +
                        '<div class="flex flex-1 p-2 border-b border-gray-300 cursor-pointer hover:bg-blue-100">' +
                            '<div class="flex-[0.4] flex flex-col items-center ">' +
                                    '<div class="m-auto"><i class="fa-solid fa-caret-up fa-xl text-gray-400"></i></div>' +
                                        '<div class="">'+post.thumb+'</div>' +
                                    '</div>' +
                            '<div class="flex-[1] m-auto">' +
                                '<div class="flex">' +
                                
                                    '<div class="text-base font-medium">' + post.title + '</div>' +
                                
                                '</div>' +
                                '<div class="flex">' +
                                    '<div class="font-base text-gray-500">'+ '자유</div>' + // 카테고리 또는 태그 필요
                                '</div>' +
                            '</div>' +
                            '<div class="flex-1 m-auto">' +
                            '<i class="fa-solid fa-eye"></i>' +
                            post.views +
                            '</div>' +
                            '<div class="flex-[1] m-auto"><i class="fa-regular fa-clock mr-2"></i> ' +
                            post.create_date +
                            '</div>' +
                        '</div>' +
                    '</a>' +
                    '<div>'+
                    '</div>'+
                    '</div>';

                });
            } else {
                html = `
                        <div class="flex flex-col border-b">
                            <div class="flex flex-1 p-2 bg-base-100 border-gray-300 cursor-pointer justify-center">
                                <div class="p-4">${response.no_results}</div>
                            </div>
                        </div>
                    `;
            }
            $("#dynamic-wrote-container").html(html);

            }
        });
    });




    // '내가 쓴 댓글' 탭 클릭 이벤트
    $("#comments-tab").click(function(e){


        $("#initial-wrote-container").hide();
      
        e.preventDefault();
  


            // '내가 쓴 글' 탭에 투명 밑줄 적용
            $("#posts-tab").removeClass("border-blue-600 text-blue-600").addClass("border-transparent");

            // '내가 쓴 댓글' 탭에 파란색 밑줄 적용
            $(this).removeClass("border-transparent").addClass("border-blue-600 text-blue-600");

            
        $.ajax({
            url: "/member/Wrote/wrote_comment",
            type: "GET",
            dataType:"json",
            success: function(response){

            var html = '';
            if (response.wrote_comment && response.wrote_comment.length > 0) {
                $.each(response.wrote_comment, function(index, comment){
                    var safeContent = $('<div/>').text(comment.comment_content).html();

                        html +=
                            '<div class="bg-base-100">' +
                            '<div class="flex flex-col border-b ">' +
                            '<a href="/posts/free/' + comment.post_id + '">' +
                            '<div class="flex flex-1 p-2 border-b border-gray-300 cursor-pointer hover:bg-blue-100">' +
                            '<div class="flex-[0.4] flex flex-col items-center ">' +
                            '</div>' +
                            '<div class="flex-[1] m-auto">' +
                            '<div class="flex">' +
                            '<div class="text-base font-medium">' + safeContent + '</div>'+
                            
                            '</div>' +
                            '<div class="flex">' +
                            '<div class="font-base text-gray-500">' + comment.title +'에 대한 댓글</div>' + // 카테고리 또는 태그 필요
                            '</div>' +
                            '</div>' +
                            '<div class="flex-1 m-auto">' +
                            '</div>' +
                            '<div class="flex-[1] m-auto"><i class="fa-regular fa-clock mr-2"></i> ' +
                            comment.create_date +
                            '</div>' +
                            '</div>' +
                            '</a>' +
                            '<div>' +
                            '</div>' +
                            '</div>';
                });
            } else {
                html = `
                        <div class="flex flex-col border-b">
                            <div class="flex flex-1 p-2 bg-base-100 border-gray-300 cursor-pointer justify-center">
                                <div class="p-4">${response.no_results}</div>
                            </div>
                        </div>
                    `;
            }
            $("#dynamic-wrote-container").html(html);


            }

        });
    });
}); -->
</script>