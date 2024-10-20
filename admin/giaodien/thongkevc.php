<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sơ đồ cột đơn hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<?php
$month = isset($_POST['monthFilter']) ? (int) $_POST['monthFilter'] : date('m');
$year = date('Y');

$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

$dates = [];
$orderCounts = array_fill(1, $daysInMonth, 0);
$totalAmounts = array_fill(1, $daysInMonth, 0);

$hoadon = mysqli_query($con, "
    SELECT 
        DATE(`ngaynhan_thucte`) AS ngay_nhan, 
        COUNT(*) AS so_luong_don, 
        SUM(`tong_tien`) AS tong_tien 
    FROM 
        `hoadon` 
    LEFT JOIN 
        `nhanvien` 
    ON 
        `hoadon`.`id_nhanvien` = `nhanvien`.`id` 
    WHERE 
        `hoadon`.`deliveryStatus` = 3 
        AND `phancong` = '" . $_SESSION['user'] . "' 
        AND MONTH(`ngaynhan_thucte`) = $month
    GROUP BY 
        DATE(`ngaynhan_thucte`)
");

if ($hoadon && mysqli_num_rows($hoadon) > 0) {
    while ($row = mysqli_fetch_assoc($hoadon)) {
        $day = (int) date('d', strtotime($row['ngay_nhan']));
        $orderCounts[$day] = $row['so_luong_don'];
        $totalAmounts[$day] = $row['tong_tien'];
    }
}

for ($i = 1; $i <= $daysInMonth; $i++) {
    $dates[] = "Ngày $i";
}
?>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Thống kê đơn hàng và tổng tiền</h3>
                <div class="d-flex justify-content-end mb-3">
                    <form method="POST" action="./admin.php?muc=23&tmuc=Thống%20kê">
                        <select class="form-select w-auto" name="monthFilter" id="monthFilter">
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                echo "<option value=\"$i\"" . ($i == $month ? ' selected' : '') . ">Tháng $i</option>";
                            }
                            ?>
                        </select>
                        <input style="margin-top: 10px;" name="filter" type="submit" class="btn btn-primary"
                            value="Lọc">
                    </form>
                </div>
                <canvas id="orderChart"></canvas>
            </div>
        </div>
    </div>

    <script>
    const ctx = document.getElementById('orderChart').getContext('2d');
    const orderChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($dates); ?>,
            datasets: [{
                label: 'Tổng tiền (VNĐ)',
                backgroundColor: 'rgba(255, 206, 86, 0.7)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1,
                data: <?php echo json_encode(array_values($totalAmounts)); ?>,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Giá trị'
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const totalAmount = context.raw;
                            const dayIndex = context.dataIndex;
                            const orderCount = <?php echo json_encode(array_values($orderCounts)); ?>[
                                dayIndex];
                            return [
                                `Tổng tiền: ${totalAmount} VNĐ`,
                                `Số lượng đơn hàng: ${orderCount}`
                            ];
                        }
                    }
                }
            }
        }
    });
    </script>

</body>


</html>