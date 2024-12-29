<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/admin_style.css">
</head>

<body>
    <?php

    include_once("./connect_db.php");
    if (!empty($_SESSION['nguoidung'])) {
        // Phân trang
        $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 6;
        $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $offset = ($current_page - 1) * $item_per_page;

        // Kiểm tra kết nối cơ sở dữ liệu
        if ($con) {
            // Lấy thông tin sản phẩm cần kiểm định, địa chỉ vườn và tên nhân viên phụ trách.   
            $sql = "SELECT sanpham.*, khachhang.diachivuon, taikhoang.fullname 
                    FROM sanpham 
                    JOIN khachhang ON sanpham.id_nhaban = khachhang.id 
                    JOIN taikhoang ON taikhoang.username = sanpham.phancong
                    WHERE sanpham.trangthai = 2 AND sanpham.phancong = '" . $_SESSION['user'] . "'";
            // Tìm kiếm sản phẩm
            if (isset($_POST['search'])) {
                $sql = "SELECT sanpham.*, khachhang.diachivuon, taikhoang.fullname 
                    FROM sanpham 
                    JOIN khachhang ON sanpham.id_nhaban = khachhang.id 
                    JOIN taikhoang ON taikhoang.username = sanpham.phancong
                    WHERE sanpham.trangthai = 2 AND sanpham.phancong = '" . $_SESSION['user'] . "'";

                if (!empty($_POST['productId'])) {
                    $sql .= " AND sanpham.id = '" . $_POST['productId'] . "'";
                }
                if (!empty($_POST['productName'])) {
                    $sql .= " AND sanpham.ten_sp LIKE '%" . $_POST['productName'] . "%'";
                }
                $totalRecordsQuery = mysqli_query($con, $sql);

            } else
                $totalRecordsQuery = mysqli_query($con, "SELECT sanpham.*, khachhang.diachivuon, taikhoang.fullname 
                    FROM sanpham 
                    JOIN khachhang ON sanpham.id_nhaban = khachhang.id 
                    JOIN taikhoang ON taikhoang.username = sanpham.phancong
                    WHERE sanpham.trangthai = 2 AND sanpham.phancong = '" . $_SESSION['user'] . "'");
            if ($totalRecordsQuery) {
                $totalRecords = $totalRecordsQuery->num_rows;
                $totalPages = ceil($totalRecords / $item_per_page); // Tính tổng số trang
    
                // Truy vấn sản phẩm với phân trang
                $sql .= " LIMIT $item_per_page OFFSET $offset";
                $products = mysqli_query($con, $sql);
            } else {
                echo "Lỗi truy vấn tổng số bản ghi: " . mysqli_error($con);
            }
        } else {
            echo "Lỗi kết nối cơ sở dữ liệu: " . mysqli_connect_error();
        }

        // Đóng kết nối
        mysqli_close($con);
    } else {
        echo "Bạn chưa đăng nhập.";
    }
    ?>

    <div class="main-content">
        <h1>Danh sách sản phẩm cần kiểm định</h1>
        <form method="POST" action="./admin.php?muc=16&tmuc=Kiểm%20định%20nông%20sản">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="productId">Mã sản phẩm:</label>
                    <input type="text" class="form-control" id="productId" name="productId"
                        placeholder="Nhập Mã sản phẩm">
                </div>
                <div class="form-group col-md-3">
                    <label for="productName">Tên sản phẩm:</label>
                    <input type="text" class="form-control" id="productName" name="productName"
                        placeholder="Nhập Tên sản phẩm">
                </div>
            </div>
            <input name="search" type="submit" class="btn btn-primary" value="SEARCH">
        </form>
        <div class="product-items">
            <div class="buttons">
                <a href="admin.php?tmuc=SP_QRCode">Sản phẩm cần tạo QR</a>
            </div>
            <div class="table-responsive-sm">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="text-align:center">ID</th>
                            <th style="text-align:center">Ảnh</th>
                            <th style="text-align:center">Tên sản phẩm</th>
                            <th style="text-align:center">Địa chỉ vườn</th>
                            <th style="text-align:center">Trạng thái</th>
                            <th style="text-align:center">Nhân viên kiểm định</th>
                            <th style="text-align:center">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($products) && mysqli_num_rows($products) > 0): ?>
                            <?php while ($row = mysqli_fetch_array($products)): ?>
                                <tr>
                                    <td style="text-align:center; padding-top: 50px"><?= $row['id'] ?></td>
                                    <td><img style="width: 100px; height: 100px;" src="../img/<?= $row['hinh_anh'] ?>" /></td>
                                    <td style="text-align:center; padding-top: 50px"><?= $row['ten_sp'] ?></td>
                                    <td style="text-align:center; padding-top: 50px"><?= $row['diachivuon'] ?></td>
                                    <td style="text-align:center; padding-top: 50px">
                                        <?php
                                        switch ($row['trangthai']) {
                                            case '7':
                                                echo "Đã đăng";
                                                break;
                                            case '6':
                                                echo "Chờ duyệt bài đăng";
                                                break;
                                            case '5':
                                                echo "Sản phẩm chưa đạt chuẩn";
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
                                    <td style="text-align:center; padding-top: 50px">
                                        <?= isset($row['fullname']) ? $row['fullname'] : 'Chưa có thông tin' ?>
                                    </td>
                                    <td style="text-align:center; padding-top: 50px"><a
                                            href="admin.php?act=suakd&id=<?= $row['id'] ?>">Kiểm định</a></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" style="text-align:center">Không có sản phẩm nào.</td>
                            </tr>
                        <?php endif; ?>
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