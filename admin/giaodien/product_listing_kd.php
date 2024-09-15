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
           $totalRecordsQuery = mysqli_query($con, "SELECT * FROM `sanpham` WHERE `trangthai` = 1");
           
           if ($totalRecordsQuery) {
               $totalRecords = $totalRecordsQuery->num_rows;
               $totalPages = ceil($totalRecords / $item_per_page);

               // Truy vấn mặc định để lấy sản phẩm với trangthai = 1
               $query = "SELECT sanpham.*, khachhang.diachivuon 
                         FROM sanpham 
                         JOIN khachhang ON sanpham.id_nhaban = khachhang.id 
                         WHERE sanpham.trangthai = 1 
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

        <div class="main-content">
            <h1>Danh sách sản phẩm cần kiểm định</h1>
            <div class="product-items">
                <div class="buttons">
                    <a href="admin.php?tmuc=SP_QRCode">Sản phẩm cần tạo QR</a>
                </div>
                <div class="table-responsive-sm ">
                    <table class="table table-bordered table-striped table-hover">
                        <thead >
                            <tr>
                                <th style="text-align:center">ID<a href="./nvkiemdinh.php?muc=4&tmuc=Sản%20phẩm&sapxep=idgiam"></a><a href="./nvkiemdinh.php?muc=4&tmuc=Sản%20phẩm&sapxep=idtang"></i></a></th>
                                <th style="text-align:center">Ảnh </th>
                                <th style="text-align:center">Tên sản phẩm<a href="./nvkiemdinh.php?muc=4&tmuc=Sản%20phẩm&sapxep=tengiam"></i></a><a href="./nvkiemdinh.php?muc=4&tmuc=Sản%20phẩm&sapxep=tentang"></i></a></th>
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
                                        <td><img style="width: 100px;height: 100px " src="../img/<?= $row['hinh_anh'] ?>"  /></td>
                                        <td style="text-align:center; padding-top: 50px"><?= $row['ten_sp'] ?></td>
                                        <td style="text-align:center; padding-top: 50px"><?= $row['diachivuon'] ?></td>
                                        <td style="text-align:center; padding-top: 50px">
                                            <?php 
                                                if($row['trangthai'] == '4') echo "Đã đăng"; 
                                                elseif($row['trangthai'] == '3') echo "Kiểm định thất bại"; 
                                                elseif($row['trangthai'] == '2') echo "Đã kiểm định thành công";
                                                elseif($row['trangthai'] == '1') echo "Đang chờ kiểm định";
                                                elseif($row['trangthai'] == '0') echo "Chưa kiểm định ";
                                            ?>
                                        </td>
                                        <td style="text-align:center; padding-top: 50px"><a href="admin.php?act=suakd&id=<?= $row['id'] ?>">Kiểm định</a></td>               
                                        <div class="clear-both"></div>
                                    </tr>
                                <?php } ?>
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
    ?>
</body>

</html>