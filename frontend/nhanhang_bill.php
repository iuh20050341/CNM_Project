<?php
include('../db/dbhelper.php');
if (isset($_POST['id_hoadon'])) {
    $id_hoadon = $_POST['id_hoadon'];
    
    // Cập nhật trạng thái giao hàng
    $sql = 'UPDATE hoadon SET deliveryStatus = 3 WHERE id =' . $id_hoadon;
    execute($sql);
    
    // Lấy thông tin chi tiết hóa đơn
    $sql1 = "SELECT cthoadon.id_sanpham, cthoadon.id_hoadon, cthoadon.so_luong, sanpham.id_nhaban, sanpham.don_gia
              FROM cthoadon
              JOIN sanpham ON cthoadon.id_sanpham = sanpham.id
              WHERE cthoadon.id_hoadon = $id_hoadon";
    $result = executeResult($sql1);

    // Tính toán doanh thu và cập nhật cho từng nhà cung cấp
    $total_amount = 0; // Khởi tạo tổng số tiền của hóa đơn
    foreach ($result as $row) {
        $don_gia = $row['don_gia'];
        $so_luong = $row['so_luong'];
        $total_amount += ($don_gia * $so_luong); // Cộng dồn tổng số tiền
    }

    // Trừ đi 20% từ tổng hóa đơn
    $final_amount = $total_amount * 0.8;

    foreach ($result as $row) {
        $id_nhaban = $row['id_nhaban'];
        // Cập nhật doanh thu cho nhà cung cấp với số tiền đã trừ
        $sql3 = 'UPDATE khachhang SET doanhthu = doanhthu + ' . $final_amount . ' WHERE id =' . $id_nhaban;
        execute($sql3);
    }
}
?>
