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
        
        // Tổng số bản ghi
        $totalRecordsQuery = "SELECT * FROM `sanpham` WHERE id_nhaban = $user_id AND trangthai = 0";
        $totalRecordsResult = mysqli_query($con, $totalRecordsQuery);
        $totalRecords = $totalRecordsResult->num_rows;
        $totalPages = ceil($totalRecords / $item_per_page);
        
        // Sản phẩm hiển thị theo trang
        $query = "SELECT * FROM `sanpham` WHERE id_nhaban = $user_id AND trangthai = 0 LIMIT $item_per_page OFFSET $offset";
        $products = mysqli_query($con, $query);
        mysqli_close($con);
    ?>
        <div class="main-content" style="color: green">
            <h1>Danh sách sản phẩm chưa kiểm định</h1>
            <div class="product-items">
                <div class="buttons">
                    <a href="supplier.php?act=add">Thêm sản phẩm</a>
                </div>
                <div class="table-responsive-sm ">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="text-align:center">ID</th>
                                <th style="text-align:center">Ảnh</th>
                                <th style="text-align:center">Tên sản phẩm</th>
                                <th style="text-align:center">Số lượng tồn</th>
                                <th style="text-align:center">Số lượng bán</th>
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
                                    <td style="text-align:center; padding-top: 50px">
                                        <form method="POST" action="xulythem.php">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="btngui">Gửi yêu cầu kiểm định</button>
                                        </form>

                                        <?php if ($row['trangthai'] == '0') { ?>
                                            <a href="supplier.php?act=xoa&id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this item?');"><button type="submit" name="btndang">Xóa</button></a>
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
    }
    ?>
</body>

</html>
