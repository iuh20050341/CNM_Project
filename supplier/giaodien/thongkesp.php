<?php
include_once("./connect_db.php");

if (isset($_SESSION['ten_dangnhap']) && !empty($_SESSION['ten_dangnhap']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Lấy năm và tháng được chọn từ form (nếu có)
    $selectedYear = isset($_GET['year']) ? $_GET['year'] : '';
    $selectedMonth = isset($_GET['month']) ? $_GET['month'] : '';

    // Truy vấn danh sách sản phẩm bán chạy theo số lượng và thống kê theo tháng
    $sanPhamQuery = "
        SELECT 
            sp.ten_sp, 
            SUM(cthd.so_luong) AS total_sold,
            DATE_FORMAT(hd.ngay_tao, '%Y-%m') AS month_sold
        FROM 
            cthoadon cthd 
        INNER JOIN sanpham sp ON cthd.id_sanpham = sp.id
        INNER JOIN hoadon hd ON cthd.id_hoadon = hd.id
        WHERE 
            cthd.id_nhaban = '$user_id'";

    // Thêm điều kiện lọc theo tháng và năm nếu người dùng chọn
    if (!empty($selectedMonth) && !empty($selectedYear)) {
        $sanPhamQuery .= " AND DATE_FORMAT(hd.ngay_tao, '%Y-%m') = '$selectedYear-$selectedMonth'";
    }

    $sanPhamQuery .= "
        GROUP BY 
            cthd.id_sanpham, month_sold
        ORDER BY 
            month_sold DESC, total_sold DESC";

    // Thực thi truy vấn
    $sanPhamResult = mysqli_query($con, $sanPhamQuery);

    // Lưu dữ liệu để vẽ biểu đồ
    $products = [];
    $labels = [];
    $data = [];

    if (mysqli_num_rows($sanPhamResult) > 0) {
        while ($row = mysqli_fetch_assoc($sanPhamResult)) {
            $productName = htmlspecialchars($row['ten_sp']);
            $totalSold = (int)$row['total_sold'];

            // Thêm dữ liệu cho biểu đồ
            if (!in_array($productName, $labels)) {
                $labels[] = $productName;
            }
            $data[] = $totalSold; // Dữ liệu số lượng bán
        }
    }
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm bán chạy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        h1 {
            text-align: center;
            color: #fff;
            background-color: #1E90FF;
            padding: 20px 0;
            margin: 0;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #2980b9;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="main-content">
    <h1>Sản phẩm đã bán trong tháng <?= htmlspecialchars($selectedMonth) ?> năm <?= htmlspecialchars($selectedYear) ?></h1>

    <!-- Form lọc theo tháng và năm -->
    <form id="filterForm" action="./supplier.php" method="get">
        <input type="hidden" name="muc" value="25">
        <input type="hidden" name="tmuc" value="Thống kê sản phẩm">
        <label for="year">Chọn năm:</label>
        <select name="year" id="year">
            <option value="">Tất cả</option>
            <?php
            // Tạo danh sách năm
            for ($i = date('Y'); $i >= 2000; $i--) {
                $selected = ($i == $selectedYear) ? 'selected' : '';
                echo "<option value='$i' $selected>$i</option>";
            }
            ?>
        </select>

        <label for="month">Chọn tháng:</label>
        <select name="month" id="month">
            <option value="">Tất cả</option>
            <?php
            // Tạo danh sách tháng
            for ($i = 1; $i <= 12; $i++) {
                $month = str_pad($i, 2, '0', STR_PAD_LEFT);
                $selected = ($month === $selectedMonth) ? 'selected' : '';
                echo "<option value='$month' $selected>$month</option>";
            }
            ?>
        </select>
        <button type="submit">Lọc</button>
    </form>

    <div id="productChart">
        <?php if (!empty($data)): ?>
            <canvas id="myChart" width="400" height="200"></canvas>
            <script>
                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?= json_encode($labels) ?>,
                        datasets: [{
                            label: 'Tổng số lượng bán theo tháng',
                            data: <?= json_encode($data) ?>,
                            backgroundColor: 'rgba(30, 144, 255, 0.5)',
                            borderColor: 'rgba(30, 144, 255, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Sản phẩm'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Số lượng bán'
                                }
                            }
                        }
                    }
                });
            </script>
        <?php else: ?>
            <p>Không có sản phẩm bán trong tháng này.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>

<?php
    mysqli_close($con);
} else {
    echo "<p>Vui lòng đăng nhập.</p>";
}
?>
