<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>
<<<<<<< HEAD
<?php include "admin/admin_function.php"; ?>

    <div class="main">
        <form role="form" action="registration.php" method="POST" class="form" id="form-1" autocomplete="off">
            <!-- <h5><?php echo $message; ?></h5> -->
            <div class="form-header">
                <img class="form-logo" src="./images/logo.jpg" alt="logo">
                <h3 class="heading">Đăng ký thành viên</h3>
            </div>
    
            <div class="form-group">
                <label for="fullname" class="form-label">Tên đăng nhập</label>
                <input id="fullname" name="username" type="text" placeholder="Nhập username" class="form-control">
                <span class="form-message"></span>
            </div>
    
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input class="form-control"id="email" name="email" type="text" placeholder="Nhập email">
                <span class="form-message"></span>
            </div>
    
            <div class="form-group">
                <label for="password" class="form-label">Mật khẩu</label>
                <input class="form-control" id="password" name="password" type="password" placeholder="Nhập mật khẩu">
                <span class="form-message"></span>
            </div>
    
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                <input id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu" type="password" class="form-control">
                <span class="form-message"></span>
            </div>
            
            <button type="submit" name="submit" class="btn btn-danger form-submit">Đăng ký</button>
            
        </form>

    </div>
    
    <script>
        
    document.addEventListener('DOMContentLoaded', function () {
      // Mong muốn của chúng ta
      Validator({
        form: '#form-1',
        formGroupSelector: '.form-group',
        errorSelector: '.form-message',
        rules: [
          Validator.isRequired('#fullname', 'Vui lòng nhập tên đăng nhập của bạn'),
          Validator.isEmail('#email'),
          Validator.minLength('#password', 6),
          Validator.isRequired('#password_confirmation'),
          Validator.isConfirmed('#password_confirmation', function () {
            return document.querySelector('#form-1 #password').value;
          }, 'Mật khẩu nhập lại không chính xác')
        ],
        onSubmit: function (data) {
          // Call API
          console.log(data);
        }
      });
    });
=======
<?php include "admin/admin_function.php" ?>
<?php

$message = '';
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $password = $_POST['user_password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    $user_email = mysqli_real_escape_string($connection, $user_email);

    $query = "SELECT randSalt FROM users";
    $select_randsalt_query = mysqli_query($connection, $query);
    confirm($select_randsalt_query);

    //encrypting password
    $row = mysqli_fetch_array($select_randsalt_query);
    $salt = $row['randSalt'];
    $password = crypt($password, $salt);

    $query = "SELECT username FROM users WHERE username = '$username'";
    $check_user_query = mysqli_query($connection, $query);
    if (mysqli_num_rows($check_user_query) >= 1) {
        $message = "Tên đăng nhập đã tồn tại!";
    } else {
        $query = "INSERT INTO users(username, user_email, user_password, user_role)";
        $query .= "VALUES('{$username}', '{$user_email}','{$password}','subcriber')";

        $create_user_query = mysqli_query($connection, $query);

        confirm($create_user_query);
        $message = "Đăng ký thành công";
    }
}

?>
<div class="main">
    <form role="form" action="registration.php" method="post" class="form" id="form-1">
        <h5><?php echo $message; ?></h5>
        <div class="form-header">
            <img class="form-logo" src="./images/logo.jpg" alt="logo">
            <h3 class="heading">Đăng ký thành viên</h3>
        </div>

        <div class="form-group">
            <label for="fullname" class="form-label">Tên đăng nhập</label>
            <input id="username" name="username" type="text" placeholder="Nhập username" class="form-control">

            <span class="form-message"></span>
        </div>
>>>>>>> duyen

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input class="form-control" id="user_email" name="user_email" type="email" placeholder="Nhập email">
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


        <input type="submit" name="create_user" class="btn btn-danger form-submit" value="Đăng ký">


    </form>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
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
                Validator.isConfirmed('#password_confirmation', function() {
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