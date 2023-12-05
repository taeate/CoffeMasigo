<?php $this->load->view('layout/header'); ?>

<body>

    <div class="flex flex-col lg:flex-row flex-container ml-[350px] mr-[350px] mt-[200px] mb-[200px]">


        <!-- 사이드바 -->
        <div class="w-80">
            <?php $this->load->view('layout/sidebar'); ?>
        </div>


        <!-- 리스트 페이지 컨텐츠 -->
        <div  class="flex w-2/3 flex-col contentbox ml-4 z-10">
    
            <div class="flex bg-base-100 text-base font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 mb-2 justify-between">
                <ul class="flex flex-wrap -mb-px">
                    <li class="me-2">
                        <a href="#" id="posts-tab" class="flex gap-2 inline-block p-4 text-blue-600 border-blue-600 active border-b-2  rounded-t-lg dark:hover:text-gray-300">
                            <span>내가 쓴 글</span>
                            <div></div>
                        </a>
                    </li>
                    <li class="me-2">
                        <a href="#" id="comments-tab" class="inline-block p-4 border-b-2 rounded-t-lg active dark:text-blue-500 dark:border-blue-500"
                            aria-current="page">
                            <span>내가 쓴 댓글</span>
                            <div></div>
                        </a>
                    </li>
                </ul>

                <ul class="p-4">
                    <div class="">
                        <input type="checkbox">
                        <span>전체선택</span>
                    </div>
                </ul>
            </div>

  

            <body id="dynamic-content" class="bg-base-300">
                <?php if(isset($wrote_post) && !empty($wrote_post)): ?>
                <?php foreach ($wrote_post as $wrote_post): ?>
                <!-- 리스트 페이지의 내용 -->
                <div class="bg-base-100">

                    <div class="">
                        <!-- 메인 글 -->
                        <div id="wrote-container">
                            <div class="flex flex-col border-b hover:bg-blue-100">
                                <div class="flex flex-1 p-2 border-b border-gray-300 cursor-pointer">   
                                    <div class="flex"><input type="checkbox"></div>
                                    <div class="flex-[0.4] flex flex-col items-center ">
                                        <div class="m-auto"><i class='fa-solid fa-caret-up fa-xl text-gray-400'></i></div>
                                        <div class=""><?php echo $wrote_post['thumb']; ?></div>
                                    </div>
                                    <div class="flex-[2] m-auto">
                                        <div class="flex">

                                            <div class="text-base font-medium"><?php echo $wrote_post['title']; ?></div>
                                            <div class="ml-1 text-red-500">[33]</div>
                                        </div>
                                        <div class="flex">
                                            <div class="font-base text-gray-500">자유</div>

                                            <!-- 답글이 있을 때만 버튼이 보임 -->
                                            <!-- <?php if($post->replies > 1): ?>
                                                    <a href="#" class="view-replies ml-2 text-red-500 hover:text-blue-800" onclick="event.stopPropagation(); loadReplies(<?=$post->post_id?>); return false;">답글보기</a>
                                                <?php endif; ?> -->


                                        </div>
                                    </div>
                                    <!-- <div class="flex-[2] m-auto">
                                        <i class="fa-solid fa-user mr-2"></i>
                                        <div><?php echo $wrote_post['user_id']; ?></div>
                                    </div> -->
                                    <div class="flex-1 m-auto">
                                        <i class="fa-solid fa-eye"></i>
                                        <?php echo $wrote_post['views']; ?>
                                    </div>
                                    <div class="flex-[1] m-auto"><i class="fa-regular fa-clock mr-2"></i>
                                    <?php echo $wrote_post['create_date']; ?>
                                    </div>

                                </div>
                                <!-- <div id="replies-container-<?=$post->post_id?>" style="display: none;"></div> -->

                            </div>

                            <!-- 메인 글 끝-->



                        </div>
                    <?php endforeach; ?>
                    
                        <!-- <div class="mt-6 mb-6">
                        <div class="flex justify-center">
                            <div class="pagination mb-4">
                                <?php echo $link; ?>                 
                            </div>
                        </div>
                    </div> -->
                    </div>
                    
                    <?php else: ?>
                        <div class="shadow-md">
                        <!-- 메인 글 -->
                        <div id="wrote-container">
                            <div class="flex flex-col border-b">
                                <div class="flex flex-1 p-2 bg-base-100 border-gray-300 cursor-pointer justify-center">
                                    <div class="p-4"> 등록된 글이 없습니다.</div>
                                </div>
                            </div>
                        </div>
                   

                    </div>
                    <?php endif; ?>
            </body>


        </div>


        <!-- <div class="w-80 ml-4">
    <?php $this->load->view('layout/rightbar'); ?>
    </div> -->



    </div>
</body>
<!-- <?php $this->load->view('layout/footer'); ?> -->


<script>
$(document).ready(function(){
    // '내가 쓴 글' 탭 클릭 이벤트
    console.log('내가쓴글 탭');
    $("#posts-tab").click(function(e){
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
                    '<div class="flex flex-col border-b ">' +
                    '<div class="flex flex-1 p-2 border-b border-gray-300 cursor-pointer hover:bg-blue-100">' +
                        '<div class="ml-4 flex-[0.2] flex flex-col items-center ">' +
                            '<div class="m-auto"><input type="checkbox"/></div>' +
                            '<div class="">' + '</div>' +
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
                            
                        '</div>' +
                        '<div class="flex-[1] m-auto"><i class="fa-regular fa-clock mr-2"></i> ' +
                        '</div>' +
                    '</div>' +
                    '<div>'
                    '</div>';

                });
            } else {
                html = '<div>' + response.no_results + '</div>';
            }
            $("#wrote-container").html(html);

            }
        });
    });




    // '내가 쓴 댓글' 탭 클릭 이벤트
    $("#comments-tab").click(function(e){
        console.log('내가쓴 댓글 탭');
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
                    html += 

                    '<div class="flex flex-col border-b ">' +
                    '<div class="flex flex-1 p-2 border-b border-gray-300 cursor-pointer hover:bg-blue-100">' +
                        '<div class="ml-4 flex-[0.2] flex flex-col items-center ">' +
                            '<div class="m-auto"><input type="checkbox"/></div>' +
                            '<div class="">' + '</div>' +
                        '</div>' +
                        '<div class="flex-[1] m-auto">' +
                            '<div class="flex">' +
                                '<div class="text-base font-medium">' + comment.comment_content + '</div>' +
                             
                            '</div>' +
                            '<div class="flex">' +
                                '<div class="font-base text-gray-500">'+ comment.title +'에 대한 댓글</div>' + // 카테고리 또는 태그 필요
                            '</div>' +
                        '</div>' +
                        '<div class="flex-1 m-auto">' +
                            
                        '</div>' +
                        '<div class="flex-[1] m-auto"><i class="fa-regular fa-clock mr-2"></i> ' + comment.create_date +
                        '</div>' +
                    '</div>' +
                    '<div>'
                    '</div>';
                });
            } else {
                html = '<div>' + response.no_results + '</div>';
            }
            $("#wrote-container").html(html);


            }

        });
    });
});
</script>