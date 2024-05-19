<style>
.form-tt {
margin: 0 auto;
margin-bottom: -120px;
width: 500px;
border-radius: 10px;
overflow: hidden;
padding: 55px 55px 37px;
/* background: -webkit-linear-gradient(top,#000000,#736A6A,#000000);
background: -o-linear-gradient(top,#000000,#736A6A,#000000);
background: -moz-linear-gradient(top,#000000,#736A6A,#000000);
background: linear-gradient(top,#000000,#736A6A,#000000); */
background: darkgreen;
text-align: center;
margin-top: 20px;
}
.form-tt h2 {
font-size: 30px;
color: #fff;
line-height: 1.2;
text-align: center;
text-transform: uppercase;
display: block;
margin-bottom: 30px;
}

.form-tt input[type=text], 
.form-tt input[type=password], 
.form-tt input[type=email], 
.form-tt input[type=phone],
.form-tt textarea[type=text]
{
font-family: Poppins-Regular;
font-size: 16px;
color: #fff;
line-height: 1.2;
display: block;
width: calc(100% - 10px);
height: 45px;
background: 0 0;
padding: 10px 0;
border-bottom: 2px solid rgba(255,255,255,.24)!important;
border: 0;
outline: 0;
}
.form-tt input[type=text]::focus, 
.form-tt input[type=password]::focus, 
.form-tt input[type=email]::focus, 
.form-tt input[type=phone]::focus{
color: red;
}
.form-tt input[type=password]{
margin-bottom: 20px;
}
.form-tt input::placeholder {
color: #fff;
}
.checkbox {
display: block;
}
.form-tt input[type=submit] {
font-size: 16px;
color: #555;
line-height: 1.2;
padding: 0 20px;
min-width: 120px;
height: 50px;
border-radius: 25px;
background: #fff;
position: relative;
z-index: 1;
border: 0;
outline: 0;
display: block;
margin: 30px auto;
}
.psw-text {
color: #fff;
}
.title{
color: #fff;
}
.radio_option {
label {
    margin-right: 1em;
    &:before {
      content: "";
      display: inline-block;
      width: 0.5em;
      height: 0.5em;
      margin-right: 0.5em;
      border-radius: 100%;
      vertical-align: -3px;
      border: 2px solid $grey;
      padding: 0.15em;
      background-color: transparent;
      background-clip: content-box;
      transition: all 0.2s ease;
    }
  }
}
#textt{
color: #fff;
}
#dk{
color: #fff;
}
</style>
<div class="form-tt">
<form method="post" action="index.php?act=register" style="text-align:center;">

		<br><h3 class="title">ĐĂNG KÝ TÀI KHOẢN</h3>
        <div class="form-group">
        <br><input class="input" type="text" name="ten_kh" value="" required placeholder="Họ và tên" ><br>
        </div>
        <div class="form-group">
        <br><input class="input" type="text" name="ten_dangnhap" value="" required placeholder="Tên đăng nhập" ><br>
        </div>
        <div class="form-group">
        <br><input class="input" type="password" name="mat_khau" value="" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,15}$" 
       title="Mật khẩu phải chứa từ 8 - 15 ký tự, bao gồm ít nhất một chữ thường, một chữ in hoa, một số và một ký tự đặc biệt" required placeholder="Mật khẩu" /><br>
        </div>
        <div class="form-group">
        <br><input class="input" type="email" name="email" value="" required placeholder="Email" /><br>
        </div>
        <div class="form-group">
        <br><input class="input" type="text" name="phone" value="" id="phone" pattern="0[0-9]{9}" title="Số điện thoại phải bắt đầu bằng số 0 và có đúng 10 ký tự" required placeholder="Số điện thoại" /><br>
        </div>
        <div class="form-group">
        <div class="radio_option">
        <input type="radio" name="radiogroup1" id="rd1"><label for="rd1" style="color: #fff;">Nam</label>
        <input type="radio" name="radiogroup1" id="rd2"><label for="rd2" style="color: #fff;">Nữ</label>
        </div>
        </div>
        <div class="form-group">
        <textarea name="dia_chi" class="input" type="text" cols="30" rows="10" required placeholder="Địa chỉ"></textarea><br>
        </div>
		<input class="btn"type="submit" name="dangky" value="Đăng Ký"/>
		<?php require 'xulydangky.php';?>
		</form>
</div><br><br><br><br><br><br>
