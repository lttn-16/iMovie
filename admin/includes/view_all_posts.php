<h1 class="page-header">
    Tất cả bài viết

</h1>
<form action="" method="post" class="sroll">
    <table class="table table-bordered table-hover">

        <div id="bulkOptionContainer" class="col-xs-4 post" >
            <select name="bulk_options" id="" class="form-control">
                <option value="">Chọn thao tác</option>
                <option value="published">Xuất bản</option>
                <option value="draft">Nháp</option>
                <option value="delete">Xóa</option>

            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" value="Thực hiện" name="submit" class="btn btn-success">
            <a href="posts.php?source=add_post" class="btn btn-primary">Thêm bài viết</a>
        </div>

        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th><input type="checkbox" name="" id="selectAllBoxes"></th>
                    <th>Id</th>
                    <th>Tác giả</th>
                    <th>Tiêu đề</th>
                    <th>Danh mục</th>
                    <th>Trạng thái</th>
        
                    <th>Thẻ tag</th>
                    <th>Ngày xuất bản</th>
                    <th>Bình luận</th>
                    <th>Lượt xem</th>
                    <th>Xem</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $query = "SELECT * FROM posts ORDER BY post_id DESC";
                $select_posts = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_posts)){
                    $post_id = $row['post_id'];
                    $post_category_id = $row['post_category_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_user = $row['post_user'];
                    $post_date = $row['post_date'];
                    
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_status = $row['post_status'];
                    $post_views = $row['post_views'];
                    echo "<tr class='center'>";
            ?>
                
                    <td><input type='checkbox' class='checkBoxes' name="checkBoxArray[]" value="<?php echo $post_id;  ?>"></td>
            <?php 
                    echo "<td>{$post_id}</td>";

                    if(!empty($post_author)){
                        echo "<td>{$post_author}</td>";
                    } elseif(!empty($post_user)) {
                        echo "<td>{$post_user}</td>";
                    }

                    echo "<td>{$post_title}</td>";
                    

                    $query = "SELECT * FROM category WHERE cat_id = {$post_category_id} ";
                    $seclect_categories_id = mysqli_query($connection,$query);

                        
                    while($row = mysqli_fetch_assoc($seclect_categories_id)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                                    
                        echo "<td>{$cat_title}</td>";

                    }

                    echo "<td>{$post_status}</td>";
                    
                    echo "<td>{$post_tags}</td>";
                    echo "<td>{$post_date}</td>";
                    echo "<td>{$post_comment_count}</td>";
                    echo "<td>{$post_views}</td>";
                    echo "<td><a href='../post.php?p_id={$post_id}' ><i class='fas fa-eye fa-lg'></a></td>";
                    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}' ><i class='fas fa-edit fa-lg'></i></a></td>";
                    echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete={$post_id}' ><i class='fas fa-trash-alt fa-lg'></i></a></td>";
                    
                    echo "</tr>";
                }
            ?>
               
            </tbody>
        </table>


<?php 
        if(isset($_GET['delete'])){
            $the_post_id = $_GET['delete'];

            $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
            $delete_query = mysqli_query($connection, $query);
            header("Location: posts.php"); 
        }
?>


