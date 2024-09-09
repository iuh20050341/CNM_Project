<h1>Thêm tài khoản</h1>
<form name="taikhoan-formadd" method="POST" action="./xulythem.php" enctype="multipart/form-data">
    
    <div class="clear-both"></div>
    <div class="box-content">
    <div class="wrap-field">
        <label>Tài khoản: </label>
        <input type="text" name="tendangnhap" value="" />
        <div class="clear-both"></div>
    </div>
    <div class="wrap-field">
        <label>Mật khẩu: </label>
        <input type="password" name="matkhau" value="" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,15}$" required title="Mật khẩu phải chứa từ 8 - 15 ký tự, bao gồm ít nhất một chữ thường, một chữ in hoa, một số và một ký tự đặc biệt"/><br>
        <div class="clear-both"></div>
    </div>
    <div class="wrap-field">
        <label>Họ và tên: </label>
        <input type="text" name="name" value="" />
        <div class="clear-both"></div>
    </div>
    <input name="btntkadd" type="submit" title="Lưu tài khoản" value="Lưu" />
    </div>
</form>