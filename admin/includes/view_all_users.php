<h1 class="page-header">
    Tất cả người dùng

</h1>
<form action="" method="post" class="sroll"> 
        <div style="margin-bottom: 10px;">    
            <a  href="users.php?source=add_user" class="btn btn-primary">Thêm người dùng</a>
        </div>

        <table id="example" class="table table-striped table-bordered" style="width:100%;">
            <thead>
                <tr class="center">
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th>Cập nhập vai trò</th>
                    <!-- <th>Vai trò</th> -->
                    <th>Sửa</th>
                    <th>Xóa</th>

                </tr>
            </thead>
            <tbody>
            <?php

                $query = "SELECT * FROM users ORDER BY user_id DESC"; //chon bang user va sap xep theo id
                $select_users =  mysqli_query($connection, $query); // dung de ket noi voi cau truy van voi bien la $query
             
                while($row = mysqli_fetch_assoc($select_users)){ // dung de lay tung hang trong bang users
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

                   
                    echo "<td><a onClick=\" javascript: return confirm('Bạn chắc chắn muốn cập nhật lại vai trò của {$username}?'); \" href='users.php?update={$user_id}'>{$user_role}</i></a></td>";
                    echo "<td><a href='users.php?source=edit_user&us_id={$user_id}' ><i class='fas fa-edit fa-lg'></i></a></td>";
                    echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete?'); \" href='users.php?delete={$user_id}' ><i class='fas fa-trash-alt fa-lg'></i></a></td>";
                    
                    echo "</tr>";
                }
            ?>
                    



                <!-- <tr class="center">
                    <td>1</td>
                    <td>nhi</td>
                    <td>lenhi@gmail.com</td>
                    <td>admin</td>
                    <th><a href='/'>Admin</a></th>
                    <th><a href='/'>Subcriber</a></th>
                    <td><a href='/'><i class="fas fa-edit fa-lg"></i></a></td>
                    <td><a href='/'><i class="fas fa-trash-alt fa-lg"></i></a></td>
                </tr> -->

            </tbody>
        </table>
<?php
    if(isset($_GET['update'])) {
        $the_user_id = $_GET['update'];

        

        $query = "SELECT * FROM users WHERE user_id = {$the_user_id}";
        $select_user_byId = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_user_byId)) {
            $user_role = $row['user_role'];
        }
  

        if ($user_role === 'admin') 
        {
            $user_role = 'subcriber';
          
            
           
        } else {
            $user_role = 'admin';
            
        }
        $query = "UPDATE users SET user_role = '{$user_role}' WHERE user_id = {$the_user_id}";
        $update = mysqli_query($connection, $query);
        confirm($update);
        header("Location: users.php"); 
    }
     
?>

<?php
    if(isset($_GET['delete'])){
        $the_user_id = $_GET['delete'];

        $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: users.php"); 
    }
?>

