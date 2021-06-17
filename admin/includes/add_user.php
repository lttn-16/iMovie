<?php add_user(); ?>

<!-- Thêm người dùng -->
<h1 class="page-header">
    Thêm người dùng
</h1>
<?php echo $message; ?>
<form method="post" enctype="multipart/form-data" id="form-1">

    <div class="form-group">
        <label for="user_role">Vai trò</label>
        <br>
        <select name="user_role">
            <option value="subcriber">Chọn vai trò</option>
            <option value="admin">Admin</option>
            <option value="subcriber">Subcriber</option>
        </select>
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" id="username">
        <span id="form-message"></span>
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" name="user_email" class="form-control" id="user_email">
        <span id="form-message"></span>
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" name="user_password" class="form-control" id="user_password">
        <span id="form-message"></span>
    </div>

    <div class="form-group">
        <input type="submit" name="create_user" class="btn btn-primary" value="Add User">
    </div>
</form>