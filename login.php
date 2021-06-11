<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>
<?php session_start(); ?>
<?php
$message = '';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username); //clean data
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);
    if (!$select_user_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_array($select_user_query)) {
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_role = $row['user_role'];
    }

    $password = crypt($password, $db_user_password); //uncrypt

    if ($username === $db_username && $password === $db_user_password) {
        $_SESSION['username'] = $db_username;
        $_SESSION['user_role'] = $db_user_role;
        header("Location: index.php");
    } else {
        $message = 'Tên đăng nhập hoặc mật khẩu chưa chính xác!';
    }
}
?>

<div class="main">
    <form action="" method="POST" class="form" id="form-2">
        <h5><?php echo $message; ?></h5>
        <div class="form-header">
            <img class="form-logo" src="./images/logo.jpg" alt="logo">
            <h3 class="heading">Đăng nhập</h3>
        </div>

        <div class="form-group">
            <label class="form-label" for="email">Tên đăng nhập</label>
            <input type="text" name="username" class="form-control" placeholder="Nhập username">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Mật khẩu</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu">
            <span class="form-message"></span>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="check">
            <label class="form-check-label" for="check">Nhớ mật khẩu</label>
        </div>
        <button name="login" class="btn btn-danger form-submit">Đăng nhập</button>
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

<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        Validator({
            form: '#form-2',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isEmail('#email'),
                Validator.minLength('#password', 6),
            ],
            onSubmit: function(data) {
                // Call API
                console.log(data);
            }
        });
    });
</script> -->

<?php include "include/end.php"; ?>