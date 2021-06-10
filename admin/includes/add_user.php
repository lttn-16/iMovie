<?php

    if(isset($_POST['create_user'])){
        $username=$_POST['username'];
        $user_email=$_POST['user_email'];
        $user_password=$_POST['user_password'];
        $user_role=$_POST['user_role'];

        $query = "INSERT INTO users(username, user_email, user_password, user_role)";
        $query .= "VALUES('{$username}', '{$user_email}',{$user_password}, '{$user_role}')";
       
        $create_user_query = mysqli_query($connection, $query);
      
        confirm($create_user_query);

        $the_user_id = mysqli_insert_id($connection);

        echo "<p class='bg-success'> Thêm người dùng thành công. ". "<a href='users.php'>Xem người dùng</a></p>";
    }

?>


<h1 class="page-header">
    Thêm người dùng

</h1>

<form method="post" enctype="multipart/form-data" id="form-1">
   
    <div class="form-group">
        <label for="user_role">Vai trò</label>
        <br>
        <select name="user_role">

            <option value="admin">Chọn vai trò</option>
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


