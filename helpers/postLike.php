<?php 

include "../include/db.php"; 
session_start();

$onload = $_POST['onload'];

$postid = $_POST['post_id'];
$postid = htmlspecialchars($postid);
$postid = mysqli_real_escape_string($connection, $postid);

$like_count = 0;
$liked = false;
$require_login = false;

if (isset($_SESSION['userId'])) {
    $userid = $_SESSION['userId'];
    $sql = "SELECT * FROM post_likes WHERE postid = '$postid' AND userid = '$userid'";
    $user_liked = mysqli_query($connection, $sql);
    if ($onload == 'true') {
        if ($user_liked->num_rows != 0) {
            $liked = true;
        }
        $sql_count_like = "SELECT count(id) as like_count FROM post_likes GROUP BY postid HAVING postid = '$postid'";
        $result = mysqli_query($connection, $sql_count_like);
        if ($result->num_rows != 0) {
            $row = mysqli_fetch_assoc($result);
            $like_count = $row['like_count'];
        }
    }
    else {
        if ($user_liked->num_rows != 0) {
            $sql_remove_like = "DELETE FROM post_likes WHERE postid = '$postid' AND userid = '$userid'";
            mysqli_query($connection, $sql_remove_like);
            $sql_count_like = "SELECT count(id) as like_count FROM post_likes GROUP BY postid HAVING postid = '$postid'";
            $result = mysqli_query($connection, $sql_count_like);
            if ($result->num_rows != 0) {
                $row = mysqli_fetch_assoc($result);
                $like_count = $row['like_count'];
            }
            $sql_update_like = "UPDATE posts SET likes = '$like_count' WHERE post_id = '$postid'";
            mysqli_query($connection, $sql_update_like);
        } else {
            $liked = true;
            $sql_add_like = "INSERT INTO post_likes (`postid`, `userid`) VALUES ('$postid', '$userid')";
            mysqli_query($connection, $sql_add_like);
            $sql_count_like = "SELECT count(id) as like_count FROM post_likes GROUP BY postid HAVING postid = '$postid'";
            $result = mysqli_query($connection, $sql_count_like);
            if ($result->num_rows != 0) {
                $row = mysqli_fetch_assoc($result);
                $like_count = $row['like_count'];
            }
            $sql_update_like = "UPDATE posts SET likes = '$like_count' WHERE post_id = '$postid'";
            mysqli_query($connection, $sql_update_like);
        }
    }
} else {
    if ($onload == 'false') {
        $require_login = true;
    }
    $sql_count_like = "SELECT count(id) as like_count FROM post_likes GROUP BY postid HAVING postid = '$postid'";
    $result = mysqli_query($connection, $sql_count_like);
    if ($result->num_rows != 0) {
        $row = mysqli_fetch_assoc($result);
        $like_count = $row['like_count'];
    }
}

$like_info = array(
    'onload' => $onload,
    'liked' => $liked,
    'like_count' => $like_count,
    'require_login' => $require_login
);

echo json_encode($like_info);

?>