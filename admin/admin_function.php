<?php

function confirm($result)
{
    global $connection;
    if (!$result) {
        die(mysqli_error($connection));
    }
}

//Insert category
function insert_categories()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        if ($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty.";
        } else {
            $query = "INSERT INTO category(cat_title) ";
            $query .= "VALUE('{$cat_title}') ";

            $create_category_query = mysqli_query($connection, $query);

            confirm($create_category_query);
        }
    }
}

//Add and delete category
function add_delete_categories()
{
    $query = "SELECT * FROM category";
    global $connection;
    $seclect_categories = mysqli_query($connection, $query);

    //Add categories
    while ($row = mysqli_fetch_assoc($seclect_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr class='center'>";
        echo "<td>$cat_id</td>";
        echo "<td>$cat_title</td>";
        echo "<td><a href='categories.php?edit={$cat_id}'><i class='fas fa-edit fa-lg'></i></a></td>";
        echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete?'); \" href='categories.php?delete={$cat_id}'><i class='fas fa-trash-alt fa-lg'></i></a></td>";
        echo "<tr>";
    }

    //Delete categories
    if (isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];

        $query = "DELETE FROM category WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection, $query);
        confirm($delete_query);
        header("Location: categories.php"); //refesh page
    }
}

//Edit category
function edit_category()
{
    global $connection;
    if (isset($_GET['edit'])) {
        $cat_id = $_GET['edit'];

        $query = "SELECT * FROM category WHERE cat_id = {$cat_id} ";
        $seclect_categories_id = mysqli_query($connection, $query);


        while ($row = mysqli_fetch_assoc($seclect_categories_id)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
?>
            <input value="<?php if (isset($cat_title)) {
                                echo $cat_title;
                            } ?>" class="form-control" type="text" name="cat_title">
<?php
        }
    }
    //Update query
    if (isset($_POST['update_category'])) {
        $the_cat_title = $_POST['cat_title'];

        $query = "UPDATE category SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id} ";
        $update_query = mysqli_query($connection, $query);
        confirm($update_query);
        header("Location: categories.php");
    }
}

//Get checkBox
function get_checkBox()
{
    global $connection;
    if (isset($_POST['checkBoxArray'])) {
        foreach ($_POST['checkBoxArray'] as $checkBoxValue) {
            $bulk_options = $_POST['bulk_options'];
            switch ($bulk_options) {
                case 'published':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue}  ";
                    mysqli_query($connection, $query);
                    break;

                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue}  ";
                    mysqli_query($connection, $query);
                    break;

                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = {$checkBoxValue}  ";
                    mysqli_query($connection, $query);
                    break;
            }
        }
    }
}
//Display posts
function display_all_posts()
{
    global $connection;
    $query = "SELECT * FROM posts ORDER BY post_id DESC";
    $select_posts = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_posts)) {
        $post_id = $row['post_id'];
        $post_category_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_user = $row['post_user'];
        $post_date = $row['post_date'];

        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_status = $row['post_status'];
        $post_views = $row['post_views'];
        echo "<tr class='center'>";
        echo "<td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='$post_id'></td>";
        echo "<td>{$post_id}</td>";

        if (!empty($post_author)) {
            echo "<td>{$post_author}</td>";
        } elseif (!empty($post_user)) {
            echo "<td>{$post_user}</td>";
        }

        echo "<td>{$post_title}</td>";


        $query = "SELECT * FROM category WHERE cat_id = {$post_category_id} ";
        $seclect_categories_id = mysqli_query($connection, $query);


        while ($row = mysqli_fetch_assoc($seclect_categories_id)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<td>{$cat_title}</td>";
        }

        echo "<td>";
        echo $post_status == 'draft' ? 'Nháp' : 'Xuất bản';
        echo "</td>";

        echo "<td>{$post_tags}</td>";
        echo "<td>{$post_date}</td>";
        echo "<td>{$post_comment_count}</td>";
        echo "<td>{$post_views}</td>";
        echo "<td><a href='../post.php?p_id={$post_id}' ><i class='fas fa-eye fa-lg'></a></td>";
        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}' ><i class='fas fa-edit fa-lg'></i></a></td>";
        echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete={$post_id}' ><i class='fas fa-trash-alt fa-lg'></i></a></td>";
        echo "<td><a href='posts.php?reset={$post_id}'>{$post_views}</a></td>";
        echo "</tr>";
    }
}
////Delete post
function delete_post()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $the_post_id = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
        $delete_query = mysqli_query($connection, $query);
        confirm($delete_query);
        header("Location: posts.php");
    }
}

