<?php $this->load->view('layout/header'); ?>

<body>
    <div class="flex flex-col bg-gray-100 h-auto">
    <img src="/application/views/images/car.jpg" class="z-0 absolute h-[400px] w-screen object-cover" alt="">
    <div class="flex flex-1 pt-[250px] gap-4 px-[200px] z-10 relative text-black justify-center">
            <aside class="w-84">
                <?php $this->load->view('layout/sidebar'); ?>
            </aside>
            <main class="w-full">
                <div class="flex flex-1 content" style="flex: 3;">
                    <div class="flex flex-col w-full ">
                        <div class="h-auto bg-white text-black">
                            <div name="title" class="mt-8 ml-12 mr-12">


                                <?php if ($post_data) : ?>
                                <?php $post_id = $post_data->post_id; ?>
                                <?php $title = $post_data->title; ?>

                                <div class="flex flex-col justify-normal mb-2 gap-4">
                                    <div class="flex flex-none">
                                        <div class="mt-2 text-2xl font-bold">답 게시글작성</div>
                                    </div>
                                    <div class="flex flex-none">
                                        <div class="flex mt-2 text-xl gap-2">
                                            <div>"<?php echo htmlspecialchars($title) ?>"</div>
                                            <div class=" text-xl"> 에 대한 답변 글 작성</div>
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
                    
                                <!-- 답변 폼 -->
                                <form data-post-id="<?= $post_id?>" id="answer_form" method="POST" class="mt-8">
                                    <div class="mb-4 hidden">
                                            <select name="answer_channel_id" class="select select-bordered w-52 h-4 max-w-xs mt-2">
                                                <option disabled selected>채널선택</option>
                                                <option value="3" <?php if ($post_data->channel_id == 3) echo 'selected'; ?>>자유게시판</option>
                                                <option value="4" <?php if ($post_data->channel_id == 4) echo 'selected'; ?>>7세대 머스탱</option>
                                                <option value="5" <?php if ($post_data->channel_id == 5) echo 'selected'; ?>>머스탱 5.0</option>
                                                <option value="6" <?php if ($post_data->channel_id == 6) echo 'selected'; ?>>머스탱 2.3 에코부스터</option>
                                                <option value="7" <?php if ($post_data->channel_id == 7) echo 'selected'; ?>>머스탱은 OOO 이다</option>
                                                <option value="8" <?php if ($post_data->channel_id == 8) echo 'selected'; ?>>머스탱 시승기 공유</option>
                                                <option value="9" <?php if ($post_data->channel_id == 9) echo 'selected'; ?>>머스탱 연비 공유</option>
                                                <option value="10" <?php if ($post_data->channel_id ==10) echo 'selected'; ?>>머스탱 부품 공유</option>
                                                <option value="11" <?php if ($post_data->channel_id == 11) echo 'selected'; ?>>맛집/여행/드라이브</option>
                                                <option value="12" <?php if ($post_data->channel_id == 12) echo 'selected'; ?>>리스/승계</option>
                                                <option value="13" <?php if ($post_data->channel_id == 13) echo 'selected'; ?>>사건사고</option>
                                                <option value="14" <?php if ($post_data->channel_id == 14) echo 'selected'; ?>>QNA</option>
                                                <option value="16" <?php if ($post_data->channel_id == 16) echo 'selected'; ?>>서울</option>
                                                <option value="17" <?php if ($post_data->channel_id == 17) echo 'selected'; ?>>대전</option>
                                                <option value="18" <?php if ($post_data->channel_id == 18) echo 'selected'; ?>>대구</option>
                                                <option value="19" <?php if ($post_data->channel_id == 19) echo 'selected'; ?>>부산</option>
                                                <option value="20" <?php if ($post_data->channel_id == 20) echo 'selected'; ?>>제주</option>
                                            </select>
                                        </div>
                                    <div class="mb-6">
                                        <label for="title"
                                            class="block mb-2 font-bold text-gray-900  text-lg">제목</label>
                                        <input type="text" name="title" id="title"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                            value="<?php echo htmlspecialchars(set_value('title')); ?>">
                                        <?php echo form_error('title'); ?>
                                    </div>
                                    <div class="mb-6" id="editor">


                                        <label for="content"
                                            class="block mb-2 font-bold text-gray-900 text-lg"></label>

                                        <textarea class="h-36 form-control ckeditor" type="text" name="content" id="content"
                                            value="<?php echo set_value('content'); ?>"></textarea>
                                        <?php echo form_error('content'); ?>


                                    </div>

                                    <div class="flex justify-between">
                                        <div class="mt-2">
                                             <div class="ml-2 mb-2 text-sm">* 글작성시 파일 크기는 총 10MB 이하여야 합니다</div>
                                            <div class="ml-2 mb-2 text-sm">* 파일첨부는 최대 10개까지만 가능합니다.</div>
                                            <div class="ml-2 mb-2  text-sm">* 단일 파일 추가는 불가능합니다.</div>
                                            <input type="file" id="file" name="file[]" accept="image/gif, image/jpeg, image/png, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, text/plain, application/zip, application/pdf"
                                                class="file rounded-lg border-2 file-input-bordered w-full max-w-sm bg-white  file:bg-blue-500 flie:text-none file:border-none" multiple />
                                            <div class="pt-2" id="uploaded-files"></div>
                                        </div>
                                        <div>
                                            <button type="button" class="bg-gray-500 text-white w-24 h-12 rounded"><a href="/posts/free/<?=$post_id?>">취소</a></button>
                                            <button type="submit" class="bg-gray-500 text-white w-24 h-12 rounded">작성</button>
                                        </div>
                                    </div>


                                </form>


                                <?php else: ?>
                                <div class="flex justify-normal mb-2">
                                    <div class="flex flex-none">
                                        <div class="mt-2 text-2xl font-bold">게시글작성</div>
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
                                <div class="mb-4">
                                        <select name="channel_id" class="select select-bordered w-52 h-4 max-w-xs mt-2 bg-white">
                                        <option value="3" <?php echo set_select('channel_id', '3', TRUE); ?>>자유게시판</option>
                                        <option value="4" <?php echo set_select('channel_id', '4'); ?>>7세대 머스탱</option>
                                        <option value="5" <?php echo set_select('channel_id', '5'); ?>>머스탱 5.0</option>
                                        <option value="6" <?php echo set_select('channel_id', '6'); ?>>머스탱 2.3 에코부스터</option>
                                        <option value="7" <?php echo set_select('channel_id', '7'); ?>>머스탱은 OOO 이다</option>
                                        <option value="8" <?php echo set_select('channel_id', '8'); ?>>머스탱 시승기 공유</option>
                                        <option value="9" <?php echo set_select('channel_id', '9'); ?>>머스탱 연비 공유</option>
                                        <option value="10" <?php echo set_select('channel_id', '10'); ?>>머스탱 부품 공유</option>
                                        <option value="11" <?php echo set_select('channel_id', '11'); ?>>맛집/여행/드라이브</option>
                                        <option value="12" <?php echo set_select('channel_id', '12'); ?>>리스/승계</option>
                                        <option value="13" <?php echo set_select('channel_id', '13'); ?>>사건사고</option>
                                        <option value="14" <?php echo set_select('channel_id', '14'); ?>>QNA</option>
                                        <option value="16" <?php echo set_select('channel_id', '16'); ?>>서울</option>
                                        <option value="17" <?php echo set_select('channel_id', '17'); ?>>대전</option>
                                        <option value="18" <?php echo set_select('channel_id', '18'); ?>>대구</option>
                                        <option value="19" <?php echo set_select('channel_id', '19'); ?>>부산</option>
                                        <option value="20" <?php echo set_select('channel_id', '20'); ?>>제주</option>
                                        </select>
                                    </div>
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
                                            class="block mb-2 font-bold text-black bg-white text-lg">제목</label>
                                        <input type="text" name="title" id="title"
                                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                            value="<?php echo set_value('title'); ?>">
                                        <?php echo form_error('title', '<div class="error">', '</div>'); ?>

                                    </div>
                                    <div class="mb-6" id="editor">


                                        <label for="content" class="block mb-2 font-bold text-gray-900 dark:text-white text-lg"
                                            value="<?php echo set_value('content'); ?>"></label>

                                        <textarea class="h-36" type="text" name="content" id="content"></textarea>
                                        <?php echo form_error('content', '<div class="error">', '</div>'); ?>

                                        
                                    </div>

                                    <div class="flex justify-between">
                                        <div class="mt-2">
                                            <div class="ml-2 mb-2 text-sm">* 글작성시 파일 크기는 총 10MB 이하여야 합니다</div>
                                            <div class="ml-2 mb-2 text-sm">* 파일첨부는 최대 10개까지만 가능합니다.</div>
                                            <div class="ml-2 mb-2  text-sm">* 단일 파일 추가는 불가능합니다.</div>
                                            <input type="file" id="file" name="file[]" accept="image/gif, image/jpeg, image/png, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, text/plain, application/zip, application/pdf"
                                                class="file rounded-lg border-2 file-input-bordered w-full max-w-sm bg-white  file:bg-blue-500 flie:text-none file:border-none" multiple />
                                            <div class="pt-2" id="uploaded-files"></div>
                                        </div>
                                        <div>
                                            <button type="button" class="bg-gray-500 text-white w-24 h-12 rounded"><a href="/posts">취소</a></button>
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



                    <script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>
                    <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />

                    
                    <script>
                        
                editor = new toastui.Editor({
                        el: document.querySelector('#editor'), // 에디터를 적용할 요소 (컨테이너)
                        height: '500px',                        // 에디터 영역의 높이 값 (OOOpx || auto)
                        initialEditType: 'wysiwyg',            // 최초로 보여줄 에디터 타입 (markdown || wysiwyg)
                        initialValue: '',     // 내용의 초기 값으로, 반드시 마크다운 문자열 형태여야 함
                        previewStyle: 'vertical',  // 마크다운 프리뷰 스타일 (tab || vertical)
                        
                        hooks: {
                            addImageBlobHook: async (blob, callback) => {
                                // FormData를 사용하여 이미지 파일을 서버로 전송
                                const formData = new FormData();
                                formData.append('upload', blob); 

                                try {
                                    // 이미지를 서버에 업로드하는 요청 보내기
                                    const response = await fetch('/posts/write/saveImage', {
                                        method: 'POST',
                                        body: formData
                                    });
                                    const data = await response.json();

                                    // callback 함수를 사용하여 에디터에 이미지 URL 삽입
                                    callback(data.url, '이미지 설명'); // 서버에서 반환된 이미지 URL
                                } catch (error) {
                                    console.error('이미지 업로드 실패', error);
                                }
                            }
                        }
                    });

                    </script>

                    
                </div>
            </main>
             <!-- Rightbar -->
             <aside class="w-84">
                <?php $this->load->view('layout/rightbar'); ?>
            </aside>
        </div>

