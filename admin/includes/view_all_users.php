<?php
delete_user();
change_to_admin();
change_to_sub();
?>

<!-- Tất cả người dùng -->
<h1 class="page-header">
    Tất cả người dùng
</h1>
<form action="" method="post" class="sroll">
    <div style="margin-bottom: 10px;">
        <a href="users.php?source=add_user" class="btn btn-primary">Thêm người dùng</a>
    </div>

    <table id="example" class="table table-striped table-bordered" style="width:100%;">
        <thead>
            <tr class="center">
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>Admin</th>
                <th>Subcriber</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php display_user(); ?>
        </tbody>
    </table>