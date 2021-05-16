<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>

    <div class="main">
        <form action="" method="POST" class="form" id="form-1">
            <div class="form-header">
                <img class="form-logo" src="./images/logo.jpg" alt="logo">
                <h3 class="heading">Đăng ký thành viên</h3>
            </div>
    
            <div class="form-group">
                <label for="fullname" class="form-label">Tên đăng nhập</label>
                <input id="fullname" name="fullname" type="text" placeholder="Nhập username" class="form-control">
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
    
            <button class="btn btn-danger form-submit">Đăng ký</button>

            
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