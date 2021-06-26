<?php include "include/header.php"; ?>
<!-- Trang chủ -->
<?php include "include/navigation.php"; ?>
<?php include "include/user_online.php" ?>

</script>  
<div class="container container-index">
    <div class="left">
        <div class="title-wrap">
            <h4 class="block-title">
                <a href="#">REVIEW PHIM </a>
            </h4>
        </div>
        <?php
        $query = "SELECT * FROM posts LIMIT 4";
        $query_seclect_all_posts = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($query_seclect_all_posts)) {
            $post_title = $row['post_title'];
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image_display = $row['post_img_display'];
            $post_status = $row['post_status'];
            $post_summary = $row['post_summary'];
            if ($post_status == 'published') {
        ?>
                <div class="row row-index">
                    <div class="post">
                        <a href="post.php?p_id=<?php echo $post_id ?>">
                            <img class="index-img" src="images/<?php echo $post_image_display;?>">
                        </a>
                        <div class="content">
                            <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                            <p class="date"><?php echo $post_date ?></p>
                            <span><?php echo $post_summary ?></span>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>

        <h4 class="block-title">
            <a href="#">Giới thiệu phim hay </a>
        </h4>
        <?php
        $query = "SELECT * FROM posts WHERE post_category_id = 7 LIMIT 4";
        $query_seclect_all_posts = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($query_seclect_all_posts)) {
            $post_title = $row['post_title'];
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image_display = $row['post_img_display'];
            $post_status = $row['post_status'];
            $post_summary = $row['post_summary'];
            if ($post_status == 'published') {
        ?>
                <div class="row row-index">
                    <div class="post">
                        <a href="post.php?p_id=<?php echo $post_id ?>">
                            <img class="index-img" src="images/<?php echo $post_image_display;?>">
                        </a>
                        <div class="content">
                            <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                            <p class="date"><?php echo $post_date ?></p>
                            <span><?php echo $post_summary ?></span>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>



        <h4 class="block-title">
            <a href="#">Tin tức </a>
        </h4>
        <?php
        $query = "SELECT * FROM posts WHERE post_category_id = 6 LIMIT 4";
        $query_seclect_all_posts = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($query_seclect_all_posts)) {
            $post_title = $row['post_title'];
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image_display = $row['post_img_display'];
            $post_status = $row['post_status'];
            $post_summary = $row['post_summary'];
            if ($post_status == 'published') {
        ?>
                <div class="row row-index">
                    <div class="post">
                        <a href="post.php?p_id=<?php echo $post_id ?>">
                            <img class="index-img" src="images/<?php echo $post_image_display;?>">
                        </a>
                        <div class="content">
                            <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                            <p class="date"><?php echo $post_date ?></p>
                            <span><?php echo $post_summary ?></span>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>

    </div>

    <?php include "include/side-bar.php"; ?>

</div>

<?php include "include/footer.php"; ?>