<?php
if (isset($_GET['us_id'])) {
    $the_user_id = $_GET['us_id'];

    $query = "SELECT * FROM users WHERE user_id = $the_user_id";
    $select_users_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_users_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
    }
}
if (isset($_POST['edit_user'])) {

    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];


    // $query = "SELECT randSalt FROM users";
    // $select_randsalt_query = mysqli_query($connection, $query);
    // confirm($select_randsalt_query);
    // $row = mysqli_fetch_array($select_randsalt_query);
    // $salt = $row['randSalt'];
    // $hashed_password = crypt($user_password, $salt); 

    $query = "UPDATE users SET ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    // $query .= "user_password = '{$hashed_password}' ";
    $query .= "WHERE user_id = {$the_user_id} ";

    $update_users = mysqli_query($connection, $query);
    confirm($update_users);
    echo "<p class='bg-success'>User updated: " . "<a href='users.php'>View Users</a></p>";
}

?>

<h1 class="page-header">
    Chỉnh sửa người dùng

</h1>
<form method="post" enctype="multipart/form-data">

    <div class="form-group">
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
        <input type="password" name="user_password" value="<?php echo "{$user_password}" ?>" class="form-control">
    </div>

    <div class="form-group">
        <input type="submit" name="edit_user" class="btn btn-primary" value="Edit User">
    </div>
</form>