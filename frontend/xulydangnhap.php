<!-- Thêm toastr CSS và JS vào file HTML -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
function showNotification(message) {
    toastr.success(message);
}
</script>

<?php
// Khai báo sử dụng session
// session_start();
// // Khai báo utf-8 để hiển thị được tiếng việt
// header('Content-Type: text/html; charset=UTF-8');

// Xử lý đăng nhập
if (isset($_POST['dangnhap'])) {
    // Kết nối tới database
    $conn = mysqli_connect('localhost', 'root', '', 'bannuocdb') or die('Lỗi kết nối');
    mysqli_set_charset($conn, "utf8");

    // Lấy dữ liệu nhập vào
    $username = addslashes($_POST['username']);
    $password = addslashes($_POST['password']);

    if ($username == "" || $password == "") {
        echo '<br><p style="color:red;">Username hoặc Password không được để trống!</p>';
    } else {
        // Lấy mật khẩu đã băm từ cơ sở dữ liệu
        $sql = "SELECT id, ten_dangnhap, mat_khau, trangthai, is_nongdan FROM khachhang WHERE ten_dangnhap = '$username'";
        $query = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($query);

        if ($num_rows == 0) {
            echo '<br><p style="color:red;">Tên đăng nhập hoặc mật khẩu không đúng ! </p>';
        } else {
            $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
            // Kiểm tra mật khẩu bằng password_verify
            if (password_verify($password, $row['mat_khau'])) {
                // Tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
                if ($row['trangthai'] == 1) {
                    echo "<script type='text/javascript'>alert('Tài khoản của bạn đã bị khóa');window.location='index.php?act=login';</script>";
                } else {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['ten_dangnhap'] = $username;
                    $_SESSION['quyen'] = '7';
                    $_SESSION['isNongDan'] = $row['is_nongdan'];
                    echo "<script>
                            showNotification('Đăng nhập thành công!');
                            setTimeout(() => {
                                window.location = 'index.php';
                            }, 1000);
                        </script>";
                }
            } else {
                echo '<br><p style="color:red;">Tên đăng nhập hoặc mật khẩu không đúng ! </p>';
            }
        }
    }
}
?>