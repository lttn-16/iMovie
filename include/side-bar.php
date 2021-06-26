        <div class="right">
            <div class="title-wrap">
                <h4 class="block-title">
                    <a href="#">BÀI VIẾT XEM NHIỀU</a>
                </h4>
            </div>
            <?php 
                    $query = "SELECT * FROM posts ORDER BY post_views DESC LIMIT 10";
                    $query_seclect_all_posts = mysqli_query($connection,$query);
    
                    while($row = mysqli_fetch_assoc($query_seclect_all_posts)){
                        $post_title = $row['post_title'];
                        $post_image_display = $row['post_img_display'];
                        $post_date = $row['post_date'];
                        $post_id = $row['post_id'];
                        $post_status = $row['post_status'];
                        if($post_status == 'published'){
                    ?>
        
            <div class="post">
                <a href="post.php?p_id=<?php echo $post_id ?>">
                    <img src="images/<?php echo $post_image_display;?>">
                </a>
                <div class="content">
                    <a class="title" href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                    <span class="date"><?php echo $post_date ?></span>
                </div>
            </div>
            <?php }} ?>
        </div>