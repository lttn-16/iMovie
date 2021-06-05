<?php include "include/db.php"; ?>
<?php include "include/header.php";?>
<!-- Trang chủ -->
<?php include "./include/navigation.php"; ?>
    <div class="container container-index">
        <div class="left">
            <div class="title-wrap">
                <h4 class="block-title">
                    <a href="#">REVIEW PHIM </a>
                </h4>
            </div>
            <?php 
                $query = "SELECT * FROM posts LIMIT 4";
                $query_seclect_all_posts = mysqli_query($connection,$query);

                    while($row = mysqli_fetch_assoc($query_seclect_all_posts)){
                        $post_title = $row['post_title'];
                        $post_id = $row['post_id'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image_display = $row['post_img_display'];
                        $post_status = $row['post_status'];
                        $post_summary = $row['post_summary'];
                        if($post_status == 'published'){
                                    
            ?>
            <div class="row row-index">
                    <div class="post">
                        <a href="post.php?p_id=<?php echo $post_id ?>">
                            <img class="index-img" src="./images/<?php echo $post_image_display; ?>">
                        </a>
                        <div class="content">
                            <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                            <p class="date"><?php echo $post_date ?></p>
                            <span><?php echo $post_summary ?></span>
                        </div>
                    </div>
            </div>
            <?php }} ?>
            
            
            
            <h4 class="block-title">
                <a href="#">Giới thiệu phim hay </a>
            </h4>
            <div class="row row-index">
                    <div class="post">
                        <a href="post.php">
                            <img class="index-img" src="./images/all-my-friends.jpg">
                        </a>
                        <div class="content">
                            <a href="post.php">Review phim All My Friends Are Dead (2020) tác phẩm kinh dị hài đầy ẩn ý</a>
                            <p class="date">6/5/2021</p>
                            <span>Review phim All My Friends Are Dead của đạo diễn Jan Belcl thuộc thể loại hài, kinh dị theo phong cách gore đầy máu me và chết chóc.</span>
                        </div>
                    </div>
            </div>
            <div class="row row-index">
                    <div class="post">
                        <a href="post.php">
                            <img class="index-img" src="./images/shadow-and-bone.jpg">
                        </a>
                        <div class="content">
                            <a href="post.php">Review phim Shadow and Bone – Series giả tưởng hot trên Netflix</a>
                            <p class="date">27/4/2021</p>
                            <span>Trong thời gian khan hiếm series fantasy cũng như khó khăn trong việc khởi quay vì dịch Covid thì Shadow and Bone chắc chắn là một lựa chọn đúng đắn.</span>
                        </div>
                    </div>
            </div>
            <div class="row row-index">
                    <div class="post">
                        <a href="post.php">
                            <img class="index-img" src="./images/sound-of-metal.jpg">
                        </a>
                        <div class="content">
                            <a href="post.php">Review phim Sound of Metal (2019) khiếm thính và âm nhạc</a>
                            <p class="date">2/2/2021</p>
                            <span>Review phim Sound of Metal là tác phẩm với kịch bản có phần đơn giản, tròn trịa được nâng tầm đáng kể bởi các diễn viên dựng âm thanh ấn tượng.</span>
                        </div>
                    </div>
            </div>
            <div class="row row-index">
                    <div class="post">
                        <a href="post.php">
                            <img class="index-img" src="./images/lupin.jpg">
                        </a>
                        <div class="content">
                            <a href="post.php">Review series phim Lupin và giải thích cốt truyện</a>
                            <p class="date">16/1/2021</p>
                            <span>Review phim Lupin TV series của Pháp được khán giả yêu thích trên Netflix. Phim mang đến một câu chuyện mới mẻ, diễn biến bất ngờ và thú vị.</span>
                        </div>
                    </div>
            </div>
            <h4 class="block-title">
                <a href="#">Tin tức </a>
            </h4>
            <div class="row row-index">
                    <div class="post">
                        <a href="post.php">
                            <img class="index-img" src="./images/suicide-squad.jpg">
                        </a>
                        <div class="content">
                            <a href="post.php">Bom tấn The Suicide Squad còn chưa chiếu, cái kết đã bị "vạch trần" trên mạng làm khán giả thấp thỏm</a>
                            <p class="date">24/4/2021</p>
                            <span>Cái kết của các nhân vật chính trong bom tấn The Suicide Squad nhà DC đã bị một nhân vật quan trọng đưa lên mạng xã hội, liệu có tin được không?</span>
                        </div>
                    </div>
            </div>
            <div class="row row-index">
                    <div class="post">
                        <a href="post.php">
                            <img class="index-img" src="./images/marvel.jpg">
                        </a>
                        <div class="content">
                            <a href="post.php">"Toang" cho Marvel: 2 bom tấn Shang-Chi và The Eternals có nguy cơ bị cấm chiếu ở Trung Quốc</a>
                            <p class="date">13/5/2021</p>
                            <span>Trong danh sách các bộ phim sắp tới của Marvel trên kênh CCTV6 của Trung Quốc, không thể tìm thấy 2 bom tấn Shang-Chi và The Eternals.</span>
                        </div>
                    </div>
            </div>
            <div class="row row-index">
                    <div class="post">
                        <a href="post.php">
                            <img class="index-img" src="./images/friends.jpg">
                        </a>
                        <div class="content">
                            <a href="post.php">Phim Friends đình đám trở lại, bất ngờ có tên BTS cùng loạt sao khủng</a>
                            <p class="date">14/5/2021</p>
                            <span>Sau 17 năm, loạt phim Friends sẽ chính thức trở lại vào mùa hè này với loạt diễn viên quen thuộc và dàn khách mời vô cùng đình đám.</span>
                        </div>
                    </div>
            </div>
            <div class="row row-index">
                    <div class="post">
                        <a href="post.php">
                            <img class="index-img" src="./images/nanno.jpg">
                        </a>
                        <div class="content">
                            <a href="post.php">Cuộc đối đầu ma quái của 2 ma nữ Girl From Nowhere: Khi cái chết không phải bản án nặng nề nhất?</a>
                            <p class="date">14/5/2021</p>
                            <span>Girl From Nowhere mùa 2 đặt ra cho khán giả những câu hỏi bỏ ngỏ rằng ai mới là kẻ có quyền phán xét tội lỗi của con người.</span>
                        </div>
                    </div>
            </div>
        </div>
        
        <?php include "include/side-bar.php"; ?>

    </div>
   
<?php include "include/footer.php"; ?>