//Reset view
function reset_view()
{
    global $connection;
    if (isset($_GET['reset'])) {
        $the_post_id = $_GET['reset'];

        $query = "UPDATE posts SET post_views = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
        $reset_query = mysqli_query($connection, $query);
        confirm($reset_query);
        header("Location: posts.php"); //refesh page
    }
}

//Count post
function count_post()
{
    global $connection;
    $query = "SELECT * FROM posts";
    $count_post_query = mysqli_query($connection, $query);
    $post_count = mysqli_num_rows($count_post_query);
    echo "<div class='huge'>{$post_count}</div>";
}

//Count user
function count_user()
{
    global $connection;
    $query = "SELECT * FROM users";
    $count_user_query = mysqli_query($connection, $query);
    $user_count = mysqli_num_rows($count_user_query);
    echo "<div class='huge'>{$user_count}</div>";
}

//Count categories
function count_categories()
{
    global $connection;
    $query = "SELECT * FROM category";
    $count_category_query = mysqli_query($connection, $query);
    $category_count = mysqli_num_rows($count_category_query);
    echo "<div class='huge'>{$category_count}</div>";
}

//Count comments
function count_comments()
{
    global $connection;
    $query = "SELECT * FROM comments";
    $count_comment_query = mysqli_query($connection, $query);
    $comment_count = mysqli_num_rows($count_comment_query);
    echo "<div class='huge'>{$comment_count}</div>";
}

//Display comments
function dispaly_all_comments()
{
    global $connection;
    $query = "SELECT * FROM comments, posts WHERE comments.post_id = posts.post_id";
    $select_cmts = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($select_cmts)) {
        if ($row['cmt_status'] == 1) {
            $row['cmt_status'] = "Xuất bản";
        } else {
            $row['cmt_status'] = "Nháp";
        }
        $cmt_id = $row['cmt_id'];
        $comment_post_id = $row['post_id'];
        $cmt_author = $row['cmt_author'];
        $cmt_content = $row['cmt_content'];
        $cmt_email = $row['cmt_email'];
        $cmt_status = $row['cmt_status'];
        $cmt_date = $row['cmt_date'];

        echo "<tr class='center'>";
        echo "<td>{$cmt_id}</td>";
        echo "<td>{$cmt_author}</td>";
        echo "<td>{$cmt_content}</td>";
        echo "<td>{$cmt_email}</td>";
        echo "<td>{$cmt_status}</td>";
        $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id} ";
        $seclect_post_id = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($seclect_post_id)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];

            echo "<th><a href='../post.php?p_id=$post_id'>{$post_title}</a></th>";
        }
        echo "<td>{$cmt_date}</td>";

        echo " <td><a href='comments.php?approve={$cmt_id}' ><i class='fas fa-check-circle fa-lg'></i></a></td>";
        echo "<td><a href='comments.php?not-approve={$cmt_id}' ><i class='fas fa-window-close fa-lg'></i></a></td>";
        echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete?') \" href='comments.php?delete={$cmt_id}' ><i class='fas fa-trash-alt fa-lg'></i></a></td>";

        echo "</tr>";
    }
}

//Delete comment
function delete_comment()
{
    global $connection;

    if (isset($_GET['delete'])) {
        //Delete comment
        $cmt_id = $_GET['delete'];

        $query = "DELETE FROM comments WHERE cmt_id = $cmt_id";
        $delete_query = mysqli_query($connection, $query);
        confirm($delete_query);
        header("Location: comments.php");
    } elseif (isset($_GET['approve'])) {
        //Approve comment
        $cmt_id = $_GET['approve'];

        $query = "UPDATE comments SET cmt_status ='1' WHERE cmt_id = $cmt_id";
        $delete_query = mysqli_query($connection, $query);
        confirm($delete_query);
        header("Location: comments.php");
    } elseif (isset($_GET['not-approve'])) {
        //Not approve comment
        $cmt_id = $_GET['not-approve'];

        $query = "UPDATE comments SET cmt_status ='0' WHERE cmt_id = $cmt_id";
        $delete_query = mysqli_query($connection, $query);
        confirm($delete_query);
        header("Location: comments.php");
    }
}

function online_users()
{
    if (isset($_GET['onlineusers'])) {

        global $connection;

        if (!$connection) {
            session_start();

            include("../include/db.php");

            $session = session_id();
            $time = time();
            $time_out_in_seconds = 30;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);

            if ($count == NULL) {
                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time') ");
            } else {
                mysqli_query($connection, "UPDATE users_online SET time ='$time' WHERE session = '$session' ");
            }

            $user_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
            echo $count_user = mysqli_num_rows($user_online_query);
        }
    }
}

online_users();
?>