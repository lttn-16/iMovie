<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>
<!-- Trang chủ -->
<?php include "include/navigation.php"; ?>

<div class="container container-index">
    <div class="left">
        <div class="title-wrap">
            <h4 class="block-title">
                <a href="#">KẾT QUẢ TÌM KIẾM - "<?php echo $_GET['keyword'] ?>"</a>
            </h4>
        </div>

        <?php include "helpers/postList.php"; ?>
        
    </div>

    <?php include "include/side-bar.php"; ?>

</div>

<?php include "include/footer.php"; ?>