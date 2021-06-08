<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>

<div class="row " >
  <div class="col-sm-8 logo">
  <a href="./index.php"><img class="logo__img"  src="./images/logo.jpg" alt="iMovie Logo"></a>
  <a href="./index.php" class="logo__name">iMovie</a>
  </div>
  <div class="col-lg-4">
     <div class="btn_nav">
        <a href="login.php"><button type="submit" class="btn btn-login btn-danger"> Đăng nhập</button></a>
        <a href="registration.php"><button type="submit" class="btn btn-login btn-danger"> Đăng ký</button></a>
  </div>
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
            function searchPost(){
              //Get keyword entered by user
              var keyword = document.getElementById("keyword").value;

              //Make Ajax request
              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                  var searchResults = JSON.parse(this.responseText);
                  document.getElementById("search-result").innerHTML= ""; //Clear search result
                  for (iResult in searchResults)
                  {
                    var productHtml = "<img class='col-md-4 col-sm-6 col-xs-12 thumbnail img-responsive' src='" + searchResults[iResult].ImageLink + "'>";
                    document.getElementById("search-result").innerHTML += productHtml;
                  }
                }
              };
              //Send Ajax request
              xhttp.open("GET", "http://localhost/dealcongnghe2/server/postcontroller.php?action=searchAjax&keyword="+keyword, true);
              xhttp.send();
            }
          </script>
          <i class="menu-icon fa fa-bars" aria-hidden="true" style="color: #fff; font-size: 1.8rem;"></i>
        </div>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active li-nav">
            <a class="nav-link" href="index.php">Trang chủ </a>
          </li>
          <li class="nav-item active li-nav">
            <a class="nav-link" href="tintuc.php">Tin tức</a>
          </li>
          <li class="nav-item dropdown active li-nav">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Review phim</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="phimtinhcam.php">Phim tình cảm</a>
              <a class="dropdown-item" href="phimhanhdong.php">Phim hành động</a>
              <a class="dropdown-item" href="phimkinhdi.php">Phim kinh dị</a>
              <a class="dropdown-item" href="#">Phim hài</a>
              <a class="dropdown-item" href="#">Phim hoạt hình</a>
            </div>
          </li>
          <li class="nav-item active li-nav">
            <a class="nav-link" href="gioithieuphimhay.php">Giới thiệu phim hay</a>
          </li>
          <li class="nav-item active li-nav">
            <a class="nav-link" href="./contact.php">Liên hệ</a>
          </li>
        </ul>
        <form id="searchbox"class="search-form form-inline my-2 my-lg-0 searchbar" action="./search.php" method="get">
          <input class="form-control mr-sm-2" type="text" id="keyword" name="keyword" placeholder="Nhập tên phim" aria-label="Search" >
          <button type="submit" class="btn btn-search btn-light">
            <i class="fa fa-search" aria-hidden="true"></i>
          </button> 
        </form>

        <!-- 
        Dong code nay khi nao can dung ajax thi dung 
        <script src="./js/jquery-3.6.0.min.js"></script>
        <script>
        var jqNew = jQuery.noConflict();
          jqNew( "#searchbox" ).submit(function( event ) {
              console.log(jqNew("#keyword").val());
              event.preventDefault();
              jqNew.ajax({
                type: "GET",
                url: "./search.php",
                data: jqNew(this).serialize(),
                success: function (res) {
                  console.log(JSON.parse(res));
                },
              });
            });
        </script>
        -->
      </div>
  </nav>