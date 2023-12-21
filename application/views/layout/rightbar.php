
<div class="bg-base-100 h-auto w-[300px] rounded rightbox">
    
<div class="flex flex-col gap-2 p-4  border-b rounded w-[300px]">

    <p class="flex justify-center font-bold text-lg">
        카페에서 가장 인기 있는 글
    </p>
</div>
<div class="p-2 ">
    <div class="justify-center">
            <ul>
                
                <?php foreach($hot_posts as $hot_post): ?>
                <li>
                <a href="/posts/free/<?= $hot_post['post_id'] ?>" class="p-1 hover:bg-gray-200 text-sm overflow-hidden whitespace-nowrap hover:cursor-pointer ">
                    <?= $hot_post['channel_name'] ?> ·
                    <?php echo mb_strimwidth($hot_post['title'], 0, 25, "..."); ?>
                </a>

                    
                </li>
                <?php endforeach;?>
                <!-- <li>
                <?php echo mb_strimwidth(" w-autow-autow-autow-autow-autow-autow-autow-autow-autow-autow-autow-autow-autow-autow-autow-autow-autow-autow-autow-autow-autow-autow-autow-autow-autow-autow-autow-autow-auto", 0, 35, "..."); ?>     
                </li> -->
            
            </ul>
        


    </div>
</div>
    
</div>
