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
        $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 6;
        $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $offset = ($current_page - 1) * $item_per_page;

        // Kiểm tra kết nối cơ sở dữ liệu
        if ($con) {
            // Lấy tổng số bản ghi với trangthai = 1
            if (isset($_POST['search'])) {
                $sql = "SELECT * FROM `sanpham` WHERE `trangthai` = 3 AND `phancong` = '" . $_SESSION['user'] . "'";

                if (!empty($_POST['productId'])) {
                    $sql .= " AND `id` = '" . $_POST['productId'] . "'";
                }
                if (!empty($_POST['productName'])) {
                    $sql .= " AND `ten_sp` = '" . $_POST['productName'] . "'";
                }
                // echo '' . $sql . '';
                $totalRecordsQuery = mysqli_query($con, $sql);
            } else {
                $totalRecordsQuery = mysqli_query($con, "SELECT * FROM `sanpham` WHERE `trangthai` = 3 AND `phancong` = '" . $_SESSION['user'] . "'");
            }

            if ($totalRecordsQuery) {

                $totalRecords = $totalRecordsQuery->num_rows;
                $totalPages = ceil($totalRecords / $item_per_page);

                if (isset($_POST['search'])) {
                    $sql = "SELECT sanpham.*, khachhang.diachivuon 
                         FROM sanpham 
                         JOIN khachhang ON sanpham.id_nhaban = khachhang.id 
                         WHERE sanpham.trangthai = 3 AND `phancong` = '" . $_SESSION['user'] . "'";

                    if (!empty($_POST['productId'])) {
                        $sql .= " AND `sanpham`.`id` = '" . $_POST['productId'] . "'";
                    }
                    if (!empty($_POST['productName'])) {
                        $sql .= " AND `sanpham`.`ten_sp` LIKE '%" . $_POST['productName'] . "%'";
                    }
                    $products = mysqli_query($con, $sql);

                } else {
                    $query = "SELECT sanpham.*, khachhang.diachivuon 
                    FROM sanpham 
                    JOIN khachhang ON sanpham.id_nhaban = khachhang.id 
                    WHERE sanpham.trangthai = 3 AND `phancong` = '" . $_SESSION['user'] . "'
                    ORDER BY sanpham.id ASC 
                    LIMIT $item_per_page OFFSET $offset";

                    $products = mysqli_query($con, $query);
                }
                if (!$products) {
                    echo "Lỗi truy vấn: " . mysqli_error($con);
                }

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
    <div class="main-content" style="color: green">
        <h1>Danh sách sản phẩm cần tạo mã QR</h1>
        <form method="POST" action="./admin.php?tmuc=SP_QRCode">
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
            </div>
            <input name="search" type="submit" class="btn btn-primary" value="SEARCH">
        </form>
        <div class="product-items">
            <div class="table-responsive-sm ">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="text-align:center">ID</th>
                            <th style="text-align:center">Ảnh</th>
                            <th style="text-align:center">Tên sản phẩm</th>
                            <th style="text-align:center">Địa chỉ vườn</th>
                            <th style="text-align:center">Trạng thái</th>
                            <th style="text-align:center">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($products)) {
                            ?>
                            <tr>
                                <td style="text-align:center; padding-top: 50px"><?= $row['id'] ?></td>
                                <td><img style="width: 100px;height: 100px " src="../img/<?= $row['hinh_anh'] ?>" /></td>
                                <td style="text-align:center; padding-top: 50px"><?= $row['ten_sp'] ?></td>
                                <td style="text-align:center; padding-top: 50px"><?= $row['diachivuon'] ?></td>
                                <td style="text-align:center; padding-top: 50px">
                                    <?php
                                        if ($row['trangthai'] == '7')
                                            echo "Đã đăng";
                                        elseif ($row['trangthai'] == '6')
                                            echo "Chờ duyệt bài đăng";
                                        elseif ($row['trangthai'] == '5')
                                            echo "Sản phẩm chưa đạt chuẩn";
                                        elseif ($row['trangthai'] == '4')
                                            echo "Sản phẩm đạt chuẩn";
                                        elseif ($row['trangthai'] == '3')
                                            echo "Đang chờ tạo mã QR";
                                        elseif ($row['trangthai'] == '2')
                                            echo "Đang chờ kiểm định";
                                        elseif ($row['trangthai'] == '1')
                                            echo "Đang chờ phân công kiểm định";
                                        elseif ($row['trangthai'] == '0')
                                            echo "Chưa kiểm định ";
                                    ?>
                                </td>
                                <td style="text-align:center; padding-top: 50px">
                                    <a href="admin.php?act=add_qr&id=<?= $row['id'] ?>">Tạo mã QR</a>
                                    <?php if ($row['trangthai'] == '4') { ?>
                                        <a href="admin.php?act=xoa&id=<?= $row['id'] ?>"
                                            onclick="return confirm('Are you sure you want to delete this item?');">Xóa</a>
                                    <?php } ?>
                                </td>
                                <div class="clear-both"></div>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include './pagination.php'; ?>
        <div class="clear-both"></div>
    </div>
    <?php
    ?>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>