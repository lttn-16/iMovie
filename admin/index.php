<?php include "includes/admin_header.php" ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Xin chào!
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>


                </div>
            </div>
            <!-- /.row -->


            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    count_post();
                                    ?>
                                    <div>Bài viết</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">Chi tiết</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    count_comments();
                                    ?>

                                    <div>Bình luận</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">Chi tiết</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    count_user();
                                    ?>

                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">Chi tiết</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    count_categories();
                                    ?>

                                    <div>Danh mục</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">Chi tiết</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <br>
            <!-- /.row -->
            <?php

            $query = "SELECT * FROM posts WHERE post_status = 'draft'";
            $select_draft_post = mysqli_query($connection, $query);
            $draft_count = mysqli_num_rows($select_draft_post);

            $query = "SELECT * FROM posts WHERE post_status = 'published'";
            $select_publish_post = mysqli_query($connection, $query);
            $publish_count = mysqli_num_rows($select_publish_post);


            $query = "SELECT * FROM comments WHERE cmt_status = 0";
            $select_unapproved = mysqli_query($connection, $query);
            $unapproved_count = mysqli_num_rows($select_unapproved);

            $query = "SELECT * FROM comments WHERE cmt_status = 1";
            $select_approved = mysqli_query($connection, $query);
            $approved_count = mysqli_num_rows($select_approved);


            $query = "SELECT * FROM users WHERE user_role = 'subcriber'";
            $select_subcriber = mysqli_query($connection, $query);
            $subcriber_count = mysqli_num_rows($select_subcriber);

            $query = "SELECT * FROM users WHERE user_role = 'admin'";
            $select_admin = mysqli_query($connection, $query);
            $admin_count = mysqli_num_rows($select_admin);

            ?>

            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],

                            <?php
                            $element_text = ['Xuất bản', 'Nháp', 'Bình luận Duyệt', 'Bình luận Không duyệt', 'Amin', 'Subcriber'];
                            $element_count = [$publish_count, $draft_count, $approved_count, $unapproved_count, $admin_count, $subcriber_count];
                            for ($i = 0; $i < 6; $i++) {
                                echo "['{$element_text[$i]}'," . " {$element_count[$i]}],";
                            }
                            ?>
                        ]);

                        var options = {
                            chart: {
                                title: 'Số liệu tổng quan',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>


            </div>

            <!-- category chart -->
            <br>
            <?php
            $category = array();
            for ($i = 1; $i <= 7; $i++) {
                $query = "SELECT * FROM posts WHERE post_category_id = $i";
                $count_posts = mysqli_query($connection, $query);
                $count =  mysqli_num_rows($count_posts);
                array_push($category, $count);
            }
            $name = array();
            for ($i = 1; $i <= 7; $i++) {
                $query = "SELECT * FROM category WHERE cat_id = $i";
                $select_title = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_title)) {
                    $title = $row['cat_title'];
                    array_push($name, $title);
                }
            }
            ?>
            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Danh mục', 'Count'],

                            <?php
                            $element_text = [$name[0], $name[1], $name[2], $name[3], $name[4], $name[5], $name[6]];
                            $element_count = [$category[0], $category[1], $category[2], $category[3], $category[4], $category[5], $category[6]];
                            for ($i = 0; $i < 7; $i++) {
                                echo "['{$element_text[$i]}'," . " {$element_count[$i]}],";
                            }
                            ?>
                        ]);

                        var options = {
                            chart: {
                                title: 'Bài viết theo Danh mục',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material1'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material1" style="width: 'auto'; height: 500px;"></div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->



        <?php include "includes/admin_footer.php"; ?>