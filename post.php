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
                    $post_id = $row['post_id'];
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

        <!--Post-like -->
        <div class="post-like">
            <button id="like-button" class="btn btn-primary" onclick="like()">
                <i class="fa fa-thumbs-up"></i>
                <span id="like-count"></span>
                <span id="like-status"></span>
            </button>
            <script src="./js/jquery-3.6.0.min.js"></script>
            <script>
                var jqNew = $.noConflict();
                var likeData = {
                    onload: true,
                    post_id: '<?php echo $post_id?>'
                }
                window.onload = function() {
                    jqNew.ajax({
                        type: "POST",
                        url: './helpers/postLike.php',
                        data: likeData,
                        success: (data) => {
                            var obj = JSON.parse(data);
                            jqNew('#like-count').html(obj.like_count);
                            if (obj.liked == true) {
                                jqNew('#like-status').html('Đã thích');
                                jqNew('#like-button').removeClass('btn-primary').addClass('btn-success');
                            } else {
                                jqNew('#like-status').html('Thích');
                            }
                        }
                    });
                }
                function like() {
                    var likeData = {
                        onload: false,
                        post_id: '<?php echo $post_id?>'
                    }
                    jqNew.ajax({
                        type: "POST",
                        url: './helpers/postLike.php',
                        data: likeData,
                        success: (data) => {
                            var obj = JSON.parse(data);
                            if (obj.require_login) {
                                window.location.href = './login.php?from=post.php?p_id=' + likeData.post_id;
                            }
                            jqNew('#like-count').html(obj.like_count);
                            if (obj.liked == true) {
                                jqNew('#like-status').html('Đã thích');
                                jqNew('#like-button').removeClass('btn-primary').addClass('btn-success');
                            } else {
                                jqNew('#like-status').html('Thích');
                                jqNew('#like-button').removeClass('btn-success').addClass('btn-primary');
                            }
                        }
                    });
                }
            </script>
        </div>
        <!-- End Post-like -->

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
                        if($_SESSION['user_email']) {
                            $cmt_email = $_SESSION['user_email'];
                        }
                        $cmt_email = $_POST['cmt_email'];
                        $cmt_content = $_POST['cmt_content'];
                        $cmt_date = date("Y-m-d H:i:s");
                        $cmt_status = 0;

                        if (isset($cmt_author) && isset($cmt_email) && isset($cmt_content)) {
                            $sql = "INSERT INTO comments(post_id, cmt_author, cmt_content, cmt_date, cmt_email, cmt_status) VALUES ($p_id, '$cmt_author', '$cmt_content', '$cmt_date', '$cmt_email', $cmt_status);";
                            $query = mysqli_query($connection, $sql);
                            $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                            $query .= "WHERE post_id = $the_post_id ";
                            $update_comment_count = mysqli_query($connection, $query);
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
                    $sql_cmt = "SELECT * FROM comments WHERE post_id = $p_id LIMIT 3";
                    $query_cmt = mysqli_query($connection, $sql_cmt);
                    $sql_count_cmt = "SELECT * FROM comments WHERE post_id = $p_id AND cmt_status = 1;";
                    $count_cmt = mysqli_query($connection, $sql_count_cmt);
                    $total_cmt = mysqli_num_rows($count_cmt);
                    if ($total_cmt > 0) {
                        echo '<p><span class="badge">' . $total_cmt . '</span> Comments:</p><br>';
                        echo '<div class="row" id="load_cmt">';
                        while ($row = mysqli_fetch_array($query_cmt)) {
                            if ($row['cmt_status'] == 1) {
                                echo '<div class="col-sm-2 text-center">
                            <img src="./images/avatar.jpg" class="img-circle" height="65" width="65" alt="Avatar">
                            </div>
                            <div class="col-sm-10">
                                <h4>' . $row['cmt_author'] . '<small style="margin-left:15px;">' . $row['cmt_date'] . '</small></h4>
                                <p>' . $row['cmt_content'] . '</p>
                                <br>
                            </div>';
                            }
                        }
                        echo '</div>';

                        if ($total_cmt > 3) {
                            echo '<div class="show_more_button">
                            <center><button type="button" id="loadmore" name="' . $total_cmt . '" class="btn btn-danger" style="margin-left:30px;margin-bottom:100px;">Xem thêm</button></center>
                        </div>';
                        }
                    }
        ?>
        <!-- End Comment zone -->

        <!-- End Post -->
    </div>

<?php  } ?>

<script>
    $(document).ready(function() {
        var total_cmt = $('#loadmore').attr("name");
        var cmt_count = 3;
        $('#loadmore').click(function() {
            cmt_count += 3;
            $('#load_cmt').load("include/load_more_cmt.php", {
                cmt_count_pass: cmt_count,
                id: <?php echo $_GET['p_id']; ?>
            });

            //remove btn loadmore
            if (cmt_count >= total_cmt) {
                $("#loadmore").remove();
            }
        });
    });
</script>

<!-- Sidebar -->
<?php include "include/side-bar.php"; ?>
<!-- End Sidebar -->
                </div>
<!-- End Post page -->
<?php include "include/footer.php"; ?>