
<!-- SECTION -->
<div class="section">
	
			 <!-- Banner -->
			 <div class="row">
				<div class="col-md-12">
					<div class="banner text-center mx-auto"> <!-- Thêm lớp "text-center" để căn giữa -->
						<!-- Thay đổi đường dẫn và alt theo hình ảnh của banner bạn muốn sử dụng -->
						<div>
							<a href="#"><img src="./img/banner/banner9.png" alt="Your Banner" style="max-width: 75%; height: auto; display: inline-block; border-radius: 20px; box-shadow: 0 14px 16px rgba(0, 0, 0, 0.1);" class="img-fluid"></a> <!-- Thêm thuộc tính "display: inline-block;" -->
						</div>
					</div>
				</div>
			</div>
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop" style="width: 350pxl;">
							<div class="shop-img">
								<img src="https://xenangnhapkhau.com/wp-content/uploads/2022/01/nong-san-la-gi-4.jpg" alt="">
							</div>
							<div class="shop-body">
								<a href="#"><h3>Thực Phẩm An Toàn</h3></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop" style="width: 350pxl;">
							<div class="shop-img">
								<img src="https://vietjack.me/storage/uploads/images/34622/gia-dinh-hanh-phuc-hoat-hinh-10-1697616192.jpg" alt="">
							</div>
							<div class="shop-body">
								<a href="#"><h3>Bữa Tối Hạnh Phúc</h3></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop" style="width: 350pxl;">
							<div class="shop-img">
								<img src="https://cdnmedia.baotintuc.vn/Upload/pTMF1jgWpbjY1m8G1xWUsg/files/2022/12/dongnai.jpg" alt="">
							</div>
							<div class="shop-body">
								<a href="#"><h3>Đặc Sản Vùng Miền</h3></a>
							</div>
						</div>
					</div>
					<!-- /shop -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->

    <!-- /Banner -->
		</div>
		<!-- /SECTION -->
        <!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Sản Phẩm Bán Chạy</h3>
							
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
                                        <!-- product -->
                                        <?php
                                        $sql='select * from sanpham where 1 limit 9, 10';
                                        $list=executeResult($sql);
                                        foreach($list as $item){
											if($item['so_luong']==0 && $item['trangthai']==7){ // Hết hàng 
												echo '
												<div class="product">
												<div class="product-img" style="height:250px">
													<img src="./img/'.$item['hinh_anh'].'" alt="" style="height:100%">
													<div class="product-label">
														
														<span class="new">HẾT HÀNG</span>
													</div>
												</div>
												<div class="product-body">
													<p class="product-category">SẢN PHẨM</p>
													<h3 class="product-name"><a href="?act=product&id='.$item['id'].'">'.$item['ten_sp'].'</a></h3>
													<h4 class="product-price">'.currency_format($item['don_gia']).' </h4>
													<div class="product-rating">
														<button class="add-to-cart-btn" >SẢN PHẨM ĐÃ HẾT</button>
													</div>
													
												</div>
												<div class="add-to-cart">
													<button class="add-to-cart-btn" >SẢN PHẨM ĐÃ HẾT</button>
												</div>
											</div>';
											}else if($item['trangthai']==7)// Còn hàng
                                            echo '<div class="product" >
											<div class="product-img" style="height:250px" onclick="location=\'index.php?act=product&id='.$item['id'].'\'">
												<img src="./img/'.$item['hinh_anh'].'" alt="" style="height:100%">
												<div class="product-label">
													
													<span class="new">Best Seller</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category"><small>'.$item['sl_da_ban'].' đã bán</small></p>
												<h3 class="product-name"><a href="?act=product&id='.$item['id'].'">'.$item['ten_sp'].'</a></h3>
												<h4 class="product-price">'.currency_format($item['don_gia']).'</h4>
												<div class="product-rating">
													<button class="add-to-cart-btn" onclick="addCart('.$item['id'].',1);themThanhCong('.$item['id'].');"><i class="fa fa-shopping-cart"></i> <span id="messAddCart'.$item['id'].'">Thêm vào giỏ</span></button>
												</div>
												
											</div>
											
										</div>';
                                        }
                                        ?>
										<!-- /product -->
										
									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>

					
					<!-- Products tab & slick -->
				</div>
				<!-- /row -->

				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Sản Phẩm Mới</h3>
							
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->

					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
                                        <!-- product -->
                                        <?php
                                        $sql='select * from sanpham where 1 limit 4, 5';
                                        $list=executeResult($sql);
                                        foreach($list as $item){
											if($item['so_luong']==0 && $item['trangthai']==7){ // Hết hàng 
												echo '
												<div class="product">
												<div class="product-img" style="height:250px">
													<img src="./img/'.$item['hinh_anh'].'" alt="" style="height:100%">
													<div class="product-label">
														
														<span class="new">HẾT HÀNG</span>
													</div>
												</div>
												<div class="product-body">
													<p class="product-category">SẢN PHẨM</p>
													<h3 class="product-name"><a href="?act=product&id='.$item['id'].'">'.$item['ten_sp'].'</a></h3>
													<h4 class="product-price">'.currency_format($item['don_gia']).' </h4>
													<div class="product-rating">
														<button class="add-to-cart-btn" >SẢN PHẨM ĐÃ HẾT</button>
													</div>
													
												</div>
												<div class="add-to-cart">
													<button class="add-to-cart-btn" >SẢN PHẨM ĐÃ HẾT</button>
												</div>
											</div>';
											}else if($item['trangthai']==7)// Còn hàng
                                            echo '<div class="product" >
											<div class="product-img" style="height:250px" onclick="location=\'index.php?act=product&id='.$item['id'].'\'">
												<img src="./img/'.$item['hinh_anh'].'" alt="" style="height:100%">
												<div class="product-label">
													
													<span class="new">New</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category"><small>'.$item['sl_da_ban'].' đã bán</small></p>
												<h3 class="product-name"><a href="?act=product&id='.$item['id'].'">'.$item['ten_sp'].'</a></h3>
												<h4 class="product-price">'.currency_format($item['don_gia']).'</h4>
												<div class="product-rating">
													<button class="add-to-cart-btn" onclick="addCart('.$item['id'].',1);themThanhCong('.$item['id'].');"><i class="fa fa-shopping-cart"></i> <span id="messAddCart'.$item['id'].'">Thêm vào giỏ</span></button>
												</div>
												
											</div>
										
										</div>';
                                        }
                                        ?>
										<!-- /product -->
										
									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					
					<!-- Products tab & slick -->
				</div>

				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Sản Phẩm Sale</h3>
							
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->				

					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
                                        <!-- product -->
                                        <?php
                                        $sql='select * from sanpham where 1 limit 20, 30';
                                        $list=executeResult($sql);
                                        foreach($list as $item){
											if($item['so_luong']==0 && $item['trangthai']==7){ // Hết hàng 
												echo '
												<div class="product">
												<div class="product-img" style="height:250px">
													<img src="./img/'.$item['hinh_anh'].'" alt="" style="height:100%">
													<div class="product-label">
														
														<span class="new">HẾT HÀNG</span>
													</div>
												</div>
												<div class="product-body">
													<p class="product-category">SẢN PHẨM</p>
													<h3 class="product-name"><a href="?act=product&id='.$item['id'].'">'.$item['ten_sp'].'</a></h3>
													<h4 class="product-price">'.currency_format($item['don_gia']).' </h4>
													<div class="product-rating">
														<button class="add-to-cart-btn" >SẢN PHẨM ĐÃ HẾT</button>
													</div>
													
												</div>
												<div class="add-to-cart">
													<button class="add-to-cart-btn" >SẢN PHẨM ĐÃ HẾT</button>
												</div>
											</div>';
											}else if($item['trangthai']==7)// Còn hàng
                                            echo '<div class="product" >
											<div class="product-img" style="height:250px" onclick="location=\'index.php?act=product&id='.$item['id'].'\'">
												<img src="./img/'.$item['hinh_anh'].'" alt="" style="height:100%">
												<div class="product-label">
													
													<span class="new">Sale</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category"><small>'.$item['sl_da_ban'].' đã bán</small></p>
												<h3 class="product-name"><a href="?act=product&id='.$item['id'].'">'.$item['ten_sp'].'</a></h3>
												<h4 class="product-price">'.currency_format($item['don_gia']).'</h4>
												<div class="product-rating">
													<button class="add-to-cart-btn" onclick="addCart('.$item['id'].',1);themThanhCong('.$item['id'].');"><i class="fa fa-shopping-cart"></i> <span id="messAddCart'.$item['id'].'">Thêm vào giỏ</span></button>
												</div>
												
											</div>
											
										</div>';
                                        }
                                        ?>
										<!-- /product -->
										
									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					
					<!-- Products tab & slick -->
				</div>
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
