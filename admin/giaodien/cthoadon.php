<?php
include_once("./connect_db.php");

if (!empty($_SESSION['nguoidung'])) {
    // Bảo vệ chống SQL Injection bằng cách sử dụng hàm mysqli_real_escape_string
    $id_hoadon = mysqli_real_escape_string($con, $_GET['id']);

    // Số sản phẩm mỗi trang
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;

    // Lấy tổng số bản ghi hóa đơn
    $totalRecordsQuery = mysqli_query($con, "SELECT * FROM `cthoadon`,`sanpham` WHERE `id_sanpham`=`sanpham`.`id` AND `id_hoadon`='$id_hoadon'");
    $totalRecords = $totalRecordsQuery->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);

    // Lấy dữ liệu chi tiết hóa đơn với truy vấn đã bảo vệ
    $cthoadonQuery = "SELECT `id_hoadon`, `id_sanpham`, `cthoadon`.`so_luong`, `sanpham`.`id`, `ten_sp`, `don_gia`, `sanpham`.`id_nhaban` 
                      FROM `cthoadon`, `sanpham` 
                      WHERE `id_sanpham`=`sanpham`.`id` AND `id_hoadon`='$id_hoadon' 
                      ORDER BY `cthoadon`.`id_hoadon` ASC 
                      LIMIT $item_per_page OFFSET $offset";

    $cthoadon = mysqli_query($con, $cthoadonQuery);

    $sql = 'select * from hoadon where id="' . $id_hoadon . '"';
    $infoCus = executeSingleResult($sql);


    // Đóng kết nối cơ sở dữ liệu sau khi truy vấn
    mysqli_close($con);
    ?>

<div style="margin: 10px">
    <button style="background-color: darkgray; border-radius: 5px; width: 55px; height: auto;">
        <a href="./admin.php?muc=1&tmuc=Quản%20lý%20vận%20chuyển"><i class="fa-solid fa-backward"></i></a>
    </button>
</div>

<div class="clear-both"></div>

<div class="main-content">
    <h1>Chi tiết hóa đơn</h1>
    <div class="product-items">
        <div class="customer-info mb-4 p-3 border rounded">
            <h5 class="mb-3">Thông tin khách hàng</h5>
            <div class="row">
                <div class="col-md-6">
                    <strong>Tên khách hàng:</strong>
                    <?= isset($infoCus['ten_nguoinhan']) ? htmlspecialchars($infoCus['ten_nguoinhan']) : 'Không có thông tin' ?>
                </div>
                <div class="col-md-6">
                    <strong>Số điện thoại:</strong>
                    <?= isset($infoCus['sdt_nguoinhan']) ? htmlspecialchars($infoCus['sdt_nguoinhan']) : 'Không có thông tin' ?>
                </div>
                <div class="col-md-6">
                    <strong>Địa chỉ:</strong>
                    <?= isset($infoCus['diachinhanhang']) ? htmlspecialchars($infoCus['diachinhanhang']) : 'Không có thông tin' ?>
                </div>
            </div>
        </div>


        <div class="table-responsive-sm">
            <!-- Bảng sản phẩm -->
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>ID Nhà bán</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($row = mysqli_fetch_array($cthoadon)) {
                            ?>
                    <tr>
                        <td><?= htmlspecialchars($row['ten_sp']) ?></td>
                        <td><?= htmlspecialchars($row['so_luong']) ?></td>
                        <td><?= htmlspecialchars($row['don_gia']) ?></td>
                        <td><?= htmlspecialchars($row['id_nhaban']) ?></td> <!-- Hiển thị ID Nhà bán -->
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>


    <?php include './pagination2.php'; ?>

    <div class="clear-both"></div>
</div>
<?php
} else {
    echo "Bạn cần đăng nhập để xem chi tiết hóa đơn.";
}
?>