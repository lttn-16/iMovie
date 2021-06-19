<?php include "db.php"; ?>
<?php
    $sql_cmt = "SELECT * FROM comments WHERE post_id = ".$_POST['id']." ORDER BY cmt_id DESC";
    $query_cmt = mysqli_query($connection, $sql_cmt);
    $sql_count_cmt = "SELECT * FROM comments WHERE post_id = ".$_POST['id']." AND cmt_status = 1;";
    $count_cmt = mysqli_query($connection, $sql_count_cmt);
    $total_cmt = mysqli_num_rows($count_cmt);
    if ($total_cmt > 0) {
?>

    <div class="row" id="load_cmt">
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
    </div>
    
<?php
}
?>
