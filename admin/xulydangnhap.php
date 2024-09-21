<?php
session_start();
$user = $_POST['username'];
$pass = $_POST['password'];
$conn = mysqli_connect("localhost", "root", "", "bannuocdb");

// Use prepared statements to prevent SQL Injection
$sql = "SELECT * FROM taikhoang WHERE username = ? AND pass = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $user, $pass);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_array($result);

if ($row) {
    if ($row['trang_thai'] == '1') {
        header("location:index.php?dn=khoa");
        exit();
    }
    
    $_SESSION['nguoidung'] = $row['fullname'];
    $_SESSION['quyen'] = $row['id_quyen'];
    $_SESSION['user'] = $row['username'];
    
    // Check the `nhanvien` table if the user exists in the `taikhoang` table
    $sql2 = "SELECT * FROM nhanvien WHERE ten_dangnhap = ? AND mat_khau = ?";
    $stmt2 = mysqli_prepare($conn, $sql2);
    mysqli_stmt_bind_param($stmt2, "ss", $user, $pass);
    mysqli_stmt_execute($stmt2);
    $result2 = mysqli_stmt_get_result($stmt2);
    $row2 = mysqli_fetch_array($result2);
    
    if ($row2) {
        $_SESSION['nguoidung1'] = $row2['ten_nv'];
        $_SESSION['quyen1'] = $row2['id_quyen'];
        $_SESSION['user'] = $row2['ten_dangnhap'];
    }
    
    header("location:admin.php?dn=true");
} else {
    header("location:index.php?dn=false");
}

exit();
?>
