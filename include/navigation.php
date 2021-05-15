<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>
<div class="row">
  <div class="col-md-10">
  <a href="./index.php"><img class="logo-img" src="./images/logo.jpg" alt="iMovie Logo"></a>
  </div>
  <div class="col-md-2">
    <a href="login.php"><button type="submit" class="btn btn-login btn-danger"style="border-radius: 5px; margin-top:30px;"> Đăng nhập</button></a>
    <a href="registration.php"><button type="submit" class="btn btn-login btn-danger"style="border-radius: 5px; margin-top:30px;"> Đăng ký</button></a>
  </div>
</div>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-md navbar-dark bg-fade ">
      <div class="navbar-collapse" id="navbarsExampleDefault">
        <div class="menu-wrap" onclick="openMenu()">
          <script>
            function openMenu() {
                console.log('open');
                let menu = document.getElementsByTagName('nav')[0];
                if (!menu.classList.contains('open')) {
                  let icon = document.getElementsByTagName('i')[0];
                  icon.classList.add('fa-times');
                  icon.classList.remove('fa-bars');
                  menu.classList.add('open');
                }
                else {
                  let icon = document.getElementsByTagName('i')[0];
                  icon.classList.add('fa-bars');
                  icon.classList.remove('fa-times');
                  menu.classList.remove('open');
                }
            }
          </script>
          <i class="menu-icon fa fa-bars" aria-hidden="true" style="color: #fff; font-size: 1.8rem;"></i>
        </div>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active li-nav">
            <a class="nav-link" href="index.php">Trang chủ </a>
          </li>
          <li class="nav-item active li-nav">
            <a class="nav-link" href="index.php">Tin tức</a>
          </li>
          <li class="nav-item dropdown active li-nav">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Review phim</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Phim tình cảm</a>
              <a class="dropdown-item" href="#">Phim hành động</a>
              <a class="dropdown-item" href="#">Phim kinh dị</a>
              <a class="dropdown-item" href="#">Phim hài</a>
              <a class="dropdown-item" href="#">Phim hoạt hình</a>
            </div>
          </li>
          <li class="nav-item active li-nav">
            <a class="nav-link" href="index.php">Giới thiệu phim hay</a>
          </li>
          <li class="nav-item active li-nav">
            <a class="nav-link" href="admin/index.php">Admin</a>
          </li>
        </ul>
        <form class="search-form form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Nhập tên phim" aria-label="Search">
          <button type="submit" class="btn btn-search btn-light">
            <i class="fa fa-search" aria-hidden="true"></i>
          </button> 
        </form>
      </div>
  </nav>