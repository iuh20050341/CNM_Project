<?php

if (!empty($_SESSION['nguoidung'])) {
    ?>
    <div class="main-content">
        <h1>Xóa PTVC</h1>
        <div id="content-box">
            <?php
            $error = false;
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                include_once './connect_db.php';
                include_once './function.php';
                $result = execute("DELETE FROM `phuongthucvanchuyen` WHERE `id` = " . $_GET['id']."");
                if (!$result) {
                    $error = "Không thể xóa PTVC.";
                }
                if ($error != false) {
                    ?>
                    <div id="error-notify" class="box-content">
                        <h2>Thành công</h2>
                        
                        <a href="./admin.php?tmuc=Phương thức vận chuyển">Danh sách Phương thức vận chuyển</a>
                    </div>
        <?php } else { ?>
                    <div id="success-notify" class="box-content">
                        <h2>Xóa Phương thức vận chuyển thành công</h2>
                        <a href="./admin.php?tmuc=Phương thức vận chuyển">Danh sách Phương thức vận chuyển</a>
                    </div>
                <?php } ?>
    <?php } ?>
        </div>
    </div>
    <?php
}

?>