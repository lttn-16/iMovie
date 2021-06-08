<?php delete_comment() ?>
<div class="sroll">
<table id="example" class="table table-striped table-bordered" style="width:100%;">
    <thead>
        <tr>
            <th>Id</th>
            <th>Tác giả</th>
            <th>Bình luận</th>
            <th>Email</th>
            <th>Trạng thái</th>
            <th>Bài viết</th>
            <th>Ngày</th>
            <th>Duyệt</th>
            <th>Không duyệt</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tbody>
    <?php dispaly_all_comments(); ?>
    </tbody>
</table>
</div>