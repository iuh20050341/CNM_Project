<?php
    include_once("./connect_db.php");
    if (!empty($_SESSION['nguoidung'])) {
        $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
        $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $offset = ($current_page - 1) * $item_per_page;
        $totalRecords = mysqli_query($con, "SELECT * FROM `nhanvien`");
        $totalRecords = $totalRecords->num_rows;
        $totalPages = ceil($totalRecords / $item_per_page);
        $nhanvien = mysqli_query($con, "SELECT * FROM `nhanvien` ORDER BY `id` ASC LIMIT " . $item_per_page . " OFFSET " . $offset);

        mysqli_close($con);
    ?>
<div class="main-content">
            <h1>Danh sách nhân viên</h1>
            <div class="product-items">
                <div class="table-responsive-sm ">
                    <table class="table table-bordered table-striped table-hover">
                        <thead >
                            <tr>
                                <th>ID</th>
                                <th>Tên nhân viên</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>SĐT</th>
                                <th>Ngày tạo</th>
                                <th>Ngày sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                            while ($row = mysqli_fetch_array($nhanvien)) {
                            ?>
                                <tr>                 
                                    <td><?= $row['id'] ?></td>         
                                    <td><?= $row['ten_nv'] ?></td>
                                    <td><?= $row['ten_dangnhap'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['phone'] ?></td>
                                    <td><?= $row['ngay_tao'] ?></td>
                                    <td><?= $row['ngay_sua'] ?></td>
                                </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php
        include './pagination.php';
        ?>
        <div class="clear-both"></div>
        </div>
    <?php
    }
    ?>