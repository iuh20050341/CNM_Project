<?php
if (isset($_SESSION['ten_dangnhap'])) {
	$ten_dangnhap = $_SESSION['ten_dangnhap'];
	$sql = 'select * from khachhang where ten_dangnhap="' . $ten_dangnhap . '"';
	$infoCus = executeSingleResult($sql);
}
?>
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">GIỎ hÀNG</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="index.php">Trang chủ</a></li>
                    <li class="active">Giỏ hàng</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row " style="padding-right:5%; padding-left:5%">
            <!-- Order Details -->
            <div class="col col-lg-12 order-details">
                <div class="section-title text-center">
                    <h3 class="title">Giỏ Hàng</h3>
                </div>
                <div class="order-summary">
                    <div class="order-products">
                        <?php
						echo '<table class="row" style="width:100%;vertical-align:middle;">
								<tr>
									<td></td>
									<td><strong>SẢN PHẨM</strong></td>
									<td><strong>GIÁ</strong></td>
									<td  align=center ><strong>SỐ LƯỢNG</strong></td>
									<td></td>
								</tr>';
						$total = 0;
						if (isset($_SESSION['cart'])) {
							$cart = $_SESSION['cart'];
							foreach ($cart as $key => $value) {
								$soLuongTonKho = executeSingleResult('SELECT so_luong FROM sanpham WHERE id=' . $key)['so_luong'];
								echo '
												<tr>
													<td width=60px>
														
														<img src="./img/' . $value['img'] . '" width="100%">
														
													</td>
													<td width=40%>' . $value['name'] . '</td>
													<td>' . currency_format($value['price']) . '</td>
													<td  align=center style="width:100px">
														<div class="row" style="display: inline-block;">
															<input type="button" value="-" onclick="addCart(' . $key . ',0);location.reload();">
															<input style="width:40px;" type="number"  id="soLuong' . $key . '" value="' . $value['qty'] . '" min=1 style="width:30px;" readonly onchange="kiemTraSoLuong1(' . $soLuongTonKho . ',' . $key . ');" >
															<input type="button" value="+" onclick="addCart(' . $key . ',1);kiemTraSoLuong1(' . $soLuongTonKho . ',' . $key . ');location.reload();">
														</div>
														<p id="tbQty' . $key . '" style="color:red"></p>
													</td>
													<td width=10% align=right>
														
														<button class="delete" onclick="addCart(' . $key . ',-1);location.reload();"><i class="fa fa-close fa-xs"></i></button>
													</td>
												</tr>';
								$total += $value['price'] * $value['qty'];
							}
						}
						echo '</table>';
						?>
                    </div>
                    <div class="order-col">
                        <div><strong>TỔNG TIỀN</strong></div>
                        <div><strong class="order-total"><?= currency_format($total) ?></strong></div>
                    </div>
                </div>



                <?php
				if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
					if (isset($_SESSION['ten_dangnhap']) && !empty($_SESSION['ten_dangnhap'])) { ?>
                <div style="margin-bottom: 20px;">

                    <h2 style="margin-left: 10px;">Thông tin nhận hàng</h2>

                    <div style="display: flex; width: 30%; justify-content: flex-start; margin-left: 40px;">

                        <form action="frontend/thanh_toan.php" method="post" class="row g-3">

                            <div class="col-md-6">
                                <label for="customerName" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="customerName" name="customerName"
                                    placeholder="Nhập họ và tên" value="<?= $infoCus['ten_kh'] ?>" required disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="customerPhone" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" id="customerPhone" name="customerPhone"
                                    value="<?= $infoCus['phone'] ?>" placeholder="Nhập số điện thoại" required disabled>
                            </div>
                            <div class="col-md-12">
                                <label for="customerAddress" class="form-label">Địa chỉ nhận hàng</label>
                                <input type="text" class="form-control" id="customerAddress" name="customerAddress"
                                    value="<?= $infoCus['dia_chi'] ?>" placeholder="Nhập địa chỉ nhận hàng" required
                                    disabled>
                            </div>
                            <button style="margin-left: 20px; margin-top: 20px;" type="button" id="editButton"
                                class="btn btn-primary" onclick="enableFields()">Cập nhật thông
                                tin</button>
                            <input style="margin-left: 20px; margin-top: 20px;" type="submit" name="saveTT"
                                value="Tiến Hành Thanh Toán" id="saveButton" class="btn btn-success">
                        </form>

                    </div>
                </div>
                <?php } else
						echo '<a href="index.php?act=login"><button style="width:100%" class="primary-btn order-submit">Vui Lòng
								đăng nhập để Tiến Hành Thanh Toán</button></a>';
				}
				?>
            </div>
            <!-- /Order Details -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
<script>
function enableFields() {
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.disabled = !input.disabled;
    });

}
</script>