<?php
    include_once("./connect_db.php");
    if (!empty($_SESSION['nguoidung'])) {
        $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
        $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $offset = ($current_page - 1) * $item_per_page;

        // Lấy tổng số bản ghi với điều kiện is_nongdan khác 1
        $totalRecords = mysqli_query($con, "SELECT * FROM `khachhang` WHERE `is_nongdan` = 1");
        $totalRecords = $totalRecords->num_rows;

        // Tính tổng số trang
        $totalPages = ceil($totalRecords / $item_per_page);

        // Truy vấn dữ liệu với điều kiện is_nongdan khác 1
        $khachhang = mysqli_query($con, "SELECT * FROM `khachhang` WHERE `is_nongdan` = 1 ORDER BY `id` ASC LIMIT " . $item_per_page . " OFFSET " . $offset);

        mysqli_close($con);
?>
<style>
.table-bordered th,
.table-bordered td {
    background-color: #ffffff;
    border: 1px solid #ddd;
    padding: 8px;
    font-size: 16px;
}

.table-bordered th {
    background-color: #f0f0f0;
    text-align: center;
}

.table td {
    text-align: left;
}
</style>
<div class="main-content">
    <h1>Quản lý doanh thu nông dân</h1>
    <div class="product-items">
        <div class="table-responsive-sm ">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Tên KH</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>SĐT</th>
                        <th>Doanh thu</th>
                        <th>Thay đổi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $currentPage = 1;
                    $rowsPerPage = 8;
                    $rowCount = 0;
                            while ($row = mysqli_fetch_array($khachhang)) {
                                if ($rowCount < $rowsPerPage) {
                    ?>
                    <tr>
                        <td><?= $row['ten_kh'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['diachivuon'] ?></td>
                        <td><?= $row['phone'] ?></td>
                        <td><?= $row['doanhthu'] ?></td>
                        <td>
                            <form method="POST" action="./xulythem.php?id=<?= $row['id'] ?>">
                            <input type="submit" name="btn_dt" value="Thanh toán" onclick="return confirm('Bạn có muốn thanh toán doanh thu?')">
                        </td>
                        </form>
                        <div class="clear-both"></div>
                    </tr>
                    <?php
                 $rowCount++; }else {
                    // Break the loop
                    break;
                }
                        } ?>
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