<?php
    //lấy giá trị ban đầu
    if (isset($_GET['us_id'])){
        $the_user_id = $_GET['us_id'];

        $query = "SELECT * FROM users WHERE user_id = {$the_user_id}";
        $select_user_byId = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_user_byId)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_password = $row['user_password'];
            
        }

        //lấy giá trị cập nhập

        if (isset($_POST['update_user'])) {
            $username = $_POST['username'];
            $user_email = $_POST['user_email'];
            $user_role = $_POST['user_role'];
            $user_password = $_POST['user_password'];
        }
        
        //cap nhap gia tri
        $query = "UPDATE users SET ";
        $query .= "username = '{$username}', ";
        $query .= "user_email = '{$user_email}',";
        $query .= "user_role = '{$user_role}', ";
        $query .= "user_password = '{$user_password}', ";

        $update_user_query=mysqli_query($connection, $query);
        confirm($update_user_query);
        echo "<p class='bg-success'>Post updated:</p>";
    
    
    }

?>

<h1 class="page-header">
    Chỉnh sửa người dùng

</h1>

<form method="post" enctype="multipart/form-data" id="form-1">
   
    <div class="form-group">
        <label for="user_role" name ="user_role">Vai trò</label>
        <br>
        <select name="user_role" id="">
            <option value='<?php echo $user_role ?>'> <?php echo $user_role == 'admin' ? "Admin":"Subcriber";?></option>
            <?php 
                if ($user_role == "admin") 
                {
                    echo "<option value='subcriber'>Subcriber</option>";
                } else {
                    echo "<option value='admin'>Admin</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" id="username" value="<?php echo "{$username}"?>">
        <span id="form-message"></span>
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" name="user_email" class="form-control" id="user_email" value="<?php echo "{$user_email}"?>">
        <span id="form-message"></span>
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" name="user_password" class="form-control" id="user_password" value="<?php echo "{$user_password}"?>">
        <span id="form-message"></span>
    </div>

    <div class="form-group">
        <input type="submit" name="update_user" class="btn btn-primary" value="Cập nhật">
    </div>
</form>