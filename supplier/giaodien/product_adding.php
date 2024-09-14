<!-- if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['price']) && !empty($_POST['price']) && isset($_POST['idtl']) && !empty($_POST['idtl']) && isset($_POST['idncc']) && !empty($_POST['idncc'])) {
$sql = "INSERT INTO `sanpham` (`id`, `ten_sp`, `hinh_anh`, `don_gia`, `noi_dung`, `ngay_tao`, `ngay_sua`,`so_luong`,`id_the_loai`,`id_nha_cc`) VALUES (NULL, '" . $_POST['name'] . "','" . $image . "', " . str_replace('.', '', $_POST['price']) . ", '" . $_POST['content'] . "', " . time() . ", " . time() . ",0,'" . $_POST['idtl'] . "','" . $_POST['idncc'] . "');";
                    -->
                    <?php 
    $theloai=mysqli_query($con,"SELECT * FROM `theloai`");
    $nhacungcap=mysqli_query($con,"SELECT * FROM `nhacungcap`");
    $user_id = $_SESSION['user_id']; 
?>
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
<h1>Thêm sản phẩm</h1>
<div class="box-contentt">
<form name="product-formadd" method="POST" action="./xulythem.php" enctype="multipart/form-data">
    
    <div class="clear-both"></div>
    <div class="wrap-field">
        <label>Tên sản phẩm: </label>
        <input type="text" name="name" value="" />
        <div class="clear-both"></div>
    </div>
    <div class="wrap-field">
        <label>Giá sản phẩm: </label>
        <input type="number" name="price" value="" />
        <div class="clear-both"></div>
    </div>
    <div class="wrap-field">
        <label>Ảnh đại diện: </label>
        <div class="wrap-field">
            <input type="file" name="image" />
        </div>
        <div class="clear-both"></div>
    </div>
    <div class="wrap-field">
        <label>Thư viện ảnh: </label>
        <div class="wrap-field"> 
            
            <input multiple="" type="file" name="gallery[]" />
        </div>
        <div class="clear-both"></div>
    </div>
    <div class="wrap-field">
        <label>ID thể loại: </label>
        <select name="idtl"><?php while($row=mysqli_fetch_array($theloai)){?><option value="<?= $row['id']?>"><?= $row['id']?> - <?=$row['ten_tl']?></option><?php } ?></select>
        <div class="clear-both"></div>
    </div>
    <div class="wrap-field">
        <label>Số lượng: </label>
        <input type="number" name="quantity" value="" min="0" />
        <div class="clear-both"></div>
    </div>
    <div class="wrap-field">
        <label>ID nhà bán: </label>
        <input readonly type="text" name="idnb" value="<?php echo''.$user_id.'';?>" />
        <div class="clear-both"></div>
    </div>
    <div class="wrap-field">
        <label>Nội dung: </label>
        <textarea name="content" id="product-content"></textarea>
        <div class="clear-both"></div>
    </div>
    
    <input name="btnadd" type="submit" title="Lưu sản phẩm" value="Lưu" />
</form>
<div class="clear-both"></div>

</div>
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
