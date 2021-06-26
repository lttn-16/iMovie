<!-- Trang tin tức -->

<!-- Navigation -->
<?php include "./include/navigation.php"; ?>
<!--Page content -->
<div class="container container-index">
    <div class="left">
        <h3 class="block-title">
            Phim hài
        </h3>
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = '';
        }

        if ($page == '' || $page == 1) {
            $page_1 = 0;
        } else {
            $page_1 = ($page * 10) - 10;
        }

        $post_query_count = "SELECT * FROM posts WHERE post_category_id = 4";
        $find_count = mysqli_query($connection, $post_query_count);
        $count = mysqli_num_rows($find_count);
        $count = ceil($count / 10);

        $query = "SELECT * FROM posts WHERE post_category_id = 4 LIMIT $page_1,10";
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
                            <img class="index-img" src="images/<?php echo $post_image_display; ?>">
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

        <ul class="pagination justify-content-center">
            <?php
            for ($i = 1; $i <= $count; $i++) {
                if ($i == $page) {
                    echo "<li class='page-item active'><a class='page-link' href='phimhai.php?page={$i}'>{$i}</a></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='phimhai.php?page={$i}'>{$i}</a></li>";
                }
            }
            ?>
        </ul>
    </div>
    <!-- Sidebar -->
    <?php include "include/side-bar.php"; ?>
    <!-- End Sidebar -->
</div>
<!-- End page content -->
<?php include "include/footer.php"; ?>