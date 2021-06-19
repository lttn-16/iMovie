<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>
<!-- Trang chủ -->
<?php include "./include/navigation.php"; ?>
<div class="container container-index">
    <div class="left">
        <div class="title-wrap">
            <h4 class="block-title">
                <a href="#">LIÊN HỆ</a>
            </h4>
        </div>

        <form id="contact">
            <div class="form-group">
                <label for="name">Họ và tên</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="content">Nội dung</label>
                <textarea class="form-control" id="content" name="content" rows="3"></textarea>
            </div>
            <button type="submit" class="btn mb-2" style="background-color:#bd2b35; color:white;">Gửi đi</button>
        </form>

    </div>
    <?php include "include/side-bar.php"; ?>
</div>
<script src="./js/jquery-3.6.0.min.js"></script>
<script>
    var jqNew = $.noConflict();
    jqNew("#contact").submit(function(event) {
        event.preventDefault();
        jqNew.ajax({
            type: "POST",
            url: './helpers/sendmail.php',
            data: jqNew(this).serialize(),
            success: (data) => {
                alert("Tin nhắn đã được gửi!");
            }
        });
    })
</script>

<?php include "include/footer.php"; ?>