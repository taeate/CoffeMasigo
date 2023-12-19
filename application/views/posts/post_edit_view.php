
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
                    
               
                   
                        <?php if($before_data): ?>
                            <?php $title = $before_data['post_info']->title; ?>
                            <?php $content = $before_data['post_info']->content; ?>
                            <?php $post_id = $before_data['post_info']->post_id; ?>
                            <?php $channel_name = $before_data['post_info']->channel_name; ?>
                            
                            
                           
                      
                        <div class="flex justify-normal mb-2">
                            <div class="flex flex-none">
                                <div class="mt-2 text-2xl">
                                    <?php echo $title; ?>
                                </div>
                     
                            </div>
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
                       

                        <form id="edit_form" method="POST" class="mt-8"  enctype="multipart/form-data" data-post-id="<?= $post_id ?>">
                            <div class="mb-4">
                                <select name="channel_id" class="select select-bordered w-52 h-4 max-w-xs mt-2">
                                    <option disabled selected>채널선택</option>
                                    <option value="3" <?php if ($before_data['post_info']->channel_id == 3) echo 'selected'; ?> >자유게시판</option>
                                    <option value="4" <?php if ($before_data['post_info']->channel_id == 4) echo 'selected'; ?>>7세대 머스탱</option>
                                    <option value="5" <?php if ($before_data['post_info']->channel_id == 5) echo 'selected'; ?>>머스탱 5.0</option>
                                    <option value="6" <?php if ($before_data['post_info']->channel_id == 6) echo 'selected'; ?>>머스탱 2.3 에코부스터</option>
                                    <option value="7" <?php if ($before_data['post_info']->channel_id == 7) echo 'selected'; ?>>머스탱은 OOO 이다</option>
                                    <option value="8" <?php if ($before_data['post_info']->channel_id == 8) echo 'selected'; ?>>머스탱 시승기 공유</option>
                                    <option value="9" <?php if ($before_data['post_info']->channel_id == 9) echo 'selected'; ?>>머스탱 연비 공유</option>
                                    <option value="10" <?php if ($before_data['post_info']->channel_id == 10) echo 'selected'; ?>>머스탱 부품 공유</option>
                                    <option value="11" <?php if ($before_data['post_info']->channel_id == 11) echo 'selected'; ?>>맛집/여행/드라이브</option>
                                    <option value="12" <?php if ($before_data['post_info']->channel_id == 12) echo 'selected'; ?>>리스/승계</option>
                                    <option value="13" <?php if ($before_data['post_info']->channel_id == 13) echo 'selected'; ?>>사건사고</option>
                                    <option value="14" <?php if ($before_data['post_info']->channel_id == 14) echo 'selected'; ?>>QNA</option>
                                    <option value="16" <?php if ($before_data['post_info']->channel_id == 16) echo 'selected'; ?>>서울</option>
                                    <option value="17" <?php if ($before_data['post_info']->channel_id == 17) echo 'selected'; ?>>대전</option>
                                    <option value="18" <?php if ($before_data['post_info']->channel_id == 18) echo 'selected'; ?>>대구</option>
                                    <option value="19" <?php if ($before_data['post_info']->channel_id == 19) echo 'selected'; ?>>부산</option>
                                    <option value="20" <?php if ($before_data['post_info']->channel_id == 20) echo 'selected'; ?>>제주</option>
                                </select>
                            </div>
                            <div class="mb-6">
                                <label for="title" class="block mb-2 font-bold text-gray-900 dark:text-white text-lg">제목</label>
                                <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $title; ?>">
                            
                            </div>
                            <div class="mb-6" id="editor">
                

                                <label for="content" class="block mb-2 font-bold text-gray-900 dark:text-white text-lg"></label>
                               
                                <textarea class="h-36" type="text" name="content" id="content"><?php echo $content; ?></textarea>
                        
                                
                            </div>

                            <div class="flex justify-between">
                                <div class="mt-2">
                                    <div class="ml-2 mb-2">* 파일 크기는 250kb 이하여야 합니다.</div>
                                    <input type="file" id="file" name="file[]" class="file-input file-input-bordered w-full max-w-xs" multiple />
                                    <div id="uploaded-files"></div>
                                </div>
                                <div>
                                    <button type="submit" class="bg-gray-500 text-white w-24 h-12 rounded">취소</button>
                                    <button type="submit" class="bg-gray-500 text-white w-24 h-12 rounded">작성</button>
                                </div>
                            </div>

                           
                        </form>
                    
                </div>
                                
                <div  class="m-8">
                    <div class="mt-4 flex flex-col">
                        <div><strong>[첨부된 파일]</strong></div>
                        <div id="existing-files">
                        <?php foreach ($before_data['files'] as $file): ?>
                            <div id="file-<?php echo $file->file_id; ?>">
                                <?php echo $file->file_name; ?>
                                <button class="bg-blue-500 rounded text-white w-8 h-6 m-2" onclick="deleteFile('<?php echo $file->file_id; ?>', '<?php echo $post_id; ?>')">X</button>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
              
               
                <?php endif; ?>
            </div>
           
        </div>
        
 

                         

        <script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>
        <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />


        </body>
    </div>
</div>


<script>


const editor = new toastui.Editor({
    el: document.querySelector('#editor'), // 에디터를 적용할 요소 (컨테이너)
    height: '500px',                        // 에디터 영역의 높이 값 (OOOpx || auto)
    initialEditType: 'markdown',            // 최초로 보여줄 에디터 타입 (markdown || wysiwyg)
    initialValue: document.querySelector('#content').value,     // 내용의 초기 값으로, 반드시 마크다운 문자열 형태여야 함
    previewStyle: 'vertical',                // 마크다운 프리뷰 스타일 (tab || vertical)
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
    var editorContent = editor.getMarkdown(); // 또는 editor.getHtml() 사용
    formData.append('content', editorContent); // 에디터 내용을 FormData에 추가
    formData.append('channel_id', document.querySelector('select[name="channel_id"]').value);
    let post_id = $('#edit_form').attr('data-post-id');

    // 제목 검사
    let title = document.getElementById('title').value.trim();

    if (title === '' ) {
        alert('제목을 입력해주세요.');
        return;
    }

    // 내용 검사
    if (editorContent.trim() === '' ) {
        alert('내용을 입력해주세요.');
        return;
    }
   


    axios.post('/posts/write/post_edit/'+post_id, formData)
        .then(function (response) {
            console.log('성공: ', response);
            alert('글이 수정되었습니다.')
            location.href = '/posts/free/' +post_id;
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
            fileElement.innerHTML = file.name + ' <button class="bg-blue-500 rounded text-white w-8 h-6 m-2" onclick="newfile_remove(' + (uploadedFiles.length - 1) + ')">X</button>';
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
        dataType:"json",
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

 