    <!-- bài báo mới -->
    <div class="container container-index">
        <div class="post_footer">
            <hr class="my-1-footer" />
            <!-- Tiêu đề -->
            <div class="row padding">
                <div class="col-md-12">
                    <h4 class="title t-bold t-bold--condensed mb-3">Bài viết mới</h4>
                </div>
            </div>
            <!-- Hết phần tiêu đề -->
            <!-- Phần bài viết mới -->
            <div class="row padding">
                <!-- Một bài viết mới -->
                <?php
                $query = "SELECT * FROM posts ORDER BY post_date DESC LIMIT 4";
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
                        <div class="col-md-3 col-sm-6 post_card">
                            <div class="card">
                                <a href="post.php?p_id=<?php echo $post_id ?>">
                                    <img class="card-img-top" src="images/<?php echo $post_image_display;?>">
                                </a>
                                <div class="card-body">
                                    <h4><a class="card-title" href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a></h4>

                                    <p class="card-text"><?php echo $post_summary ?></p>
                                    <a class=" btn btn-danger" href="post.php?p_id=<?php echo $post_id ?> ">Xem Thêm</a>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
                <!-- Hết một bài viết -->

            </div>
        </div>
    </div>
    <!-- footer -->
    <footer class="footer">
        <!-- Viết footer -->
        <div class="container container-footer">
            <div class="row row-footer">
                <div class="footer-col col-md-3 col-sm-6">
                    <h4>Giới Thiệu</h4>
                    <p style="width:88%;">iMovie là một trang blog chuyên review phim: nhận xét, đánh giá,
                        tóm tắt nội dung các phim chiếu rạp Việt Nam và Hollywood với cảm nhận cá nhân.
                    </p>
                </div>
                <div class="footer-col col-md-3 col-sm-6">
                    <h4>Điều Khoản Và Chính Sách</h4>
                    <ul>
                        <li><a href="#">Trách nhiệm người sử dụng</a></li>
                        <li><a href="#">Về nội dung trên trang web</a></li>
                        <li><a href="#">Về bản quyền</a></li>
                        <li><a href="#">Thay đổi nội dung</a></li>
                    </ul>

                </div>
                <div class="footer-col col-md-3 col-sm-6">
                    <h4>Liên Hệ</h4>
                    <ul style="width:88%;">
                        <!-- <li><a href="#"><img src="./images/logo_transparent.png" alt="logo"></a></li> -->
                        <li><a href="#">Hotline: 0938 043 314</a></li>
                        <li><a href="#">Email: iMovie@gmail.com</a></li>
                        <li>
                            <p>Địa chỉ: Khu phố 6, phường Linh Trung, TP. Thủ Đức</p>
                        </li>
                    </ul>
                </div>
                <div class="footer-col col-md-3 col-sm-6">
                    <h4>Theo Dõi iMovie</h4>
                    <ul>
                        <li>
                            <a href="#">
                                <i class="fa fa-facebook-square footer_icon"></i>
                                Facebook
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-twitter-square footer_icon"></i>
                                Twitter
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-instagram footer_icon"></i>
                                Instagram
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-linkedin-square footer_icon"></i>
                                Linkedin
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <div>
                <hr class="my-2-footer">
                <p class="footer__text">&copy; 2021 Copyright by iMovie.</p>
            </div>
        </div>
    </footer>

    <?php include "include/end.php"; ?>