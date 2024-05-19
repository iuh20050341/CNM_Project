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
    box-sizing: border-box; /* Ensure padding and border are included in element's total width and height */
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
    display: none; /* Ẩn modal ban đầu */
    position: fixed; /* Vị trí cố định */
    z-index: 1; /* Hiển thị trên cùng */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto; /* Cuộn khi cần thiết */
    background-color: rgba(0,0,0,0.4); /* Màu nền */
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
</style>
<?php
if (!empty($_SESSION['nguoidung'])) {
if (!empty($_GET['id'])) {
    // $result = mysqli_query($con, "SELECT * FROM `sanpham` WHERE `sanpham`.`id`=".$_GET['id']."");
    $result = mysqli_query($con, "SELECT `sanpham`.`id`, `ten_sp`, `don_gia`, `hinh_anh`, `noi_dung`, `id_the_loai`, `id_nha_cc`, `so_luong`, `sl_da_ban`, `sanpham`.`ngay_tao`, `sanpham`.`ngay_sua`, `trangthai`, `xuatsu`, `phanbon`, `chatluong`, `baoquan`, `vanchuyen`, `theloai`.`id`,`theloai`.`ten_tl` FROM `sanpham`,`theloai`,`nhacungcap` WHERE `sanpham`.`id`=".$_GET['id']." AND `sanpham`.`id_the_loai`=`theloai`.`id`");
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

    $theloai=mysqli_query($con,"SELECT * FROM `theloai`");
    $nhacungcap=mysqli_query($con,"SELECT * FROM `nhacungcap`");
?>
<h1>Xem sản phẩm</h1>
<div class="box-contentt">
<form name="product-formsua" method="POST" action="./xulythem.php?act=sua&id=<?= $_GET['id'] ?>" enctype="multipart/form-data">
    
    <div class="clear-both"></div>
    <div class="wrap-field">
        <label>Tên sản phẩm: </label>
        <input readonly type="text" name="name" value="<?= (!empty($product) ? $product['ten_sp'] : "") ?>" />
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
                <img style="width: 250px;height: 200px;" src="../img/<?= $product['hinh_anh'] ?>" /><br />
                <input type="hidden" name="image" value="<?= $product['hinh_anh'] ?>" />
            <?php } ?>
            <!-- <input readonly type="file" name="image" /> -->
        </div>
        <div class="clear-both"></div>
    </div>
    <div class="wrap-field">
        <label>Thư viện ảnh: </label>
        <div class="wrap-field">
            <?php if (!empty($product['gallery'])) { ?>
                <ul>
                    <?php foreach ($product['gallery'] as $image) {
                            if($image['path']!='') {?>
                        <li>
                            <img style="width: 250px;height: 200px;" src="../img/<?= $image['path'] ?>" />
                            <!-- <a href="./supplier.php?act=gallery_delete&id=<?= $image['id'] ?>">Xóa</a> -->
                        </li>
                    <?php } }?>
                </ul>
            <?php } ?>
            <?php if (isset($_GET['task']) && !empty($product['gallery'])) { ?>
                <?php foreach ($product['gallery'] as $image) { ?>
                    <input readonly type="hidden" name="gallery_image[]" value="<?= $image['path'] ?>" />
                <?php } ?>
            <?php } ?>
            <!-- <input readonly multiple="" type="file" name="gallery[]" /> -->
        </div>
        <div class="clear-both"></div>
    </div>
    <div class="wrap-field">
        <label>ID thể loại: </label>
        <select disabled name="idtl"><option value="<?=$product['id_the_loai']?>">ID hiện tại: <?=$product['id_the_loai']?> - <?=$product['ten_tl']?></option><?php while($row=mysqli_fetch_array($theloai)){?><option value="<?= $row['id']?>"><?= $row['id']?> - <?=$row['ten_tl']?></option><?php } ?></select>
        <div class="clear-both"></div>
    </div>
    <div class="wrap-field">
        <label>Số lượng: </label>
        <input readonly type="number" name="quantity" value="<?=(!empty($product) ? $product['so_luong'] : "")?>" />
        <div class="clear-both"></div>
    </div>
    <div class="wrap-field">
        <label>Nội dung: </label>
        <textarea readonly name="content" id="product-content" > <?= (!empty($product) ?$product['noi_dung']:"")?></textarea>
        <div class="clear-both"></div>
    </div>
    <div class="wrap-field">
        <label>Trạng thái: </label>
        <input disabled type="checkbox" name="trangthai" value="<?= $product['trangthai']?>"<?php if($product['trangthai']=='0') echo "checked" ?> />
        <div class="clear-both"></div>
    </div>
    <div class="wrap-field">
            <label id="toggle-qrcode-label" class="toggle-button">Nội dung QRCode</label>
            <div class="qr-content-modal" id="qr-modal">
                <div class="modal-content">
                    <span class="close" id="modal-close">&times;</span>
                    <div class="qr-field">
                        <label>Xuất xứ:</label>
                        <input readonly type="text" name="xuatsu" value="<?= (!empty($product) ? $product['xuatsu'] : "") ?>"/>
                    </div>
                    <div class="qr-field">
                        <label>Phân bón:</label>
                        <input readonly type="text" name="phanbon" value="<?= (!empty($product) ? $product['phanbon'] : "") ?>"/>
                    </div>
                    <div class="qr-field">
                        <label>Chất lượng:</label>
                        <input readonly type="text" name="chatluong" value="<?= (!empty($product) ? $product['chatluong'] : "") ?>"/>
                    </div>
                    <div class="qr-field">
                        <label>Bảo quản:</label>
                        <input readonly type="text" name="baoquan" value="<?= (!empty($product) ? $product['baoquan'] : "") ?>"/>
                    </div>
                    <div class="qr-field">
                        <label>Vận chuyển:</label>
                        <input readonly type="text" name="vanchuyen" value="<?= (!empty($product) ? $product['vanchuyen'] : "") ?>"/>
                    </div>
                </div>
            </div>
            <div class="clear-both"></div>
        </div>
<div class="clear-both"></div>
<!-- <input name="btnsua" type="submit" title="Lưu sản phẩm" value="Lưu" /> -->
</div>
</form>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    var toggleLabel = document.getElementById("toggle-qrcode-label");
    var modal = document.getElementById("qr-modal");
    var modalClose = document.getElementById("modal-close");

    toggleLabel.addEventListener("click", function() {
        modal.style.display = "block";
    });

    modalClose.addEventListener("click", function() {
        modal.style.display = "none";
    });

    window.addEventListener("click", function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });
});
</script>