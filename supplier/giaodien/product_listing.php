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
    if (isset($_SESSION['ten_dangnhap']) && !empty($_SESSION['ten_dangnhap']) && $_SESSION['user_id']) { 
        $user_id = $_SESSION['user_id'];   
        $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 6;
        $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $offset = ($current_page - 1) * $item_per_page;

        // Add filter to exclude statuses 0, 1, 2, 3
        $status_filter = "trangthai NOT IN (0, 1, 2, 3, 5)";

        $totalRecords = mysqli_query($con, "SELECT * FROM `sanpham` WHERE id_nhaban = $user_id AND $status_filter");
        $totalRecords = $totalRecords->num_rows;
        $totalPages = ceil($totalRecords / $item_per_page);

        if(isset($_GET['sapxep'])){
            switch($_GET['sapxep']) {
                case 'idgiam':
                    $order = "ORDER BY `id` DESC";
                    break;
                case 'idtang':
                    $order = "ORDER BY `id` ASC";
                    break;
                case 'tengiam':
                    $order = "ORDER BY `ten_sp` DESC";
                    break;
                case 'tentang':
                    $order = "ORDER BY `ten_sp` ASC";
                    break;
                case 'tongiam':
                    $order = "ORDER BY `so_luong` DESC";
                    break;
                case 'tontang':
                    $order = "ORDER BY `so_luong` ASC";
                    break;
                case 'bangiam':
                    $order = "ORDER BY `sl_da_ban` DESC";
                    break;
                case 'bantang':
                    $order = "ORDER BY `sl_da_ban` ASC";
                    break;
                default:
                    $order = "ORDER BY `id` ASC";
            }
        } else {
            $order = "ORDER BY `id` ASC";
        }

        $products = mysqli_query($con, "SELECT * FROM `sanpham` WHERE id_nhaban =$user_id AND $status_filter $order LIMIT $item_per_page OFFSET $offset");
        mysqli_close($con);
?>
    <div class="main-content" style="color: green">
        <h1>Danh sách sản phẩm đã đăng bán</h1>
        <div class="product-items">
            <div class="buttons">
                <a href="supplier.php?tmuc=SP chưa duyệt">Sản phẩm chưa kiểm định</a>
                <a href="supplier.php?tmuc=SP đã duyệt">Sản phẩm đã kiểm định</a>
            </div>
            <div class="table-responsive-sm">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="text-align:center">ID<a href="./supplier.php?muc=4&tmuc=Sản%20phẩm&sapxep=idgiam"></a><a href="./supplier.php?muc=4&tmuc=Sản%20phẩm&sapxep=idtang"></i></a></th>
                            <th style="text-align:center">Ảnh</th>
                            <th style="text-align:center">Tên sản phẩm<a href="./supplier.php?muc=4&tmuc=Sản%20phẩm&sapxep=tengiam"></i></a><a href="./supplier.php?muc=4&tmuc=Sản%20phẩm&sapxep=tentang"></i></a></th>
                            <th style="text-align:center">Số lượng tồn<a href="./supplier.php?muc=4&tmuc=Sản%20phẩm&sapxep=tongiam"></i></a><a href="./supplier.php?muc=4&tmuc=Sản%20phẩm&sapxep=tontang"></i></a></th>
                            <th style="text-align:center">Số lượng bán<a href="./supplier.php?muc=4&tmuc=Sản%20phẩm&sapxep=bangiam"></i></a><a href="./supplier.php?muc=4&tmuc=Sản%20phẩm&sapxep=bantang"></i></a></th>
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
                                <td style="text-align:center; padding-top: 50px"><?= $row['so_luong'] ?></td>
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
                                <td style="text-align:center; padding-top: 50px"><a href="supplier.php?act=sua&id=<?= $row['id'] ?>">Sửa</a> | <?php if($row['trangthai']=='4'){?><a href="supplier.php?act=xoa&id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this item?');">Xóa</a><?php }?></td>                                  
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
}
?>

</body>

</html>