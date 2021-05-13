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
                <option>Phim hay</option>
                <option>Phim mới</option>

            </select>
        </div>
    </div>


    <div class="form-group">
        <label for="users">Tác giả</label>
        <div>
            <select name="post_user" id="post_category">
                <option>nhi</option>
                <option>max</option>

            </select>
        </div>
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

    <div class="form-group">
        <label for="post_tags">Thẻ Tags</label>
        <input type="text" name="post_tags" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_content">Nội dung</label>

        <textarea name="post_content" id="editor" class="form-control">
        </textarea>


    </div>
    </div>

    <div class="form-group" style="padding-left:14px;" pl-5>
        <input type="submit" name="create_post" class="btn btn-primary" value="Xuất bản">
    </div>
</form>