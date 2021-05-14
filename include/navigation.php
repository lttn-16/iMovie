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
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
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
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Nhập tên phim" aria-label="Search">
          <button type="submit" class="btn btn-search btn-light">Tìm kiếm</button> 
        </form>
      </div>
  </nav>