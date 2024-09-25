<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<?php
include_once("./connect_db.php");
if (!empty($_SESSION['nguoidung'])) {
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 6;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;

    // Kiểm tra kết nối cơ sở dữ liệu
    if ($con) {
        $usersQuery = "SELECT username, fullname FROM taikhoang WHERE id_quyen = 8";
        $usersResult = mysqli_query($con, $usersQuery);
        if (isset($_POST['search'])) {
            $sql = "SELECT * FROM `sanpham` WHERE `trangthai` = 1";
            if (!empty($_POST['productId'])) {
                $sql .= " AND `id` = '" . $_POST['productId'] . "'";
            }
            if (!empty($_POST['productName'])) {
                $sql .= " AND `ten_sp` = '" . $_POST['productName'] . "'";
            }
            if (!empty($_POST['phancong']) && $_POST['phancong'] != '') {
                $sql .= " AND `hoadon`.`phancong` = '" . $_POST['phancong'] . "'";
            }

            // echo '' . $sql . '';
            $totalRecordsQuery = mysqli_query($con, $sql);

        } else {
            $totalRecordsQuery = mysqli_query($con, "SELECT * FROM `sanpham` WHERE `trangthai` = 1");
        }
        // Lấy tổng số bản ghi với trangthai = 1

        if ($totalRecordsQuery) {
            $totalRecords = $totalRecordsQuery->num_rows;
            $totalPages = ceil($totalRecords / $item_per_page);
            if (isset($_POST['search'])) {
                $sql = "SELECT sanpham.*, khachhang.diachivuon 
                         FROM sanpham 
                         JOIN khachhang ON sanpham.id_nhaban = khachhang.id 
                         WHERE sanpham.trangthai = 1";

                if (!empty($_POST['productId'])) {
                    $sql .= " AND `id` = '" . $_POST['productId'] . "'";
                }
                if (!empty($_POST['productName'])) {
                    $sql .= " AND `ten_sp` = '" . $_POST['productName'] . "'";
                }
                if (!empty($_POST['phancong']) && $_POST['phancong'] != '') {
                    $sql .= " AND `hoadon`.`phancong` = '" . $_POST['phancong'] . "'";
                }
                $products = mysqli_query($con, $sql);

            } else {
                // Truy vấn mặc định để lấy sản phẩm với trangthai = 1 và JOIN thêm bảng taikhoang
                $query = "SELECT sanpham.*, khachhang.diachivuon 
                         FROM sanpham 
                         JOIN khachhang ON sanpham.id_nhaban = khachhang.id 
                         WHERE sanpham.trangthai = 1 
                         ORDER BY sanpham.id ASC 
                         LIMIT $item_per_page OFFSET $offset";

                // Thực thi truy vấn
                $products = mysqli_query($con, $query);
            }

            if (!$products) {
                echo "Lỗi truy vấn: " . mysqli_error($con);
            }
            if (!$usersResult) {
                echo "Lỗi truy vấn người dùng: " . mysqli_error($con);
            }
        } else {
            echo "Lỗi truy vấn tổng số bản ghi: " . mysqli_error($con);
        }
    } else {
        echo "Lỗi kết nối cơ sở dữ liệu: " . mysqli_connect_error();
    }
    $totalPages = isset($totalPages) ? $totalPages : 1;


    // Đóng kết nối
    mysqli_close($con);
} else {
    echo "Bạn chưa đăng nhập.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <!-- Gắn style trực tiếp vào đây -->
    <style>
        /* admin_style.css */

        /* Đảm bảo các hàng trong bảng có cùng chiều cao */
        .table td,
        .table th {
            vertical-align: middle;
            /* Căn giữa theo chiều dọc */
            padding: 10px;
            /* Khoảng cách xung quanh nội dung của các ô */
        }

        /* Căn giữa nội dung của ô */
        .table img {
            max-width: 100px;
            max-height: 100px;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <h1>PHÂN CÔNG NHÂN VIÊN KIỂM ĐỊNH</h1>
        <form method="POST" action="./admin.php?tmuc=Phân%20công%20kiểm%20định">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="orderId">Mã sản phẩm:</label>
                    <input type="text" class="form-control" id="productId" name="productId"
                        placeholder="Nhập Mã sản phẩm">
                </div>
                <div class="form-group col-md-3">
                    <label for="orderId">Tên sản phẩm:</label>
                    <input type="text" class="form-control" id="productName" name="productName"
                        placeholder="Nhập Tên sản phẩm">
                </div>

                <div class="form-group col-md-3">
                    <label for="phancong">Phân công:</label>
                    <select id="phancong" name="phancong" class="form-control">
                        <option value="">Chưa phân công</option>
                        <?php while ($user = mysqli_fetch_array($usersResult)) { ?>
                            <option value="<?= htmlspecialchars($user['username']) ?>">
                                <?= htmlspecialchars($user['fullname']) ?>
                            </option>
                        <?php } ?>
                        <?php foreach ($users as $user): ?>
                            <option value="<?= $user['username'] ?>"><?= $user['fullname'] ?></option>
                        <?php endforeach; ?>
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
                            <th style="text-align:center">ID</th>
                            <th style="text-align:center">Ảnh</th>
                            <th style="text-align:center">Tên sản phẩm</th>
                            <th style="text-align:center">Địa chỉ vườn</th>
                            <th style="text-align:center">Trạng thái</th>
                            <th style="text-align:center">Phân công</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($products)) { ?>
                            <tr>
                                <td style="text-align:center"><?= $row['id'] ?></td>
                                <td><img src="../img/<?= htmlspecialchars($row['hinh_anh']) ?>" /></td>
                                <td style="text-align:center"><?= htmlspecialchars($row['ten_sp']) ?></td>
                                <td style="text-align:center"><?= htmlspecialchars($row['diachivuon']) ?></td>
                                <td style="text-align:center">
                                    <?php
                                    switch ($row['trangthai']) {
                                        case '7':
                                            echo "Đã đăng";
                                            break;
                                        case '6':
                                            echo "Đang chờ duyệt bài đăng";
                                            break;
                                        case '5':
                                            echo "Sản phẩm không đạt chuẩn";
                                            break;
                                        case '4':
                                            echo "Sản phẩm đạt chuẩn";
                                            break;
                                        case '3':
                                            echo "Đang chờ tạo mã QR";
                                            break;
                                        case '2':
                                            echo "Đang chờ kiểm định";
                                            break;
                                        case '1':
                                            echo "Đang chờ phân công kiểm định";
                                            break;
                                        case '0':
                                            echo "Chưa kiểm định";
                                            break;
                                    }
                                    ?>
                                </td>
                                <td style="text-align:center">
                                    <form action="xulythem.php" method="POST" class="form-container1">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>" />
                                        <select name="kd">
                                            <?php while ($user = mysqli_fetch_array($usersResult)) { ?>
                                                <option value="<?= htmlspecialchars($user['username']) ?>">
                                                    <?= htmlspecialchars($user['fullname']) ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <input type="submit" name="btn_pckd" value="Phân công">
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include './pagination.php'; ?>
        <div class="clear-both"></div>
    </div>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>