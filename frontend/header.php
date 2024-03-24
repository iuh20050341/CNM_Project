<!-- TOP HEADER -->
<div id="top-header" style="background: #5fa533">
			
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> 0987654321</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> namphuc@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 256/126/33 Phan Huy Ích, Phường 12, Gò Vấp, Thành phố Hồ Chí Minh</a></li>
					</ul>
					
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header" style="background-color:white">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<!-- <div class="col-md-1">
							<div class="my-store">
									<a href="#">
										<i class="fa-solid fa-store"></i>
										<span>Cửa hàng của tôi</span>
									</a>
								</div>
						</div> -->
						<div class="col-md-2">
							<div class="header-logo">
								<a href="index.php" class="logo">
									<img src="./img/logo2.png" alt="" width=150px, height= 125px>
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6" style="padding-top:30px">
							<div class="header-search">
								<form method="get">
									
									<input style ="width: 400px" class="input" name="search" id="search-input" placeholder="Tên sản phẩm......" required>
						                        <span class="microphone">
						                            <i class="fa fa-microphone"></i>
						                            <span class="recording-icon"></span>
						                        </span>
						                        <button style="background: green;" class="search-btn">Tìm</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->

						<div class="col-md-4 clearfix">
							<div class="header-ctn">
								

								<!-- Cart -->
								<?php
									$qty=0;
									if(isset($_SESSION['cart'])){
										$cart=$_SESSION['cart'];
										foreach($cart as $value){
											$qty += $value['qty'];
										}
									}
								?>
								<div style="padding-top:30px">
									<a href="?act=cart">
										<i class="fa fa-shopping-cart" style="color: green"></i>
										<span style="color: black">Giỏ Hàng</span>
										<div class="qty" id="qtyPro"><?=$qty?></div>
									</a>
								</div>
								
								<!-- /Cart -->

								<!-- Cài đặt -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
									<i class="fa-solid fa-gear" style="color: green"></i>										
									<span style="color: black">Cài Đặt</span>
										
									</a>
									<div class="cart-dropdown">
										<?php
											if(isset($_SESSION['ten_dangnhap'])){
												echo '<div class="cart">
														<div class="product-widget">
														<a href="index.php?act=my_account">Quản Lý Tài Khoản</a>
														</div>
														<div class="product-widget">
														<a href="index.php?act=my_bill">Quản Lý Đơn Hàng</a>											
														</div>
													</div>';
											}
										?>
										
										<div class="cart-btns">
											<a href="index.php?act=login">Đăng Nhập</a>
											<?php
												if(isset($_SESSION['ten_dangnhap'])){
													echo '<a href="frontend/logout.php">Đăng Xuất <i class="fa fa-arrow-circle-right"></i></a>';
												}else echo '<a href="index.php?act=register">Đăng Ký</a>';
											?>
											
										</div>
									</div>
								</div>
								<!-- /Cài đặt -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
							<div class="my-store" style="margin-top:30px; color:green; padding-top:25px">
								<a href="./supplier/giaodien/index.php">
										<i class="fa-solid fa-store"></i>
										<span>My Store</span>
									</a>
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<?php
							if($act=='' && !(isset($_GET['id']))) {
								echo '<li class="active"><a href="index.php">Trang Chủ</a></li>';
							}else echo '<li><a href="index.php">Trang Chủ</a></li>';
							// if($act=='hot'){
							// 	echo '<li class="active"><a href="index.php?act=category">Tùy Chọn</a></li>';
							// }else echo '<li><a href="?act=category">Tùy Chọn</a></li>';
						?>				
						
						
						<?php
							if(isset($_GET['id'])) $id=$_GET['id'];
							if($act=='product'){
								$sql='select id_the_loai from sanpham where id='.$id;
								$id=executeSingleResult($sql)['id_the_loai'];
								
							}
							$sql='select id, ten_tl from theloai';
							$list=executeResult($sql);
										foreach($list as $item){
											if($item['id']==$id){
												echo '<li class="active"><a href="?act=category&id='.$item['id'].'">'.$item['ten_tl'].'</a></li>';
											}else echo '<li><a href="?act=category&id='.$item['id'].'">'.$item['ten_tl'].'</a></li>';
											
										}
						?>
					</ul>
					
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->