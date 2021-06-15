<?php edit_user(); ?>

<!-- Chỉnh sửa người dùng -->
<h1 class="page-header">
    Chỉnh sửa người dùng
</h1>
<?php echo $message; ?>
<form method="post" enctype="multipart/form-data">

    <div class="form-group">
        <div><label for="user_role">Vai trò</label></div>
        <select name="user_role">
            <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
            <?php
            if ($user_role == 'admin') {
                echo "<option value='subcriber'>subcriber</option>";
            } else {
                echo "<option value='admin'>admin</option>";
            }
            ?>
        </select>
    </div>


    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" value="<?php echo "{$username}" ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" name="user_email" value="<?php echo "{$user_email}" ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" name="user_password" value="<?php echo "{$password}" ?>" class="form-control">
    </div>

    <div class="form-group">
        <input type="submit" name="edit_user" class="btn btn-primary" value="Cập nhật">
    </div>
</form>