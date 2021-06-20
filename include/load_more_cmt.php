<?php include "db.php"; ?>

<?php
$cmt_count = $_POST['cmt_count_pass'];
$p_id = $_POST['id'];
$sql_cmt = "SELECT * FROM comments WHERE post_id = $p_id LIMIT $cmt_count";
$query_cmt = mysqli_query($connection, $sql_cmt);
?>


<?php
while ($row = mysqli_fetch_array($query_cmt)) {
    if ($row['cmt_status'] == 1) {
?>
        <div class="col-sm-2 text-center">
            <img src="./images/avatar.jpg" class="img-circle" height="65" width="65" alt="Avatar">
        </div>
        <div class="col-sm-10">
            <h4> <?php echo $row['cmt_author'] ?> <small><?php echo $row['cmt_date'] ?></small></h4>
            <p><?php echo $row['cmt_content'] ?></p>
            <br>
        </div>
<?php
    }
}
?>