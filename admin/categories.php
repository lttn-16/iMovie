<?php include "includes/admin_header.php" ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Danh mục

                    </h1>
                    <div class="col-xs-6">


                        <form action="" method="post">
                            <div class="form-group">
                                <h3>Thêm danh mục</h3>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">

                                <input class="btn btn-primary" type="submit" name="submit" value="Thêm">
                            </div>
                        </form>


                    </div>

                    <div class="col-xs-6">



                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="center">Id</th>
                                    <th class="center">Tên thể loại</th>
                                    <th class="center">Sửa</th>
                                    <th class="center">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="center">
                                    <td>1</td>
                                    <td>Phim mới</td>
                                    <td><a href='/'><i class="fas fa-edit fa-lg"></i></a></td>
                                    <td><a href='/'><i class="fas fa-trash-alt fa-lg"></i></a></td>
                                </tr>
                                <tr class="center">
                                    <td>2</td>
                                    <td>Phim hay</td>
                                    <td><a href='/'><i class="fas fa-edit fa-lg"></i></a></td>
                                    <td><a href='/'><i class="fas fa-trash-alt fa-lg"></i></a></td>
                                </tr>
                                <tr class="center">
                                    <td>2</td>
                                    <td>Phim Ok</td>
                                    <td><a href='/'><i class="fas fa-edit fa-lg"></i></a></td>
                                    <td><a href='/'><i class="fas fa-trash-alt fa-lg"></i></a></td>
                                </tr>
                                <tr class="center">
                                    <td>2</td>
                                    <td>Ok</td>
                                    <td><a href='/'><i class="fas fa-edit fa-lg"></i></a></td>
                                    <td><a href='/'><i class="fas fa-trash-alt fa-lg"></i></a></td>
                                </tr>
                            </tbody>



                        </table>
                    </div>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"; ?>