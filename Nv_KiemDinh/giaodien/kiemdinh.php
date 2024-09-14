<?php
    include_once("./connect_db.php");
    if (!empty($_SESSION['nguoidung'])) {
        $con = mysqli_connect($host, $user, $password, $database);
        $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
        $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $offset = ($current_page - 1) * $item_per_page;

        // Query to get total records
        $totalRecords = mysqli_query($con, "SELECT `ten_sp`, `hinh_anh` FROM `sanpham`");
        $totalRecords = $totalRecords->num_rows;

        // Calculate total pages
        $totalPages = ceil($totalRecords / $item_per_page);

        // Query to get products with pagination (MariaDB compatible LIMIT syntax)
        $product = mysqli_query($con, "SELECT `ten_sp`, `hinh_anh`, `trangthai`, `statu` FROM `sanpham` WHERE `sanpham`.`id`=".$_GET['id']." LIMIT $offset, $item_per_page");
    }
?>
<div class="main-content">
        <h1>Kiểm định sản phẩm</h1>
        <div class="product-items">
            <div class="table-responsive-sm">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="text-align:center">Tên sản phẩm</th>
                            <th style="text-align:center">Ảnh</th>
                            <th style="text-align:center">Xuất xứ rõ ràng</th>
                            <th style="text-align:center">Phân bón</th>
                            <th style="text-align:center">Chất lượng sản phẩm</th>
                            <th style="text-align:center">Độ tươi</th>
                            <th style="text-align:center">An toàn thực phẩm</th>
                            <th style="text-align:center">Tính hợp pháp và nguồn gốc</th>
                            <th style="text-align:center">Điều kiện bảo quản</th>
                            <th style="text-align:center">Phân tích vi sinh vật</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch and display each row
                        while ($row = mysqli_fetch_assoc($product)) {
                        ?>
                            <tr>
                                <td><?php echo $row['ten_sp']; ?></td>
                                <td><img style="width: 100px;height: 100px " src="../img/<?= $row['hinh_anh'] ?>" /></td>
                                <td style="text-align: center;">
                                    <input style = "align=center;" type="checkbox">
                                    <?php if($row['statu']==2) echo "Đạt chuẩn"; if($row['statu']==3) echo "Không đạt chuẩn";?>
                                </td>
                                <td style="text-align: center;">
                                    <input type="checkbox" name ="checkbox">
                                    <?php if($row['statu']==2) echo "Đạt chuẩn"; if($row['statu']==3) echo "Không đạt chuẩn";?>
                                </td>
                                <td style="text-align: center;">
                                    <input type="checkbox" name ="checkbox">
                                    <?php if($row['statu']==2) echo "Đạt chuẩn"; if($row['statu']==3) echo "Không đạt chuẩn";?>
                                </td>
                                <td style="text-align: center;">
                                    <input type="checkbox" name ="checkbox">
                                    <?php if($row['statu']==2) echo "Đạt chuẩn"; if($row['statu']==3) echo "Không đạt chuẩn";?>
                                </td>
                                <td style="text-align: center;">
                                    <input type="checkbox" name ="checkbox">
                                    <?php if($row['statu']==2) echo "Đạt chuẩn"; if($row['statu']==3) echo "Không đạt chuẩn";?>
                                    
                                </td>
                                <td style="text-align: center;">
                                    <input type="checkbox" name ="checkbox">
                                    <?php if($row['statu']==2) echo "Đạt chuẩn"; if($row['statu']==3) echo "Không đạt chuẩn";?>
                                </td>
                                <td style="text-align: center;">
                                    <input type="checkbox" name ="checkbox">
                                    <?php if($row['statu']==2) echo "Đạt chuẩn"; if($row['statu']==3) echo "Không đạt chuẩn";?>
                                </td>
                                <td style="text-align: center;">
                                    <input type="checkbox" name ="checkbox">
                                    <?php if($row['statu']==2) echo "Đạt chuẩn"; if($row['statu']==3) echo "Không đạt chuẩn";?>
                                </td>                                
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <input name="btnkd" type="submit" title="Lưu sản phẩm" value="Lưu" />
    </div>

    <?php
    //include './pagination.php';
    ?>
    <div class="clear-both"></div>
</div>
