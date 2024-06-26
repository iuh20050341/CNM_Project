<?php
    include_once("./connect_db.php");
    if (isset($_SESSION['ten_dangnhap']) && !empty($_SESSION['ten_dangnhap'])) {
        $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
        $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $offset = ($current_page - 1) * $item_per_page;
        $totalRecords = mysqli_query($con, "SELECT * FROM `nhacungcap`");
        $totalRecords = $totalRecords->num_rows;
        $totalPages = ceil($totalRecords / $item_per_page);
        $nhacungcap = mysqli_query($con, "SELECT * FROM `nhacungcap` ORDER BY `id` ASC LIMIT " . $item_per_page . " OFFSET " . $offset);

        mysqli_close($con);
    ?>
<div class="main-content">
            <h1>Nhà cung cấp</h1>
            <div class="product-items">
                <div class="table-responsive-sm ">
                    <table class="table table-bordered table-striped table-hover">
                        <thead >
                            <tr>
                                <th>Id</th>
                                <th>Tên nhà cung cấp</th>
                                <th>Email</th>
                                <th>Website</th>
                                <th>SĐT</th>
                                <th>Đặt hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                            while ($row = mysqli_fetch_array($nhacungcap)) {
                            ?>
                                <tr>           
                                    <td><?= $row['id'] ?></td>     
                                    <td><?= $row['ten_ncc'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['web_site'] ?></td>
                                    <td><?= $row['phone'] ?></td>
                                    <td><a href="supplier.php?act=datncc&id=<?= $row['id'] ?>">Đặt</a></td>
                                    <div class="clear-both"></div>
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