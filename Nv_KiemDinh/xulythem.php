<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="css/slick.css" />
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/admin_style.css">

</head>

<body>

<?php
    include_once('function.php');
    include_once('connect_db.php');
    if (isset($_POST['btnkd'])) {
        // Đếm số checkbox được check (trangthai là một mảng chứa giá trị "on" nếu checkbox được check)
        $countChecked = 0;
        if (isset($_POST['trangthai']) && is_array($_POST['trangthai'])) {
            $countChecked = count($_POST['trangthai']);
        }
    
        // Cập nhật giá trị của $trangthai dựa trên số checkbox đã được check
        if ($countChecked >= 5) {
            $trangthai = 5;
        } else {
            $trangthai = 3;
        }
    
        // Cập nhật giá trị của cột trangthai trong bảng sanpham
        $sql = "UPDATE `sanpham` SET `trangthai` = '" . $trangthai . "' WHERE `sanpham`.`id` = " . $_GET['id'] . " ";
        $result = execute($sql);
    
        // Chuyển hướng sau khi cập nhật
        header("location:./admin.php?act=khtttc&dk=yes");
    }  

    session_start(); // Đảm bảo rằng session đã được khởi tạo

    if (isset($_POST['btnadd_qr'])) {
        // Kiểm tra tất cả các trường có giá trị không rỗng
        if (!empty($_POST['xuatsu']) && !empty($_POST['phanbon']) && !empty($_POST['chatluong']) && 
            !empty($_POST['dotuoi']) && !empty($_POST['antoanthucpham']) && 
            !empty($_POST['tinhhopphapnguongoc']) && !empty($_POST['dieukienbaoquan']) && 
            !empty($_POST['phantichvisinhvat']) && !empty($_POST['id'])) {

            $id = $_POST['id'];

            // Kết nối cơ sở dữ liệu
            $conn = mysqli_connect("localhost", "root", "", "bannuocdb");

            // Kiểm tra kết nối
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Lấy và bảo vệ dữ liệu POST
            $qr1 = mysqli_real_escape_string($conn, $_POST['xuatsu']);
            $qr2 = mysqli_real_escape_string($conn, $_POST['phanbon']);
            $qr3 = mysqli_real_escape_string($conn, $_POST['chatluong']);
            $qr4 = mysqli_real_escape_string($conn, $_POST['dotuoi']);
            $qr5 = mysqli_real_escape_string($conn, $_POST['antoanthucpham']);
            $qr6 = mysqli_real_escape_string($conn, $_POST['tinhhopphapnguongoc']);
            $qr7 = mysqli_real_escape_string($conn, $_POST['dieukienbaoquan']);
            $qr8 = mysqli_real_escape_string($conn, $_POST['phantichvisinhvat']);

            // Truy vấn cập nhật thông tin QR
            $stmt = $conn->prepare("UPDATE sanpham SET 
                xuatsu = ?, phanbon = ?, chatluong = ?, dotuoi = ?, 
                antoanthucpham = ?, tinhhopphapnguongoc = ?, dieukienbaoquan = ?, 
                phantichvisinhvat = ? WHERE id = ?");
            
            // Gán các tham số
            $stmt->bind_param("ssssssssi", $qr1, $qr2, $qr3, $qr4, $qr5, $qr6, $qr7, $qr8, $id);

            // Thực thi truy vấn
            if ($stmt->execute()) {
                // Cập nhật trạng thái của sản phẩm thành 2
                $stmt2 = $conn->prepare("UPDATE sanpham SET trangthai = ? WHERE id = ?");
                $trangthai = 2; // Giá trị trạng thái là 2
                $stmt2->bind_param("ii", $trangthai, $id);

                if ($stmt2->execute()) {
                    // Chuyển hướng nếu thành công
                    header("Location: ./nvkiemdinh.php?act=suaqr&dk=yes");
                    exit(); // Đảm bảo không thực thi mã nào khác
                } else {
                    // Hiển thị lỗi SQL nếu có
                    echo "Error updating status: " . $stmt2->error;
                    // Chuyển hướng nếu thất bại
                    header("Location: ./nvkiemdinh.php?act=suaqr&dk=no");
                    exit(); // Đảm bảo không thực thi mã nào khác
                }

                // Đóng câu lệnh và kết nối
                $stmt2->close();
            } else {
                // Hiển thị lỗi SQL nếu có
                echo "Error: " . $stmt->error;
                // Chuyển hướng nếu thất bại
                header("Location: ./nvkiemdinh.php?act=suaqr&dk=no");
                exit(); // Đảm bảo không thực thi mã nào khác
            }

            $stmt->close();
            mysqli_close($conn);

        } else {
            // Chuyển hướng nếu có trường rỗng hoặc thiếu 'id'
            header("Location: ./nvkiemdinh.php?act=suaqr&dk=noid");
            exit(); // Đảm bảo không thực thi mã nào khác
        }
    }

?>
</body>

</html>