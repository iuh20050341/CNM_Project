<?php
include('../db/dbhelper.php');
if (isset($_POST['id_hoadon'])) {
    $id_hoadon = $_POST['id_hoadon'];
    $ngaynhanhang = date('Y-m-d');
    $sql = 'UPDATE hoadon SET deliveryStatus = 3, ngaynhan_thucte = "' . $ngaynhanhang . '" WHERE id =' . $id_hoadon;
    execute($sql);

    // Lấy thông tin chi tiết hóa đơn
    $sql1 = "SELECT cthoadon.id_sanpham, cthoadon.id_hoadon, cthoadon.so_luong, sanpham.id_nhaban, sanpham.don_gia
              FROM cthoadon
              JOIN sanpham ON cthoadon.id_sanpham = sanpham.id
              WHERE cthoadon.id_hoadon = $id_hoadon";
    $result = executeResult($sql1);

    // Khởi tạo mảng để lưu doanh thu của từng nhà cung cấp
    $revenue_per_nhaban = [];

    foreach ($result as $row) {
        $id_nhaban = $row['id_nhaban'];
        $don_gia = $row['don_gia'];
        $so_luong = $row['so_luong'];
        $amount = $don_gia * $so_luong; // Tính tiền cho sản phẩm của nhà cung cấp

        // Trừ đi 20% từ tổng tiền sản phẩm
        $final_amount = $amount * 0.8;

        // Cộng dồn doanh thu cho từng nhà cung cấp
        if (!isset($revenue_per_nhaban[$id_nhaban])) {
            $revenue_per_nhaban[$id_nhaban] = 0;
        }
        $revenue_per_nhaban[$id_nhaban] += $final_amount;
    }

    // Cập nhật doanh thu cho từng nhà cung cấp
    foreach ($revenue_per_nhaban as $id_nhaban => $revenue) {
        $sql3 = 'UPDATE khachhang SET doanhthu = doanhthu + ' . $revenue . ' WHERE id =' . $id_nhaban;
        execute($sql3);
    }
}
?>