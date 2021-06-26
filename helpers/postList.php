<?php include "./include/db.php";
$keyword = $_GET['keyword'];
$keyword = htmlspecialchars($keyword);
$keyword = mysqli_real_escape_string($connection, $keyword);

$sql = "SELECT count(post_id) as total FROM posts ";

$sql .= "WHERE post_title LIKE '%" . $keyword . "%' or post_author like '%" . $keyword . "%' ";

$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];

$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 12;

$total_page = ceil($total_records / $limit);

if ($current_page > $total_page) {
    $current_page = $total_page;
} else if ($current_page < 1) {
    $current_page = 1;
}

$start = ($current_page - 1) * $limit;

$sql = "SELECT post_id, post_title, post_date, post_author, post_summary, post_img_display FROM posts ";
$sql .= "WHERE post_title LIKE '%" . $keyword . "%' or post_author like '%" . $keyword . "%' ";
$sql .= " LIMIT $start, $limit";

$query_select_matched_posts = mysqli_query($connection, $sql);

if ($query_select_matched_posts) {
    while ($row = mysqli_fetch_assoc($query_select_matched_posts)) {
        echo <<<EOF
        <div class="row row-index">
            <div class="post">
                <a href="post.php?p_id=$row[post_id]">
                    <img class="index-img" src="images/$row[post_img_display]">
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
} else {
    echo '<span style = "margin: auto; font-size: 1.8em">Không có bài viết phù hợp</span>';
}
?>
<ul class="pagination justify-content-center">
    <?php
    // Lặp khoảng giữa
    for ($i = 1; $i <= $total_page; $i++) {
        if ($i == $current_page) {
            echo "<li class='page-item active'style='display:inline-block;list-style-type:none'><a class='page-link' href='search.php?keyword={$keyword}'>{$i}</a></li>";
        } else {
            echo '<li class="page-item"style="display:inline-block;list-style-type:none"><a class="page-link" href="search.php?keyword=' . $keyword . '&page=' . $i . '">' . $i . '</a></li>';
        }
    }
    ?>
</ul>