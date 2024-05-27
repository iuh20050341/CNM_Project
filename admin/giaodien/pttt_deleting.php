<?php

if (!empty($_SESSION['nguoidung'])) {
    ?>
    <div class="main-content">
        <h1>Xóa PTTT</h1>
        <div id="content-box">
            <?php
            $error = false;
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                include_once './connect_db.php';
                include_once './function.php';
                $result = execute("DELETE FROM `phuongthucthanhtoan` WHERE `id` = " . $_GET['id']."");
                if (!$result) {
                    $error = "Không thể xóa PTTT.";
                }
                if ($error != false) {
                    ?>
                    <div id="error-notify" class="box-content">
                        <h2>Thành công</h2>
                        
                        <a href="./admin.php?tmuc=Phương thức thanh toán">Danh sách Phương thức thanh toán</a>
                    </div>
        <?php } else { ?>
                    <div id="success-notify" class="box-content">
                        <h2>Xóa Phương thức thanh toán thành công</h2>
                        <a href="./admin.php?tmuc=Phương thức thanh toán">Danh sách Phương thức thanh toán</a>
                    </div>
                <?php } ?>
    <?php } ?>
        </div>
    </div>
    <?php
}

?>