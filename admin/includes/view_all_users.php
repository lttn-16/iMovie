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
            <?php

            $query = "SELECT * FROM users ORDER BY user_id DESC"; //chon bang user va sap xep theo id
            $select_users =  mysqli_query($connection, $query); // dung de ket noi voi cau truy van voi bien la $query

            while ($row = mysqli_fetch_assoc($select_users)) { // dung de lay tung hang trong bang users
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_password = $row['user_password'];
                $user_email = $row['user_email'];
                $user_role = $row['user_role'];

                echo "<tr class='center'>";
                echo "<td>{$user_id}</td>";
                echo "<td>{$username}</td>";
                echo "<td>{$user_email}</td>";

                echo "<td>{$user_role}</td>";

                //echo "<td><a>admin</a></td>";


                // echo "<td><a href='edit_userole.php?user_id={$user_id}&user_role=".$user_role=isset($user_role)?'subcriber':'admin'."'>Thay đổi</a></td>";

                echo "<th><a href='users.php?change_to_admin=$user_id' >Admin</a></th>";
                echo "<th><a href='users.php?change_to_sub=$user_id' >Subcriber</a></th>";
                echo "<td><a href='users.php?source=edit_user&us_id={$user_id}' ><i class='fas fa-edit fa-lg'></i></a></td>";
                echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete?'); \" href='users.php?delete={$user_id}' ><i class='fas fa-trash-alt fa-lg'></i></a></td>";

                echo "</tr>";
            }
            ?>

        </tbody>
    </table>

    <?php
    if (isset($_GET['delete'])) {
        $the_user_id = $_GET['delete'];

        $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: users.php");
    }

    if (isset($_GET['change_to_admin'])) {
        $the_user_id = $_GET['change_to_admin'];

        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id";
        $unapprove_comment_query = mysqli_query($connection, $query);
        header("Location: users.php"); //refesh page


    }

    if (isset($_GET['change_to_sub'])) {
        $the_user_id = $_GET['change_to_sub'];

        $query = "UPDATE users SET user_role = 'subcriber' WHERE user_id = $the_user_id";
        $unapprove_comment_query = mysqli_query($connection, $query);
        header("Location: users.php"); //refesh page

    }
    ?>