</body>

<style>
    .toastui-editor-mode-switch {
        display: none !important;
    }
</style>

<script>




document.addEventListener('DOMContentLoaded', function () {
    var answerForm = document.getElementById('answer_form');
    if (answerForm) {

    //답글작성폼
    document.getElementById('answer_form').addEventListener('submit', function(e) {
    e.preventDefault();


        let formData = new FormData(this);
        let post_id = $('#answer_form').attr('data-post-id'); 
        var editorContent = editor.getHTML();

        var decodedEditorContent = new DOMParser().parseFromString(editorContent, 'text/html').body.textContent.trim();

      

        // 제목 검사
        let title = document.getElementById('title').value.trim();
        if (title === '' ) {
            alert('제목을 입력해주세요.');
            return;
        }

        // 내용검사
        if (decodedEditorContent === '') {
        alert('내용을 입력해주세요.');
        return;
        }

        formData.append('content', editorContent); // 에디터 내용을 FormData에 추가
        formData.append('channel_id', document.querySelector('select[name="answer_channel_id"]').value);


   
           // 파일 업로드 수 및 크기 검사
           var fileInput = document.getElementById('file');
            if (fileInput) {
                var files = fileInput.files;

                // 파일 개수 확인
                if (files.length > 10) {
                    alert('파일은 최대 10개까지 업로드 가능합니다.');
                    return;
                }

                // 파일 크기 확인
                var totalSize = 0;
                for (var i = 0; i < files.length; i++) {
                    totalSize += files[i].size;
                }
                var maxSize = 10 * 1024 * 1024; // 10MB를 바이트로 변환
                if (totalSize > maxSize) {
                    alert('파일 크기가 최대 허용 크기를 초과합니다.');
                    return;
                }
            }


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
            var editorContent = editor.getHTML();

            // HTML 엔터티로 디코딩된 내용 가져오기
            var decodedEditorContent = new DOMParser().parseFromString(editorContent, 'text/html').body.textContent.trim();
            
            // 제목 검사
            let title = document.getElementById('title').value.trim();
            if (title === '' ) {
                alert('제목을 입력해주세요.');
                return;
            }
            
            // 내용검사
            if (decodedEditorContent === '') {
            alert('내용을 입력해주세요.');
            return;
            }

           


            formData.append('content', editorContent); // 에디터 내용을 FormData에 추가
            formData.append('channel_id', document.querySelector('select[name="channel_id"]').value);

              

               
                // 파일 업로드 수 및 크기 검사
                var fileInput = document.getElementById('file');
                if (fileInput) {
                    var files = fileInput.files;

                    // 파일 개수 확인
                    if (files.length > 10) {
                        alert('파일은 최대 10개까지 업로드 가능합니다.');
                        return;
                    }

                    // 파일 크기 확인
                    var totalSize = 0;
                    for (var i = 0; i < files.length; i++) {
                        totalSize += files[i].size;
                    }
                    var maxSize = 10 * 1024 * 1024; // 10MB를 바이트로 변환
                    if (totalSize > maxSize) {
                        alert('파일 크기가 최대 허용 크기를 초과합니다.');
                        return;
                    }
                }


                fetch('/posts/write', {
                        method: 'POST',
                        body: formData,              
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // 성공 메시지 표시 및 리디렉션
                            window.location.href = data.redirect;
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

        // 파일 크기를 KB 단위로 변환
        var fileSize = (file.size / 1024).toFixed(2) + ' KB';

        var fileElement = document.createElement('div');
        fileElement.innerHTML = (i + 1) + '. ' + file.name + ' [' + fileSize +
            ']<button class="bg-blue-500 rounded text-white w-8 h-6 m-2" onclick="removeFile(' + i + ')">X</button>';

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
