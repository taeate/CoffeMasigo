
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
                            <div class="mb-6">
                

                                <label for="content" class="block mb-2 font-bold text-gray-900 dark:text-white text-lg">내용</label>
                               
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



document.getElementById('edit_form').addEventListener('submit', function(e) {
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
    formData.append('channel_id', document.querySelector('select[name="channel_id"]').value);
    let post_id = $('#edit_form').attr('data-post-id');


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




document.getElementById('file').addEventListener('change', function(e) {
    var files = e.target.files;
    var filesList = document.getElementById('existing-files'); 

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var fileElement = document.createElement('div');
        fileElement.className = 'new-file'; 
        fileElement.innerHTML = file.name + ' <button class="bg-blue-500 rounded text-white w-8 h-6 m-2" onclick="newfile_remove(' + i + ')">X</button>';
        filesList.appendChild(fileElement);
    }
});

function newfile_remove(index) {
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
	.ck.ck-editor {
    	
	}
	.ck-editor__editable {
	    min-height: 200px;
	}
</style>
 