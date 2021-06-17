<?php
include "../include/function.php";
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">iMovie Admin</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li><a href="">Users Online: <span class="useronline"></span></a></li>
        <li><a href="../index.php">HOME SITE</a></li>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                <?php
                if (isset($_SESSION['username'])) {
                    echo $_SESSION['username'];
                }
                ?>

                <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="profile.php"><i class="fa fa-fw fa-user"></i> Thông tin</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="../include/logout.php"><i class="fa fa-fw fa-power-off"></i> Đăng xuất</a>
                </li>
            </ul>
        </li>
    </ul>


    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">

            <li>
                <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Trang chủ</a>
            </li>

            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Bài viết <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="posts_dropdown" class="collapse">
                    <li>
                        <a href="./posts.php">Tất cả bài viết</a>
                    </li>
                    <li>
                        <a href="posts.php?source=add_post">Thêm bài viết</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="./categories.php"><i class="fa fa-fw fa-wrench"></i>Danh mục</a>
            </li>
            <li>
                <a href="./comments.php"><i class="fa fa-fw fa-file"></i> Bình luận</a>
            <li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                    <li>
                        <a href="./users.php">Tất cả Users</a>
                    </li>
                    <li>
                        <a href="users.php?source=add_user">Thêm User</a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="profile.php"><i class="fa fa-user"></i> Thông tin</a>
            </li>
        </ul>

    </div>

    <!-- /.navbar-collapse -->
</nav>
<script>
    <?php if (isset($_SESSION['user_role'])) { ?>

        function loadUsersOnline() {
            $.get("../include/function.php?onlineusers=result", function(data) {
                $(".useronline").text(data);
            });
        }
        setInterval(function() {
            loadUsersOnline();
        }, 500);
    <?php } else { ?>
        $(".useronline").text("0");
    <?php } ?>
</script>