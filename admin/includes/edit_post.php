<?php

//Lấy giá trị ban đầu
if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];

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
        $query .= "post_img_display = '{$post_image_display}', ";
        $query .= "WHERE post_id = {$the_post_id} ";

        $update_post = mysqli_query($connection, $query);
        confirm($update_post);
        echo "<p class='bg-success'>Post updated: " . "<a href='../post.php?p_id={$the_post_id}'>View Posts</a> or <a href='posts.php'>Edit More Posts</a></p>";
    }
}
?>

<h1 class="page-header">
    Chỉnh sửa Bài viết

</h1>
<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Tên bài viết</label>
        <input value="<?php echo "{$post_title}" ?>" type="text" name="post_title" class="form-control">
    </div>

    <div class="form-group">
        <label for="category">Danh mục</label>
        <div>
            <select name="post_category" id="post_category">
                <?php
                $query = "SELECT * FROM category ";
                $seclect_categories = mysqli_query($connection, $query);

                confirm($seclect_categories);
                while ($row = mysqli_fetch_assoc($seclect_categories)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    if ($cat_id == $post_category_id) {
                        echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
                    } else {
                        echo "<option value='{$cat_id}'>{$cat_title}</option>";
                    }
                }

                ?>

            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="title">Tác giả</label>
        <input value="<?php echo "{$post_author}" ?>" type="text" name="post_author" class="form-control">
    </div>



    <div class="form-group">
        <label for="summary">Tóm tắt</label>
        <input value="<?php echo "{$post_summary}" ?>" type="text" name="post_summary" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_status" name="post_status">Trạng thái</label>
        <div>
            <select name="post_status" id="">

                <option value='<?php echo $post_status ?>'><?php echo $post_status == 'draft' ? "Nháp" : "Xuất bản"; ?></option>
                <?php
                if ($post_status == "published") {
                    echo "<option value='draft'>Nháp</option>";
                } else {
                    echo "<option value='published'>Xuất bản</option>";
                }
                ?>
            </select>
        </div>
    </div>


    <div class="form-group" mb-3>
        <label for="post_image">Ảnh bìa</label>
        <br>
        <img width='100' src="../images/<?php echo $post_image_display ?>">
        <br><br>
        <input type="file" name="image_display">
    </div>

    <div class="form-group">
        <label for="post_tags">Thẻ Tags</label>
        <input value="<?php echo "{$post_tags}" ?>" type="text" name="post_tags" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_content">Nội dung</label>

        <textarea id="editor" name="post_content" class="form-control" cols="30" rows="10"><?php echo "{$post_content}" ?>
        </textarea>


    </div>
    </div>

    <div class="form-group" style="padding-left:14px;" pl-5>
        <input type="submit" name="update_post" class="btn btn-primary" value="Cập nhật">
    </div>
</form>