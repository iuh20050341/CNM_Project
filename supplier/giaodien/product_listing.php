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
        $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
        $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $offset = ($current_page - 1) * $item_per_page;
        $totalRecords = mysqli_query($con, "SELECT * FROM `sanpham` WHERE id_nhaban = $user_id");
        $totalRecords = $totalRecords->num_rows;
        $totalPages = ceil($totalRecords / $item_per_page);
        $products = mysqli_query($con, "SELECT * FROM `sanpham` WHERE id_nhaban =$user_id ORDER BY `id` ASC LIMIT " . $item_per_page . " OFFSET " . $offset);
        if(isset($_GET['sapxep'])){
            if($_GET['sapxep']=='idgiam')
            $products = mysqli_query($con, "SELECT * FROM `sanpham` WHERE id_nhaban =$user_id ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
            if($_GET['sapxep']=='idtang')
            $products = mysqli_query($con, "SELECT * FROM `sanpham` WHERE id_nhaban =$user_id ORDER BY `id` ASC LIMIT " . $item_per_page . " OFFSET " . $offset);
            if($_GET['sapxep']=='tengiam')
            $products = mysqli_query($con, "SELECT * FROM `sanpham` WHERE id_nhaban =$user_id ORDER BY `ten_sp` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
            if($_GET['sapxep']=='tentang')
            $products = mysqli_query($con, "SELECT * FROM `sanpham` WHERE id_nhaban =$user_id ORDER BY `ten_sp` ASC LIMIT " . $item_per_page . " OFFSET " . $offset);
            if($_GET['sapxep']=='tongiam')
            $products = mysqli_query($con, "SELECT * FROM `sanpham` WHERE id_nhaban =$user_id ORDER BY `so_luong` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
            if($_GET['sapxep']=='tontang')
            $products = mysqli_query($con, "SELECT * FROM `sanpham` WHERE id_nhaban =$user_id ORDER BY `so_luong` ASC LIMIT " . $item_per_page . " OFFSET " . $offset);
            if($_GET['sapxep']=='bangiam')
            $products = mysqli_query($con, "SELECT * FROM `sanpham` WHERE id_nhaban =$user_id ORDER BY `sl_da_ban` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
            if($_GET['sapxep']=='bantang')
            $products = mysqli_query($con, "SELECT * FROM `sanpham` WHERE id_nhaban =$user_id ORDER BY `sl_da_ban` ASC LIMIT " . $item_per_page . " OFFSET " . $offset);
        }
        mysqli_close($con);
    ?>
        <div class="main-content">
            <h1>Danh sách sản phẩm</h1>
            <div class="product-items">
                <div class="buttons">
                    <a href="admin.php?act=add">Thêm sản phẩm</a>
                </div>
                <div class="table-responsive-sm ">
                    <table class="table table-bordered table-striped table-hover">
                        <thead >
                            <tr>
                                <th style="text-align:center">ID<a href="./admin.php?muc=4&tmuc=Sản%20phẩm&sapxep=idgiam"></a><a href="./admin.php?muc=4&tmuc=Sản%20phẩm&sapxep=idtang"></i></a></th>
                                <th style="text-align:center">Ảnh </th>
                                <th style="text-align:center">Tên sản phẩm<a href="./admin.php?muc=4&tmuc=Sản%20phẩm&sapxep=tengiam"></i></a><a href="./admin.php?muc=4&tmuc=Sản%20phẩm&sapxep=tentang"></i></a></th>
                                <th style="text-align:center">Số lượng tồn<a href="./admin.php?muc=4&tmuc=Sản%20phẩm&sapxep=tongiam"></i></a><a href="./admin.php?muc=4&tmuc=Sản%20phẩm&sapxep=tontang"></i></a></th>
                                <th style="text-align:center">Số lượng bán<a href="./admin.php?muc=4&tmuc=Sản%20phẩm&sapxep=bangiam"></i></a><a href="./admin.php?muc=4&tmuc=Sản%20phẩm&sapxep=bantang"></i></a></th>
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
                                    <td style="text-align:center; padding-top: 50px"><?php if($row['trangthai']=='0')echo "Hiển thị";else echo "Bị ẩn" ?></td>
                                    <td style="text-align:center; padding-top: 50px"><a href="admin.php?act=sua&id=<?= $row['id'] ?>">Sửa</a></td>
                                    <td style="text-align:center; padding-top: 50px"><?php if($row['trangthai']=='0'){?><a href="admin.php?act=xoa&id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this item?');">Xóa</a><?php }?></td>                                  
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