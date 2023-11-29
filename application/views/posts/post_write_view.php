
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

                            <div class="form-control mr-4">
                                <label class="cursor-pointer label">
                                    <input type="checkbox" checked="checked" class="checkbox checkbox-accent" />
                                    <span class="label-text ml-1">공지로등록</span>
                                </label>
                            </div>

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

                        <form method="POST" class="mt-8">
                            <div class="mb-6">
                                <label for="title" class="block mb-2 font-bold text-gray-900 dark:text-white text-lg">제목</label>
                                <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 " value="<?php echo set_value('title'); ?>">
                                <?php echo form_error('title'); ?>
                            </div>
                            <div class="mb-6">
                

                                <label for="content" class="block mb-2 font-bold text-gray-900 dark:text-white text-lg">내용</label>
                               
                                <textarea class="h-36 form-control ckeditor" type="text" name="content" id="content" value="<?php echo set_value('content'); ?>"></textarea>
                                <?php echo form_error('content'); ?>

                                
                            </div>

                            <div class="flex justify-between">
                                <div class="mt-2">
                                    <div class="ml-2 mb-2">* 파일 크기는 250kb 이하여야 합니다.</div>
                                    <input type="file" class="file-input file-input-bordered w-full max-w-xs" />
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
                                <option>자유</option>
                                <option>PYTHON</option>
                                <option>JAVA</option>
                                <option>PHP</option>
                                <option>C++</option>
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

                    
                            
                        <form method="POST" class="mt-8">
                            <?php if($user_role == 'admin'): ?>
                            <div class="flex mb-4">
                                <div class="form-control mr-2 ">
                                    <label class="cursor-pointer label">
                                        <input name="is_notice" type="checkbox"  class="checkbox checkbox-accent" />                                   
                                    </label>              
                                </div>
                                <span class="label-text mt-3">공지로등록</span>
                               
                            </div>
                           <?php endif; ?>
                            <div class="mb-6">
                                <label for="title" class="block mb-2 font-bold text-gray-900 dark:text-white text-lg">제목</label>
                                <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 "  value="<?php echo set_value('title'); ?>" >
                                <?php echo form_error('title'); ?>
                            </div>
                            <div class="mb-6">
                            

                                <label for="content" class="block mb-2 font-bold text-gray-900 dark:text-white text-lg" value="<?php echo set_value('content'); ?>">내용</label>
                               
                                <textarea class="h-36" type="text" name="content" id="content"></textarea>
                                <?php echo form_error('content'); ?>
                                
                            </div>

                            <div class="flex justify-between">
                                <div class="mt-2">
                                    <div class="ml-2 mb-2">* 파일 크기는 250kb 이하여야 합니다.</div>
                                    <input type="file" id="file" name="file[]" class="file-input file-input-bordered w-full max-w-xs" />
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


  ClassicEditor.create( document.querySelector( '#content' ), {
    
    language: "ko",
    simpleUpload: {
        uploadUrl: '/posts/write/saveImage'
    },
    ckfinder : {
        uploadUrl: "/posts/write/saveImage",
        withCredentials: true
    }

  } )
  .then(editor => {
      // 초기화가 성공적으로 완료됐을 때 실행될 코드
      console.log(editor);
    })
    .catch(error => {
      // 초기화 중 오류가 발생했을 때 실행될 코드
      console.error(error);
    });



//     $(document).ready(function () {
//     $('#file').on('change', function (event) {
//         var files = event.target.files;

//         var formData = new FormData();
//         for (var i = 0; i < files.length; i++) {
//             formData.append('file[]', files[i]);
//         }

//         $.ajax({
//             url: '/posts/write/upload_files', 
//             type: 'POST',
//             data: formData,
//             contentType: false,
//             processData: false,
//             success: function (data) {
//                 // 업로드된 파일 목록을 표시하는 로직
//                 if(data.uploaded) {
//                     data.files.forEach(function(file) {
//                         $('#uploaded-files').append('<div>' + file.name + ' <button onclick="removeFile(' + file.id + ')">삭제</button></div>');
//                     });
//                 }
//             },
//             error: function (jqXHR, textStatus, errorThrown) {
//                 // 오류 처리 로직
//                 console.log('File upload failed: ' + textStatus);
//             }
//         });
//     });
// });

// function removeFile(fileId) {
//     // 파일 삭제 요청을 서버에 보내는 AJAX 코드
// }







</script>
<style>
  
	.ck-editor__editable {
	    min-height: 200px;
	}

    
</style>
 