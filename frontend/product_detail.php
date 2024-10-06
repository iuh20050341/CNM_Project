<!-- Lấy tên thể loại khi biết id sản phẩm -->
<?php
$sql = 'select ten_sp, ten_tl,id_nhaban, theloai.id as id_tl from sanpham, theloai where sanpham.id=' . $id . ' and theloai.id=sanpham.id_the_loai';
$listcate_pro = executeSingleResult($sql);
$id_nhaban = $listcate_pro['id_nhaban'];
$sql1 = 'select ten_kh from khachhang where id = ' . $id_nhaban . '';
$nhaban = executeSingleResult($sql1);
$ten_nhaban = $nhaban['ten_kh'];

?>
<!-- /Lấy tên thể loại khi biết id sản phẩm -->

<!-- Lấy thông tin chi tiết của sản phẩm -->
<?php
$sql = 'select * from sanpham where id=' . $id;
$detailproduct = executeSingleResult($sql);
?>

<!-- /Lấy thông tin chi tiết của sản phẩm -->

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="index.php">Trang Chủ</a></li>
                    <li><a href="?act=category">Danh Mục Sản Phẩm</a></li>
                    <li><a href="?act=category&id=<?= $listcate_pro['id_tl'] ?>"><?= $listcate_pro['ten_tl'] ?></a></li>
                    <li class="active"><?= $listcate_pro['ten_sp'] ?></li>
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
        <div class="row">
            <!-- Product main img -->
            <div class="col-md-5 col-md-push-2">
                <div id="product-main-img">
                    <?php
					$sql = 'select hinh_anh from hinhanhsp where id_sp=' . $id;
					$listImg = executeResult($sql);
					foreach ($listImg as $item) {
						echo '<div class="product-preview">
								<img src="./img/' . $item['hinh_anh'] . '" alt="">
								</div>';
					}
					?>

                </div>
            </div>
            <!-- /Product main img -->

            <!-- Product thumb imgs -->
            <div class="col-md-2  col-md-pull-5">
                <div id="product-imgs">
                    <?php
					foreach ($listImg as $item) {
						echo '<div class="product-preview">
								<img src="./img/' . $item['hinh_anh'] . '" alt="">
							</div>';
					}
					?>

                </div>
            </div>
            <!-- /Product thumb imgs -->

            <!-- Product details -->


            <div class="col-md-5">
                <div class="product-details">
                    <h2 class="product-name"><?= $detailproduct['ten_sp'] ?></h2>
                    <div>
                        <div class="product-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <a class="review-link" href="#"><?= $detailproduct['sl_da_ban'] ?> sản phẩm đã bán.</a>
                    </div>
                    <div>
                        <h3 class="product-price"><?= currency_format($detailproduct['don_gia']) ?> <del
                                class="product-old-price"><?= currency_format($detailproduct['don_gia'] + $detailproduct['don_gia'] * 0.2) ?></del>
                        </h3>
                        <span class="product-available">còn hàng</span>
                    </div>
                    <p><?= $detailproduct['noi_dung'] ?></p>


                    <div class="add-to-cart">
                        <div class="qty-label">
                            Số Lượng
                            <div class="input-number">
                                <?php
								$soLuongHienCoTrongGioHang = 0;
								if (isset($_SESSION['cart'][$id]))
									$soLuongHienCoTrongGioHang = $_SESSION['cart'][$id]['qty'];
								?>
                                <input type="number" id="qtyAdd" value=1
                                    onchange="kiemTraSoLuong(<?= $detailproduct['so_luong'] - $soLuongHienCoTrongGioHang ?>);">
                                <div id="sl_tonkho<?= $id ?>" style="display:none">
                                    <?= ($detailproduct['so_luong'] - $soLuongHienCoTrongGioHang) ?>
                                </div>
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                        </div>
                        <button class="add-to-cart-btn" onclick="addCart(<?= $id ?>,1);themThanhCong(<?= $id ?>);"><i
                                class="fa fa-shopping-cart"></i> <span id="messAddCart<?= $id ?>">Thêm vào
                                giỏ</span></button>
                    </div>
                    <div id="tbQty" style="color:red"></div>


                    <ul class="product-links">
                        <li>Danh mục:</li>

                        <li><a href="?act=category&id=<?= $listcate_pro['id_tl'] ?>"><?= $listcate_pro['ten_tl'] ?></a>
                        </li>
                        <li><a href=""><?= $listcate_pro['ten_sp'] ?></a></li>
                    </ul>
                    <ul class="product-links">
                        <li>Nhà bán:</li>
                        <li><b><?= $ten_nhaban ?></b></li>
                    </ul>

                    <ul class="product-links">
                        <li>Chia sẽ:</li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                    </ul>
                    <?php
					echo '<h5 style="margin-top:10px;"><i>Quét để truy xuất nguồn gốc</i></h5>';
					require_once './QRcode/phpqrcode/qrlib.php';
					$path = './QRcode/images/';
					$qrcode = $path . time() . ".png";
					$sql = 'select ten_sp, ten_tl,id_nhaban, xuatsu,phanbon, chatluong, dotuoi, antoanthucpham, tinhhopphapnguongoc, dieukienbaoquan, phantichvisinhvat, theloai.id as id_tl from sanpham, theloai where sanpham.id=' . $id . ' and theloai.id=sanpham.id_the_loai';
					$listcate_pro = executeSingleResult($sql);
					$xuatsu = $listcate_pro['xuatsu'];
					$phanbon = $listcate_pro['phanbon'];
					$chatluong = $listcate_pro['chatluong'];
					$dotuoi = $listcate_pro['dotuoi'];
					$antoanthucpham = $listcate_pro['antoanthucpham'];
					$tinhhopphapnguongoc = $listcate_pro['tinhhopphapnguongoc'];
					$dieukienbaoquan = $listcate_pro['dieukienbaoquan'];
					$phantichvisinhvat = $listcate_pro['phantichvisinhvat'];
					$noidung = "$xuatsu
								$phanbon 
								$chatluong
								$dotuoi
								$antoanthucpham
								$tinhhopphapnguongoc 
								$dieukienbaoquan 
								$phantichvisinhvat";

					QRcode::png($noidung, $qrcode, 1.9, 1.9);
					echo "<img src='" . $qrcode . "'>";
					?>

                </div>
            </div>
            <!-- /Product details -->


            <!-- Product tab -->
            <div class="col-md-12">
                <div id="product-tab">
                    <!-- product tab nav -->
                    <ul class="tab-nav">
                        <li class="active"><a data-toggle="tab" href="#tab1">Thông Tin Sản Phẩm</a></li>

                    </ul>
                    <!-- /product tab nav -->

                    <!-- product tab content -->
                    <div class="tab-content">
                        <!-- tab1  -->
                        <div id="tab1" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">
                                    <p><?= $detailproduct['noi_dung'] ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- /tab1  -->
                    </div>
                    <!-- /product tab content  -->
                </div>
            </div>
            <!-- /product tab -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- Section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3 class="title">Các sản phẩm tương tự</h3>
                </div>
            </div>
            <!-- product -->
            <?php
			$sql = 'select * from sanpham where id_the_loai=' . $listcate_pro['id_tl'] . ' limit 2, 4';
			$list = executeResult($sql);
			foreach ($list as $item) {
				if ($item['so_luong'] == 0 && $item['trangthai'] == 7) {
					echo '<div class="col-md-4 col-xs-6">
								<div class="product">
									<div class="product-img" style="height:250px">
										<img src="./img/' . $item['hinh_anh'] . '" alt="" style="height:100%">
										<div class="product-label">
											
											<span class="new">HẾT HÀNG</span>
										</div>
									</div>
									<div class="product-body">
										<p class="product-category"><small>' . $item['sl_da_ban'] . ' đã bán</small></p>
										<h3 class="product-name"><a href="index.php?act=product&id=' . $item['id'] . '">' . $item['ten_sp'] . '</a></h3>
										<h4 class="product-price">' . currency_format($item['don_gia']) . '</h4>
										<div class="product-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
										
									</div>
									<div class="add-to-cart">
										<button class="add-to-cart-btn"> SẢN PHẨM ĐÃ HẾT</button>
									</div>
								</div>
							</div>';
				} else if ($item['trangthai'] == 7)
					echo '<div class="col-md-3 col-xs-6">
							<div class="product" >
								<div class="product-img">
									<img src="./img/' . $item['hinh_anh'] . '" alt="" style="height:250px" onclick="location=\'index.php?act=product&id=' . $item['id'] . '\'">
									<div class="product-label">
										
										<span class="new">NEW</span>
									</div>
								</div>
								<div class="product-body">
									<p class="product-category">sản phẩm</p>
									<h3 class="product-name"><a href="?act=product&id=' . $item['id'] . '">' . $item['ten_sp'] . '</a></h3>
									<h4 class="product-price">' . currency_format($item['don_gia']) . ' </h4>
									<div class="product-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
									</div>
									
								</div>
								<div class="add-to-cart">
									<button class="add-to-cart-btn" onclick="addCart(' . $item['id'] . ',1); themThanhCong(' . $item['id'] . '); "><i class="fa fa-shopping-cart"></i> <span id="messAddCart' . $item['id'] . '">thêm vào giỏ</span></button>
								</div>
							</div>
						</div>';
			}
			?>
            <!-- /product -->



        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /Section -->