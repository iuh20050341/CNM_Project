<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<?php
include_once("./connect_db.php");
if (!empty($_SESSION['nguoidung'])) {
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    if (isset($_POST['search'])) {
        $sql = "SELECT * FROM `khachhang` WHERE `is_nongdan` = 1";
        if (isset($_POST['status'])) {
            if ($_POST['status'] == 0) {
                $sql .= " AND `khachhang`.`doanhthu` = 0";
            } elseif ($_POST['status'] == 1) {
                $sql .= " AND `khachhang`.`doanhthu` > 0";
            }
        }
        if (!empty($_POST['ndName'])) {
            $sql .= " AND `ten_kh` LIKE '%" . $_POST['ndName'] . "%'";
        }
        // echo '' . $sql . '';

        $totalRecords = mysqli_query($con, $sql);
    } else
        $totalRecords = mysqli_query($con, "SELECT * FROM `khachhang` WHERE `is_nongdan` = 1");
    $totalRecords = $totalRecords->num_rows;

    $totalPages = ceil($totalRecords / $item_per_page);

    if (isset($_POST['search'])) {
        $sql = "SELECT * FROM `khachhang` WHERE `is_nongdan` = 1";
        if (isset($_POST['status'])) {
            if ($_POST['status'] == 0) {
                $sql .= " AND `khachhang`.`doanhthu` = 0";
            } elseif ($_POST['status'] == 1) {
                $sql .= " AND `khachhang`.`doanhthu` > 0";
            } else {
                $sql .= " AND `khachhang`.`doanhthu` >= 0";
            }
        }
        if (!empty($_POST['ndName'])) {
            $sql .= " AND `ten_kh` LIKE '%" . $_POST['ndName'] . "%'";
        }
        // echo '' . $sql . '';

        $khachhang = mysqli_query($con, $sql);
    } else
        $khachhang = mysqli_query($con, "SELECT * FROM `khachhang` WHERE `is_nongdan` = 1");

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
        <form method="POST" action="./admin.php?muc=22&tmuc=Quản%20lý%20doanh%20thu">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="ndName">Tên nông dân:</label>
                    <input type="text" class="form-control" id="ndName" name="ndName" placeholder="Nhập Tên nông dân">
                </div>
                <div class="form-group col-md-3">
                    <label for="status">Trạng thái:</label>
                    <select id="status" name="status" class="form-control">
                        <option value="99">Chọn trạng thái</option>
                        <option value="1">Chưa thanh toán</option>
                        <option value="2">Đã thanh toán</option>
                    </select>
                </div>

            </div>
            <input name="search" type="submit" class="btn btn-primary" value="SEARCH">
        </form>
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
                                    <td><?= number_format($row['doanhthu'], 0, ',', '.') . ' VNĐ' ?></td>
                                    <td>
                                        <form method="POST" action="./xulythem.php?id=<?= $row['id'] ?>">
                                            <input type="submit" name="btn_dt" value="Thanh toán"
                                                onclick="return confirm('Bạn có muốn thanh toán doanh thu?')">
                                    </td>
                                    </form>
                                    <div class="clear-both"></div>
                                </tr>
                                <?php
                                $rowCount++;
                            } else {
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>