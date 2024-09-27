<?php
// Kết nối cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', '', 'bannuocdb') or die('Lỗi kết nối');
mysqli_set_charset($conn, "utf8");

// Dùng isset để kiểm tra Form
if (isset($_POST['dangky'])) {
    $name = trim($_POST['ten_kh']);
    $username = trim($_POST['ten_dangnhap']);
    $password = trim($_POST['mat_khau']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $diachi = trim($_POST['dia_chi']);
    $isNongDan = isset($_POST['is_farmer']) ? 1 : 0;
    $dia_chi_vuon = isset($_POST['dia_chi_vuon']) ? trim($_POST['dia_chi_vuon']) : '';

    // Băm mật khẩu
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Khởi tạo mảng lỗi
    $errors = [];

    // Kiểm tra các trường bắt buộc
    if (empty($name)) {
        array_push($errors, "Tên khách hàng không được để trống");
    }
    if (empty($username)) {
        array_push($errors, "Tên đăng nhập không được để trống");
    }
    if (empty($email)) {
        array_push($errors, "Email không được để trống");
    }
    if (empty($phone)) {
        array_push($errors, "Số điện thoại không được để trống");
    }
    if (empty($password)) {
        array_push($errors, "Mật khẩu không được để trống");
    }
    if (empty($diachi)) {
        array_push($errors, "Địa chỉ không được để trống");
    }
    
    // Nếu là nông dân, kiểm tra trường địa chỉ vườn
    if ($isNongDan && empty($dia_chi_vuon)) {
        array_push($errors, "Địa chỉ vườn không được để trống nếu bạn là nông dân");
    }

    // Kiểm tra username hoặc email có bị trùng hay không
    $sql = "SELECT * FROM khachhang WHERE ten_dangnhap = '$username' OR email = '$email'";
    $result = mysqli_query($conn, $sql);

    // Nếu username hoặc email đã tồn tại trong CSDL
    if (mysqli_num_rows($result) > 0) {
        echo '<script language="javascript">alert("Bị trùng tên đăng nhập hoặc trùng email!"); window.location="index.php?act=register";</script>';
    } else {
        // Kiểm tra nếu không có lỗi nào
        if (empty($errors)) {
            // Nếu là nông dân, thêm địa chỉ vườn
            if ($isNongDan == 1) {
                $sql = "INSERT INTO khachhang (ten_kh, ten_dangnhap, mat_khau, email, phone, dia_chi, is_nongdan, diachivuon) 
                        VALUES ('$name', '$username', '$hashed_password', '$email', '$phone', '$diachi', '$isNongDan', '$dia_chi_vuon')";
            } else {
                $sql = "INSERT INTO khachhang (ten_kh, ten_dangnhap, mat_khau, email, phone, dia_chi, is_nongdan) 
                        VALUES ('$name', '$username', '$hashed_password', '$email', '$phone', '$diachi', '$isNongDan')";
            }

            // Thực thi truy vấn
            if (mysqli_query($conn, $sql)) {
                echo '<script language="javascript">alert("Đăng ký thành công!"); window.location="index.php?act=login";</script>';
            } else {
                echo '<script language="javascript">alert("Có lỗi trong quá trình xử lý"); window.location="index.php?act=register";</script>';
            }
        } else {
            // Hiển thị danh sách lỗi nếu có
            foreach ($errors as $error) {
                echo '<script language="javascript">alert("' . $error . '");</script>';
            }
        }
    }
}
?>
