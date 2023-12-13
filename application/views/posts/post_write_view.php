<?php $this->load->view('layout/header'); ?>

<div class="flex-container" style="display: flex; margin: 400px;">
    <!-- 사이드바 -->
    <div class="w-80">
        <?php $this->load->view('layout/sidebar'); ?>
    </div>
    <!-- <body class="mt-96"> -->
    <div class="content ml-8" style="flex: 3;">
        <div class="flex flex-col w-full ">
            <div class="h-auto bg-base-100">
                <div name="title" class="mt-8 ml-12 mr-12">


                    <?php if ($post_data) : ?>
                    <?php $post_id = $post_data->post_id; ?>
                    <?php $title = $post_data->title; ?>

                    <div class="flex justify-normal mb-2">
                        <div class="flex flex-none">
                            <div class="mt-2 text-2xl">
                                <?php echo $title ?> 에 대한 답변 글 작성
                            </div>

                        </div>
                        <div class="grow"></div>
                        <div class="flex flex-none">

                            <!-- <div class="form-control mr-4">
                        
                                <label class="cursor-pointer label">
                                    <input type="checkbox" checked="checked" class="checkbox checkbox-accent" />
                                    <span class="label-text ml-1">공지로등록</span>
                         
                            </div> -->


                        </div>
                    </div>
                    <div class="mt-2">
                        <select class="select select-bordered w-28 h-4 max-w-xs mt-2">
                            <option disabled selected>채널선택</option>
                            <option>자유</option>
                            <option>PYTHON</option>
                            <option>JAVA</option>
                            <option>PHP</option>
                            <option>C++</option>
                        </select>
                    </div>
                    
                    <!-- 답변 폼 -->
                    <form data-post-id="<?= $post_id?>" id="answer_form" method="POST" class="mt-8">
                        <div class="mb-6">
                            <label for="title"
                                class="block mb-2 font-bold text-gray-900 dark:text-white text-lg">제목</label>
                            <input type="text" name="title" id="title"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 "
                                value="<?php echo set_value('title'); ?>">
                            <?php echo form_error('title'); ?>
                        </div>
                        <div class="mb-6">


                            <label for="content"
                                class="block mb-2 font-bold text-gray-900 dark:text-white text-lg">내용</label>

                            <textarea class="h-36 form-control ckeditor" type="text" name="content" id="content"
                                value="<?php echo set_value('content'); ?>"></textarea>
                            <?php echo form_error('content'); ?>


                        </div>

                        <div class="flex justify-between">
                            <div class="mt-2">
                                <div class="ml-2 mb-2">* 파일 크기는 250kb 이하여야 합니다.</div>
                                <input type="file" id="file" name="file[]"
                                    class="file-input file-input-bordered w-full max-w-xs" multiple />
                                <div id="uploaded-files"></div>
                            </div>
                            <div>
                                <button type="submit" class="bg-gray-500 text-white w-24 h-12 rounded">취소</button>
                                <button type="submit" class="bg-gray-500 text-white w-24 h-12 rounded">작성</button>
                            </div>
                        </div>


                    </form>


                    <?php else: ?>
                    <div class="flex justify-normal mb-2">
                        <div class="flex flex-none">
                            <div class="mt-2 text-2xl font-bold">게시글작성</div>
                        </div>
                        <div class="ml-4 mb-4">
                            <select class="select select-bordered w-28 h-4 max-w-xs mt-2">
                                <option disabled selected>채널선택</option>
                                <option>자유게시판</option>
                                <option>머스탱 5.0</option>
                                <option>머스탱 2.3 에코부스터</option>
                                <option>머스탱 시승기 공유</option>
                                <option>머스탱 연비 공유</option>
                            </select>
                        </div>
                        <div class="grow"></div>
                        <div class="flex flex-none">



                            <!-- <div class="form-control ml-4">
                                <label class="cursor-pointer label">
                                    <input type="checkbox" checked="checked" class="checkbox checkbox-accent" />
                                    <span class="label-text ml-1">전체공개</span>
                                </label>
                            </div> -->

                        </div>
                    </div>



                    <form  id="postForm" method="POST" class="mt-8" enctype="multipart/form-data">
                        <?php if($user_role == 'admin'): ?>
                        <div class="flex mb-4">
                            <div class="form-control mr-2 ">
                                <label class="cursor-pointer label">
                                    <input name="is_notice" type="checkbox" class="checkbox checkbox-accent" />
                                </label>
                            </div>
                            <span class="label-text mt-3">공지로등록</span>

                        </div>
                        <?php endif; ?>
                        <div class="mb-6">
                            <label for="title"
                                class="block mb-2 font-bold text-gray-900 dark:text-white text-lg">제목</label>
                            <input type="text" name="title" id="title"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 "
                                value="<?php echo set_value('title'); ?>">
                            <?php echo form_error('title', '<div class="error">', '</div>'); ?>

                        </div>
                        <div class="mb-6">


                            <label for="content" class="block mb-2 font-bold text-gray-900 dark:text-white text-lg"
                                value="<?php echo set_value('content'); ?>">내용</label>

                            <textarea class="h-36" type="text" name="content" id="content"></textarea>
                            <?php echo form_error('content', '<div class="error">', '</div>'); ?>


                        </div>

                        <div class="flex justify-between">
                            <div class="mt-2">
                                <div class="ml-2 mb-2">* 파일 크기는 250kb 이하여야 합니다.</div>
                                <input type="file" id="file" name="file[]"
                                    class="file-input file-input-bordered w-full max-w-xs" multiple />
                                <div id="uploaded-files"></div>
                            </div>
                            <div>
                                <button type="submit" class="bg-gray-500 text-white w-24 h-12 rounded">취소</button>
                                <button type="submit" class="bg-gray-500 text-white w-24 h-12 rounded">작성</button>
                            </div>
                        </div>


                    </form>

                    <?php endif ?>

                </div>

                <div name="content " class="">
                    <div class="m-12">



                    </div>
                </div>


            </div>

        </div>








        </body>
    </div>
