<?php 
    
    if(isset($_POST['create_post'])){
        $post_title = $_POST['title'];
        $post_author = $_POST['post_author'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        $post_summary = $_POST['summary'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        $post_image_display = $_FILES['image_display']['name'];
        $post_image_display_temp = $_FILES['image_display']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        

        move_uploaded_file($post_image_temp, "../images/$post_image");
        move_uploaded_file($post_image_display_temp, "../images/$post_image_display");

        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, 
        post_image, post_img_display, post_content, post_summary, post_tags, post_status) ";

        $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_image_display}','{$post_content}','{$post_summary}', '{$post_tags}', '{$post_status}')";

        $create_post_query = mysqli_query($connection, $query);

        confirm($create_post_query); 

        $the_post_id = mysqli_insert_id($connection); //the last id had been created
        echo "<p class='bg-success'>Post created: " . "<a href='../post.php?p_id={$the_post_id}'>View Posts</a> or <a href='posts.php'>Edit More Posts</a></p>";
    }

?>
<h1 class="page-header">
    Thêm Bài viết

</h1>
<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Tên bài viết</label>
        <input type="text" name="title" class="form-control">
    </div>

    <div class="form-group">
        <label for="category">Danh mục</label>
        <div>
            <select name="post_category" id="post_category">
            <?php 
                $query = "SELECT * FROM category ";
                $seclect_categories = mysqli_query($connection,$query);

                confirm($seclect_categories);
                while($row = mysqli_fetch_assoc($seclect_categories)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title']; 
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            ?>

            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="title">Tác giả</label>
        <input type="text" name="post_author" class="form-control">
    </div>



    <div class="form-group">
        <label for="title">Tóm tắt</label>
        <input type="text" name="summary" class="form-control">
    </div>

    <div class="form-group">
        <label for="status">Trạng thái</label>
        <div>
            <select name="post_status" id="">
                <option value="draft">Chọn</option>
                <option value="published">Xuất bản</option>
                <option value="draft">Nháp</option>
            </select>
        </div>
    </div>

    <div class="form-group" mb-3>
        <label for="post_image">Hình ảnh</label>
        <input type="file" name="image">
    </div>

    <div class="form-group" mb-3>
        <label for="post_image">Ảnh bìa</label>
        <input type="file" name="image_display">
    </div>

    <div class="form-group">
        <label for="post_tags">Thẻ Tags</label>
        <input type="text" name="post_tags" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_content">Nội dung</label>

        <textarea name="post_content" id="editor" class="form-control"></textarea>
        </textarea>


    </div>
    </div>

    <div class="form-group" style="padding-left:14px;" pl-5>
        <input type="submit" name="create_post" class="btn btn-primary" value="Xuất bản">
    </div>
</form>






