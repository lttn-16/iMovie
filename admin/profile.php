<?php include "includes/admin_header.php" ?>

<?php
edit_profile()
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Thông tin người dùng
                    </h1>
                    <?php echo $message; ?>
                    <form method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <div><label for="user_role">Vai trò</label></div>
                            <select name="user_role">
                                <option value="admin"><?php echo $user_role ?></option>
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

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"; ?>