<style>
    .box-contentt {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .wrap-field {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    select,
    textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="file"] {
        margin-top: 5px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    .clear-both {
        clear: both;
    }

    /* CSS cho modal */
    .qr-content-modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .qr-image {
        max-width: 250px;
        max-height: 250px;
    }
</style>

<?php

if (!empty($_SESSION['nguoidung'])) {
    if (!empty($_GET['id'])) {
        $result = mysqli_query($con, "SELECT `sanpham`.`id`, `ten_sp`, `don_gia`, `hinh_anh`, `noi_dung`, `id_the_loai`, `id_nha_cc`, `so_luong`, `sl_da_ban`, `sanpham`.`ngay_tao`, `sanpham`.`ngay_sua`, `trangthai`, `xuatsu`, `phanbon`, `chatluong`, `dotuoi`, `antoanthucpham`, `tinhhopphapnguongoc`, `dieukienbaoquan`, `phantichvisinhvat`, `theloai`.`id`, `theloai`.`ten_tl` FROM `sanpham`, `theloai` WHERE `sanpham`.`id`=".$_GET['id']." AND `sanpham`.`id_the_loai`=`theloai`.`id`");
        $product = $result->fetch_assoc();
        
        $gallery = mysqli_query($con, "SELECT * FROM `hinhanhsp` WHERE `id_sp` = " . $_GET['id']);
        if (!empty($gallery) && !empty($gallery->num_rows)) {
            while ($row = mysqli_fetch_array($gallery)) {
                $product['gallery'][] = array(
                    'id' => $row['id'],
                    'path' => $row['hinh_anh']
                );
            }
        }
    }
}

$theloai = mysqli_query($con, "SELECT * FROM `theloai`");
$nhacungcap = mysqli_query($con, "SELECT * FROM `nhacungcap`");

// Tạo mã QR cho sản phẩm
include('C:/xampp/htdocs/CNM_Project/QRcode/phpqrcode/qrlib.php'); // Nhúng thư viện QRCode
$qrContent = "Xuất xứ: " . htmlspecialchars($product['xuatsu']) . "\n" .
             "Phân bón: " . htmlspecialchars($product['phanbon']) . "\n" .
             "Chất lượng: " . htmlspecialchars($product['chatluong']) . "\n" .
             "Độ tươi: " . htmlspecialchars($product['dotuoi']) . "\n" .
             "An toàn thực phẩm: " . htmlspecialchars($product['antoanthucpham']) . "\n" .
             "Tính hợp pháp nguồn gốc: " . htmlspecialchars($product['tinhhopphapnguongoc']) . "\n" .
             "Điều kiện bảo quản: " . htmlspecialchars($product['dieukienbaoquan']) . "\n" .
             "Phân tích vi sinh vật: " . htmlspecialchars($product['phantichvisinhvat']);
QRcode::png($qrContent, 'qrcode.png', QR_ECLEVEL_L, 4); // Tạo mã QR và lưu thành file
?>

<h1>Xem sản phẩm</h1>
<div class="box-contentt">
    <form name="product-formsua" method="POST" action="./xulythem.php?act=sua&id=<?= $_GET['id'] ?>" enctype="multipart/form-data">
        <div class="clear-both"></div>
        <div class="wrap-field">
            <label>Tên sản phẩm: </label>
            <input readonly type="text" name="name" value="<?= (!empty($product) ? htmlspecialchars($product['ten_sp']) : "") ?>" />
            <div class="clear-both"></div>
        </div>
        <div class="wrap-field">
            <label>Giá sản phẩm: </label>
            <input readonly type="number" name="price" value="<?= (!empty($product) ? number_format($product['don_gia'], 0, ",", ".") : "") ?>" />
            <div class="clear-both"></div>
        </div>
        <div class="wrap-field">
            <label>Ảnh đại diện: </label>
            <div class="wrap-field">
                <?php if (!empty($product['hinh_anh'])) { ?>
                    <img style="width: 250px;height: 200px;" src="../img/<?= htmlspecialchars($product['hinh_anh']) ?>" /><br />
                    <input type="hidden" name="image" value="<?= htmlspecialchars($product['hinh_anh']) ?>" />
                <?php } ?>
            </div>
            <div class="clear-both"></div>
        </div>
        <div class="wrap-field">
            <label>Thư viện ảnh: </label>
            <div class="wrap-field">
                <?php if (!empty($product['gallery'])) { ?>
                    <ul>
                        <?php foreach ($product['gallery'] as $image) {
                            if ($image['path'] != '') { ?>
                                <li>
                                    <img style="width: 250px;height: 200px;" src="../img/<?= htmlspecialchars($image['path']) ?>" />
                                </li>
                            <?php }
                        } ?>
                    </ul>
                <?php } ?>
                <?php if (isset($_GET['task']) && !empty($product['gallery'])) { ?>
                    <?php foreach ($product['gallery'] as $image) { ?>
                        <input readonly type="hidden" name="gallery_image[]" value="<?= htmlspecialchars($image['path']) ?>" />
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="clear-both"></div>
        </div>
        <div class="wrap-field">
            <label>ID thể loại: </label>
            <select disabled name="idtl">
                <option value="<?= htmlspecialchars($product['id_the_loai']) ?>">ID hiện tại: <?= htmlspecialchars($product['id_the_loai']) ?> - <?= htmlspecialchars($product['ten_tl']) ?></option>
                <?php while ($row = mysqli_fetch_array($theloai)) { ?>
                    <option value="<?= htmlspecialchars($row['id']) ?>"><?= htmlspecialchars($row['id']) ?> - <?= htmlspecialchars($row['ten_tl']) ?></option>
                <?php } ?>
            </select>
            <div class="clear-both"></div>
        </div>
        <div class="wrap-field">
            <label>Số lượng: </label>
            <input readonly type="number" name="quantity" value="<?= (!empty($product) ? htmlspecialchars($product['so_luong']) : "") ?>" />
            <div class="clear-both"></div>
        </div>
        <div class="wrap-field">
            <label>Nội dung: </label>
            <textarea readonly name="content" id="product-content"><?= (!empty($product) ? htmlspecialchars($product['noi_dung']) : "") ?></textarea>
            <div class="clear-both"></div>
        </div>
        <div class="wrap-field">
            <label>Trạng thái: </label>
            <input disabled type="checkbox" name="trangthai" value="<?= $product['trangthai'] ?>" <?php if ($product['trangthai'] == '0') echo "checked" ?> />
            <div class="clear-both"></div>
        </div>
        <div class="wrap-field">
            <label id="toggle-qrcode-label" class="toggle-button" style="cursor: pointer; color: blue; text-decoration: underline;">Hiển thị mã QR</label>
            <div class="qr-content-modal" id="qr-modal">
                <div class="modal-content">
                    <span class="close" id="modal-close">&times;</span>
                    <h2>Mã QR cho sản phẩm</h2>
                    <img class="qr-image" src="qrcode.png" alt="QR Code" />
                </div>
            </div>
        </div>
        <div class="clear-both"></div>

    </form>
</div>

<script>
    const qrModal = document.getElementById("qr-modal");
    const toggleQrLabel = document.getElementById("toggle-qrcode-label");
    const modalClose = document.getElementById("modal-close");

    toggleQrLabel.onclick = function () {
        qrModal.style.display = "block";
    }

    modalClose.onclick = function () {
        qrModal.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == qrModal) {
            qrModal.style.display = "none";
        }
    }
</script>
