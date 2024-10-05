<?php
error_reporting(0);
ini_set('display_errors', 0);

?>
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">

                <ul class="breadcrumb-tree">
                    <li><a href="index.php">Trang chủ</a></li>
                    <li class="active">Đơn hàng của tôi</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->
<!-- ĐƠN HÀNG CỦA TÔI -->
<div class="container">
    <div class="row">
        <div class="col col-lg-3 col-sm-12">
            <div class="row">
                <p>Tài khoản
                <p>
                    <strong><?= $_SESSION['ten_dangnhap'] ?></strong>
            </div>
            <div>

                <ul class="footer-links">
                    <li><a href="?act=my_account"><i class="fa fa-user-o" style="color:black;"></i> Tài Khoản Của
                            Tôi</a>
                    </li>
                    <li><br></li>
                    <li><a href="?act=my_bill" style="color:#D10024;"><i class="fa fa-bars" style="color:black;"></i>
                            Đơn Hàng Của Tôi</a></li>

                </ul>
            </div>
        </div>
        <div class="col col-lg-9 col-sm-12">
            <div class="section-title">
                <h3 class="title">Đơn hàng của tôi</h3>
            </div>
            <table class="table table-striped" width=100%>
                <tr>
                    <th style="text-align:center">Mã đơn hàng</th>
                    <th style=" width: 120px">Ngày mua</th>
                    <th style="width: 200px">Sản phẩm</th>
                    <th style="width: 100px">Tổng tiền</th>
                    <th style="text-align:center; width: 200px">Trạng thái đơn hàng</th>
                    <th style="text-align:center; width: 120px">-----</th>

                </tr>
                <?php
                $sql = 'SELECT * from hoadon where id_khachhang=' . $info['id'] . ' ORDER BY hoadon.ngay_tao DESC';
                $listBill = executeResult($sql);

                foreach ($listBill as $value) {
                    $ten_sp = $trangthai = '';
                    $sl_sp = 0;

                    $ten_sp = executeSingleResult('SELECT sanpham.ten_sp FROM cthoadon, sanpham WHERE cthoadon.id_sanpham=sanpham.id AND id_hoadon=' . $value['id'] . ' LIMIT 0, 1')['ten_sp'];
                    $sl_sp = executeSingleResult('SELECT COUNT(id_sanpham) AS sl_sp FROM cthoadon WHERE id_hoadon=' . $value['id'])['sl_sp'];
                    if ($sl_sp > 1)
                        $ten_sp = $ten_sp . ', ... và ' . ($sl_sp - 1) . ' sản phẩm khác.';
                    echo '<tr width=100% height=80px>
                                        <td align=center ><a href="index.php?act=bill_detail&id=' . $value['id'] . '"><strong style="color:deepskyblue;"><u>HĐ' . $value['id'] . '</u></strong></a></td>
                                        <td>' . $value['ngay_tao'] . '</td>
                                        <td>' . $ten_sp . '</td>
                                        <td>' . currency_format($value['tong_tien']) . '</td>';
                    if ($value['deliveryStatus'] == 0) {
                        echo '<td align=center><b style="color:red">Đang xử lý</b></td>
                            <td align:right; ><a onclick="huydonhang(' . $value['id'] . ')" style="color:#d10024"><u>Hủy</u></a></td>';
                    }
                    if ($value['deliveryStatus'] == 1) {
                        echo '<td align=center><b style="color:orange">Chờ lấy hàng</b></td>';
                    }
                    if ($value['deliveryStatus'] == 2) {
                        echo '<td align=center><b style="color:green">Đang vận chuyển</b></td>
                            <td align:right; ><button onclick="nhandonhang(' . $value['id'] . ')" style="color:green; border-radius: 5px"><b>Xác nhận đã nhận hàng</b></button></td>';
                    }
                    if ($value['deliveryStatus'] == 3) {
                        echo '<td align=center ><b style="color:darkgreen;">Giao thành công</b><br><i style="font-size: 12px">Đã nhận hàng vào: ' . $value['ngaynhan_thucte'] . '</i></td>';
                    }
                    echo '<td></td></tr>';
                    if (!empty($value['ngaynhandukien'])) {
                        echo '<tr style="background-color: inherit !important;"><td colspan="6"><i style="color: red; font-size: 12px;">Ngày giao hàng dự kiến: <b>' . $value['ngaynhandukien'] . '</b></i></td></tr>';
                    }
                }
                ?>

            </table>
        </div>
    </div>
</div>
<!-- /ĐƠN HÀNG CỦA TÔI -->