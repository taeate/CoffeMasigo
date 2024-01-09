<?php $this->load->view('layout/header'); ?>

<body>
    <div class="flex flex-col bg-gray-200 h-auto">
    <img src="/application/views/images/car.jpg" class="z-0 absolute h-[400px] w-screen object-cover" alt="">
    <div class="flex flex-1 pt-[250px] gap-4 px-[200px] z-10 relative text-black justify-center">
            
            <!-- Sidebar -->
            <aside class="w-84">
                <?php $this->load->view('layout/sidebar'); ?>
            </aside>
            <main class="w-full">
                <!-- 리스트 페이지 컨텐츠 -->
                <div id="content" class="contentbox bg-white" >
                    <?php if($this->session->userdata('user_id')):?>
                    <div class="container">
                            <div class="flex flex-col items-center p-10">
                                <!-- <div class="text-2xl mb-12">내정보</div> -->
                                <div class="flex flex-col items-center p-14">

                                    <div class="w-44 h-44 rounded-full border-2 border-gray-300 flex items-center justify-center overflow-hidden">
                                        <img id="userimage" src="<?php echo ('uploads/' . $this->session->userdata('profile_image')); ?>" class="object-cover object-center h-full w-full" />
                                        <img style="display: none;" onchange="previewImage(this)" id="image-preview"  alt="프로필 미리보기" class="object-cover object-center h-full w-full" />
                                    </div>
                                    <h5 class="mb-1 mt-4 text-xl font-bold text-gray-900 "><?php echo $this->session->userdata('username');?></h5>
                                    <span class="text-sm text-gray-500 font-medium">ID: <?php echo $this->session->userdata('user_id');?></span>
                                    <div class="flex mt-4 md:mt-6">
                                        <form action="member/Mypage/change_image" method="post">
                                        <input type="file" class="hidden" id="file-input" name="profile_image">
                                        <a id="imgchange-btn" onclick="openFileUploader();" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">프로필사진 변경</a>
                                        <button type="submit" onclick="saveProfile(event)" id="save-btn" class="btn bg-green-300 text-white hidden">저장</button>

                                        <button onclick="cancelProfileChange(event)" id="cancel-btn" class="btn btn-error hidden">취소</button>
                                        </form>
                                    
                                    </div>

                                    <div class="gap-4 p-12 text-black">

                                        <div class="flex gap-4">
                                            <div name="1" class="w-96">
                                                    <div class=" w-max-sm bg-white border border-gray-200 rounded-lg shadow">
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
                                                                <?php if(isset($user_data->create_date)): ?>
                                                                <div><?php echo date('Y.m.d', strtotime($user_data->create_date)); ?></div>                                                
                                                                    
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>

                                            <div name="2" class="w-96">
                                                    <div class="w-full h-full w-max-sm bg-white border border-gray-200 rounded-lg shadow ">
                                                        <div class="p-6 font-bold text-lg">비밀번호</div>
                                                        <hr>
                                                        <div class="p-6">
                                                        <button onclick="my_modal_1.showModal()" class="text-blue-500" href="">비밀번호 재설정</button>
                                                        
                                                            <dialog id="my_modal_1" class="modal">
                                                            <div class="modal-box dark:bg-gray-700">
                                                                <h3 class="font-bold text-xl mt-4 mb-4 dark:text-white">비밀번호변경</h3>
                                                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 dark:text-white" id="close_modal_button" onclick="closeModal1()">✕</button> 
                                                                <form id="password-form" class="space-y-4 dark:bg-gray-700" action="#" method="post">
                                                            
                                                                    <div>
                                                                        <label for="password" class="block mb-2 text-sm font-medium dark:text-white">비밀번호</label>
                                                                        <input type="password" name="password0" id="password0" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                                                                        <?php if ($this->session->flashdata('error')): ?>
                                                                        <div class="text-red-500"><?php echo $this->session->flashdata('error'); ?></div>
                                                                        <?php endif; ?>
                                                                        <div class="text-red-500 text-sm font-bold pt-2" id="password_error_0"><?php echo form_error('password0'); ?></div>
                                                                        
                                                                    </div>
                                                                    <div>
                                                                        <div class="flex gap-1">
                                                                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">변경할 비밀번호</label>
                                                                            <span class="text-sm dark:text-white">(최소 4자 이상, 영문과 숫자를 모두 포함)</span>
                                                                        </div>
                                                                        <input type="password" name="password1" id="password1" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                                                                        <div class="text-red-500 text-sm font-bold pt-2" id="password_error_1"><?php echo form_error('password1'); ?></div>
                                                                    </div>
                                                                    <div>
                                                                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">비밀번호 확인</label>
                                                                        <input type="password" name="password2" id="password2" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                                                                        <div class="text-red-500 text-sm font-bold pt-2" id="password_error_2"><?php echo form_error('password2'); ?></div>
                                                                    </div>
                                                                    <div class="flex justify-between">
                                                        
                                                                        <a href="member/Find_password/findPassword" class="text-sm text-blue-700 hover:underline dark:text-blue-500">비밀번호를 잊어버리셨나요?</a>
                                                                    </div>
                                                                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">변경하기</button>
                                                                    
                                                                </form>
                                                                
                                                            </div>
                                                            </dialog>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>


                                        <div class="flex gap-4 pt-4">
                                            <div name="3" class="w-96">
                                                    <div class="w-full h-full w-max-sm bg-white border border-gray-200 rounded-lg shadow ">
                                                        <div class="p-6 font-bold text-lg">내활동</div>
                                                        <hr>
                                                        <div class="p-6 flex flex-col">
                                                            <a href="/member/wrote/post" class="mb-2 text-blue-500">내가 작성한 글  <?php echo $post_count; ?>개</a>
                                                            <a href="/member/wrote/comment" class="mb-2 text-blue-500">내가 작성한 댓글  <?php echo $comment_count; ?>개</a>
                                                            <a href="/member/wrote/thumb_post" class="mb-2 text-blue-500">내가 추천한 글  <?php echo $wrote_thumb_post_count; ?>개</a>
                                                        </div>
                                                    </div>
                                            </div>

                                            <div name="4" class="w-96">
                                                    <div class=" w-max-sm bg-white border border-gray-200 rounded-lg shadow ">
                                                        <div class="">
                                                            <div class="p-6 font-bold text-lg">소개글</div>
                                                            <hr>
                                                            <div class="p-6 text-gray-500 break-words break-all">
                                                                <?php echo $user_data->introduction ?>
                                                            </div>
                                                        </div>
                                                        
                                                        <hr>
                                                        <div class="p-6">
                                                            <button onclick="my_modal_2.showModal()" class="text-blue-500" href="">소개글 재설정</button>
                                                            <dialog id="my_modal_2" class="modal">
                                                                <div class="modal-box dark:bg-gray-700">
                                                                    <h3 class="font-bold text-xl mt-4 mb-4 dark:text-white">소개글 변경</h3>
                                                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 dark:text-white" id="close_modal_button" onclick="closeModal2()">✕</button> 
                                                                    <form id="intro-form" class="space-y-4" action="#" method="post">
                                                                
                                                                        <div>
                                                                            <div class="flex justify-between">
                                                                                <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">소개글</label>
                                                                                <div class="text-gray-400 text-sm">
                                                                                    <span id="charCount">0</span>/
                                                                                    <span>30</span>
                                                                                </div>
                                                                            </div>
                                                                            <input type="text" name="intro" id="intro" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                                                                            
                                                                            <?php if ($this->session->flashdata('error')): ?>
                                                                            <div class="text-red-500 text-sm font-bold pt-2"><?php echo $this->session->flashdata('error'); ?></div>
                                                                            <?php endif; ?>
                                                                            <div class="text-red-500 text-sm font-bold pt-2" id="intro_error"><?php echo form_error('intro'); ?></div>
                                                                           
                                                                            
                                                                        </div>
                                                                        
                                                                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">변경하기</button>
                                                                        
                                                                    </form>
                                                                    
                                                                </div>
                                                            </dialog>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        
                    </div>
                    <?php endif;?>

                    

                </div>
            </main>
             <!-- Rightbar -->
             <aside class="w-84">
                <?php $this->load->view('layout/rightbar'); ?>
            </aside>

        </div>

    </div>
