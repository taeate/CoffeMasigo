<?php $this->load->view('layout/header'); ?>

<body>

<div class="flex-container" style="display: flex; margin-left: 400px; margin-right: 400px; margin-top: 200px; margin-bottom: 200px;">


    <!-- 사이드바 -->
    <div class="w-80">
        <?php $this->load->view('layout/sidebar'); ?>
    </div>
    
    <!-- 리스트 페이지 컨텐츠 -->
    <div id="content" class="contentbox ml-4 z-10 bg-base-100" style="flex: 3;" >
        <?php if($this->session->userdata('user_id')):?>
        <div class="container">
                <div class="flex flex-col items-center p-14">
                    <!-- <div class="text-2xl mb-12">내정보</div> -->
                    <div class="flex flex-col items-center">

                        <div class="w-44 h-44 rounded-full border-2 border-gray-300 flex items-center justify-center overflow-hidden">
                            <img id="userimage" src="<?php echo ('uploads/' . $this->session->userdata('profile_image')); ?>" class="object-cover object-center h-full w-full" />
                            <img style="display: none;" onchange="previewImage(this)" id="image-preview"  alt="프로필 미리보기" class="object-cover object-center h-full w-full" />
                        </div>
                        <h5 class="mb-1 mt-4 text-xl font-bold text-gray-900 dark:text-white"><?php echo $this->session->userdata('username');?></h5>
                        <span class="text-sm text-gray-500 font-medium dark:text-gray-400"><?php echo $this->session->userdata('user_id');?></span>
                        <div class="flex mt-4 md:mt-6">
                            <form action="" method="post">
                            <input type="file" class="hidden" id="file-input" name="profile_image">
                            <a id="imgchange-btn" onclick="openFileUploader();" href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">프로필사진 변경</a>
                            <button type="submit" onclick="saveProfile()" id="save-btn" class="btn btn-accent hidden">저장</button>
                            <button onclick="cancelProfileChange()" id="cancel-btn" class="btn btn-error hidden">취소</button>
                            </form>
                        
                        </div>

                        <div class="grid grid-cols-2 grid-rows-2 gap-4 mt-12">

                            <div name="1">
                                    <div class="w-full w-max-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <div class="p-6 font-bold text-lg">MEMBER</div>
                                        <hr>
                                        <div class="p-6">
                                            <div class="mb-3 text-gray-500 flex" name="userid">
                                                <div><i class="fa-solid fa-address-card mr-2"></i></div>
                                                <div><?php echo $this->session->userdata('user_id');?></div>
                                            </div>
                                            <div class="mb-3 text-gray-500 flex" name="useremail" class="flex items-center">
                                                <div><i class="fa-solid fa-envelope mr-2"></i></div>
                                                <div><?php echo $this->session->userdata('email');?></div>
                                            </div>
                                            <div class="mb-3 text-gray-500 flex" name="useremail" class="flex items-center">
                                                <div><i class="fa-solid fa-calendar mr-2"></i></div>
                                                <div>2023.11.29</div>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <div name="2">
                                    <div class="w-full w-max-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <div class="p-6 font-bold text-lg">비밀번호</div>
                                        <hr>
                                        <div class="p-6">
                                           <button onclick="my_modal_1.showModal()" class="text-blue-500" href="">비밀번호 재설정</button>
                                           
                                            <dialog id="my_modal_1" class="modal">
                                            <div class="modal-box">
                                                <h3 class="font-bold text-xl mt-4 mb-4">비밀번호변경</h3>
                                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" id="close_modal_button" onclick="closeModal()">✕</button> 
                                                <form id="password-form" class="space-y-4" action="#" method="post">
                                               
                                                    <div>
                                                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">비밀번호</label>
                                                        <input type="password" name="password0" id="password0" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                                                        <?php if ($this->session->flashdata('error')): ?>
                                                        <div class="text-red-500"><?php echo $this->session->flashdata('error'); ?></div>
                                                        <?php endif; ?>
                                                        <div class="text-red-500" id="password_error_0"><?php echo form_error('password0'); ?></div>
                                                        
                                                    </div>
                                                    <div>
                                                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">변경할 비밀번호</label>
                                                        <input type="password" name="password1" id="password1" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                                                        <div class="text-red-500" id="password_error_1"><?php echo form_error('password1'); ?></div>
                                                    </div>
                                                    <div>
                                                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">비밀번호 확인</label>
                                                        <input type="password" name="password2" id="password2" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                                                        <div class="text-red-500" id="password_error_2"><?php echo form_error('password2'); ?></div>
                                                    </div>
                                                    <div class="flex justify-between">
                                          
                                                        <a href="#" class="text-sm text-blue-700 hover:underline dark:text-blue-500">비밀번호를 잊어버리셨나요?</a>
                                                    </div>
                                                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">변경하기</button>
                                                    
                                                </form>
                                                
                                            </div>
                                            </dialog>
                                        </div>
                                    </div>
                            </div>


                            <div name="3">
                                    <div class="w-full w-max-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <div class="p-6 font-bold text-lg">내활동</div>
                                        <hr>
                                        <div class="p-6 flex flex-col">
                                            <a href="#" class="mb-2 text-blue-500">내가 작성한 글 1개</a>
                                            <a href="#" class="mb-2 text-blue-500">내가 작성한 댓글 12개</a>
                                        </div>
                                    </div>
                            </div>

                            <div name="4">
                                    <div class="w-full w-max-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <div class="p-6">
                                            <div class="font-bold text-lg">소개글</div>
                                            <div class="text-gray-500 mt-4">소개글입니다.소개글입니다.소개글입니다.소개글입니다.소개글입니다.</div>
                                        </div>
                                        
                                        <hr>
                                        <div class="p-6">
                                             <a class="text-blue-500" href="">소개글 재설정</a>
                                        </div>
                                    </div>
                            </div>


                        </div>

                    </div>
                </div>
            
        </div>
        <?php endif;?>

        

    </div>

    <!-- <div class="w-80 ml-4">
    <?php $this->load->view('layout/rightbar'); ?>
    </div> -->

    
    
