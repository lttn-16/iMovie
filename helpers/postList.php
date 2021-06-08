<?php include "./include/db.php"; 
$keyword = $_GET['keyword'];
$keyword = htmlspecialchars($keyword);
$keyword = mysqli_real_escape_string($connection, $keyword);

$sql="SELECT count(post_id) as total FROM posts ";

$sql .="WHERE post_title LIKE '%".$keyword."%' or post_author like '%".$keyword."%' ";

$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];
 
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 12;
 
$total_page = ceil($total_records / $limit);
 
if ($current_page > $total_page){
    $current_page = $total_page;
}
else if ($current_page < 1){
    $current_page = 1;
}
 
$start = ($current_page - 1) * $limit;

$sql="SELECT post_id, post_title, post_date, post_author, post_summary, post_img_display FROM posts ";
$sql .="WHERE post_title LIKE '%".$keyword."%' or post_author like '%".$keyword."%' "; 
$sql.=" LIMIT $start, $limit";

$query_seclect_matched_posts = mysqli_query($connection, $sql);
$i = 0;
while ($row = mysqli_fetch_assoc($query_seclect_matched_posts)) {
    $i++;
    echo <<<EOF
    <div class="row row-index">
        <div class="post">
            <a href="post.php?p_id=$row[post_id]">
                <img class="index-img" src="./images/$row[post_img_display]">
            </a>
            <div class="content">
                <a href="post.php?p_id=$row[post_id]">$row[post_title]</a>
                <p class="date">$row[post_date]</p>
                <span>$row[post_summary]</span>
            </div>
        </div>
    </div>
    EOF;
}

if ($i == 0) {
    echo '<span style = "margin: auto; font-size: 1.8em">Không có bài viết phù hợp</span>';
}

if ($current_page > 1 && $total_page > 1){
    echo '<a href="index.php?page='.($current_page-1).'">Prev</a> | ';
}
// Lặp khoảng giữa
for ($i = 1; $i <= $total_page; $i++){
    // Nếu là trang hiện tại thì hiển thị thẻ span
    // ngược lại hiển thị thẻ a
    if ($i == $current_page){
        echo '<span>'.$i.'</span> | ';
    }

    else{
        echo '<a href="search.php?keyword=' . $keyword . '&page='.$i.'">'.$i.'</a> | ';
    }
}
 
// nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
if ($current_page < $total_page && $total_page > 1){
    echo '<a href="index.php?page='.($current_page+1).'">Next</a> | ';
}
?>