</body>



<script>

document.addEventListener('DOMContentLoaded', function () {
    var commentTextArea = document.getElementById('intro');
    var charCountSpan = document.getElementById('charCount');

    commentTextArea.addEventListener('input', function () {
        var charCount = commentTextArea.value.length;
        charCountSpan.textContent = charCount;


        if (charCount > 30) {
            alert('글자 수가 30자를 초과하였습니다.');

            commentTextArea.value = commentTextArea.value.substring(0, 30);
            charCountSpan.textContent = 30;
        }
    });
});

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

    }
});

function saveProfile(event) {
    event.preventDefault();
  
    const selectedFile = document.getElementById('file-input').files[0];



    if (selectedFile) {
        
        const formData = new FormData();
        formData.append('profile_image', selectedFile);
        
        console.log(selectedFile,'profile_image');

        $.ajax({
            type: 'POST',
            url: '/member/Mypage/change_image',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json', 
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            },
            success: function(response) {
                console.log('들어옴');
                if (response.success) {
            

                    alert('저장완료');
                    window.location.href = '/mypage'; // 로그인 페이지로 리다이렉트
                } else {
                    alert('저장실패');
                    // 오류 메시지를 각 필드 아래에 표시
                    for (var key in response.errors) {
                        $('#' + key).addClass('is-invalid');
                        $('#' + key + '_error').text(response.errors[key]);
                    }
                }
            }
        });

    }
}

function cancelProfileChange(event) {
    if (event) {
        event.preventDefault();  // 기본 동작 중단
    }

    document.getElementById('file-input').value = ''; // 파일 입력 필드 초기화

    // 프로필 이미지 관련 요소 숨김
    document.getElementById('imgchange-btn').style.display = 'inline-block'; // 프로필 변경 버튼 표시
    document.getElementById('save-btn').style.display = 'none'; // 저장 버튼 숨김
    document.getElementById('cancel-btn').style.display = 'none'; // 취소 버튼 숨김

    // 미리보기 이미지 숨김
    const preview = document.getElementById('image-preview');
    const userimage = document.getElementById('userimage');
    preview.style.display = 'none';
    userimage.style.display = 'block'; // 사용자 이미지 표시
}






function closeModal1() {
    var modal = document.getElementById('my_modal_1');
    console.log('클릭됨');
    modal.close();
}


function closeModal2() {
    var modal = document.getElementById('my_modal_2');
    console.log('클릭됨');
    modal.close();
}

$("#intro-form").submit(function(event) {
    console.log('시작');
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "/member/Mypage/change_intro",
        dataType: 'json',
        data: {
            intro: $('#intro').val() // 소개글 값을 가져와서 전달
        },
        success: function(response) {
            if (response.error) {
                $('#intro_error').html(response.errors.intro_error);
            } else {
                // 성공 처리
                alert(response.message); // 성공 메시지 표시 후
                window.location.href = "/mypage";
            }
        },
        error: function(response) {
            // 오류 메시지 표시
            // 모달을 열어 둠
        }
    });
    console.log('끝');
});



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