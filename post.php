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

                //Update view post
                $query = "UPDATE posts SET post_views = post_views + 1 WHERE post_id = $the_post_id";
                $view_query = mysqli_query($connection, $query);

                if (!$view_query) {
                    die("QUERY FAILED" . mysqli_error($connection));
                }

                //Render post
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
        <?php
                    if (isset($_POST['comment'])) {
                        $p_id = $_GET['p_id'];
                        $cmt_author = $_POST['cmt_author'];
                        $cmt_email = $_POST['cmt_email'];
                        $cmt_content = $_POST['cmt_content'];
                        $cmt_date = date("Y-m-d H:i:s");
                        $cmt_status = 0;

                        if (isset($cmt_author) && isset($cmt_email) && isset($cmt_content)) {
                            $sql = "INSERT INTO comments(post_id, cmt_author, cmt_content, cmt_date, cmt_email, cmt_status) VALUES ($p_id, '$cmt_author', '$cmt_content', '$cmt_date', '$cmt_email', $cmt_status);";
                            $query = mysqli_query($connection, $sql);
                        }
                    }
        ?>
        <div class="comment">
            <?php if (isset($_SESSION['username'])){
            ?>
                <h4><b>Bình luận:</b></h4>
                <form method="POST">
                    <div class="form-group">
                        <label for="author" hidden >Tên</label>
                        <input type="text" require="" class="form-control" name="cmt_author" value="<?php echo $_SESSION['username']  ?>" hidden>
                    </div>
                    <div class="form-group">
                        <label for="email" hidden>Email</label>
                        <input type="email" require="" class="form-control" name="cmt_email" value="<?php echo $_SESSION['user_email'] ?>" hidden>
                    </div>
                    <div class="form-group">
                        <label for="comment">Nội dung</label>
                        <textarea class="form-control" require="" rows="4" name="cmt_content" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger" name="comment">Đăng</button>
                </form>
            <?php } else {?>
                <h4><b>Bình luận:</b></h4>
                <form method="POST">
                    <div class="form-group">
                        <label for="author">Tên</label>
                        <input type="text" require="" class="form-control" name="cmt_author">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" require="" class="form-control" name="cmt_email">
                    </div>
                    <div class="form-group">
                        <label for="comment">Nội dung</label>
                        <textarea class="form-control" require="" rows="4" name="cmt_content" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger" name="comment">Đăng</button>
                </form>
            <?php }?>
        </div>
        <!-- End Comment Form -->

        <?php
                    $p_id = $_GET['p_id'];
                    $sql_cmt = "SELECT * FROM comments WHERE post_id = $p_id ORDER BY cmt_id DESC";
                    $query_cmt = mysqli_query($connection, $sql_cmt);
                    $sql_count_cmt = "SELECT * FROM comments WHERE post_id = $p_id AND cmt_status = 1;";
                    $count_cmt = mysqli_query($connection, $sql_count_cmt);
                    $total_cmt = mysqli_num_rows($count_cmt);
                    if ($total_cmt > 0) {

        ?>
            <p><span class="badge"><?php echo $total_cmt ?></span> Comments:</p><br>
            <!-- Reply Zone -->
            <div class="row">
                <?php
                        while ($row = mysqli_fetch_array($query_cmt)) {
                            if ($row['cmt_status'] == 1) {
                ?>
                        <div class="col-sm-2 text-center">
                            <img src="./images/avatar.jpg" class="img-circle" height="65" width="65" alt="Avatar">
                        </div>
                        <div class="col-sm-10">
                            <h4> <?php echo $row['cmt_author'] ?> <small><?php echo $row['cmt_date'] ?></small></h4>
                            <p><?php echo $row['cmt_content'] ?></p>
                            <br>
                        </div>
                <?php
                            }
                        }
                ?>

                <!-- End Reply Zone -->
                <!-- End Comment zone -->
            </div>
        <?php
                    }
        ?>
        <!-- End Post -->
    </div>

<?php  } ?>
<!-- Sidebar -->
<?php include "include/side-bar.php"; ?>
<!-- End Sidebar -->
</div>
<!-- End Post page -->
<?php include "include/footer.php"; ?>