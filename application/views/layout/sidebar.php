
<div class=" bg-base-100 h-auto w-auto rounded">
    <div name="sidebar-container" class="rounded">
        <div class=" bg-base-100 h-auto flex">
            <div class="flex mt-12 ml-8">

                <div name="profile-image" class="">
                    <label tabindex="0" class="btn btn-ghost btn-circle avatar w-32 h-20 mr-4">
                    <div class="w-500 rounded-full">
                    <img src="/application/views/images/sho.jpg" />
                    </div>
                    </label>
                </div>

                <div name="flex justify-center sidebar-text" class="flex flex-col justify-center h-full"> 
                    <div class="text-xl font-bold mb-2">
                        user
                    </div>
                    <div class="text-sm">
                        내가 쓴 글 3개
                    </div>
                    <div class="text-sm mt-1">
                        내가 쓴 댓글 16개
                    </div>
                    <div class="text-sm mt-1">
                        마이페이지
                    </div>
                </div>

            </div>

        </div>
        <div>
        <div name="login-write-but" class="flex justify-center mt-8">
                <a href="/posts/write" class="btn btn-primary w-40 h-12 rounded-lg" >글작성하기</a>
           </div>
        </div>

        <hr class="mt-8">
        

        <div name="sec-side-box" class="mt-4 ml-8">
            <div >
                
                <button  class="hover:bg-base-200">
                    <a href="">전체글보기</a>
                </button>
                <div>인기글보기</div>
            </div>
        </div>
            
        <hr class="mt-4">


        <div name="sec-side-box" class="mt-4 ml-8">
            <div >
                <div>공지사항</div>
                <button  class="hover:bg-base-200">
                    <a href="">자유</a>
                </button>
                <div>가입인사</div>
                <div>사건사고</div>
            </div>
        </div>
            
        <hr class="mt-4">
    </div>

</div>