</div>


<script>
ClassicEditor
        .create( document.querySelector( '#content' ), {
    
        language: "ko",
        simpleUpload: {
            uploadUrl: '/posts/write/saveImage'
        },
        ckfinder : {
            uploadUrl: "/posts/write/saveImage",
            withCredentials: true
        },
        removePlugins: [ 'Heading' ],
        

        } )
        .then(editor => {
            globalEditor = editor; // 전역 변수에 인스턴스 저장
        })
        .catch(error => {
            console.error(error);
        });


document.addEventListener('DOMContentLoaded', function () {
    var answerForm = document.getElementById('answer_form');
    if (answerForm) {
        //답글작성폼
    document.getElementById('answer_form').addEventListener('submit', function(e) {
    e.preventDefault();

        if (globalEditor) {
            var content = globalEditor.getData();
            document.getElementById('content').value = content;
        }

        // 제목과 내용이 비어 있는지 검사
        let title = document.getElementById('title').value.trim();
        

        if (title === '' ) {
            alert('제목을 입력해주세요.');
            return;
        }

        if (content === '' ) {
            alert('내용을 입력해주세요.');
            return;
        }

        let formData = new FormData(this);
        let post_id = $('#answer_form').attr('data-post-id');

        console.log(post_id);

        axios.post('/posts/write/answer_post/'+post_id, formData)
            .then(function (response) {
                console.log('성공: ', response);
                alert('글이 작성 되었습니다.')

                var new_post_id = response.data.new_post_id;
                location.href = '/posts/free/' + new_post_id; 
            })
            .catch(function (error) {
                if (error.response && error.response.data.errors) {
                // 오류 메시지를 사용자에게 보여주는 로직
                console.log('유효성 검증 오류: ', error.response.data.errors);
                // 예시: alert 사용
                alert('오류: ' + Object.values(error.response.data.errors).join('\n'));
                
                } else {
                    // 다른 종류의 오류 처리
                    console.log('실패: ', error);
                }
            });
        });
    }
    


        //일반작성폼
        var postForm = document.getElementById('postForm');
        if (postForm) {
            document.getElementById('postForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);

                fetch('/posts/write', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // 성공 메시지 표시 및 리디렉션
                            window.location.href = '/posts';
                        } else {
                            // 에러 메시지 표시
                            alert(data.message);
                        }
                    })
                    .catch((error) => {
                        // 네트워크 오류 또는 서버 에러 처리
                        console.error('Error:', error);
                });
            });

        }
        




}); 










document.getElementById('file').addEventListener('change', function(e) {

    var files = e.target.files;
    var filesList = document.getElementById('uploaded-files');
    filesList.innerHTML = '';

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var fileElement = document.createElement('div');
        fileElement.innerHTML = (i + 1) + '. ' + file.name +
            ' <button class="btn btn-primary" onclick="removeFile(' + i + ')">삭제</button>';
        filesList.appendChild(fileElement);
    }
});

function removeFile(index) {
    var filesInput = document.getElementById('file');
    var dataTransfer = new DataTransfer();

    Array.from(filesInput.files).forEach((file, i) => {
        if (i !== index) {
            dataTransfer.items.add(file);
        }
    });

    filesInput.files = dataTransfer.files;
    // 파일 목록을 새로고침
    var event = new Event('change');
    filesInput.dispatchEvent(event);
}




</script>
<style>
.ck-editor__editable {
    min-height: 200px;
}
</style>