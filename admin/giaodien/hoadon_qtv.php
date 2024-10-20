<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<?php
include_once("./connect_db.php");
if (!empty($_SESSION['nguoidung'])) {
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    if (isset($_POST['search'])) {
        $sql = "SELECT * FROM hoadon LEFT JOIN nhanvien ON `id_nhanvien`=`nhanvien`.`id` WHERE `hoadon`.`deliveryStatus` != -99";

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
        // echo '' . $sql . '';

        $totalRecords = mysqli_query($con, $sql);
    }
    // if (isset($_POST['timebd']) && isset($_POST['timekt'])) {
    //     if (($_POST['timebd'] == '') && ($_POST['timekt'] == ''))
    //         $totalRecords = mysqli_query($con, "SELECT * FROM (hoadon LEFT JOIN nhanvien ON`id_nhanvien`=`nhanvien`.`id` )");
    //     if (($_POST['timebd'] == '') && (!empty($_POST['timekt'])))
    //         $totalRecords = mysqli_query($con, "SELECT * FROM (hoadon LEFT JOIN nhanvien ON`id_nhanvien`=`nhanvien`.`id` ) WHERE `hoadon`.`ngay_tao` <= DATE_ADD('" . $_POST['timekt'] . "',INTERVAL '1' DAY)");
    //     if (($_POST['timekt'] == '') && (!empty($_POST['timebd'])))
    //         $totalRecords = mysqli_query($con, "SELECT * FROM (hoadon LEFT JOIN nhanvien ON`id_nhanvien`=`nhanvien`.`id` ) WHERE `hoadon`.`ngay_tao` >= '" . $_POST['timebd'] . "'");
    //     if (!empty($_POST['timebd']) && (!empty($_POST['timekt'])))
    //         $totalRecords = mysqli_query($con, "SELECT * FROM (hoadon LEFT JOIN nhanvien ON`id_nhanvien`=`nhanvien`.`id` ) WHERE `hoadon`.`ngay_tao` <= DATE_ADD('" . $_POST['timekt'] . "',INTERVAL '1' DAY) AND `hoadon`.`ngay_tao` >= '" . $_POST['timebd'] . "'");
    // } 
    else
        $totalRecords = mysqli_query($con, "SELECT * FROM (hoadon LEFT JOIN nhanvien ON`id_nhanvien`=`nhanvien`.`id` )");
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    if (isset($_POST['timebd']) && isset($_POST['timekt'])) {
        $sql = "SELECT `hoadon`.`id` AS `idhoadon`, `deliveryStatus`, `id_khachhang`, `tong_tien`, `hoadon`.`ngay_tao`, `id_nhanvien`,`trang_thai`,`ten_nv`,`nhanvien`.`id` FROM (hoadon LEFT JOIN nhanvien ON`id_nhanvien`=`nhanvien`.`id` ) WHERE `hoadon`.`deliveryStatus` != -99";
        if (!empty($_POST['timebd']) && !empty($_POST['timekt'])) {
            $sql .= " AND `hoadon`.`ngay_tao` <= DATE_ADD('" . $_POST['timekt'] . "',INTERVAL '1' DAY) AND `hoadon`.`ngay_tao` >= '" . $_POST['timebd'] . "' ORDER BY `hoadon`.`ngay_tao` DESC LIMIT " . $item_per_page . " OFFSET " . $offset;
        }

        if (($_POST['timebd'] == '') && (!empty($_POST['timekt']))) {
            $sql .= " AND `hoadon`.`ngay_tao` <= DATE_ADD('" . $_POST['timekt'] . "',INTERVAL '1' DAY) ORDER BY `hoadon`.`ngay_tao` DESC LIMIT " . $item_per_page . " OFFSET " . $offset;

        }
        if (($_POST['timekt'] == '') && (!empty($_POST['timebd']))) {
            $sql .= " AND `hoadon`.`ngay_tao` >= '" . $_POST['timebd'] . "' ORDER BY `hoadon`.`ngay_tao` DESC LIMIT " . $item_per_page . " OFFSET " . $offset;

        }
        if (!empty($_POST['status']) && $_POST['status'] != '99') {
            $sql .= " AND `hoadon`.`deliveryStatus` = '" . $_POST['status'] . "'";
        }

        if (!empty($_POST['orderId'])) {
            $sql .= " AND `hoadon`.`id` = '" . $_POST['orderId'] . "'";
        }
        // echo 'h' . $sql . '';
        $hoadon = mysqli_query($con, $sql);

        // if (($_POST['timebd'] == '') && ($_POST['timekt'] == ''))
        //     $hoadon = mysqli_query($con, "SELECT `hoadon`.`id` AS `idhoadon`, `deliveryStatus`, `id_khachhang`, `tong_tien`, `hoadon`.`ngay_tao`, `id_nhanvien`,`trang_thai`,`ten_nv`,`nhanvien`.`id` FROM (hoadon LEFT JOIN nhanvien ON`id_nhanvien`=`nhanvien`.`id` ) WHERE `hoadon`.`deliveryStatus` != 0 ORDER BY `hoadon`.`ngay_tao` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
        // if (($_POST['timebd'] == '') && (!empty($_POST['timekt'])))
        //     $hoadon = mysqli_query($con, "SELECT `hoadon`.`id` AS `idhoadon`, `deliveryStatus`, `id_khachhang`, `tong_tien`, `hoadon`.`ngay_tao`, `id_nhanvien`,`trang_thai`,`ten_nv`,`nhanvien`.`id` FROM (hoadon LEFT JOIN nhanvien ON`id_nhanvien`=`nhanvien`.`id` ) WHERE `hoadon`.`deliveryStatus` != 0 AND `hoadon`.`ngay_tao` <= DATE_ADD('" . $_POST['timekt'] . "',INTERVAL '1' DAY) ORDER BY `hoadon`.`ngay_tao` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
        // if (($_POST['timekt'] == '') && (!empty($_POST['timebd'])))
        //     $hoadon = mysqli_query($con, "SELECT `hoadon`.`id` AS `idhoadon`, `deliveryStatus`, `id_khachhang`, `tong_tien`, `hoadon`.`ngay_tao`, `id_nhanvien`,`trang_thai`,`ten_nv`,`nhanvien`.`id` FROM (hoadon LEFT JOIN nhanvien ON`id_nhanvien`=`nhanvien`.`id` ) WHERE `hoadon`.`deliveryStatus` != 0 AND `hoadon`.`ngay_tao` >= '" . $_POST['timebd'] . "' ORDER BY `hoadon`.`ngay_tao` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
        // if (!empty($_POST['timebd']) && (!empty($_POST['timekt'])))
        //     $hoadon = mysqli_query($con, "SELECT `hoadon`.`id` AS `idhoadon`, `deliveryStatus`, `id_khachhang`, `tong_tien`, `hoadon`.`ngay_tao`, `id_nhanvien`,`trang_thai`,`ten_nv`,`nhanvien`.`id` FROM (hoadon LEFT JOIN nhanvien ON`id_nhanvien`=`nhanvien`.`id` ) WHERE `hoadon`.`deliveryStatus` != 0 AND `hoadon`.`ngay_tao` <= DATE_ADD('" . $_POST['timekt'] . "',INTERVAL '1' DAY) AND `hoadon`.`ngay_tao` >= '" . $_POST['timebd'] . "' ORDER BY `hoadon`.`ngay_tao` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    } else
        $hoadon = mysqli_query($con, "SELECT `hoadon`.`id` AS `idhoadon`,`deliveryStatus`, `id_khachhang`, `tong_tien`, `hoadon`.`ngay_tao`, `id_nhanvien`,`trang_thai`,`ten_nv`,`nhanvien`.`id` FROM (hoadon LEFT JOIN nhanvien ON`id_nhanvien`=`nhanvien`.`id` ) ORDER BY `hoadon`.`ngay_tao` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    mysqli_close($con);
    ?>
<style>
.hoadon-daxacnhan {
    color: #000;
    font-weight: bold;
}

.hoadon-chuaxacnhan {
    color: #f00;
    font-weight: bold;
}

.table-bordered th,
.table-bordered td {
    background-color: #ffffff;
}

.table-bordered th {
    background-color: #f0f0f0;
}

.table td {
    border: 1px solid #ddd;
    font-size: 16px;
}

/* Style the date input fields */
.product-items input[type="date"] {
    /* Set the width of the input fields to 150px */
    width: 150px;

    /* Add padding of 5px to the input fields */
    padding: 5px;

    /* Add a margin of 5px to the input fields */
    margin: 5px;

    /* Add a solid border of 1px width and color #CCC to the input fields */
    border: 1px solid #CCC;
}

/* Style the submit button */
.product-items input[type="submit"] {
    /* Add padding of 5px horizontally and 10px vertically to the button */
    padding: 5px 10px;

    /* Add a margin of 5px to the button */
    margin: 5px;

    /* Set the background color of the button to #007BFF */
    background-color: #007BFF;

    /* Set the text color of the button to #fff */
    color: #fff;

    /* Remove the default border from the button */
    border: none;

    /* Change the cursor to a pointer when hovering over the button */
    cursor: pointer;
}

/* Style the surrounding div element */
.product-items .table-responsive-sm {
    /* Add a margin-top of 20px to the surrounding div element */
    margin-top: 20px;
}

/* Additional styling for the submit button */
.product-items input[type="submit"] {
    /* Set the font color to #fff */
    color: #fff;

    /* Set the background color to #007BFF */
    background-color: #007BFF;

    /* Add padding of 10px horizontally and 20px vertically to the button */
    padding: 10px 20px;

    /* Set the font size to 18px */
    font-size: 18px;
}
</style>

<div class="main-content">
    <h1>Hóa đơn</h1>
    <form action="./admin.php?muc=1&tmuc=Hóa%20đơn" method="POST">
        <form method="POST" action="./admin.php?muc=1&tmuc=Hóa%20đơn">
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
                    <label for="status">Trạng thái:</label>
                    <select id="status" name="status" class="form-control">
                        <option value="99">Chọn trạng thái</option>
                        <option value="0">Chờ xác nhận</option>
                        <option value="1">Chờ lấy hàng</option>
                        <option value="2">Đang vận chuyển</option>
                        <option value="3">Giao hàng thành công</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="orderId">Mã đơn hàng:</label>
                    <input type="text" class="form-control" id="orderId" name="orderId" placeholder="Nhập mã đơn hàng">
                </div>
            </div>
            <input name="search" type="submit" class="btn btn-primary" value="SEARCH">
        </form>
        <div class="product-items">
            <div class="table-responsive-sm ">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Mã khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Ngày tạo</th>
                            <th>Trạng thái</th>
                            <th>Xem chi tiết</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($row = mysqli_fetch_array($hoadon)) {
                                if ($row['deliveryStatus'] == 1) {
                                    echo '<tr class="hoadon-daxacnhan">';
                                } else {
                                    echo '<tr class="hoadon-chuaxacnhan">';
                                }
                                ?>
                        <tr>
                            <td><?= $row['idhoadon'] ?></td>
                            <td><?= $row['id_khachhang'] ?></td>
                            <td><?= $row['tong_tien'] ?></td>
                            <td><?= $row['ngay_tao'] ?></td>
                            <td><?php if ($row['deliveryStatus'] == "1")
                                        echo "<b style='color: #FF8C00'>Đã xác nhận - chờ phân công</b>";
                                    elseif ($row['deliveryStatus'] == "0")
                                        echo "<b style='color: red'>Chưa xác nhận</b>";
                                    elseif ($row['deliveryStatus'] == "2")
                                        echo "<b style='color: orange'>Đang vận chuyển</b>";
                                    elseif ($row['deliveryStatus'] == "3")
                                        echo "<b style='color: green'>Giao hàng thành công</b>";
                                    elseif ($row['deliveryStatus'] == "4")
                                        echo "Giao hàng thất bại"; ?></td>
                            <td><a href="./admin.php?act=cthoadon&id=<?= $row['idhoadon'] ?>">Xem chi tiết</a></td>
                            <td><?php if ($row['deliveryStatus'] == "0") { ?>
                                <a
                                    href="./xulythem.php?act=xnhd&id=<?= $row['idhoadon'] ?>&cuser=<?= $row['ten_nv'] ?>&iduser=<?= $_SESSION['idnhanvien'] ?>">Xác
                                    nhận</a><?php } ?>
                                <?php if ($row['deliveryStatus'] == "0") { ?>
                                <b>|</b>
                                <a href="./supplier.php?act=xoahd&id=<?= $row['idhoadon'] ?>"
                                    onclick="return confirm('Are you sure you want to reject this item?');">Từ
                                    chối</a><?php } ?>
                                <b>|</b>
                                <a href="/CNM_Project/admin/giaodien/in_hd.php?id=<?= $row['idhoadon'] ?>">In hóa
                                    đơn</a>
                            </td>
                            <div class="clear-both"></div>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>
</form>
<?php
    include './pagination.php';
    ?>
<div class="clear-both"></div>
</div>
<?php
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>