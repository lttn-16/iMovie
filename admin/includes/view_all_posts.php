<?php
get_checkBox();
delete_post();
reset_view();
?>
<h1 class="page-header">
    Tất cả bài viết

</h1>
<form action="" method="post" class="sroll">
    <table class="table table-bordered table-hover">

        <div id="bulkOptionContainer" class="col-xs-4 post">
            <select name="bulk_options" id="" class="form-control">
                <option value="">Chọn thao tác</option>
                <option value="published">Xuất bản</option>
                <option value="draft">Nháp</option>
                <option value="delete">Xóa</option>


            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" value="Thực hiện" name="submit" class="btn btn-success">
            <a href="posts.php?source=add_post" class="btn btn-primary">Thêm bài viết</a>
        </div>

        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th><input type="checkbox" name="" id="selectAllBoxes"></th>
                    <th>Id</th>
                    <th>Tác giả</th>
                    <th>Tiêu đề</th>
                    <th>Danh mục</th>
                    <th>Trạng thái</th>
                    <th>Thẻ tag</th>
                    <th>Ngày xuất bản</th>
                    <th>Bình luận</th>
                    <th>Lượt xem</th>
                    <th>Lượt like</th>
                    <th>Xem</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php display_all_posts(); ?>
            </tbody>
        </table>