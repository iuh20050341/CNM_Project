<?php
include_once("./connect_db.php");
if (isset($_SESSION['ten_dangnhap']) && !empty($_SESSION['ten_dangnhap']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Lấy user_id từ session
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;

    // Lấy tổng số bản ghi cho khách hàng cụ thể với user_id
    $totalRecordsQuery = mysqli_query($con, "SELECT * FROM `khachhang` WHERE `id` = '$user_id' AND `is_nongdan` = 1");
    $totalRecords = $totalRecordsQuery->num_rows;

    // Tính tổng số trang
    $totalPages = ceil($totalRecords / $item_per_page);

    // Truy vấn dữ liệu của khách hàng cụ thể
    $khachhang = mysqli_query($con, "SELECT * FROM `khachhang` WHERE `id` = '$user_id' AND `is_nongdan` = 1 LIMIT $item_per_page OFFSET $offset");

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
    <h1>Doanh thu của tôi</h1>
    <div class="product-items">
        <div class="table-responsive-sm">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Tên KH</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>SĐT</th>
                        <th>Doanh thu đã thanh toán</th>
                        <th>Doanh thu chưa thanh toán</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($khachhang) > 0) {
                        while ($row = mysqli_fetch_array($khachhang)) {
                    ?>
                    <tr>
                        <td><?= $row['ten_kh'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['dia_chi'] ?></td>
                        <td><?= $row['phone'] ?></td>
                        <td><?= $row['doanhthu_tt'] ?></td>
                        <td><?= $row['doanhthu'] ?></td>
                    </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="6" style="text-align: center;">Không có thông tin khách hàng.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
        include './pagination.php'; // Giả sử bạn có một trang phân trang riêng
    ?>
    <div class="clear-both"></div>
</div>
<?php
}
?>
