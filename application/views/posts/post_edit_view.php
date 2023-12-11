
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

                        <form id="editForm" method="POST" class="mt-8"  enctype="multipart/form-data">
                            <div class="mb-6">
                                <label for="title" class="block mb-2 font-bold text-gray-900 dark:text-white text-lg">제목</label>
                                <input type="hidden" name="post_id" id="post_id" value="<?php echo $post_id; ?>">
                                <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $title; ?>">
                            </div>
                            <div class="mb-6">
                

                                <label for="edit_content" class="block mb-2 font-bold text-gray-900 dark:text-white text-lg">내용</label>
                               
                                <textarea class="h-36" type="text" name="edit_content" id="edit_content"><?php echo $content; ?></textarea>
                                

                                
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
                                
                <div name="content " class="m-8">
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

ClassicEditor.create(document.querySelector('#edit_content'), {
    language: "ko",
    simpleUpload: {
        uploadUrl: '/posts/write/saveImage'
    },
    ckfinder: {
        uploadUrl: "/posts/write/saveImage",
        withCredentials: true
    }
});

document.getElementById('editForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var formData = new FormData(this);
    
    // 폼 안의 post_id 필드의 값을 가져옴
    var post_id = formData.get('post_id');

    console.log(post_id);

    fetch('/posts/write/post_edit/' + post_id, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // 수정 성공 메시지 표시 또는 리디렉션
            window.location.href = '/posts/free/' + post_id;
        } else {
            // 에러 메시지 표시
            alert(data.message);
        }
    })
    .catch(error => {
        // 네트워크 오류 또는 서버 에러 처리
        console.error('Error:', error);
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



  ClassicEditor.create( document.querySelector( '#content' ), {
    
    language: "ko"
  } )
</script>
<style>
	.ck.ck-editor {
    	
	}
	.ck-editor__editable {
	    min-height: 200px;
	}
</style>
 