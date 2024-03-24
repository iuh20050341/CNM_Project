<style>
.form-tt {
margin: 0 auto;
margin-bottom: -80px;
width: 400px;
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

.form-tt input[type=text], .form-tt input[type=password] {
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
.form-tt input[type=text]::focus, .form-tt input[type=password]::focus {
color: red;
}
.form-tt input[type=password] {
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
#checkbox {
display: inline-block;
margin-right: 10px;
}
.checkbox-text {
color: #fff;
}
.psw-text {
color: #fff;
}
.title{
color: #fff;
}
#textt{
color: #fff;
}
#dk{
color: #fff;
}
</style>
<div class="form-tt">
    
		<form action='index.php?act=login'style="text-align:center;" class="dangnhap" method='POST'> 
		<br><h3 class="title">ĐĂNG NHẬP</h3><br><br>
		<input type="text" name="username" placeholder="Nhập tên tài khoản" />
		<input type="password" name="password" placeholder="Nhập mật khẩu" />
        <input class="btn" type='submit' class="button" name="dangnhap" value='Đăng nhập' /> 
		<br><br><span id="textt">Bạn chưa có tài khoản?</span> <a href='index.php?act=register' title='Đăng ký' id="dk">Đăng ký</a><br>
		<?php require 'xulydangnhap.php';?> 
		<form>

</div><br><br><br><br>
