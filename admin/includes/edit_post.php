<?php
edit_post();
?>

<!-- Chỉnh sửa Bài viết -->
<h1 class="page-header">
    Chỉnh sửa Bài viết
</h1>
<?php echo $message; ?>
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