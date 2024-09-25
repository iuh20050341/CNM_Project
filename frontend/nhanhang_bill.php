<?php
include('../db/dbhelper.php');
if (isset($_POST['id_hoadon'])) {
    $id_hoadon = $_POST['id_hoadon'];
    $sql = 'UPDATE hoadon SET deliveryStatus = 3 where id =' . $id_hoadon;
    execute($sql);
    $sql1 = "SELECT cthoadon.id_sanpham, cthoadon.id_hoadon, cthoadon.so_luong, sanpham.id_nhaban, sanpham.don_gia
        FROM cthoadon
        JOIN sanpham ON cthoadon.id_sanpham = sanpham.id
        WHERE cthoadon.id_hoadon = $id_hoadon";
    $result = executeResult($sql1);
    foreach ($result as $row) {
        $id_nhaban = $row['id_nhaban'];
        $don_gia = $row['don_gia'];
        $so_luong = $row['so_luong'];
        $sql3 = 'UPDATE khachhang SET doanhthu_tt = doanhthu_tt + ' . ($don_gia * $so_luong) . ' WHERE id =' . $id_nhaban;
        execute($sql3);
    }
}
?>