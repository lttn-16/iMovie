<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>

    <div class="main">
        <form action="" method="POST" class="form" id="form-1">
            <div class="form-header">
                <img class="form-logo" src="./images/logo.jpg" alt="logo">
                <h3 class="heading">Đăng kí thành viên</h3>
            </div>
    
            <div class="form-group">
                <label for="fullname" class="form-label">Tên đăng nhập</label>
                <input id="fullname" name="fullname" type="text" placeholder="VD: LeNhi" class="form-control">
                <span class="form-message"></span>
            </div>
    
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input class="form-control"id="email" name="email" type="text" placeholder="VD: email@domain.com">
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

            <div class="row line">
                <hr class="ORline">
                    <span class="ORtext">OR</span>
                <hr class="ORline">
            </div>
            <div class="row">
                <p class="textgoogleaccount">Bạn có tài khoản Google?</p>  
                        
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <a class="badge badge-light googlesignupbutton">
                        <img src="./images/google.jpg" alt="google logo" class="googlelogo"> 
                        Đăng nhập với tài khoản Google
                    </a>
                </div>
            </div>
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