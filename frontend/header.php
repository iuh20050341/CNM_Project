<?php
if (isset($_SESSION['ten_dangnhap'])) {

    $conn = mysqli_connect("localhost", "root", "", "bannuocdb");
    $conn->set_charset("utf8mb4");
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    $sql = "
    SELECT DISTINCT 
        messages.receiver_id, 
        khachhang.ten_kh 
    FROM messages 
    JOIN khachhang 
        ON messages.receiver_id = khachhang.id
    WHERE messages.sender_id = $_SESSION[user_id]
    ORDER BY messages.created_at ASC";


    $result = $conn->query($sql);
    if (!$result) {
        // Hiển thị lỗi SQL
        die("Lỗi SQL: " . $conn->error);
    }
}
?>

<style>
.dropdown-mess {
    position: relative;
    /* Để chứa các thành phần con */
    display: inline-block;
}

.dropdown-toggle-mess {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 16px;
    text-decoration: none;
    color: black;
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.dropdown-toggle-mess:hover {
    background-color: #f1f1f1;
}

/* Style cho dropdown nội dung */
.cart-dropdown-mess {
    position: absolute;
    top: 100%;
    /* Đặt ngay dưới nút dropdown */
    left: 0;
    width: 250px;
    background-color: #ffffff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    display: none;
    /* Ẩn mặc định */
    padding: 10px 0;
}

/* Hiển thị dropdown khi hover */
.dropdown-mess:hover .cart-dropdown-mess {
    display: block;
    /* Hiển thị khi hover vào dropdowna */
}

/* Style cho danh sách các liên kết */
.cart-dropdown-mess .list-group {
    list-style: none;
    margin: 0;
    padding: 0;
}

.cart-dropdown-mess .list-group-item {
    padding: 10px 15px;
    border-bottom: 1px solid #eee;
}

.cart-dropdown-mess .list-group-item:last-child {
    border-bottom: none;
    /* Bỏ viền cuối cùng */
}

.cart-dropdown-mess .list-group-item a {
    text-decoration: none;
    color: #333;
    font-size: 14px;
    transition: color 0.3s ease;
}

.cart-dropdown-mess .list-group-item a:hover {
    color: #007bff;
}

/* Style cho thông báo "Không có tin nhắn nào" */
.cart-dropdown-mess p {
    text-align: center;
    color: #888;
    font-size: 14px;
    margin: 0;
    padding: 10px;
}
</style>

<!-- TOP HEADER -->
<div id="top-header" style="background: #5fa533">

    <div class="container">
        <ul class="header-links pull-left">
            <li><a href="#"><i class="fa fa-phone"></i> 0987654321</a></li>
            <li><a href="#"><i class="fa fa-envelope-o"></i> namphuc@email.com</a></li>
            <li><a href="#"><i class="fa fa-map-marker"></i> 256/126/33 Phan Huy Ích, Phường 12, Gò Vấp, Thành phố Hồ
                    Chí Minh</a></li>
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
                        <img src="./img/logo2.png" alt="" width=150px, height=125px>
                    </a>
                </div>
            </div>
            <!-- /LOGO -->

            <!-- SEARCH BAR -->
            <div class="col-md-4" style="padding-top:30px">
                <div class="header-search">
                    <form method="get">

                        <input value="<?php echo isset($search) ? $search : ''; ?>" required style="width: 200px"
                            class="input" name="search" id="search-input" placeholder="Tên sản phẩm......">

                        <span class="microphone">
                            <i class="fa fa-microphone"></i>
                            <span class="recording-icon"></span>
                        </span>
                        <button style="background: green; width: 60px;" class="search-btn">Tìm</button>
                    </form>
                </div>
            </div>
            <!-- /SEARCH BAR -->

            <!-- ACCOUNT -->

            <div class="col-md-6">
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
                            <i class="fa fa-shopping-cart" style="color: green;"></i>
                            <span style="color: black;">Giỏ Hàng</span>
                            <div class="qty" id="qtyPro"
                                style="background-color: red; color: white; border-radius: 50%; padding: 2px 5px; font-size: 12px;">
                                <?= $qty ?>
                            </div>
                        </a>
                    </div>


                    <!-- /Cart -->

                    <!-- Cài đặt -->
                    <div class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="cursor: pointer">
                            <?php echo isset($_SESSION['ten_dangnhap']) ? '<i class="fa-regular fa-user" style="color: green"></i>' : '<i class="fa-solid fa-right-to-bracket" style="color: green"></i>'; ?>
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
                                    echo '<a style="width:100%;"href="frontend/logout.php">Đăng Xuất <i class="fa fa-arrow-circle-right"></i></a>';
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

                <?php if (isset($_SESSION['ten_dangnhap'])) { ?>
                <div class="my-store"
                    style="margin-top:30px; padding-top:25px; display: flex; align-items: center; gap: 10px;">
                    <div class="dropdown-mess">
                        <a class="dropdown-toggle-mess" data-toggle="dropdown" aria-expanded="true"
                            style="cursor: pointer">
                            <i class="fa-regular fa-comments" style="color:green; font-size: 16px"></i>
                            <span>Trò chuyện</span>
                        </a>

                        <div class="cart-dropdown-mess">
                            <?php
                                if ($result->num_rows > 0) {
                                    echo '<ul class="list-group">';
                                    while ($row = $result->fetch_assoc()) {
                                        $receiver_id = htmlspecialchars($row['receiver_id']);
                                        $ten_kh = htmlspecialchars($row['ten_kh']);
                                        echo "
                                        <li class='list-group-item'>
                                            <a href='frontend/chatbox/index.php?receiver_id=$receiver_id&sender_id={$_SESSION['user_id']}'
                                               class='text-decoration-none text-dark'>
                                                $ten_kh
                                            </a>
                                        </li>";

                                    }
                                    echo '</ul>';
                                } else {
                                    echo "<p class='text-muted'>Không có tin nhắn nào.</p>";
                                }
                                ?>


                        </div>
                    </div>

                    <?php if ($_SESSION['isNongDan'] == 1) { ?>
                    <a href="./supplier/supplier.php">
                        <i class="fa-solid fa-store" style="color:green; font-size: 16px"></i>
                        <span>Cửa hàng của tôi</span>
                    </a>
                    <?php } ?>
                </div>
                <?php } ?>

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
                if ($act == '' && !(isset($_GET['id']))) {
                    echo '<li class="active"><a href="index.php">Trang Chủ</a></li>';
                } else
                    echo '<li><a href="index.php">Trang Chủ</a></li>';
                // if($act=='hot'){
                // 	echo '<li class="active"><a href="index.php?act=category">Tùy Chọn</a></li>';
                // }else echo '<li><a href="?act=category">Tùy Chọn</a></li>';
                ?>


                <?php
                if (isset($_GET['id']))
                    $id = $_GET['id'];
                if ($act == 'product') {
                    $sql = 'select id_the_loai from sanpham where id=' . $id;
                    $id = executeSingleResult($sql)['id_the_loai'];

                }
                $sql = 'select id, ten_tl from theloai';
                $list = executeResult($sql);
                foreach ($list as $item) {
                    if ($item['id'] == $id) {
                        echo '<li class="active"><a href="?act=category&id=' . $item['id'] . '">' . $item['ten_tl'] . '</a></li>';
                    } else
                        echo '<li><a href="?act=category&id=' . $item['id'] . '">' . $item['ten_tl'] . '</a></li>';

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