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
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0; // Chuyển $id thành kiểu số nguyên để tránh lỗi
        if ($id > 0) {
            $product = mysqli_query($con, "SELECT `id`, `ten_sp`, `hinh_anh`, `trangthai` FROM `sanpham` WHERE `sanpham`.`id` = $id LIMIT $offset, $item_per_page");
        } else {
            // Xử lý trường hợp không có ID hoặc ID không hợp lệ
            echo "ID không hợp lệ!";
        }
    }
?>
<div class="main-content">
        <h1>Kiểm định sản phẩm</h1>

        <div class="product-items">
            <div class="table-responsive-sm">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
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
                                <form method="POST" action="./xulythem.php?id=<?= $row['id'] ?>">
                                    <td style = "align='center;'">
                                        <input type="checkbox" name="trangthai[]" value="1" <?php if($row['trangthai']==2) echo "checked"; ?>>
                                    </td>
                                    <td style = "align='center;'">
                                        <input type="checkbox" name="trangthai[]" value="2" <?php if($row['trangthai']==2) echo "checked"; ?>>
                                    </td>
                                    <td style = "align='center;'">
                                        <input type="checkbox" name="trangthai[]" value="3" <?php if($row['trangthai']==2) echo "checked"; ?>>
                                    </td>
                                    <td style = "align='center;'">
                                        <input type="checkbox" name="trangthai[]" value="4" <?php if($row['trangthai']==2) echo "checked"; ?>>
                                    </td>
                                    <td style = "align='center;'">
                                        <input type="checkbox" name="trangthai[]" value="5" <?php if($row['trangthai']==2) echo "checked"; ?>>
                                    </td>
                                    <td style = "align='center;'">
                                        <input type="checkbox" name="trangthai[]" value="6" <?php if($row['trangthai']==2) echo "checked"; ?>>
                                    </td>
                                    <td style = "align='center;'">
                                        <input type="checkbox" name="trangthai[]" value="7" <?php if($row['trangthai']==2) echo "checked"; ?>>
                                    </td>
                                    <td style = "align='center;'">
                                        <input type="checkbox" name="trangthai[]" value="8" <?php if($row['trangthai']==2) echo "checked"; ?>>
                                    </td>
                                    <td style = "align='center;'">
                                        <input type="submit" name="btnkd" value="Lưu">
                                    </td?>
                                </form>                          
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php
    //include './pagination.php';
    ?>
    <div class="clear-both"></div>
</div>
