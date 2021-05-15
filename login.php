<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>

    <div class="main">
        <form action="" method="POST" class="form" id="form-2">
            <div class="form-header">
                <img class="form-logo" src="./images/logo.jpg" alt="logo">
                <h3 class="heading">Đăng nhập</h3>
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Nhập địa chỉ email">
                <span class="form-message"></span>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Mật khẩu</label>
                <input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu">
                <span class="form-message"></span>
            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="check">
                <label class="form-check-label" for="check">Nhớ mật khẩu</label>
            </div>
            <button class="btn btn-danger form-submit">Đăng nhập</button>
        </form>
    </div>

    <script>
       document.addEventListener('DOMContentLoaded', function () { 
        Validator({
        form: '#form-2',
        formGroupSelector: '.form-group',
        errorSelector: '.form-message',
        rules: [
          Validator.isEmail('#email'),
          Validator.minLength('#password', 6),
        ],
        onSubmit: function (data) {
          // Call API
          console.log(data);
        }
      });
    });
    </script>

<?php include "include/end.php"; ?>