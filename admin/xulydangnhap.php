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
    $_SESSION['idnhanvien'] = $row['id'];
    $_SESSION['tennhanvien'] = $row['ten_nv'];
    header("location:admin.php?dn=true");
} else {
    header("location:index.php?dn=false");
}

exit();
?>