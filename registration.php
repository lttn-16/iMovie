<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>
<?php include "admin/admin_function.php"; ?>

<?php 
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        echo $username;
        die();

        // if(username_exis($username)){
        //     $message = "User existed";
        // }

        if(!empty($username) && !empty($password) && !empty($email)){

            $username = mysqli_real_escape_string($connection, $username); //clean data
            $password = mysqli_real_escape_string($connection, $password);
            $email = mysqli_real_escape_string($connection, $email);
    
            $query = "SELECT randSalt FROM users";
            $select_randsalt_query = mysqli_query($connection, $query);
            if(!$select_randsalt_query){
                die("QUERY FAILED" . mysqli_error($connection));
            }
    
            $row = mysqli_fetch_array($select_randsalt_query);
            $salt = $row['randSalt'];
            $password = crypt($password, $salt); //encrypting password
            
            $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
            $query .= "VALUES('{$username}', '{$email}', '$password', 'subscriber')";
            $register_user_query = mysqli_query($connection, $query);
            if(!$register_user_query){
                die("QUERY FAILED" . mysqli_error($connection));
            }
            $message = "Your registration has been submitted!";
        } else {
            $message = "Fields cannot be empty!";
        }

       
    }else {
        $message = "";
    }
 ?>

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

    </script>

<?php include "include/end.php"; ?>