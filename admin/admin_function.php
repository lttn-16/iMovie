<?php

// Check error
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
        $post_likes = $row['likes'];
        if (!$post_likes) {
            $post_likes = 0;
        }

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
        echo "<td><a href='posts.php?reset={$post_id}'>{$post_views}</a></td>";
        echo "<td>{$post_likes}</td>";
        echo "<td><a href='../post.php?p_id={$post_id}' target='_blank' ><i class='fas fa-eye fa-lg'></a></td>";
        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}' ><i class='fas fa-edit fa-lg'></i></a></td>";
        echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete={$post_id}' ><i class='fas fa-trash-alt fa-lg'></i></a></td>";
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

            echo "<th><a target='_blank' href='../post.php?p_id=$post_id'>{$post_title}</a></th>";
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

//Edit user
function edit_user()
{
    global $connection;
    global $user_role;
    global $username;
    global $password;
    global $user_email;
    global $message;
    $message = '';
    if (isset($_GET['us_id'])) {
        $the_user_id = $_GET['us_id'];

        $query = "SELECT * FROM users WHERE user_id = $the_user_id";
        $select_users_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_users_query)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $password = $row['user_password'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
        }
    }
    if (isset($_POST['edit_user'])) {

        $user_role = $_POST['user_role'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        if ($password !== $user_password) {
            $query = "SELECT randSalt FROM users";
            $select_randsalt_query = mysqli_query($connection, $query);
            confirm($select_randsalt_query);
            $row = mysqli_fetch_array($select_randsalt_query);
            $salt = $row['randSalt'];
            $hashed_password = crypt($user_password, $salt);
        } else {
            $hashed_password = $password;
        }

        $query = "UPDATE users SET ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$hashed_password}' ";
        $query .= "WHERE user_id = {$the_user_id} ";

        $update_users = mysqli_query($connection, $query);
        confirm($update_users);
        $message = "<h4 class='bg-success'>Cập nhật thành công! " . "<a href='users.php'>Xem người dùng</a></h4>";
    }
}

//Add user
function add_user()
{
    global $message;
    global $connection;
    $message = '';
    if (isset($_POST['create_user'])) {
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        $user_role = $_POST['user_role'];

        $query = "SELECT randSalt FROM users";
        $select_randsalt_query = mysqli_query($connection, $query);
        confirm($select_randsalt_query);
        $row = mysqli_fetch_array($select_randsalt_query);
        $salt = $row['randSalt'];
        $hashed_password = crypt($user_password, $salt);

        $query = "INSERT INTO users(username, user_email, user_password, user_role) ";
        $query .= "VALUES('{$username}', '{$user_email}','{$hashed_password}', '{$user_role}')";

        $create_user_query = mysqli_query($connection, $query);

        confirm($create_user_query);

        $the_user_id = mysqli_insert_id($connection);

        $message = "<h4 class='bg-success'>Thêm người dùng thành công! " . "<a href='users.php'>Xem người dùng</a></h4>";
    }
}

//delete user
function delete_user()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $the_user_id = $_GET['delete'];

        $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
        mysqli_query($connection, $query);
        header("Location: users.php");
    }
}

//Change to admin
function change_to_admin()
{
    global $connection;
    if (isset($_GET['change_to_admin'])) {
        $the_user_id = $_GET['change_to_admin'];

        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id";
        mysqli_query($connection, $query);
        header("Location: users.php"); //refesh page
    }
}

//Change to subcriber
function change_to_sub()
{
    global $connection;
    if (isset($_GET['change_to_sub'])) {
        $the_user_id = $_GET['change_to_sub'];

        $query = "UPDATE users SET user_role = 'subcriber' WHERE user_id = $the_user_id";
        mysqli_query($connection, $query);
        header("Location: users.php"); //refesh page
    }
}

//Display user
function display_user()
{
    global $connection;
    $query = "SELECT * FROM users ORDER BY user_id DESC"; //chon bang user va sap xep theo id
    $select_users =  mysqli_query($connection, $query); // dung de ket noi voi cau truy van voi bien la $query

    while ($row = mysqli_fetch_assoc($select_users)) { // dung de lay tung hang trong bang users
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];

        echo "<tr class='center'>";
        echo "<td>{$user_id}</td>";
        echo "<td>{$username}</td>";
        echo "<td>{$user_email}</td>";

        echo "<td>{$user_role}</td>";

        echo "<th><a href='users.php?change_to_admin=$user_id' >Admin</a></th>";
        echo "<th><a href='users.php?change_to_sub=$user_id' >Subcriber</a></th>";
        echo "<td><a href='users.php?source=edit_user&us_id={$user_id}' ><i class='fas fa-edit fa-lg'></i></a></td>";
        echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete?'); \" href='users.php?delete={$user_id}' ><i class='fas fa-trash-alt fa-lg'></i></a></td>";

        echo "</tr>";
    }
}

