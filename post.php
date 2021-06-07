<!-- Trang hiển thị nội dung bài viết -->
<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>
<?php include "include/navigation.php"; ?>
<div class="container container-index">
    <div class="left">
        <!-- Post header -->
        <div>
            <div>
                <?php

                if (isset($_GET['p_id'])) {
                    $the_post_id = $_GET['p_id'];
                } else {
                    header("Location: index.php");
                }

                $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                $query_seclect_all_posts = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($query_seclect_all_posts)) {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_content = $row['post_content'];
                    $post_summary = $row['post_summary'];
                    $post_tags = $row['post_tags'];
                    $tags = explode(',', $post_tags);

                ?>

                    <h1>
                        <?php echo $post_title ?>

                    </h1>
            </div>
            <div class="sub-title">
                <p>
                    <i><?php echo $post_summary ?></i>
                </p>
            </div>
            <div class="date-info">
                <h5><i class="fa fa-clock-o"></i> Đăng bởi <?php echo $post_author ?>, <?php echo $post_date ?></h5>
            </div>
        </div>
        <!-- End Post header -->

        <!--Post-content -->
        <div class="post-content">

            <!-- <p>
                    <img class="body-img" src="./images/<?php echo $post_image; ?>" sizes="(max-width: 800px) 100vw, 800px">
                </p> -->
            <p>
                <?php echo $post_content ?>
            </p>



        </div>
        <!-- End Post-content -->

        <!-- Tag list -->
        <div class="tag">
            <button type="button" class="btn btn-dark" disabled="disabled">TAGS</button>
            <?php
                    foreach ($tags as $tag) {
                        echo "<button type='button' class='btn btn-danger btn-outline ml-2'>$tag</button>";
                    }
            ?>

        </div>

        <!--End Tag list -->

        <!-- Social share -->
        <div class="social-share">
            <!-- Add font awesome icons -->
            <a href="#" class="fa fa-social fa-facebook"></a>
            <a href="#" class="fa fa-social fa-twitter"></a>
            <a href="#" class="fa fa-social fa-linkedin"></a>
            <a href="#" class="fa fa-social fa-pinterest"></a>
        </div>
        <!-- End Social share -->

        <!-- Comment zone -->

        <!-- Comment Form -->
        <div class="comment">
            <h4><b>Bình luận:</b></h4>
            <form role="form" method="POST">
                <div class="form-group">
                    <label for="author">Tên</label>
                    <input type="text" class="form-control" name="comment_author">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="comment_email">
                </div>
                <div class="form-group">
                    <label for="comment">Nội dung</label>
                    <textarea class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-danger">Đăng</button>
            </form>
        </div>
        <!-- End Comment Form -->

        <p><span class="badge">2</span> Comments:</p><br>
        <!-- Reply Zone -->
        <div class="row">
            <div class="col-sm-2 text-center">
                <img src="./images/avatar.jpg" class="img-circle" height="65" width="65" alt="Avatar">
            </div>
            <div class="col-sm-10">
                <h4>Anja <small>Sep 29, 2015, 9:12 PM</small></h4>
                <p>Keep up the GREAT work! I am cheering for you!! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <br>
            </div>
            <div class="col-sm-2 text-center">
                <img src="./images/avatar.jpg" class="img-circle" height="65" width="65" alt="Avatar">
            </div>
            <div class="col-sm-10">
                <h4>John Row <small>Sep 25, 2015, 8:25 PM</small></h4>
                <p>I am so happy for you man! Finally. I am looking forward to read about your trendy life. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <br>
            </div>

            <!-- End Reply Zone -->
            <!-- End Comment zone -->
        </div>
        <!-- End Post -->
    </div>

<?php  } ?>
<!-- Sidebar -->
<?php include "include/side-bar.php"; ?>
<!-- End Sidebar -->
</div>
<!-- End Post page -->

<?php include "include/footer.php"; ?>