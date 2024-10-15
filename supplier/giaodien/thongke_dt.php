<?php
include_once("./connect_db.php");

if (isset($_SESSION['ten_dangnhap']) && !empty($_SESSION['ten_dangnhap']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Lấy user_id từ session
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;

    // Lấy tổng số bản ghi cho khách hàng cụ thể với user_id
    $totalRecordsQuery = mysqli_query($con, "SELECT * FROM `thongkedt` WHERE `id_nb` = '$user_id'");
    $totalRecords = $totalRecordsQuery->num_rows;

    // Tính tổng số trang
    $totalPages = ceil($totalRecords / $item_per_page);

    // Truy vấn dữ liệu doanh thu theo tháng
    $doanhThuQuery = "
        SELECT 
            DATE_FORMAT(thoigian_tt, '%Y-%m') AS month,
            SUM(doanhthu_tt) AS total_doanhthu
        FROM 
            `thongkedt`
        WHERE 
            `id_nb` = '$user_id'
        GROUP BY 
            month
        ORDER BY 
            month DESC
        LIMIT $item_per_page OFFSET $offset
    ";
    $doanhThuResult = mysqli_query($con, $doanhThuQuery);

    mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thống Kê Doanh Thu</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; /* Màu nền trang */
        }

        h1 {
            text-align: center;
            color: #fff; /* Màu chữ tiêu đề */
            background-color: #1E90FF; /* Màu nền tiêu đề */
            padding: 20px 0; /* Khoảng cách trên và dưới */
            margin: 0; /* Bỏ khoảng cách bên ngoài */
        }

        table {
            width: 80%; /* Chiều rộng của bảng */
            margin: 20px auto; /* Căn giữa bảng */
            border-collapse: collapse; /* Gộp viền bảng */
            background-color: #fff; /* Màu nền bảng */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Đổ bóng cho bảng */
        }

        th, td {
            border: 1px solid #ddd; /* Viền cho các ô */
            padding: 12px; /* Khoảng cách bên trong ô */
            text-align: center; /* Căn giữa nội dung */
        }

        th {
            background-color: #2980b9; /* Màu nền cho tiêu đề cột */
            color: #fff; /* Màu chữ tiêu đề cột */
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Màu nền cho hàng chẵn */
        }

        tr:hover {
            background-color: #ddd; /* Màu nền khi di chuột vào hàng */
        }

        a {
            color: #007bff; /* Màu liên kết */
            text-decoration: none; /* Bỏ gạch chân cho liên kết */
            margin: 0 5px; /* Khoảng cách giữa các liên kết */
        }

        a:hover {
            text-decoration: underline; /* Gạch chân khi di chuột vào liên kết */
        }

        /* Định dạng cho biểu đồ */
        .chart-container {
            width: 80%; /* Chiều rộng của container biểu đồ */
            margin: 20px auto; /* Căn giữa container */
            display: flex; /* Sử dụng flexbox để căn giữa */
            justify-content: center; /* Căn giữa theo chiều ngang */
        }
    </style>
</head>
<body>
<div class="main-content">
    <h1>Thống Kê Doanh Thu</h1>
    <div class="chart-container">
        <canvas id="doanhThuChart" width="300" height="300"></canvas>
    </div>
    <table border="1">
        <thead>
            <tr>
                <th>Tháng</th>
                <th>Tổng Doanh Thu</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($doanhThuResult) > 0) {
                while ($row = mysqli_fetch_assoc($doanhThuResult)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['month']) . "</td>";
                    echo "<td>" . htmlspecialchars(number_format($row['total_doanhthu'], 0, ',', '.')) . " VNĐ</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>Không có dữ liệu</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script>
    const labels = [];
    const data = [];

    <?php
    if (mysqli_num_rows($doanhThuResult) > 0) {
        mysqli_data_seek($doanhThuResult, 0); // Reset result pointer
        while ($row = mysqli_fetch_assoc($doanhThuResult)) {
            echo "labels.push('" . htmlspecialchars($row['month']) . "');";
            echo "data.push(" . (int)$row['total_doanhthu'] . ");";
        }
    }
    ?>
    
    const ctx = document.getElementById('doanhThuChart').getContext('2d');
    const doanhThuChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: labels,
        datasets: [{
            label: 'Doanh Thu Theo Tháng',
            data: data,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: false, // Đặt responsive thành false
        maintainAspectRatio: false, // Bỏ giữ tỷ lệ
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Doanh Thu Theo Tháng'
            }
        }
    },
});

</script>
<?php
        include './pagination.php'; // Giả sử bạn có một trang phân trang riêng
    ?>
</body>
</html>
<?php
} else {
    echo "Bạn cần đăng nhập để truy cập trang này.";
}
?>
