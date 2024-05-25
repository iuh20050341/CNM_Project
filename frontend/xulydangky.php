<?php
//header('Content-Type: text/html; charset=utf-8');
// Kết nối cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', '', 'bannuocdb') or die ('Lỗi kết nối'); mysqli_set_charset($conn, "utf8");

// Dùng isset để kiểm tra Form
if(isset($_POST['dangky'])){
$name = trim($_POST['ten_kh']);
$username = trim($_POST['ten_dangnhap']);
$password = trim($_POST['mat_khau']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$phone = $_POST['phone'];  
$diachi= trim($_POST['dia_chi']);
#Băm mật khẩu
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

if (empty($name)) {
array_push($errors, "Name is required"); 
}
if (empty($username)) {
array_push($errors, "Username is required"); 
}
if (empty($email)) {
array_push($errors, "Email is required"); 
}
if (empty($phone)) {
array_push($errors, "Phone is required"); 
}
if (empty($password)) {
array_push($errors, "Password is required"); 
}
if (empty($diachi)) {
array_push($errors, "Address is required"); 
}

// Kiểm tra username hoặc email có bị trùng hay không
$sql = "SELECT * FROM khachhang WHERE ten_dangnhap = '$username' OR email = '$email'";

// Thực thi câu truy vấn
$result = mysqli_query($conn, $sql);

// Nếu kết quả trả về lớn hơn 1 thì nghĩa là username hoặc email đã tồn tại trong CSDL
if (mysqli_num_rows($result) > 0)
{
echo '<script language="javascript">alert("Bị trùng tên đăng nhập hoặc trùng email!"); window.location="index.php?act=register";</script>';
// Dừng chương trình
die ();
}
else {
$sql = "INSERT INTO khachhang (ten_kh,ten_dangnhap, mat_khau, email, phone,dia_chi) VALUES ('$name','$username','$hashed_password','$email','$phone','$diachi')";
echo '<script language="javascript">alert("Đăng ký thành công!"); window.location="index.php?act=login";</script>';

if (mysqli_query($conn, $sql)){
echo "Tên khách hàng: ".$_POST['ten_kh']."<br/>";
echo "Tên đăng nhập: ".$_POST['ten_dangnhap']."<br/>";
echo "Mật khẩu: " .$_POST['mat_khau']."<br/>";
echo "Email đăng nhập: ".$_POST['email']."<br/>";
echo "Số điện thoại: ".$_POST['phone']."<br/>";
echo "Địa chỉ: ".$_POST['dia_chi']."<br/>";
}
else {
echo '<script language="javascript">alert("Có lỗi trong quá trình xử lý"); window.location="index.php?act=register";</script>';
}
}
}
?>