//Add posts
function add_posts()
{
    global $connection;
    global $message;
    $message = '';
    if (isset($_POST['create_post'])) {
        $post_title = $_POST['title'];
        $post_author = $_POST['post_author'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        $post_summary = $_POST['summary'];

        $post_image_display = $_FILES['image_display']['name'];
        $post_image_display_temp = $_FILES['image_display']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');

        move_uploaded_file($post_image_display_temp, "../images/$post_image_display");

        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, 
        post_img_display, post_content, post_summary, post_tags, post_status) ";

        $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image_display}','{$post_content}','{$post_summary}', '{$post_tags}', '{$post_status}')";

        $create_post_query = mysqli_query($connection, $query);

        confirm($create_post_query);

        $the_post_id = mysqli_insert_id($connection); //the last id had been created
        //echo "<p class='bg-success'>Post created: " . "<a href=''>View Posts</a> or <a href='posts.php'>Edit More Posts</a></p>";
        $message = "<h4 class='bg-success'>Thêm bài viết thành công! " . "<a href='../post.php?p_id={$the_post_id}'>Xem bài viết</a> hoặc <a href='posts.php'>Tất cả bài viết</a></h4>";
    }
}

//Select category in post
function select_category_in_post()
{
    global $connection;
    $query = "SELECT * FROM category ";
    $seclect_categories = mysqli_query($connection, $query);

    confirm($seclect_categories);
    while ($row = mysqli_fetch_assoc($seclect_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<option value='{$cat_id}'>{$cat_title}</option>";
    }
}

//Edit profile
function edit_profile()
{
    global $connection;
    global $user_role;
    global $username;
    global $password;
    global $user_email;
    global $message;
    $message = '';
    if (isset($_SESSION['username'])) {
        $userId = $_SESSION['userId'];

        $query = "SELECT * FROM users WHERE user_id = $userId ";
        $select_user_profile_query = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($select_user_profile_query)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $password = $row['user_password'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
        }
    }

    if (isset($_POST['edit_user'])) {
        $user_role = $_POST['user_role'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        if ($password !== $user_password) {
            $query = "SELECT randSalt FROM users";
            $select_randsalt_query = mysqli_query($connection, $query);
            confirm($select_randsalt_query);
            $row = mysqli_fetch_array($select_randsalt_query);
            $salt = $row['randSalt'];
            $hashed_password = crypt($user_password, $salt);
        } else {
            $hashed_password = $password;
        }

        $query = "UPDATE users SET ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$hashed_password}' ";
        $query .= "WHERE user_id = '{$userId}' ";

        $update_users = mysqli_query($connection, $query);
        confirm($update_users);
        $message = "<h4 class='bg-success'>Cập nhật thành công! " . "<a href='users.php'>Xem người dùng</a></h4>";
    }
}

function edit_post()
{
    global $connection;
    global $post_title;
    global $post_author;
    global $post_status;
    global $post_summary;
    global $post_content;
    global $post_image_display;
    global $post_tags;
    global $message;
    $message = '';
    if (isset($_GET['p_id'])) {
        $the_post_id = $_GET['p_id'];
        //Lấy giá trị ban đầu
        $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
        $select_posts_byId = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_posts_byId)) {
            $post_id = $row['post_id'];
            $post_category_id = $row['post_category_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image_display = $row['post_img_display'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_status = $row['post_status'];
            $post_content = $row['post_content'];
            $post_summary = $row['post_summary'];
        }
        //  Lấy giá trị sau khi cập nhật

        if (isset($_POST['update_post'])) {
            $post_title = $_POST['post_title'];
            $post_author = $_POST['post_author'];
            $post_category_id = $_POST['post_category'];
            $post_status = $_POST['post_status'];
            $post_summary = $_POST['post_summary'];


            $post_image_display = $_FILES['image_display']['name'];
            $post_image_display_temp = $_FILES['image_display']['tmp_name'];

            $post_tags = $_POST['post_tags'];
            $post_content = $_POST['post_content'];
            $post_date = date('d-m-y');

            move_uploaded_file($post_image_display_temp, "../images/$post_image_display");

            //Trường hợp không chọn ảnh

            if (empty($post_image_display)) {
                $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
                $select_image = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_image)) {
                    $post_image_display = $row['post_img_display'];
                }
            }

            // Cập nhật giá trị

            $query = "UPDATE posts SET ";
            $query .= "post_title = '{$post_title}', ";
            $query .= "post_category_id = '{$post_category_id}', ";
            $query .= "post_date = now(), ";
            $query .= "post_author = '{$post_author}', ";
            $query .= "post_status = '{$post_status}', ";
            $query .= "post_tags = '{$post_tags}', ";
            $query .= "post_content = '{$post_content}', ";
            $query .= "post_summary = '{$post_summary}', ";
            $query .= "post_img_display = '{$post_image_display}' ";
            $query .= "WHERE post_id = {$the_post_id} ";

            $update_post = mysqli_query($connection, $query);
            confirm($update_post);
            $message = "<h4 class='bg-success'>Cập nhật bài viết thành công! " . "<a href='../post.php?p_id={$the_post_id}'>Xem bài viết</a> hoặc <a href='posts.php'>Tất cả bài viết</a></h4>";
            //echo "<p class='bg-success'>Post updated: " . "<a href='../post.php?p_id={$the_post_id}'>View Posts</a> or <a href='posts.php'>Tất cả bài viết</a></p>";
        }
    }
}
?>