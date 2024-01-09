<?php $this->load->view('layout/header'); ?>

<body>
    <div class="flex flex-col bg-gray-100 h-auto">
    <img src="/application/views/images/car.jpg" class="z-0 absolute h-[400px] w-screen object-cover" alt="">
    <div class="flex flex-1 pt-[250px] gap-4 px-[200px] z-10 relative text-black justify-center">
             <!-- Sidebar -->
             <aside class="w-84">
                <?php $this->load->view('layout/sidebar'); ?>
            </aside>
            <main class="w-full">
            <div class="flex-container">
          
                    <div class="flex flex-col w-full ">
                        <div class="h-auto bg-white">
                            <div name="title" class="mt-8 ml-12 mr-12">



                                <?php if($before_data): ?>
                                <?php $title = $before_data['post_info']->title; ?>
                                <?php $content = $before_data['post_info']->content; ?>
                                <?php $post_id = $before_data['post_info']->post_id; ?>
                                <?php $channel_name = $before_data['post_info']->channel_name; ?>




                                <div class="flex justify-normal mb-2">
                                    <div class="flex flex-none">
                                        <div class="mt-2 text-2xl font-bold">게시글작성</div>
                                    </div>
                                    <!-- <div class="flex flex-none">
                                        <div class="mt-2 text-2xl">
                                            제목: <?php echo htmlspecialchars($title); ?>
                                        </div>

                                    </div> -->
                                    <div class="grow"></div>
                                    <div class="flex flex-none">
                                        <?php if($user_role == 'admin'): ?>
                                        <div class="form-control mr-4">
                                            <label class="cursor-pointer label">
                                                <input type="checkbox" checked="checked" class="checkbox checkbox-accent" />
                                                <span class="label-text ml-1">공지로등록</span>
                                            </label>
                                        </div>
                                        <?php endif; ?>
                                        <!-- <div class="form-control ml-4">
                                            <label class="cursor-pointer label">
                                                <input type="checkbox" checked="checked" class="checkbox checkbox-accent" />
                                                <span class="label-text ml-1">전체공개</span>
                                            </label>
                                        </div> -->

                                    </div>
                                </div>


                                <form id="edit_form" method="POST" class="mt-8" enctype="multipart/form-data"
                                    data-post-id="<?= $post_id ?>">
                                    <div class="mb-4">
                                        <select name="channel_id" class="select select-bordered w-52 h-4 max-w-xs mt-2 bg-white">
                                            <option disabled selected>채널선택</option>
                                            <option value="3"
                                                <?php if ($before_data['post_info']->channel_id == 3) echo 'selected'; ?>>자유게시판
                                            </option>
                                            <option value="4"
                                                <?php if ($before_data['post_info']->channel_id == 4) echo 'selected'; ?>>7세대 머스탱
                                            </option>
                                            <option value="5"
                                                <?php if ($before_data['post_info']->channel_id == 5) echo 'selected'; ?>>머스탱 5.0
                                            </option>
                                            <option value="6"
                                                <?php if ($before_data['post_info']->channel_id == 6) echo 'selected'; ?>>머스탱 2.3
                                                에코부스터</option>
                                            <option value="7"
                                                <?php if ($before_data['post_info']->channel_id == 7) echo 'selected'; ?>>머스탱은 OOO
                                                이다</option>
                                            <option value="8"
                                                <?php if ($before_data['post_info']->channel_id == 8) echo 'selected'; ?>>머스탱 시승기 공유
                                            </option>
                                            <option value="9"
                                                <?php if ($before_data['post_info']->channel_id == 9) echo 'selected'; ?>>머스탱 연비 공유
                                            </option>
                                            <option value="10"
                                                <?php if ($before_data['post_info']->channel_id == 10) echo 'selected'; ?>>머스탱 부품 공유
                                            </option>
                                            <option value="11"
                                                <?php if ($before_data['post_info']->channel_id == 11) echo 'selected'; ?>>
                                                맛집/여행/드라이브</option>
                                            <option value="12"
                                                <?php if ($before_data['post_info']->channel_id == 12) echo 'selected'; ?>>리스/승계
                                            </option>
                                            <option value="13"
                                                <?php if ($before_data['post_info']->channel_id == 13) echo 'selected'; ?>>사건사고
                                            </option>
                                            <option value="14"
                                                <?php if ($before_data['post_info']->channel_id == 14) echo 'selected'; ?>>QNA
                                            </option>
                                            <option value="16"
                                                <?php if ($before_data['post_info']->channel_id == 16) echo 'selected'; ?>>서울
                                            </option>
                                            <option value="17"
                                                <?php if ($before_data['post_info']->channel_id == 17) echo 'selected'; ?>>대전
                                            </option>
                                            <option value="18"
                                                <?php if ($before_data['post_info']->channel_id == 18) echo 'selected'; ?>>대구
                                            </option>
                                            <option value="19"
                                                <?php if ($before_data['post_info']->channel_id == 19) echo 'selected'; ?>>부산
                                            </option>
                                            <option value="20"
                                                <?php if ($before_data['post_info']->channel_id == 20) echo 'selected'; ?>>제주
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-6">
                                        <label for="title"
                                            class="block mb-2 font-bold text-gray-900 bg-white text-lg">제목</label>
                                        <input type="text" name="title" id="title"
                                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            value="<?php echo htmlspecialchars($title); ?>">

                                    </div>
                                    <div class="mb-6" id="editor">


                                        <label for="content"
                                            class="block mb-2 font-bold text-gray-900 dark:text-white text-lg"></label>

                                        <textarea class="h-36" type="text" name="content"
                                            id="content"><?php echo htmlspecialchars_decode($content); ?></textarea>


                                    </div>

                                    <div class="flex justify-between">
                                        <div class="mt-2">
                                        <div class="ml-2 mb-2">* 글작성시 파일 크기는 총 500MB 이하여야 합니다</div>
                                            <div class="ml-2 mb-2">* 파일첨부는 최대 10개까지만 가능합니다.</div>
                                            <div class="ml-2 mb-2">* 단일 파일 추가는 불가능합니다.</div>
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

                            </div>

                            <div class="m-8">
                                <div class="mt-4 flex flex-col">
                                <?php if (!empty($before_data['files'])): ?>
                                    <div><strong>[첨부된 파일]</strong></div>
                                    <?php else: ?>
                                    <div><strong></strong></div>
                                    <?php endif; ?>
                                    <div id="existing-files">
                                        <?php foreach ($before_data['files'] as $file): ?>
                                        <div id="file-<?php echo $file->file_id; ?>">
                                            <?php echo $file->file_name; ?>
                                            <button class="bg-blue-500 rounded text-white w-8 h-6 m-2"
                                                onclick="deleteFile('<?php echo $file->file_id; ?>', '<?php echo $post_id; ?>')">X</button>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                            
                                </div>
                            </div>


                            <?php endif; ?>
                        </div>

                        <button id="scrollTopBtn"
                            class="w-24 fixed hover:bg-green-500 bottom-16 right-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            위로<i class="fa-solid fa-arrow-up"></i>
                        </button>
                        <button id="scrollBottomBtn"
                            class="w-24 fixed bottom-4 right-4 bg-blue-500 hover:bg-green-500 text-white font-bold py-2 px-4 rounded">
                            아래로<i class="fa-solid fa-arrow-down"></i>
                        </button>

                    </div>





                    <script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>
                    <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />


                
                </div>
        
            </main>
            <!-- Rightbar -->
            <aside class="w-84">
                <?php $this->load->view('layout/rightbar'); ?>
            </aside>



        </div>
    </div>
