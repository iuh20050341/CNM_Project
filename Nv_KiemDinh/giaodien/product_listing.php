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

       // Get the total number of records with trangthai = 0
       $totalRecordsQuery = mysqli_query($con, "SELECT * FROM `sanpham` WHERE `trangthai` = 1");
       $totalRecords = $totalRecordsQuery->num_rows;
       $totalPages = ceil($totalRecords / $item_per_page);

       // Default query to get products with trangthai = 0
       $query = "SELECT * FROM `sanpham` WHERE `trangthai` = 1 ORDER BY `id` ASC LIMIT $item_per_page OFFSET $offset";

       if(isset($_GET['sapxep'])){
           switch($_GET['sapxep']){
               case 'idgiam':
                   $query = "SELECT * FROM `sanpham` WHERE `trangthai` = 0 ORDER BY `id` DESC LIMIT $item_per_page OFFSET $offset";
                   break;
               case 'idtang':
                   $query = "SELECT * FROM `sanpham` WHERE `trangthai` = 0 ORDER BY `id` ASC LIMIT $item_per_page OFFSET $offset";
                   break;
               case 'tengiam':
                   $query = "SELECT * FROM `sanpham` WHERE `trangthai` = 0 ORDER BY `ten_sp` DESC LIMIT $item_per_page OFFSET $offset";
                   break;
               case 'tentang':
                   $query = "SELECT * FROM `sanpham` WHERE `trangthai` = 0 ORDER BY `ten_sp` ASC LIMIT $item_per_page OFFSET $offset";
                   break;
               case 'tongiam':
                   $query = "SELECT * FROM `sanpham` WHERE `trangthai` = 0 ORDER BY `so_luong` DESC LIMIT $item_per_page OFFSET $offset";
                   break;
               case 'tontang':
                   $query = "SELECT * FROM `sanpham` WHERE `trangthai` = 0 ORDER BY `so_luong` ASC LIMIT $item_per_page OFFSET $offset";
                   break;
               case 'bangiam':
                   $query = "SELECT * FROM `sanpham` WHERE `trangthai` = 0 ORDER BY `sl_da_ban` DESC LIMIT $item_per_page OFFSET $offset";
                   break;
               case 'bantang':
                   $query = "SELECT * FROM `sanpham` WHERE `trangthai` = 0 ORDER BY `sl_da_ban` ASC LIMIT $item_per_page OFFSET $offset";
                   break;
           }
       }

       // Execute the query
       $products = mysqli_query($con, $query);
       mysqli_close($con);
   }
?>
        <div class="main-content">
            <h1>Danh sách sản phẩm cần kiểm định</h1>
            <div class="product-items">
                <div class="buttons">
                    <a href="nvkiemdinh.php?tmuc=SP_QRCode">Sản phẩm cần tạo QR</a>
                </div>
                <div class="table-responsive-sm ">
                    <table class="table table-bordered table-striped table-hover">
                        <thead >
                            <tr>
                                <th style="text-align:center">ID<a href="./nvkiemdinh.php?muc=4&tmuc=Sản%20phẩm&sapxep=idgiam"></a><a href="./nvkiemdinh.php?muc=4&tmuc=Sản%20phẩm&sapxep=idtang"></i></a></th>
                                <th style="text-align:center">Ảnh </th>
                                <th style="text-align:center">Tên sản phẩm<a href="./nvkiemdinh.php?muc=4&tmuc=Sản%20phẩm&sapxep=tengiam"></i></a><a href="./nvkiemdinh.php?muc=4&tmuc=Sản%20phẩm&sapxep=tentang"></i></a></th>
                                <th style="text-align:center">Số lượng tồn<a href="./nvkiemdinh.php?muc=4&tmuc=Sản%20phẩm&sapxep=tongiam"></i></a><a href="./nvkiemdinh.php?muc=4&tmuc=Sản%20phẩm&sapxep=tontang"></i></a></th>
                                <th style="text-align:center">Số lượng bán<a href="./nvkiemdinh.php?muc=4&tmuc=Sản%20phẩm&sapxep=bangiam"></i></a><a href="./nvkiemdinh.php?muc=4&tmuc=Sản%20phẩm&sapxep=bantang"></i></a></th>
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
                                    <td style="text-align:center; padding-top: 50px"><?= $row['so_luong'] ?>
                                    </td>
                                    <td style="text-align:center; padding-top: 50px"><?= $row['sl_da_ban'] ?></td>
                                    <td style="text-align:center; padding-top: 50px">
                                        <?php 
                                            if($row['trangthai'] == '4') echo "Đã đăng"; 
                                            elseif($row['trangthai'] == '3') echo "Kiểm định thất bại"; 
                                            elseif($row['trangthai'] == '2') echo "Đã kiểm định thành công";
                                            elseif($row['trangthai'] == '1') echo "Đang chờ kiểm định";
                                            elseif($row['trangthai'] == '0') echo "Chưa kiểm định ";
                                            ?>
                                    </td>
                                    <td style="text-align:center; padding-top: 50px"><a href="admin.php?act=sua&id=<?= $row['id'] ?>">Kiểm định</a></td>               
                                    <div class="clear-both"></div>
                                </tr><?php } ?>
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