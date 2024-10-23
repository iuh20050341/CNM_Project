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
	<div class="container">
		<div class="row">
			<!-- LOGO -->
			<div class="col-md-2">
				<div class="header-logo">
					<a href="index.php" class="logo">
						<img src="./img/logo2.png" alt="" width="150px" height="125px">
					</a>
				</div>
			</div>
			<!-- /LOGO -->

			<!-- SEARCH BAR -->
			<div class="col-md-6" style="padding-top:30px">
				<div class="header-search">
					<form method="get">
						<input value="<?php echo isset($search) ? $search : ''; ?>" required style="width: 400px" class="input" name="search" id="search-input" placeholder="Tên sản phẩm......">
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
					$qty = 0;
					if (isset($_SESSION['cart'])) {
						$cart = $_SESSION['cart'];
						foreach ($cart as $value) {
							$qty += $value['qty'];
						}
					}
					?>
					<div style="padding-top:30px">
						<a href="?act=cart">
							<i class="fa fa-shopping-cart" style="color: green"></i>
							<span style="color: black">Giỏ Hàng</span>
							<div class="qty" id="qtyPro"><?= $qty ?></div>
						</a>
					</div>
					<!-- /Cart -->

					<!-- Cài đặt -->
					<div class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
							<i class="fa-solid fa-right-to-bracket" style="color: green"></i>
							<span style="color: black">Cài Đặt</span>
						</a>
						<div class="cart-dropdown">
							<?php
							if (isset($_SESSION['ten_dangnhap'])) {
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
								<?php
								if (isset($_SESSION['ten_dangnhap'])) {
									echo '<a style="width:100%;" href="frontend/logout.php">Đăng Xuất <i class="fa fa-arrow-circle-right"></i></a>';
								} else {
									echo '<a href="index.php?act=login">Đăng Nhập</a>';
									echo '<a href="index.php?act=register">Đăng Ký</a>';
								}
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
				<?php if (isset($_SESSION['isNongDan']) && $_SESSION['isNongDan'] == 1) { ?>
					<div class="my-store" style="margin-top:30px; color:green; padding-top:25px">
						<a href="./supplier/supplier.php">
							<i class="fa-solid fa-store"></i>
							<span>My Store</span>
						</a>
					</div>
				<?php } ?>
			</div>
			<!-- /ACCOUNT -->
		</div>
		<!-- row -->
	</div>
	<!-- container -->
</div>
<!-- /MAIN HEADER -->

<!-- NAVIGATION -->
<nav id="navigation">
    <div class="container">
        <div id="responsive-nav">
            <ul class="main-nav nav navbar-nav">
                <?php
                // Trạng thái của mục Trang Chủ
                if ($act == '' && !(isset($_GET['id']))) {
                    echo '<li class="active"><a href="index.php">Trang Chủ</a></li>';
                } else {
                    echo '<li><a href="index.php">Trang Chủ</a></li>';
                }

                // Mục Sản Phẩm
                echo '<li class="dropdown">
                        <a href="#" class="dropdown-toggle">Sản Phẩm</a>
                        <ul class="dropdown">';

                // Danh sách thể loại sản phẩm
                $categories = ['Trái Cây', 'Rau Hữu Cơ', 'Thực Phẩm', 'Bún-Gạo-Đậu'];
				$sql = 'SELECT id, ten_tl FROM theloai WHERE ten_tl IN ("Trái Cây", "Rau Hữu Cơ", "Thực Phẩm", "Bún-Gạo-Đậu")';
                $list = executeResult($sql);
                foreach ($list as $item) {
                    $activeClass = ($act == 'category' && isset($_GET['id']) && $_GET['id'] == $item['id']) ? 'active' : '';
                    echo '<li class="' . $activeClass . '"><a href="?act=category&id=' . $item['id'] . '">' . $item['ten_tl'] . '</a></li>';
                }

                echo '</ul></li>'; // Đóng menu con và mục Sản Phẩm

                // Truy xuất các thể loại khác (nếu cần)
                $sql = 'SELECT id, ten_tl FROM theloai WHERE ten_tl NOT IN ("Trái Cây", "Rau Hữu Cơ", "Thực Phẩm", "Bún-Gạo-Đậu")';
                $list = executeResult($sql);

                foreach ($list as $item) {
                    // Kiểm tra xem mục hiện tại có phải là mục đang hoạt động không
                    $activeClass = ($act == 'category' && isset($_GET['id']) && $_GET['id'] == $item['id']) ? 'active' : '';
                    echo '<li class="' . $activeClass . '"><a href="?act=category&id=' . $item['id'] . '">' . $item['ten_tl'] . '</a></li>';
                }
				if ($act == '' && !(isset($_GET['id']))) {
                    echo '<li class="dropdown"><a href="index.php?act=vechungtoi">Về chúng tôi</a></li>';
                } else {
                    echo '<li><a href="index.php?act=vechungtoi">Về chúng tôi</a></li>';
                }
				if ($act == '' && !(isset($_GET['id']))) {
                    echo '<li class="dropdown"><a href="index.php">Tin tức</a></li>';
                } else {
                    echo '<li><a href="index.php">Tin tức</a></li>';
                }
				if ($act == '' && !(isset($_GET['id']))) {
                    echo '<li class="dropdown"><a href="index.php">Liên hệ</a></li>';
                } else {
                    echo '<li><a href="index.php">Liên hệ</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

<!-- CSS cho menu dropdown -->
<style>
    .main-nav {
        display: flex; /* Sử dụng flexbox để căn chỉnh các mục theo hàng */
        align-items: center; /* Căn giữa các mục theo chiều dọc */
        padding: 0; /* Loại bỏ padding của ul */
        margin: 0; /* Loại bỏ margin của ul */
    }

    .main-nav > li {
        position: relative; /* Cần thiết để định vị dropdown */
        list-style: none; /* Loại bỏ dấu chấm đầu dòng */
        margin-right: 10px; /* Thêm khoảng cách giữa các mục */
    }

    .dropdown {
        display: none; /* Ẩn menu con mặc định */
        position: absolute; /* Định vị menu con */
        background-color: white; /* Màu nền cho menu con */
        z-index: 1000; /* Đảm bảo menu con hiển thị trên các mục khác */
        padding: 30px 0; /* Thêm khoảng cách trên và dưới cho menu */
    }

    .main-nav > li:hover .dropdown {
        display: block; /* Hiển thị menu con khi hover */
    }

    .dropdown li {
        white-space: nowrap; /* Đảm bảo văn bản không bị ngắt dòng */
        padding: 10px 15px; /* Thêm padding cho các mục để tạo khoảng cách */
    }

    .dropdown li:hover {
        background-color: #f0f0f0; /* Thay đổi màu nền khi hover vào mục */
    }
</style>

<!-- /NAVIGATION -->
