<?php

include("../../../CNM_Project/TCPDF-main/tcpdf.php");
$host = "localhost";
$user = "root";
$password = "";
$database = "bannuocdb";
$con = mysqli_connect($host, $user, $password, $database);
if (mysqli_connect_errno()) {
    echo "Connection Fail: " . mysqli_connect_errno();
    exit;
}

$id_hoadon = mysqli_real_escape_string($con, $_GET['id']);

// Lấy thông tin chi tiết hóa đơn
$cthoadonQuery = "SELECT `id_hoadon`, `id_sanpham`, `cthoadon`.`so_luong`, `sanpham`.`id`, `ten_sp`, `don_gia`, `sanpham`.`id_nhaban` 
                  FROM `cthoadon`, `sanpham` 
                  WHERE `id_sanpham`=`sanpham`.`id` AND `id_hoadon`='$id_hoadon' 
                  ORDER BY `cthoadon`.`id_hoadon` ASC";

$cthoadon = mysqli_query($con, $cthoadonQuery);
if (!$cthoadon) {
    echo "Query failed: " . mysqli_error($con);
    exit;
}

$sql = 'SELECT * FROM hoadon WHERE hoadon.id = "' . $id_hoadon . '"';
$kq = $con->query($sql);

// Tạo tài liệu PDF mới
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Thiết lập thông tin tài liệu
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Hóa đơn');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// Thiết lập dữ liệu tiêu đề
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . '', PDF_HEADER_STRING);

// Thiết lập phông chữ tiêu đề và chân trang
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Thiết lập phông chữ đơn điệu mặc định
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Thiết lập lề
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Thiết lập ngắt trang tự động
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Thiết lập tỉ lệ hình ảnh
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Thiết lập các chuỗi phụ thuộc ngôn ngữ (tùy chọn)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
// Thiết lập phông chữ
$pdf->SetFont('dejavusans', '', 10);

// Thêm một trang
$pdf->AddPage();

// Tạo nội dung HTML
$row = $kq->fetch_assoc();
$tenkh = $row['ten_nguoinhan'];
$diachi = $row['diachinhanhang'];
$sdt = $row['sdt_nguoinhan'];
$tongtien = $row['tong_tien'];

// Bắt đầu nội dung HTML
$html = '<h1>HÓA ĐƠN KHÁCH HÀNG</h1>

<h3>Thông tin khách hàng</h3>
<p>
    Mã hóa đơn: ' . $id_hoadon . '<br>
    Tên Khách Hàng: ' . $tenkh . '<br>
    Địa chỉ: ' . $diachi . '<br>
    Số điện thoại: ' . $sdt . '
</p>

<h3>Danh sách sản phẩm</h3>
<table border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th><b>Sản phẩm</b></th>
        <th><b>Giá</b></th>
        <th><b>Số lượng</b></th>
    </tr>';

// Lấy từng sản phẩm trong hóa đơn
while ($product = mysqli_fetch_assoc($cthoadon)) {
    $product_name = $product['ten_sp'];
    $product_price = $product['don_gia'];
    $quantity = $product['so_luong'];

    // Thêm hàng vào bảng HTML
    $html .= '<tr>
                <td>' . $product_name . '</td>
                <td>' . $product_price . '</td>
                <td>' . $quantity . '</td>
              </tr>';
}

// Đóng bảng
$html .= '</table>

<h3>Tổng tiền: ' . $tongtien . '</h3>
';

// Xuất nội dung HTML
$pdf->writeHTML($html, true, false, true, false, '');

// Đóng và xuất tài liệu PDF
$pdf->Output('example_006.pdf', 'I');
?>
