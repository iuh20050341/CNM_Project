<?php
include_once("./connect_db.php");
if (!empty($_SESSION['nguoidung'])) {
    $con = mysqli_connect($host, $user, $password, $database);
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;

    // Truy vấn để lấy tổng số bản ghi
    $totalRecords = mysqli_query($con, "SELECT `ten_sp`, `hinh_anh` FROM `sanpham`");
    $totalRecords = $totalRecords->num_rows;

    // Tính tổng số trang
    $totalPages = ceil($totalRecords / $item_per_page);

    // Truy vấn để nhận sản phẩm có phân trang
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0; // Chuyển $id thành kiểu số nguyên
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
        <div class="buttons">
            <a href="admin.php?tmuc=Quy tắc kiểm định">Quy tắc kiểm định</a>
        </div>
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
                        <th style="text-align:center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch and display each row
                    while ($row = mysqli_fetch_assoc($product)) {
                    ?>
                        <tr>
                            <form method="POST" action="./xulythem.php?id=<?= $row['id'] ?>">
                                <td style="text-align:center;">
                                    <input type="checkbox" name="trangthai[]" value="1" <?php if($row['trangthai']==1) ?> onchange="updateQualityMessage()">
                                </td>
                                <td style="text-align:center;">
                                    <input type="checkbox" name="trangthai[]" value="2" <?php if($row['trangthai']==2) ?> onchange="updateQualityMessage()">
                                </td>
                                <td style="text-align:center;">
                                    <input type="checkbox" name="trangthai[]" value="3" <?php if($row['trangthai']==3) ?> onchange="updateQualityMessage()">
                                </td>
                                <td style="text-align:center;">
                                    <input type="checkbox" name="trangthai[]" value="4" <?php if($row['trangthai']==4) ?> onchange="updateQualityMessage()">
                                </td>
                                <td style="text-align:center;">
                                    <input type="checkbox" name="trangthai[]" value="5" <?php if($row['trangthai']==5) ?> onchange="updateQualityMessage()">
                                </td>
                                <td style="text-align:center;">
                                    <input type="checkbox" name="trangthai[]" value="6" <?php if($row['trangthai']==6) ?> onchange="updateQualityMessage()">
                                </td>
                                <td style="text-align:center;">
                                    <input type="checkbox" name="trangthai[]" value="7" <?php if($row['trangthai']==7) ?> onchange="updateQualityMessage()">
                                </td>
                                <td style="text-align:center;">
                                    <input type="checkbox" name="trangthai[]" value="8" <?php if($row['trangthai']==8) ?> onchange="updateQualityMessage()">
                                </td>
                                <td style="text-align:center;">
                                    <input type="submit" name="btnkd" value="Lưu" onclick="return confirm('Bạn có muốn kiểm định sản phẩm?')">
                                </td>
                                <tr>
                                    <td colspan="8" style="text-align:center;">
                                        <div id="input-reason" style="display: none; margin-top: 10px;">    
                                            <label for="reason">Lý do sản phẩm chưa đạt chuẩn:</label><br>
                                            <textarea name="lydo" placeholder="Nhập lý do..." rows="4" cols="50"></textarea>
                                        </div>
                                    </td>
                                </tr>
                            </form>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Thông báo chất lượng -->
<!-- Thông báo chất lượng -->
<div id="quality-message" style="color: green; font-weight: bold; display: none;"></div>

<script>
    function updateQualityMessage() {
        // Lấy tất cả checkbox
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        let checkedCount = 0;

        // Đếm số checkbox được chọn
        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                checkedCount++;
            }
        });

        // Hiển thị hoặc ẩn các phần tử liên quan
        const messageDiv = document.getElementById('quality-message');
        const inputReasonDiv = document.getElementById('input-reason');

        if (checkedCount >= 5) {
            messageDiv.innerText = "Kết quả: Sản phẩm đạt chuẩn!";
            messageDiv.style.color = "green";
            messageDiv.style.display = "block";
            inputReasonDiv.style.display = "none";
        } else {
            messageDiv.innerText = "Kết quả: Sản phẩm chưa đạt chuẩn!";
            messageDiv.style.color = "red";
            messageDiv.style.display = "block";
            inputReasonDiv.style.display = "block";
        }
    }
</script>
    
    <div class="clear-both"></div>
</div>
