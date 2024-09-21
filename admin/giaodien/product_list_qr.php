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
        // Lấy fullname của người dùng hiện tại từ session
        $loggedInFullname = $_SESSION['nguoidung'];

        // Lấy tổng số bản ghi với trangthai = 1
        $totalRecordsQuery = mysqli_query($con, "SELECT * FROM `sanpham` WHERE `trangthai` = 3");
        
        if ($totalRecordsQuery) {
            $totalRecords = $totalRecordsQuery->num_rows;
            $totalPages = ceil($totalRecords / $item_per_page);

            // Xây dựng điều kiện lọc dựa trên fullname của người dùng
            if ($loggedInFullname == 'Kiểm định 1') {
                $filterCondition = "AND sanpham.phancong = 'Kiểm định 1'";
            } elseif ($loggedInFullname == 'Kiểm định 2') {
                $filterCondition = "AND sanpham.phancong = 'Kiểm định 2'";
            } else {
                $filterCondition = ""; // Không áp dụng lọc nếu không phải 'Kiểm định 1' hoặc 'Kiểm định 2'
            }

            // Truy vấn để lấy sản phẩm với trangthai = 1 và điều kiện lọc
            $query = "SELECT sanpham.*, khachhang.diachivuon 
                     FROM sanpham
                     JOIN khachhang ON sanpham.id_nhaban = khachhang.id
                     WHERE sanpham.trangthai = 3
                     $filterCondition
                     ORDER BY sanpham.id ASC 
                     LIMIT $item_per_page OFFSET $offset";

            // Thực thi truy vấn
            $products = mysqli_query($con, $query);

            // Kiểm tra kết quả truy vấn
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
                                <th style="text-align:center">Nhân viên kiểm định</th>
                                <th style="text-align:center">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                while ($row = mysqli_fetch_array($products)) {
                                ?>
                                <tr>         
                                    <td style="text-align:center; padding-top: 50px"><?= $row['id'] ?></td>                     
                                    <td><img style="width: 100px;height: 100px " src="../img/<?= $row['hinh_anh'] ?>"  /></td>
                                    <td style="text-align:center; padding-top: 50px"><?= $row['ten_sp'] ?></td>
                                    <td style="text-align:center; padding-top: 50px"><?= $row['diachivuon'] ?></td>
                                    <td style="text-align:center; padding-top: 50px">
                                        <?php 
                                            switch($row['trangthai']) {
                                                case '7': echo "Đã đăng"; break;
                                                case '6': echo "Đang chờ duyệt bài đăng"; break;
                                                case '5': echo "Sản phẩm không đạt chuẩn"; break;
                                                case '4': echo "Sản phẩm đạt chuẩn"; break;
                                                case '3': echo "Đang chờ tạo mã QR"; break;
                                                case '2': echo "Đang chờ kiểm định"; break;
                                                case '1': echo "Đang chờ phân công kiểm định"; break;
                                                case '0': echo "Chưa kiểm định"; break;
                                            }
                                        ?>
                                    </td>
                                    <td style="text-align:center; padding-top: 50px"><?= $row['phancong'] ?></td>
                                    <td style="text-align:center; padding-top: 50px">
                                        <a href="admin.php?act=add_qr&id=<?= $row['id'] ?>">Tạo mã QR</a>
                                        <?php if ($row['trangthai'] == '4') { ?>
                                            <a href="admin.php?act=xoa&id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this item?');">Xóa</a>
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
