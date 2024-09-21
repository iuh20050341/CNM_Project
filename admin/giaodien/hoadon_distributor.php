<?php
include_once("./connect_db.php");

if (!empty($_SESSION['nguoidung'])) {
    $item_per_page = (!empty($_GET['per_page'])) ? intval($_GET['per_page']) : 10;
    $current_page = (!empty($_GET['page'])) ? intval($_GET['page']) : 1;
    $offset = ($current_page - 1) * $item_per_page;
    $loggedInFullname = $_SESSION['nguoidung'];

    // Điều kiện lọc cho bảng hoadon
    $filterCondition = "";
    if ($loggedInFullname == 'Vận chuyển 1') {
        $filterCondition = "AND hoadon.phancong = 'Vận chuyển 1'";
    } elseif ($loggedInFullname == 'Vận chuyển 2') {
        $filterCondition = "AND hoadon.phancong = 'Vận chuyển 2'";
    }

    // Lấy dữ liệu từ bảng hoadon với điều kiện lọc theo thời gian và phân trang
    $whereCondition = "WHERE hoadon.deliveryStatus != 0";
    if (isset($_POST['timebd']) && isset($_POST['timekt'])) {
        $timebd = mysqli_real_escape_string($con, $_POST['timebd']);
        $timekt = mysqli_real_escape_string($con, $_POST['timekt']);
        
        if (!empty($timebd)) {
            $whereCondition .= " AND hoadon.ngay_tao >= '$timebd'";
        }
        if (!empty($timekt)) {
            $whereCondition .= " AND hoadon.ngay_tao <= DATE_ADD('$timekt', INTERVAL 1 DAY)";
        }
    }

    // Kết hợp điều kiện lọc `phancong`
    $whereCondition .= " $filterCondition";

    // Get total records and calculate total pages for pagination
    $totalRecordsHoadonQuery = mysqli_query($con, "SELECT * FROM (hoadon LEFT JOIN nhanvien ON hoadon.id_nhanvien = nhanvien.id) $whereCondition");
    $totalRecordsHoadon = $totalRecordsHoadonQuery ? $totalRecordsHoadonQuery->num_rows : 0;
    $totalPagesHoadon = ceil($totalRecordsHoadon / $item_per_page); // Calculate total pages

    // Lấy dữ liệu cho bảng hoadon với điều kiện lọc và phân trang
    $hoadonQuery = mysqli_query($con, "SELECT hoadon.id AS idhoadon, deliveryStatus, id_khachhang, tong_tien, hoadon.ngay_tao, id_nhanvien, trang_thai, ten_nv, hoadon.phancong 
        FROM (hoadon LEFT JOIN nhanvien ON hoadon.id_nhanvien = nhanvien.id) 
        $whereCondition 
        ORDER BY hoadon.ngay_tao DESC 
        LIMIT $item_per_page OFFSET $offset");

    // Close the connection after the queries
    mysqli_close($con);
}
?>

<div class="main-content">
    <h1>Vận chuyển đơn hàng</h1>
    <form action="./admin.php?muc=1&tmuc=Hóa%20đơn" method="POST">
        <div style="margin: 10px;">
            <label for="timebd">Ngày bắt đầu:</label>
            <input type="date" id="timebd" name="timebd" required>
            <label for="timekt">Ngày kết thúc:</label>
            <input type="date" id="timekt" name="timekt" required>
            <input type="submit" value="Lọc">
        </div>
        <div class="product-items">
            <div class="table-responsive-sm">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Mã khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Ngày tạo</th>
                            <th>Trạng thái vận chuyển</th>
                            <th>Xem chi tiết</th>
                            <th style="text-align:center">Nhân viên vận chuyển</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($hoadonQuery)) {
                            $class = ($row['trang_thai'] == 1) ? 'hoadon-daxacnhan' : 'hoadon-chuaxacnhan';
                            echo "<tr class='{$class}'>";
                            ?>
                            <td><?= $row['idhoadon'] ?></td>
                            <td><?= $row['id_khachhang'] ?></td>
                            <td><?= $row['tong_tien'] ?></td>
                            <td><?= $row['ngay_tao'] ?></td>
                            <td><?php
                                if ($row['deliveryStatus'] == "1")
                                    echo "<p style='color:orange'>Chờ lấy hàng</p>";
                                elseif ($row['deliveryStatus'] == "2")
                                    echo "<p style='color:green'>Đang vận chuyển</p>";
                                elseif ($row['deliveryStatus'] == "3")
                                    echo "<p style='color:darkgreen'>Giao hàng thành công</p>";
                                elseif ($row['deliveryStatus'] == "4")
                                    echo "Giao hàng thất bại";
                                ?>
                            </td>
                            <td><a href="./admin.php?act=cthoadon&id=<?= $row['idhoadon'] ?>">Xem chi tiết</a></td>
                            <td style="text-align:center"><?= $row['phancong'] ?></td>
                            <td><?php if ($row['deliveryStatus'] == "1") { ?>
                                <a href="./xulythem.php?act=xnhdvc&type=2&id=<?= $row['idhoadon'] ?>&cuser=<?= $row['ten_nv'] ?>&iduser=<?= $_SESSION['idnhanvien'] ?>">Lấy hàng</a>
                            <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
    <?php
    // Pass total pages to pagination.php
    $totalPages = $totalPagesHoadon;
    include './pagination.php';
    ?>
    <div class="clear-both"></div>
</div>