</body>

<style>
    .toastui-editor-mode-switch {
        display: none !important;
    }
</style>

<script>

// 파일 업로드 관련 설정
var maxFileSize = 50000000; 

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


const editor = new toastui.Editor({
    el: document.querySelector('#editor'), // 에디터를 적용할 요소 (컨테이너)
    height: '500px', // 에디터 영역의 높이 값 (OOOpx || auto)
    initialEditType: 'wysiwyg', // 최초로 보여줄 에디터 타입 (markdown || wysiwyg)
    initialValue: document.querySelector('#content').value, // 내용의 초기 값으로, 반드시 마크다운 문자열 형태여야 함
    previewStyle: 'vertical', // 마크다운 프리뷰 스타일 (tab || vertical)
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



document.getElementById('edit_form').addEventListener('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);
    var editorContent = editor.getHTML(); 

    formData.append('content', editorContent); 
    formData.append('channel_id', document.querySelector('select[name="channel_id"]').value);
    let post_id = $('#edit_form').attr('data-post-id');

    // 제목 검사
    let title = document.getElementById('title').value.trim();

    if (title === '') {
        alert('제목을 입력해주세요.');
        return;
    }

    // 내용 검사
    if (editorContent.trim() === '') {
        alert('내용을 입력해주세요.');
        return;
    }

      // 파일 업로드 수 및 크기 검사
      var fileInput = document.getElementById('file');
      if (fileInput) {
        var files = fileInput.files;
        if (files.length > 10) {
            alert('파일은 최대 10개까지 업로드 가능합니다.');
            return;
        }

        // 파일 크기 검사
        for (var i = 0; i < files.length; i++) {
            if (files[i].size > maxFileSize) {
                alert('파일이 허용된 최대 크기를 초과했습니다.');
                return;
            }
        }
    }

    axios.post('/posts/write/post_edit/' + post_id, formData)
        .then(function(response) {
            console.log('성공: ', response);
            alert('글이 수정되었습니다.')
            location.href = '/posts/free/' + post_id;
        })
        .catch(function(error) {
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



var uploadedFiles = []; // 이미 업로드된 파일 목록을 저장할 배열

document.getElementById('file').addEventListener('change', function(e) {
    var files = e.target.files;
    var filesList = document.getElementById('existing-files');

    for (var i = 0; i < files.length; i++) {
        var file = files[i];

        // 이미 업로드된 파일인지 확인
        if (!uploadedFiles.includes(file.name)) {
            uploadedFiles.push(file.name); // 새로운 파일을 배열에 추가

            var fileElement = document.createElement('div');
            fileElement.className = 'new-file';
            fileElement.id = 'file-' + uploadedFiles.length; // 파일 요소에 고유한 ID 할당
            fileElement.innerHTML = file.name +
                ' <button class="bg-blue-500 rounded text-white w-8 h-6 m-2" onclick="newfile_remove(' + (
                    uploadedFiles.length - 1) + ')">X</button>';
            filesList.appendChild(fileElement);
        }
    }
});

function newfile_remove(index) {
    var filesInput = document.getElementById('file');
    var dataTransfer = new DataTransfer();

    // 선택된 파일을 제외하고 나머지 파일들을 DataTransfer 객체에 추가
    Array.from(filesInput.files).forEach((file, i) => {
        if (i !== index) {
            dataTransfer.items.add(file);
        }
    });

    // filesInput의 파일들을 업데이트
    filesInput.files = dataTransfer.files;

    // 파일 목록을 새로고침
    var event = new Event('change');
    filesInput.dispatchEvent(event);

    // DOM에서 해당 파일 요소를 제거
    var fileElement = document.getElementById('file-' + (index + 1)); // ID를 찾을 때 인덱스를 올바르게 조정
    if (fileElement) {
        fileElement.parentNode.removeChild(fileElement);
        uploadedFiles.splice(index, 1); // 배열에서도 파일 이름을 제거
    }
}

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



function deleteFile(fileId, postId) {
    $.ajax({
        url: '/posts/write/delete_file/' + fileId + '/' + postId,
        dataType: "json",
        type: 'POST',
        success: function(response) {

            if (response.status) {
                // 파일 목록 갱신 또는 사용자에게 알림
                $('#file-' + fileId).remove();
                // 예: 파일 목록을 다시 로드하거나, 화면에서 해당 파일 요소를 제거
            } else {

            }
        },
        error: function(error) {
            console.error('Error:', error);
            alert('오류가 발생했습니다.');
        }
    });
}
</script>