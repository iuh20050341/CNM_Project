<?php
   include_once("./connect_db.php");
   if (!empty($_SESSION['nguoidung'])) {
       $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 6;
       $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
       $offset = ($current_page - 1) * $item_per_page;

       // Kiểm tra kết nối cơ sở dữ liệu
       if ($con) {
           // Lấy tổng số bản ghi với trangthai = 1
           $totalRecordsQuery = mysqli_query($con, "SELECT * FROM `sanpham` WHERE `trangthai` = 1");
           
           if ($totalRecordsQuery) {
               $totalRecords = $totalRecordsQuery->num_rows;
               $totalPages = ceil($totalRecords / $item_per_page);

               // Truy vấn mặc định để lấy sản phẩm với trangthai = 1 và JOIN thêm bảng taikhoang
               $query = "SELECT sanpham.*, khachhang.diachivuon 
                         FROM sanpham 
                         JOIN khachhang ON sanpham.id_nhaban = khachhang.id 
                         WHERE sanpham.trangthai = 1 
                         ORDER BY sanpham.id ASC 
                         LIMIT $item_per_page OFFSET $offset";

               // Thực thi truy vấn
               $products = mysqli_query($con, $query);
               
               // Truy vấn để lấy dữ liệu từ bảng taikhoang với id_quyen = 8
               $usersQuery = "SELECT username, fullname FROM taikhoang WHERE id_quyen = 8";
               $usersResult = mysqli_query($con, $usersQuery);
               
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
    .table td, .table th {
        vertical-align: middle; /* Căn giữa theo chiều dọc */
        padding: 10px; /* Khoảng cách xung quanh nội dung của các ô */
    }

    /* Căn giữa nội dung của ô */
    .table img {
        max-width: 100px;
        max-height: 100px;
        display: block;
        margin: 0 auto; /* Căn giữa hình ảnh */
    }

    .form-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* Tạo khoảng cách giữa các phần tử trong form */
    .form-container input[type="text"] {
        margin-bottom: 10px; /* Khoảng cách dưới ô nhập */
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 100%; /* Đảm bảo ô nhập chiếm toàn bộ chiều rộng của form */
    }

    .form-container input[type="submit"] {
        padding: 8px 16px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%; /* Đảm bảo nút submit chiếm toàn bộ chiều rộng của form */
    }

    .form-container input[type="submit"]:hover {
        background-color: #0056b3;

    /* Căn chỉnh select và nút submit nằm chung 1 hàng */
    .form-container1 {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .form-container1 select {
        width: 70%; /* Đặt chiều rộng của select */
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .form-container1 input[type="submit"] {
        width: 28%; /* Đặt chiều rộng của nút submit */
        padding: 8px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .form-container1 input[type="submit"]:hover {
        background-color: #0056b3;
    }

    }
    </style>
</head>

<body>
    <div class="main-content">
        <h1>PHÂN CÔNG NHÂN VIÊN KIỂM ĐỊNH</h1>
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
                                <td style="text-align:center">
                                    <form action="xulythem.php" method="POST" class="form-container1">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>" />
                                        <select name="kd">
                                            <option value="" disabled selected>Chọn</option>
                                            <?php while ($user = mysqli_fetch_array($usersResult)) { ?>
                                                <option value="<?= htmlspecialchars($user['username']) ?>"><?= htmlspecialchars($user['fullname']) ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="submit" name="btn_pckd" value="Phân công" onclick="return confirm('Bạn có muốn phân công nhân viên?')">
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
