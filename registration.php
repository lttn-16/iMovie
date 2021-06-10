<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>
<?php include "admin/admin_function.php"?>
<?php

    if(isset($_POST['username'])){
        $username=$_POST['username'];
        $user_email=$_POST['user_email'];
        $user_password=$_POST['user_password'];
        

        
        // $user_role=$_POST['user_role'];

        $query = "INSERT INTO users(username, user_email, user_password, user_role)";
        $query .= "VALUES('{$username}', '{$user_email}',{$user_password}, 'subcriber')";
       
        $create_user_query = mysqli_query($connection, $query);
      
        confirm($create_user_query);

        $the_user_id = mysqli_insert_id($connection);

        echo "<p class='bg-success'> dktc </p>";
        // console.log($user_email,$user_password);
        header("Location: login.php");


        }

        // alert($username);

        // function alert($msg) {
        // echo "<script type='text/javascript'>alert('$msg');</script>";


?>
    <div class="main">
        <form action="" method="POST" class="form" id="form-1" enctype="multipart/form-data">
            <div class="form-header">
                <img class="form-logo" src="./images/logo.jpg" alt="logo">
                <h3 class="heading">Đăng ký thành viên</h3>
            </div>
    
            <div class="form-group">
                <label for="fullname" class="form-label">Tên đăng nhập</label>
                <input id="username" name="username" type="text" placeholder="Nhập username" class="form-control">
                
                <span class="form-message"></span>
            </div>
    
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input class="form-control"id="user_email" name="user_email" type="email" placeholder="Nhập email">
                <span class="form-message"></span>
            </div>
    
            <div class="form-group">
                <label for="password" class="form-label">Mật khẩu</label>
                <input class="form-control" id="user_password" name="user_password" type="password" placeholder="Nhập mật khẩu">
                <span class="form-message"></span>
            </div>
    
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                <input id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu" type="password" class="form-control">
                <span class="form-message"></span>
            </div>
            
            <div class="form-group">
              <input type="submit" name="create_user" class="btn btn-danger form-submit" value="Đăng ký">
            </div>
    
            <!-- <button class="btn btn-danger form-submit" name="create_user">Đăng ký</button> -->

            
        </form>

    </div>
    
    <script>
        
    document.addEventListener('DOMContentLoaded', function () {
      // tạo ràng buộc
      Validator({
        form: '#form-1',
        formGroupSelector: '.form-group',
        errorSelector: '.form-message',
        rules: [
          Validator.isRequired('#username', 'Vui lòng nhập tên đăng nhập của bạn'),
          Validator.isEmail('#user_email'),
          Validator.minLength('#user_password', 6),
          Validator.isRequired('#password_confirmation'),
          Validator.isConfirmed('#password_confirmation', function () {
            return document.querySelector('#form-1 #user_password').value;
          }, 'Mật khẩu nhập lại không chính xác')
        ],
        // onSubmit: function (data) {
        //   // Call API
        //   console.log(data);
        // }
      });
    });

    </script>

<?php include "include/end.php"; ?>