</div>
</body>
<!-- <?php $this->load->view('layout/footer'); ?> -->


<script>

    
function previewImage(input) {
    const preview = document.getElementById('image-preview');
    const userimage = document.getElementById('userimage');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            userimage.style.display = 'none'; // userimage 이미지 숨김
            preview.style.display = 'block'; // 미리보기 이미지 표시
            preview.src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function openFileUploader() {
    document.getElementById('file-input').click();
}

document.getElementById('file-input').addEventListener('change', function(event) {
    var selectedFile = event.target.files[0];

    if (selectedFile) {
        document.getElementById('imgchange-btn').style.display = 'none'; // 프로필 변경 버튼 숨김
        document.getElementById('save-btn').style.display = 'inline-block'; // 저장 버튼 표시
        document.getElementById('cancel-btn').style.display = 'inline-block'; // 취소 버튼 표시

        // 파일 선택 후 미리보기 이미지 표시
        previewImage(event.target);

        
        console.log('선택한 파일명:', selectedFile.name);
    }
});

function saveProfile() {
    const selectedFile = document.getElementById('file-input').files[0];
    console.log('sss');

    if (selectedFile) {
        
        const formData = new FormData();
        formData.append('profileImage', selectedFile);

        $.ajax({
        type: 'POST',
        url: 'member/mypage/change_image',
        data: formData,
        processData: false,  // FormData를 사용할 때 필요
        contentType: false, // FormData를 사용할 때 필요
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                // 성공적으로 처리되었을 때의 로직
                alert('저장완료');
                window.location.href = '/mypage'; // 로그인 페이지로 리다이렉트
            } else {
                // 오류 메시지를 각 필드 아래에 표시
                for (var key in response.errors) {
                    $('#' + key).addClass('is-invalid'); // 부트스트랩의 유효하지 않은 입력 표시
                    $('#' + key + '_error').text(response.errors[key]); // 오류 메시지 표시
                }
            }
        }
    });
    }
}

function cancelProfileChange() {
    document.getElementById('file-input').value = ''; // 파일 입력 필드 초기화
    document.getElementById('imgchange-btn').style.display = 'inline-block'; // 프로필 변경 버튼 표시
    document.getElementById('save-btn').style.display = 'none'; // 저장 버튼 숨김
    document.getElementById('cancel-btn').style.display = 'none'; // 취소 버튼 숨김
    // 취소 로직을 추가할 수 있습니다.
    console.log('프로필 변경을 취소합니다.');
}



function closeModal() {
    var modal = document.getElementById('my_modal_1');
    modal.close();
}
$("#password-form").submit(function(event){
    console.log('시작');
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "/member/Mypage",
        dataType: 'json',
        data: $(this).serialize(),
        success: function(response){
            console.log('s');
            if(response.error){
                $('#password_error_0').html(response.errors.password_error_0);
                $('#password_error_1').html(response.errors.password_error_1);
                $('#password_error_2').html(response.errors.password_error_2);
            } else {
                // 성공 처리
                alert(response.message); // 성공 메시지 표시후
                window.location.href = "/mypage";
            }
        },
        error: function(response){
            // 오류 메시지 표시
            // 모달을 열어 둠
        }
    });
    console.log('끝');
});




</script>