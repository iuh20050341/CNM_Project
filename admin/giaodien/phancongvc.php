<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<?php
//
include_once("./connect_db.php");
if (!empty($_SESSION['nguoidung'])) {
    $item_per_page = (!empty($_GET['per_page'])) ? intval($_GET['per_page']) : 6;
    $current_page = (!empty($_GET['page'])) ? intval($_GET['page']) : 1;
    $offset = ($current_page - 1) * $item_per_page;

    if (isset($_POST['search'])) {
        $sql = "SELECT *  FROM hoadon LEFT JOIN nhanvien ON `id_nhanvien`=`nhanvien`.`id` WHERE `hoadon`.`deliveryStatus` != 0";

        if (!empty($_POST['timebd']) && !empty($_POST['timekt'])) {
            $sql .= " AND `hoadon`.`ngay_tao` >= '" . $_POST['timebd'] . "' AND `hoadon`.`ngay_tao` <= DATE_ADD('" . $_POST['timekt'] . "', INTERVAL '1' DAY)";
        }

        if (($_POST['timebd'] == '') && (!empty($_POST['timekt']))) {
            $sql .= " AND `hoadon`.`ngay_tao` <= DATE_ADD('" . $_POST['timekt'] . "',INTERVAL '1' DAY)";
        }
        if (($_POST['timekt'] == '') && (!empty($_POST['timebd']))) {
            $sql .= " AND `hoadon`.`ngay_tao` >= '" . $_POST['timebd'] . "'";
        }
        if (!empty($_POST['status'])) {
            $sql .= " AND `hoadon`.`deliveryStatus` = '" . $_POST['status'] . "'";
        }

        if (!empty($_POST['orderId'])) {
            $sql .= " AND `hoadon`.`id` = '" . $_POST['orderId'] . "'";
        }
        if (!empty($_POST['phancong']) && $_POST['phancong'] != '') {
            $sql .= " AND `hoadon`.`phancong` = '" . $_POST['phancong'] . "'";
        }

        // echo '' . $sql . '';
        $totalRecordsQuery = mysqli_query($con, $sql);

    } else {
        $totalRecordsQuery = mysqli_query($con, "SELECT *  FROM hoadon LEFT JOIN nhanvien ON hoadon.id_nhanvien = nhanvien.id WHERE `hoadon`.`deliveryStatus` != 0");
    }
    if ($totalRecordsQuery) {
        $totalRecords = $totalRecordsQuery->num_rows;
        $totalPages = ceil($totalRecords / $item_per_page);
        if (isset($_POST['search'])) {
            $sql = "SELECT hoadon.id AS idhoadon, deliveryStatus, phancong, id_khachhang, tong_tien, hoadon.ngay_tao, id_nhanvien, trang_thai, ten_nv, nhanvien.id
                    FROM hoadon
                    LEFT JOIN nhanvien ON hoadon.id_nhanvien = nhanvien.id
                    WHERE `hoadon`.`deliveryStatus` != 0";

            if (!empty($_POST['timebd']) && !empty($_POST['timekt'])) {
                $sql .= " AND `hoadon`.`ngay_tao` >= '" . $_POST['timebd'] . "' AND `hoadon`.`ngay_tao` <= DATE_ADD('" . $_POST['timekt'] . "', INTERVAL '1' DAY)";
            }

            if (($_POST['timebd'] == '') && (!empty($_POST['timekt']))) {
                $sql .= " AND `hoadon`.`ngay_tao` <= DATE_ADD('" . $_POST['timekt'] . "',INTERVAL '1' DAY)";
            }
            if (($_POST['timekt'] == '') && (!empty($_POST['timebd']))) {
                $sql .= " AND `hoadon`.`ngay_tao` >= '" . $_POST['timebd'] . "'";
            }
            if (!empty($_POST['status']) && $_POST['status'] != 99) {
                $sql .= " AND `hoadon`.`deliveryStatus` = '" . $_POST['status'] . "'";
            }

            if (!empty($_POST['orderId'])) {
                $sql .= " AND `hoadon`.`id` = '" . $_POST['orderId'] . "'";
            }
            if (!empty($_POST['phancong']) && $_POST['phancong'] != '') {
                $sql .= " AND `hoadon`.`phancong` = '" . $_POST['phancong'] . "'";
            }

            // echo '' . $sql . '';
            $hoadon = mysqli_query($con, $sql);

            $totalRecords = mysqli_query($con, $sql);
        } else {
            $sql = "SELECT hoadon.id AS idhoadon, deliveryStatus, id_khachhang, phancong, tong_tien, hoadon.ngay_tao, id_nhanvien, trang_thai, ten_nv, nhanvien.id FROM hoadon LEFT JOIN nhanvien ON hoadon.id_nhanvien = nhanvien.id WHERE `hoadon`.`deliveryStatus` != 0 ORDER BY hoadon.ngay_tao DESC LIMIT $item_per_page OFFSET $offset";
            $hoadon = mysqli_query($con, $sql);
        }
    } else {
        echo "Lỗi truy vấn tổng số bản ghi: " . mysqli_error($con);
    }
    $totalPages = isset($totalPages) ? $totalPages : 1;



    // Truy vấn để lấy danh sách người dùng từ bảng taikhoang với id_quyen = 9
    $userQuery = "SELECT username, fullname FROM taikhoang WHERE id_quyen = 9";
    $userResult = mysqli_query($con, $userQuery);
    $users = [];
    while ($user = mysqli_fetch_assoc($userResult)) {
        $users[] = $user; // Lưu cả username và fullname vào mảng
    }

    mysqli_close($con);
    ?>
<style>
.table-bordered th,
.table-bordered td {
    background-color: #ffffff;
    color: #000;
    text-align: center;
    vertical-align: middle;
    font-weight: normal;
}

.table-bordered th {
    background-color: #f0f0f0;
}

.table td {
    border: 1px solid #ddd;
    font-size: 16px;
    padding: 10px;
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

.table td.status-delivery {
    color: inherit;
}

.form-container input[type="submit"] {
    padding: 0.25em 0.5em;
    /* Điều chỉnh padding cho nút */
    font-size: 0.9em;
    /* Thay đổi kích thước chữ cho nút */
    margin-left: 5px;
    /* Khoảng cách giữa nút và hộp select */
    cursor: pointer;
    /* Thay đổi con trỏ khi di chuột lên nút */
}

.form-container select {
    font-size: 0.9em;
    /* Đảm bảo kích thước chữ của hộp select khớp với nút */
}
</style>

<div class="main-content">
    <h1>Phân công vận chuyển</h1>
    <form method="POST" action="./admin.php?tmuc=Phân%20công%20vận%20chuyển">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="timebd">Ngày bắt đầu:</label>
                <input type="date" class="form-control" id="timebd" name="timebd">
            </div>
            <div class="form-group col-md-3">
                <label for="timekt">Ngày kết thúc:</label>
                <input type="date" class="form-control" id="timekt" name="timekt">
            </div>
            <div class="form-group col-md-3">
                <label for="orderId">Mã đơn hàng:</label>
                <input type="text" class="form-control" id="orderId" name="orderId" placeholder="Nhập mã đơn hàng">
            </div>
            <div class="form-group col-md-3">
                <label for="phancong">Phân công:</label>
                <select id="phancong" name="phancong" class="form-control">
                    <option value="">Chưa phân công</option>
                    <?php foreach ($users as $user): ?>
                    <option value="<?= $user['username'] ?>"><?= $user['fullname'] ?></option>
                    <?php endforeach; ?>
                </select>

            </div>
            <div class="form-group col-md-3">
                <label for="status">Trạng thái:</label>
                <select id="status" name="status" class="form-control">
                    <option value="99">Chọn trạng thái</option>
                    <option value="1">Chờ lấy hàng</option>
                    <option value="2">Đang vận chuyển</option>
                    <option value="3">Giao hàng thành công</option>
                </select>
            </div>
        </div>
        <input name="search" type="submit" class="btn btn-primary" value="SEARCH">
    </form>
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
                    <?php
                        if (mysqli_num_rows($hoadon) > 0) {
                            while ($row = mysqli_fetch_array($hoadon)) { ?>
                    <tr class="<?= $row['trang_thai'] == 1 ? 'hoadon-daxacnhan' : 'hoadon-chuaxacnhan' ?>">
                        <td><?= htmlspecialchars($row['idhoadon']) ?></td>
                        <td><?= htmlspecialchars($row['id_khachhang']) ?></td>
                        <td><?= htmlspecialchars($row['tong_tien']) ?></td>
                        <td><?= htmlspecialchars($row['ngay_tao']) ?></td>
                        <td class="status-delivery">
                            <?php
                                        switch ($row['deliveryStatus']) {
                                            case "1":
                                                echo "<p style='color:orange'>Chờ phân công</p>";
                                                break;
                                            case "2":
                                                echo "<p style='color:orange'>Chờ lấy hàng</p>";
                                                break;
                                            case "3":
                                                echo "<p style='color:green'>Đang vận chuyển</p>";
                                                break;
                                            case "4":
                                                echo "<p style='color:darkgreen'>Giao hàng thành công</p>";
                                                break;
                                            case "5":
                                                echo "Giao hàng thất bại";
                                                break;
                                        }
                                        ?>
                        </td>
                        <td><a href="./admin.php?act=cthoadon&id=<?= htmlspecialchars($row['idhoadon']) ?>">Xem chi
                                tiết</a></td>
                        <td style="text-align:center">
                            <?php if (empty($row['phancong'])) { ?>
                            <form action="xulythem.php" method="POST" class="form-container">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($row['idhoadon']) ?>" />
                                <select name="vc">
                                    <option value="">Chọn</option>
                                    <?php foreach ($users as $user) { ?>
                                    <option value="<?= htmlspecialchars($user['username']) ?>"
                                        <?= (isset($row['phancong']) && $row['phancong'] == $user['username']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($user['fullname']) ?></option>
                                    <?php } ?>
                                </select>
                                <input type="submit" name="btn_pcvc" value="Phân công">
                            </form>
                            <?php } else { ?>
                            <?= htmlspecialchars($row['phancong']) ?>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php }
                        } else {
                            echo "<tr><td colspan='7'>Không có dữ liệu hóa đơn.</td></tr>";
                        } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include './pagination.php'; ?>
</div>
<?php
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>