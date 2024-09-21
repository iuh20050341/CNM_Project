<?php
include_once("./connect_db.php");
if (!empty($_SESSION['nguoidung'])) {
    $item_per_page = (!empty($_GET['per_page'])) ? intval($_GET['per_page']) : 10;
    $current_page = (!empty($_GET['page'])) ? intval($_GET['page']) : 1;
    $offset = ($current_page - 1) * $item_per_page;

    $whereClause = "hoadon.deliveryStatus = 0";
    
    if (isset($_POST['timebd']) && isset($_POST['timekt'])) {
        $timebd = mysqli_real_escape_string($con, $_POST['timebd']);
        $timekt = mysqli_real_escape_string($con, $_POST['timekt']);

        if (!empty($timebd) && !empty($timekt)) {
            $whereClause .= " AND hoadon.ngay_tao BETWEEN '$timebd' AND DATE_ADD('$timekt', INTERVAL 1 DAY)";
        } elseif (!empty($timebd)) {
            $whereClause .= " AND hoadon.ngay_tao >= '$timebd'";
        } elseif (!empty($timekt)) {
            $whereClause .= " AND hoadon.ngay_tao <= DATE_ADD('$timekt', INTERVAL 1 DAY)";
        }
    }

    $totalRecordsQuery = "SELECT COUNT(*) AS total FROM hoadon LEFT JOIN nhanvien ON hoadon.id_nhanvien = nhanvien.id WHERE $whereClause";
    $totalRecordsResult = mysqli_query($con, $totalRecordsQuery);
    $totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];
    $totalPages = ceil($totalRecords / $item_per_page);

    $hoadonQuery = "SELECT hoadon.id AS idhoadon, deliveryStatus, id_khachhang, tong_tien, hoadon.ngay_tao, id_nhanvien, trang_thai, ten_nv, nhanvien.id
                    FROM hoadon
                    LEFT JOIN nhanvien ON hoadon.id_nhanvien = nhanvien.id
                    WHERE $whereClause
                    ORDER BY hoadon.ngay_tao DESC
                    LIMIT $item_per_page OFFSET $offset";
    $hoadon = mysqli_query($con, $hoadonQuery);
    mysqli_close($con);
    ?>
<style>
        .table-bordered th, .table-bordered td {
            background-color: #ffffff;
            color: #000;
            text-align: center; /* Căn giữa chữ trong các ô */
            vertical-align: middle; /* Căn giữa theo chiều dọc */
            font-weight: normal; /* Không in đậm */
        }

        .table-bordered th {
            background-color: #f0f0f0;
        }

        .table td {
            border: 1px solid #ddd;
            font-size: 16px;
            padding: 10px; /* Thêm padding để các ô đều nhau */
        }

        .product-items input[type="date"] {
            width: 150px;
            padding: 5px;
            margin: 5px;
            border: 1px solid #CCC;
        }

        .product-items input[type="submit"] {
            padding: 10px 20px;
            margin: 5px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 18px;
        }

        .product-items .table-responsive-sm {
            margin-top: 20px;
        }

        /* Định dạng riêng cho trạng thái vận chuyển */
        .table td.status-delivery {
            color: inherit;
        }
    </style>

    <div class="main-content">
        <h1>Phân công vận chuyển</h1>
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
                            <th style="text-align:center">Phân công</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($hoadon)) { ?>
                            <tr class="<?= $row['trang_thai'] == 1 ? 'hoadon-daxacnhan' : 'hoadon-chuaxacnhan' ?>">
                                <td><?= htmlspecialchars($row['idhoadon']) ?></td>
                                <td><?= htmlspecialchars($row['id_khachhang']) ?></td>
                                <td><?= htmlspecialchars($row['tong_tien']) ?></td>
                                <td><?= htmlspecialchars($row['ngay_tao']) ?></td>
                                <td class="status-delivery">
                                    <?php
                                    switch ($row['deliveryStatus']) {
                                        case "1":
                                            echo "<p style='color:orange'>Chờ lấy hàng</p>";
                                            break;
                                        case "2":
                                            echo "<p style='color:green'>Đang vận chuyển</p>";
                                            break;
                                        case "3":
                                            echo "<p style='color:darkgreen'>Giao hàng thành công</p>";
                                            break;
                                        case "4":
                                            echo "Giao hàng thất bại";
                                            break;
                                    }
                                    ?>
                                </td>
                                <td><a href="./admin.php?act=cthoadon&id=<?= htmlspecialchars($row['idhoadon']) ?>">Xem chi tiết</a></td>
                                <td style="text-align:center">
                                    <form action="xulythem.php" method="POST" class="form-container">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($row['idhoadon']) ?>" />
                                        <input type="text" name="vc" value="<?= isset($row['phancong']) ? htmlspecialchars($row['phancong']) : '' ?>" />
                                        <input type="submit" name="btn_pcvc" value="Phân công">
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include './pagination.php'; ?>
    </div>
    <?php
}
?>
