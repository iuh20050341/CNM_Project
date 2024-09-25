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
    if (isset($_POST['btnadd'])) {
        if (isset($_POST['name']))
            if ($_POST['name'] != '') {
                if (isset($_POST['price']))
                    if ($_POST['price'] != '') {
                        if (isset($_POST['idtl']))
                            if ($_POST['idtl'] != '') {
                                if (isset($_POST['idncc']))
                                    if ($_POST['idncc'] != '') {
                                        if (isset($_POST['content']))
                                            if ($_POST['content'] != '') {
                                                $conn = mysqli_connect("localhost", "root", "", "bannuocdb");
                                                $namei = $_POST['name'];
                                                $price = $_POST['price'];
                                                // $image=$_FILES['image'];
                                                $idtl = $_POST['idtl'];
                                                $idncc = $_POST['idncc'];
                                                $content = $_POST['content'];
                                                $check_sql = "SELECT * FROM `sanpham` WHERE `ten_sp` = '$namei'";
                                                $check_result = mysqli_query($conn, $check_sql);

                                                if (mysqli_num_rows($check_result) > 0) {
                                                    // Tên đã tồn tại
                                                    header("location:./admin.php?act=addsptc&dk=no");
                                                } else {
                                                    if ($_FILES['image']['name'] != NULL) {
                                                        // Kiểm tra file up lên có phải là ảnh không
                                                        if ($_FILES['image']['type'] == "image/jpeg" || $_FILES['image']['type'] == "image/png" || $_FILES['image']['type'] == "image/gif") {

                                                            // Nếu là ảnh tiến hành code upload
                                                            $path1 = ""; // Ảnh sẽ lưu vào thư mục images
                                                            $path2 = "../img/";
                                                            $tmp_name = $_FILES['image']['tmp_name'];
                                                            $name = $_FILES['image']['name'];
                                                            // Upload ảnh vào thư mục images
                                                            move_uploaded_file($tmp_name, $path2 . $name);
                                                            $image_url = $path1 . $name; // Đường dẫn ảnh lưu vào cơ sở dữ liệu
                                                            // Insert ảnh vào cơ sở dữ liệu
                                                            $sql1 = "INSERT INTO `sanpham` (`ten_sp`, `hinh_anh`, `don_gia`, `noi_dung`,`so_luong`,`id_the_loai`,`id_nha_cc`,`trangthai`) VALUES ('$namei','$image_url', " . str_replace('.', '', $price) . ", '$content',0,'$idtl','$idncc',0);";
                                                            $result1 = mysqli_query($conn, $sql1);
                                                            if (isset($_FILES['gallery']))
                                                                if ($_FILES['gallery'] != '') {
                                                                    $uploadedFiles = $_FILES['gallery'];
                                                                    @$result = uploadFiles($uploadedFiles);
                                                                    if ($result) {
                                                                        $galleryImages = $result['uploaded_files'];
                                                                        if (!empty($galleryImages)) {
                                                                            $product_id = $conn->insert_id;
                                                                            $insertValues = "";
                                                                            foreach ($galleryImages as $path) {
                                                                                if (empty($insertValues)) {
                                                                                    $insertValues = "( " . $product_id . ", '" . $path . "')";
                                                                                } else {
                                                                                    $insertValues .= ",( " . $product_id . ", '" . $path . "')";
                                                                                }
                                                                            }
                                                                            $result = mysqli_query($conn, "INSERT INTO `hinhanhsp` ( `id_sp`, `hinh_anh`) VALUES " . $insertValues . ";");
                                                                        }
                                                                    } else
                                                                        "ko them duoc";
                                                                }
                                                            if ($result1) {
                                                                // $result2 = mysqli_query($conn,"SELECT COUNT(`id_the_loai`) AS cid_the_loai FROM `sanpham` WHERE `id_the_loai`='$idtl'");
                                                                // $r=mysqli_fetch_array($result2);
                                                                // $result3 = mysqli_query($conn,"UPDATE `theloai` SET `tong_sp`=".$r['cid_the_loai']." WHERE `id`=$idtl");
                                                                // if ($result3) { 
                                                                header('location:admin.php?act=addsptc&dk=yes');
                                                                // }else header("location:./admin.php?act=addsptc&dk=no");
                                                            } else
                                                                header("location:./admin.php?act=addsptc&dk=no");
                                                        }
                                                    }
                                                }
                                            } else
                                                header("location:./admin.php?act=addsptc&dk=no");
                                    } else
                                        header("location:./admin.php?act=addsptc&dk=no");
                            } else
                                header("location:./admin.php?act=addsptc&dk=no");
                    } else
                        header("location:./admin.php?act=addsptc&dk=no");
            } else
                header("location:./admin.php?act=addsptc&dk=no");
    }
    if (isset($_POST['btnsua'])) {
        if (isset($_POST['name']))
            if ($_POST['name'] != '') {
                if (isset($_POST['price']))
                    if ($_POST['price'] != '') {
                        if (isset($_POST['idtl']))
                            if ($_POST['idtl'] != '') {
                                if (isset($_POST['idncc']))
                                    if ($_POST['idncc'] != '') {
                                        if (isset($_POST['content']))
                                            if ($_POST['content'] != '') {
                                                if (isset($_POST['trangthai']) == "on")
                                                    $trangthai = 0;
                                                if (isset($_POST['trangthai']) == NULL)
                                                    $trangthai = 1;
                                                include_once('function.php');
                                                $con = mysqli_connect("localhost", "root", "", "bannuocdb");
                                                $result4 = mysqli_query($con, "SELECT `id_the_loai` FROM `sanpham` WHERE `id`=" . $_GET['id'] . "");
                                                $r2 = mysqli_fetch_array($result4);
                                                if (isset($_FILES['gallery']) && !empty($_FILES['gallery']['name'][0])) {
                                                    $uploadedFiles = $_FILES['gallery'];
                                                    $result = uploadFiles($uploadedFiles);
                                                    $galleryImages = $result['uploaded_files'];
                                                }
                                                if (!empty($_POST['gallery_image'])) {
                                                    $galleryImages = array_merge($galleryImages, $_POST['gallery_image']);
                                                }
                                                if (!isset($image_url) && !empty($_POST['image'])) {
                                                    $image_url = $_POST['image'];
                                                }
                                                if ($_FILES['image']['name'] != NULL) {
                                                    // Kiểm tra file up lên có phải là ảnh không
                                                    if ($_FILES['image']['type'] == "image/jpeg" || $_FILES['image']['type'] == "image/png" || $_FILES['image']['type'] == "image/gif") {

                                                        // Nếu là ảnh tiến hành code upload
                                                        $path1 = "";
                                                        $path = "../img/"; // Ảnh sẽ lưu vào thư mục images
                                                        $tmp_name = $_FILES['image']['tmp_name'];
                                                        $name = $_FILES['image']['name'];
                                                        // Upload ảnh vào thư mục images
                                                        move_uploaded_file($tmp_name, $path . $name);
                                                        $image_url = $path1 . $name; // Đường dẫn ảnh lưu vào cơ sở dữ liệu
                                                        // Insert ảnh vào cơ sở dữ liệu
                                                    }
                                                }
                                                $result1 = mysqli_query($con, "UPDATE `sanpham` SET `ten_sp` = '" . $_POST['name'] . "',`hinh_anh` =  '$image_url', `don_gia` = " . str_replace('.', '', $_POST['price']) . ", `noi_dung` = '" . $_POST['content'] . "', `ngay_sua` = " . time() . ",`id_the_loai` =" . $_POST['idtl'] . ",`id_nha_cc`=" . $_POST['idncc'] . ",`trangthai`=" . $trangthai . " WHERE `sanpham`.`id` = " . $_GET['id']);
                                                if (!empty($galleryImages)) {
                                                    $product_id = ($_GET['act'] == 'sua' && !empty($_GET['id'])) ? $_GET['id'] : $con->insert_id;
                                                    $insertValues = "";
                                                    foreach ($galleryImages as $path) {
                                                        if (empty($insertValues)) {
                                                            $insertValues = "( " . $product_id . ", '" . $path . "')";
                                                        } else {
                                                            $insertValues .= ",( " . $product_id . ", '" . $path . "')";
                                                        }
                                                    }
                                                    $result = mysqli_query($con, "INSERT INTO `hinhanhsp` ( `id_sp`, `hinh_anh`) VALUES " . $insertValues . ";");
                                                    echo "cap nhat thanh cong";
                                                }
                                                if ($result1) {
                                                    // $result5 = mysqli_query($con,"SELECT COUNT(`id_the_loai`) AS cid_the_loai FROM `sanpham` WHERE `id_the_loai`=".$r2['id_the_loai']."");
                                                    // $r5=mysqli_fetch_array($result5);
                                                    // $result6 = mysqli_query($con,"UPDATE `theloai` SET `tong_sp`=".$r5['cid_the_loai']." WHERE `id`=".$r2['id_the_loai']."");
                                                    // $result2 = mysqli_query($con,"SELECT COUNT(`id_the_loai`) AS cid_the_loai FROM `sanpham` WHERE `id_the_loai`=".$_POST['idtl']."");
                                                    // $r=mysqli_fetch_array($result2);
                                                    // $result3 = mysqli_query($con,"UPDATE `theloai` SET `tong_sp`=".$r['cid_the_loai']." WHERE `id`=".$_POST['idtl']."");
                                                    // if ($result6&&$result3) { 
                                                    header("location:./admin.php?act=suasptc&dk=yes");
                                                    // else header("location:./admin.php?act=suasptc&dk=no"); 
                                                } else
                                                    header("location:./admin.php?act=suasptc&dk=no");
                                            } else
                                                header("location:./admin.php?act=suasptc&dk=no");
                                    } else
                                        header("location:./admin.php?act=suasptc&dk=no");
                            } else
                                header("location:./admin.php?act=suasptc&dk=no");
                    } else
                        header("location:./admin.php?act=suasptc&dk=no");
            } else
                header("location:./admin.php?act=suasptc&dk=no");
    }
    if (isset($_POST['btntladd'])) {
        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $namei = mysqli_real_escape_string($con, $_POST['name']);

            // Kiểm tra xem tên thể loại đã tồn tại chưa
            $check_sql = "SELECT * FROM `theloai` WHERE `ten_tl` = '$namei'";
            $check_result = mysqli_query($con, $check_sql);

            if (mysqli_num_rows($check_result) > 0) {
                // Tên đã tồn tại
                header("Location: ./admin.php?act=addtltc&dk=trung");
            } else {
                // Tên chưa tồn tại, tiếp tục thêm mới
                $sql = "INSERT INTO `theloai`(`ten_tl`) VALUES ('$namei')";
                $result = mysqli_query($con, $sql);

                if ($result) {
                    header("Location: ./admin.php?act=addtltc&dk=yes");
                } else {
                    header("Location: ./admin.php?act=addtltc&dk=no");
                }
            }
        } else {
            header("Location: ./admin.php?act=addtltc&dk=no");
        }
    }

    if (isset($_POST['btnvcadd'])) {
        if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['price']) && !empty($_POST['price'])) {
            $name = mysqli_real_escape_string($con, $_POST['name']);
            $price = mysqli_real_escape_string($con, $_POST['price']);

            // Kiểm tra xem tên phương thức vận chuyển đã tồn tại chưa
            $check_sql = "SELECT * FROM `phuongthucvanchuyen` WHERE `name` = '$name'";
            $check_result = mysqli_query($con, $check_sql);

            if (mysqli_num_rows($check_result) > 0) {
                // Tên đã tồn tại
                header("Location: ./admin.php?act=addvctc&dk=trung");
            } else {
                // Tên chưa tồn tại, tiếp tục thêm mới
                $sql = "INSERT INTO `phuongthucvanchuyen`(`name`, `price`) VALUES ('$name', '$price')";
                $result = mysqli_query($con, $sql);

                if ($result) {
                    header("Location: ./admin.php?act=addvctc&dk=yes");
                } else {
                    header("Location: ./admin.php?act=addvctc&dk=no");
                }
            }
        } else {
            header("Location: ./admin.php?act=addvctc&dk=no");
        }
    }

    if (isset($_POST['btnttadd'])) {
        if (isset($_POST['name']))
            if ($_POST['name'] != '') {
                $name = $_POST['name'];
                $sql = "INSERT INTO `phuongthucthanhtoan`(`name`) VALUES ('$name')";
                $result = mysqli_query($con, $sql);
                if ($result)
                    header("location:./admin.php?act=addtttc&dk=yes");
                else
                    header("location:./admin.php?act=addtttc&dk=no");
            } else
                header("location:./admin.php?act=addtttc&dk=no");
    }
    if (isset($_POST['btntlsua'])) {
        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $name = mysqli_real_escape_string($con, $_POST['name']);
            $id = isset($_GET['id']) ? (int) $_GET['id'] : 0; // Kiểm tra và ép kiểu id thành số nguyên để an toàn hơn
    
            if ($id > 0) {
                // Kiểm tra xem tên thể loại đã tồn tại chưa
                $check_sql = "SELECT * FROM `theloai` WHERE `ten_tl` = '$name'";
                $check_result = mysqli_query($con, $check_sql);

                if (mysqli_num_rows($check_result) > 0) {
                    // Tên đã tồn tại
                    header("location:./admin.php?act=suatltc&dk=trung");
                } else {
                    // Tên chưa tồn tại, tiếp tục cập nhật
                    $update_sql = "UPDATE `theloai` SET `ten_tl` = '$name' WHERE `id` = $id";
                    $result1 = mysqli_query($con, $update_sql);

                    if ($result1) {
                        header("location:./admin.php?act=suatltc&dk=yes");
                    } else {
                        header("location:./admin.php?act=suatltc&dk=no");
                    }
                }
            } else {
                header("location:./admin.php?act=suatltc&dk=no");
            }
        } else {
            header("location:./admin.php?act=suatltc&dk=no");
        }
    }

    if (isset($_POST['btnvcsua'])) {
        if (isset($_POST['name']))
            if ($_POST['name'] != '') {
                if (isset($_POST['price']))
                    if ($_POST['price'] != '') {
                        $check_sql = "SELECT * FROM `phuongthucvanchuyen` WHERE `name` = '" . $_POST['name'] . "'";
                        $check_result = mysqli_query($con, $check_sql);

                        if (mysqli_num_rows($check_result) > 0) {
                            // Tên đã tồn tại
                            header("location:./admin.php?act=suavctc&dk=trung");
                        } else {
                            $con = mysqli_connect("localhost", "root", "", "bannuocdb");
                            $result1 = mysqli_query($con, "UPDATE `phuongthucvanchuyen` SET `name` = '" . $_POST['name'] . "', `price` = '" . $_POST['price'] . "'WHERE `phuongthucvanchuyen`.`id` = " . $_GET['id'] . " ");
                            if ($result1)
                                header("location:./admin.php?act=suavctc&dk=yes");
                            else
                                header("location:./admin.php?act=suavctc&dk=no");
                        }
                    } else
                        header("location:./admin.php?act=suavctc&dk=no");
            } else
                header("location:./admin.php?act=suavctc&dk=no");

    }
    if (isset($_POST['btnttsua'])) {
        if (isset($_POST['name']))
            if ($_POST['name'] != '') {
                $con = mysqli_connect("localhost", "root", "", "bannuocdb");
                $result1 = mysqli_query($con, "UPDATE `phuongthucthanhtoan` SET `name` = '" . $_POST['name'] . "' WHERE `phuongthucthanhtoan`.`id` = " . $_GET['id'] . " ");
                if ($result1)
                    header("location:./admin.php?act=suatttc&dk=yes");
                else
                    header("location:./admin.php?act=suatttc&dk=no");
            } else
                header("location:./admin.php?act=suatttc&dk=no");

    }
    if (isset($_POST['btnnccadd'])) {
        if (isset($_POST['name']))
            if ($_POST['name'] != '') {
                if (isset($_POST['email']))
                    if ($_POST['email'] != '') {
                        if (isset($_POST['website']))
                            if ($_POST['website'] != '') {
                                if (isset($_POST['sdt']))
                                    if ($_POST['sdt'] != '') {
                                        $sql = "INSERT INTO `nhacungcap`(`ten_ncc`, `email`, `web_site`,`phone`) VALUES ('" . $_POST['name'] . "','" . $_POST['email'] . "','" . $_POST['website'] . "','" . $_POST['sdt'] . "')";
                                        $result = execute($sql);
                                        header("location:./admin.php?act=nccaddtc&dk=yes");
                                    } else
                                        header("location:./admin.php?act=nccaddtc&dk=no");
                            } else
                                header("location:./admin.php?act=nccaddtc&dk=no");
                    } else
                        header("location:./admin.php?act=nccaddtc&dk=no");
            } else
                header("location:./admin.php?act=nccaddtc&dk=no");
    }
    // if (isset($_POST['btnnccdat'])) {
    //     if ($_POST['sldat'] != "") {
    //         if (is_int(intval($_POST['sldat']))) {
    //             $con = mysqli_connect("localhost", "root", "", "bannuocdb");
    //             $sanpham = mysqli_query($con, "SELECT `so_luong` FROM `sanpham` WHERE `id` = " . $_GET['id'] . "");
    //             $b = mysqli_fetch_array($sanpham);
    //             $a = $_POST['sldat'] + $b['so_luong'];
    //             $result1 = execute("UPDATE `sanpham` SET `so_luong` = '$a' WHERE `sanpham`.`id` = " . $_GET['id'] . " ");
    //         }
    
    //     }
    
    //     echo "xin chao";
    // }
    if (isset($_POST['btnkhtt'])) {
        if (isset($_POST['trangthai']) == "on")
            $trangthai = 0;
        if (isset($_POST['trangthai']) == NULL)
            $trangthai = 1;
        $sql = "UPDATE `khachhang` SET `trangthai` = '" . $trangthai . "' WHERE `khachhang`.`id` = " . $_GET['id'] . " ";
        $result = execute($sql);
        header("location:./admin.php?act=khtttc&dk=yes");
    }
    if (isset($_POST['btn_nd'])) {
        if (isset($_POST['trangthai']) == "on")
            $trangthai = 0;
        if (isset($_POST['trangthai']) == NULL)
            $trangthai = 1;
        $sql = "UPDATE `khachhang` SET `trangthai` = '" . $trangthai . "' WHERE `khachhang`.`id` = " . $_GET['id'] . " ";
        $result = execute($sql);
        if ($result) {
            echo "<script>
                alert('Thất bại!');
                window.location.href = 'admin.php?tmuc=Quản lý doanh thu';
            </script>";
        } else {
            echo "<script>
                alert('Thành công!');
                window.location.href = 'admin.php?tmuc=Quản lý doanh thu';
            </script>";
        }
    }
    if (isset($_POST['btnnvadd'])) {
        if (isset($_POST['name']))
            if ($_POST['name'] != '') {
                // if (isset($_POST['tendangnhap'])) {
                //     if ($_POST['tendangnhap'] != '') {
                if (isset($_POST['sdt']))
                    if ($_POST['sdt'] != '') {
                        if (isset($_POST['email']))
                            if ($_POST['email'] != '') {
                                if ($_POST['tendangnhap'] != '')
                                    $tendangnhap = null;
                                $sql1 = "INSERT INTO `nhanvien`(`ten_nv`,`ten_dangnhap`,`email`,`phone`) VALUES ('" . $_POST['name'] . "','" . $_POST['tendangnhap'] . "','" . $_POST['email'] . "','" . $_POST['sdt'] . "')";
                                $result = mysqli_query($con, $sql1);
                                if ($result)
                                    header("location:./admin.php?act=addnvtc&dk=yes");
                                else
                                    header("location:./admin.php?act=addnvtc&dk=no");
                            } else
                                header("location:./admin.php?act=addnvtc&dk=no");
                    } else
                        header("location:./admin.php?act=addnvtc&dk=no");
                //     } else header("location:./admin.php?act=addnvtc&dk=no");
                // } else header("location:./admin.php?act=addnvtc&dk=no");
            } else
                header("location:./admin.php?act=addnvtc&dk=no");
    }
    if (isset($_POST['btnnvsua'])) {
        if (isset($_POST['name']))
            if ($_POST['name'] != '') {
                if (isset($_POST['sdt']))
                    if ($_POST['sdt'] != '') {
                        // if (isset($_POST['tendangnhap']))
                        //     if ($_POST['tendangnhap'] != '') {
                        if (isset($_POST['email']))
                            if ($_POST['email'] != '') {
                                if ($_POST['tendangnhap'] != '')
                                    $tendangnhap = null;
                                $con = mysqli_connect("localhost", "root", "", "bannuocdb");
                                $result1 = mysqli_query($con, "UPDATE `nhanvien` SET `ten_nv` = '" . $_POST['name'] . "',`email` = '" . $_POST['email'] . "',`phone` = '" . $_POST['sdt'] . "',`ten_dangnhap` = '" . $_POST['tendangnhap'] . "' WHERE `nhanvien`.`id` = " . $_GET['id'] . " ");
                                if ($result1)
                                    header("location:./admin.php?act=suanvtc&dk=yes");
                                else
                                    header("location:./admin.php?act=suanvtc&dk=no");
                            } else
                                header("location:./admin.php?act=suanvtc&dk=no");
                        // } else header("location:./admin.php?act=suanvtc&dk=no");
                    } else
                        header("location:./admin.php?act=suanvtc&dk=no");
            } else
                header("location:./admin.php?act=suanvtc&dk=no");
    }
    if (isset($_POST['btntkmk'])) {
        if (isset($_POST['matkhaumoi']))
            if ($_POST['matkhaumoi'] != '') {
                $result1 = mysqli_query($con, "UPDATE `taikhoang` SET `pass` = '" . $_POST['matkhaumoi'] . "' WHERE `username` = '" . $_GET['user'] . "'");
                var_dump($result1);
                if ($result1)
                    header("location:./admin.php?act=tkmktc&dk=yes");
                else
                    header("location:./admin.php?act=tkmktc&dk=no");
            } else
                header("location:./admin.php?act=tkmktc&dk=no");
    }
    if (isset($_POST['btntkadd'])) {
        if (isset($_POST['tendangnhap']))
            if ($_POST['tendangnhap'] != '') {
                if (isset($_POST['matkhau']))
                    if ($_POST['matkhau'] != '') {
                        if (isset($_POST['name']))
                            if ($_POST['name'] != '') {
                                $sql2 = "INSERT INTO `taikhoang`(`id_quyen`,`username`,`pass`,`fullname`) VALUES (1,'" . $_POST['tendangnhap'] . "','" . $_POST['matkhau'] . "','" . $_POST['name'] . "')";
                                $result1 = mysqli_query($con, $sql2);
                                if ($result1)
                                    header("location:./admin.php?act=addtktc&dk=yes");
                                else
                                    header("location:./admin.php?act=addtktc&dk=no");
                            } else
                                header("location:./admin.php?act=addtktc&dk=no");
                    } else
                        header("location:./admin.php?act=addtktc&dk=no");
            } else
                header("location:./admin.php?act=addtktc&dk=no");
    }
    if (isset($_POST['btntksua'])) {
        if (isset($_POST['quyen']))
            if ($_POST['quyen'] != '') {
                if (isset($_POST['trangthai']) == "on")
                    $trangthai = 0;
                if (isset($_POST['trangthai']) == NULL)
                    $trangthai = 1;
                var_dump(intval($_POST['quyen']));
                // if ($_POST['quyen'] == '1' || $_POST['quyen'] == '2' || $_POST['quyen'] == '3' || $_POST['quyen'] == '4') {
                $result1 = mysqli_query($con, "UPDATE `taikhoang` SET `id_quyen` = '" . $_POST['quyen'] . "', `trang_thai` = ' " . $trangthai . "' WHERE `username` = '" . $_GET['id'] . "'");
                if ($result1)
                    header("location:./admin.php?act=suatktc&dk=yes");
                else
                    header("location:./admin.php?act=suatktc&dk=no");
                // } else header("location:./admin.php?act=suatktc&dk=no");
            } else
                header("location:./admin.php?act=suatktc&dk=no");
    }
    if (isset($_GET['act'])) {
        if ($_GET['act'] == 'xnhd') {
            if (isset($_GET['cuser']))
                if ($_GET['cuser'] == '') {
                    $conn = mysqli_connect("localhost", "root", "", "bannuocdb");
                    //$sql="SELECT `hoadon`.`id`, `id_khachhang`, `tong_tien`, `hoadon`.`ngay_tao`, `id_nhanvien`, `trangthai`, `ten_dangnhap`, `ten_nv`,`nhanvien`.`id` AS `idnv` FROM (`hoadon` LEFT JOIN `nhanvien` ON `nhanvien`.`id`=`id_nhanvien` ) WHERE `hoadon`.`id` = " . $_GET['id'] . "";
                    $taikhoan = mysqli_query($conn, "SELECT `id`, `ten_dangnhap` FROM `nhanvien` WHERE `id`='" . $_GET['iduser'] . "'");
                    // $hoadon=mysqli_query($conn,$sql);var_dump($hoadon);
                    $row = mysqli_fetch_array($taikhoan);
                    $result1 = mysqli_query($conn, "UPDATE `hoadon` SET `trang_thai` = '1', `deliveryStatus` = '1'  ,`id_nhanvien` = '" . $row['id'] . "',`ngay_tao`=`ngay_tao` WHERE `id` = '" . $_GET['id'] . "'");
                    if ($result1)
                        header("location:./admin.php?act=xnhdtc&dk=yes");
                    else
                        header("location:./admin.php?act=xnhdtc&dk=no");
                } else
                    header("location:./admin.php?act=xnhdtc&dk=no");
        }
    }
    if (isset($_GET['act'])) {
        if ($_GET['act'] == 'xnhdvc') {
            if (isset($_GET['cuser']))
                if ($_GET['cuser'] == '') {
                    $conn = mysqli_connect("localhost", "root", "", "bannuocdb");
                    //$sql="SELECT `hoadon`.`id`, `id_khachhang`, `tong_tien`, `hoadon`.`ngay_tao`, `id_nhanvien`, `trangthai`, `ten_dangnhap`, `ten_nv`,`nhanvien`.`id` AS `idnv` FROM (`hoadon` LEFT JOIN `nhanvien` ON `nhanvien`.`id`=`id_nhanvien` ) WHERE `hoadon`.`id` = " . $_GET['id'] . "";
                    $taikhoan = mysqli_query($conn, "SELECT `id`, `ten_dangnhap` FROM `nhanvien` WHERE `id`='" . $_GET['iduser'] . "'");
                    // $hoadon=mysqli_query($conn,$sql);var_dump($hoadon);
                    $row = mysqli_fetch_array($taikhoan);
                    if (isset($_GET['type'])) {
                        $result1 = mysqli_query($conn, "UPDATE `hoadon` SET `deliveryStatus` = '" . $_GET['type'] . "'  ,`id_nhanvien` = '" . $row['id'] . "',`ngay_tao`=`ngay_tao` WHERE `id` = '" . $_GET['id'] . "'");

                    } else {
                        $result1 = mysqli_query($conn, "UPDATE `hoadon` SET `trang_thai` = '1', `deliveryStatus` = '1'  ,`id_nhanvien` = '" . $row['id'] . "',`ngay_tao`=`ngay_tao` WHERE `id` = '" . $_GET['id'] . "'");
                    }
                    if ($result1)
                        header("location:./admin.php?act=xnhdvctc&dk=yes");
                    else
                        header("location:./admin.php?act=xnhdvctc&dk=no");
                } else
                    header("location:./admin.php?act=xnhdvctc&dk=no");
        }
    }
    // if (isset($_POST['btndm1'])) {
    //     $data=$_POST;
    //     $inserts="";
    //     $deleted=mysqli_query($con,"DELETE FROM `quyendahmuc` WHERE `id_quyen`=1");
    //     foreach($data['row1'] as $insertid){
    //         $inserts .= !empty($inserts) ? "," : "";
    //         $inserts .= "(1,".$insertid.")";
    //     }
    //     $inserted=mysqli_query($con,"INSERT INTO `quyendahmuc`(`id_quyen`, `id_danhmuc`) VALUES ".$inserts."");
    //     header("location:./admin.php?act=btndmtc&dk=yes");
    // }
    // if (isset($_POST['btndm2'])) {
    //     $data=$_POST;
    //     $inserts="";
    //     $deleted=mysqli_query($con,"DELETE FROM `quyendahmuc` WHERE `id_quyen`=2");
    //     foreach($data['row2'] as $insertid){
    //         $inserts .= !empty($inserts) ? "," : "";
    //         $inserts .= "(2,".$insertid.")";
    //     }
    //     $inserted=mysqli_query($con,"INSERT INTO `quyendahmuc`(`id_quyen`, `id_danhmuc`) VALUES ".$inserts."");
    //     header("location:./admin.php?act=btndmtc&dk=yes");
    // }
    // if (isset($_POST['btndm3'])) {
    //     $data=$_POST;
    //     $inserts="";
    //     $deleted=mysqli_query($con,"DELETE FROM `quyendahmuc` WHERE `id_quyen`=3");
    //     foreach($data['row3'] as $insertid){
    //         $inserts .= !empty($inserts) ? "," : "";
    //         $inserts .= "(3,".$insertid.")";
    //     }
    //     $inserted=mysqli_query($con,"INSERT INTO `quyendahmuc`(`id_quyen`, `id_danhmuc`) VALUES ".$inserts."");
    //     header("location:./admin.php?act=btndmtc&dk=yes");
    // }
    // if (isset($_POST['btndm4'])) {
    //     $data=$_POST;
    //     var_dump($data);
    //     $inserts="";
    //     $deleted=mysqli_query($con,"DELETE FROM `quyendahmuc` WHERE `id_quyen`=4");
    //     foreach($data['row4'] as $insertid){
    //         $inserts .= !empty($inserts) ? "," : "";
    //         $inserts .= "(4,".$insertid.")";
    //     }
    //     $inserted=mysqli_query($con,"INSERT INTO `quyendahmuc`(`id_quyen`, `id_danhmuc`) VALUES ".$inserts."");
    
    // }
    if (isset($_POST['btndmadd'])) {
        $data = $_POST;
        $inserts = "";
        if (isset($data['row'])) {
            $them = mysqli_query($con, "INSERT INTO `quyen`(`ten_quyen`) VALUES ('" . $_POST['tendanhmuc'] . "')");
            $id_quyen = mysqli_insert_id($con);
            foreach ($data['row'] as $insertid) {
                $inserts .= !empty($inserts) ? "," : "";
                $inserts .= "(" . $id_quyen . "," . $insertid . ")";
                var_dump($data['row']);
            }

            $inserted = mysqli_query($con, "INSERT INTO `quyendahmuc`(`id_quyen`, `id_danhmuc`) VALUES " . $inserts . "");
            if ($inserted)
                header("location:./admin.php?act=btndmaddtc&dk=yes");
            else
                header("location:./admin.php?act=btndmaddtc&dk=no");
        } else
            header("location:./admin.php?act=btndmaddtc&dk=no");

        // $deleted=mysqli_query($con,"DELETE FROM `quyendahmuc` WHERE `id_quyen`=1");
        // foreach($data['row1'] as $insertid){
        //     $inserts .= !empty($inserts) ? "," : "";
        //     $inserts .= "(1,".$insertid.")";
        // }
        // $inserted=mysqli_query($con,"INSERT INTO `quyendahmuc`(`id_quyen`, `id_danhmuc`) VALUES ".$inserts."");
        // header("location:./admin.php?act=btndmtc&dk=yes");
    }
    if (isset($_POST['btndmsua'])) {
        $data = $_POST;
        $inserts = "";
        if (isset($_POST['tendanhmuc']))
            if ($_POST['tendanhmuc'] != '') {
                if (isset($data['row'])) {
                    $sua = mysqli_query($con, "UPDATE `quyen` SET `ten_quyen`='" . $_POST['tendanhmuc'] . "' WHERE `id`=" . $_GET['idq'] . "");
                    $deleted = mysqli_query($con, "DELETE FROM `quyendahmuc` WHERE `id_quyen`=" . $_GET['idq'] . "");
                    foreach ($data['row'] as $insertid) {
                        $inserts .= !empty($inserts) ? "," : "";
                        $inserts .= "(" . $_GET['idq'] . "," . $insertid . ")";
                        var_dump($inserts);
                    }

                    $inserted = mysqli_query($con, "INSERT INTO `quyendahmuc`(`id_quyen`, `id_danhmuc`) VALUES " . $inserts . "");
                    var_dump($inserted);
                    if ($inserted)
                        header("location:./admin.php?act=btndmsuatc&dk=yes");
                    else
                        header("location:./admin.php?act=btndmsuatc&dk=no");
                } else
                    header("location:./admin.php?act=btndmsuatc&dk=no");
            } else
                header("location:./admin.php?act=btndmsuatc&dk=no");

    }

    if (isset($_POST['btnkd'])) {
        // Đếm số checkbox được check (trangthai là một mảng chứa giá trị "on" nếu checkbox được check)
        $countChecked = 0;
        if (isset($_POST['trangthai']) && is_array($_POST['trangthai'])) {
            $countChecked = count($_POST['trangthai']);
        }

        // Cập nhật giá trị của $trangthai dựa trên số checkbox đã được check
        if ($countChecked >= 5) {
            $trangthai = 3;
        } else {
            $trangthai = 5;
        }

        // Cập nhật giá trị của cột trangthai trong bảng sanpham
        $sql = "UPDATE `sanpham` SET `trangthai` = '" . $trangthai . "' WHERE `sanpham`.`id` = " . $_GET['id'] . " ";
        $result = execute($sql);

        // Chuyển hướng sau khi cập nhật
        header("location:./admin.php?act=khtttc1&dk=yes");
    }

    session_start(); // Đảm bảo rằng session đã được khởi tạo
    
    if (isset($_POST['btnadd_qr'])) {
        // Kiểm tra tất cả các trường có giá trị không rỗng
        if (
            !empty($_POST['xuatsu']) && !empty($_POST['phanbon']) && !empty($_POST['chatluong']) &&
            !empty($_POST['dotuoi']) && !empty($_POST['antoanthucpham']) &&
            !empty($_POST['tinhhopphapnguongoc']) && !empty($_POST['dieukienbaoquan']) &&
            !empty($_POST['phantichvisinhvat']) && !empty($_POST['id'])
        ) {

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
                $trangthai = 4; // Giá trị trạng thái là 2
                $stmt2->bind_param("ii", $trangthai, $id);

                if ($stmt2->execute()) {
                    // Chuyển hướng nếu thành công
                    header("Location: ./admin.php?act=suaqr&dk=yes");
                    exit(); // Đảm bảo không thực thi mã nào khác
                } else {
                    // Hiển thị lỗi SQL nếu có
                    echo "Error updating status: " . $stmt2->error;
                    // Chuyển hướng nếu thất bại
                    header("Location: ./admin.php?act=suaqr&dk=no");
                    exit(); // Đảm bảo không thực thi mã nào khác
                }

                // Đóng câu lệnh và kết nối
                $stmt2->close();
            } else {
                // Hiển thị lỗi SQL nếu có
                echo "Error: " . $stmt->error;
                // Chuyển hướng nếu thất bại
                header("Location: ./admin.php?act=suaqr&dk=no");
                exit(); // Đảm bảo không thực thi mã nào khác
            }

            $stmt->close();
            mysqli_close($conn);

        } else {
            // Chuyển hướng nếu có trường rỗng hoặc thiếu 'id'
            header("Location: ./admin.php?act=suaqr&dk=noid");
            exit(); // Đảm bảo không thực thi mã nào khác
        }
    }

    if (isset($_POST['btn_pckd']) && !empty($_POST['id'])) {
        $product_id = mysqli_real_escape_string($con, $_POST['id']);
        $phancong = mysqli_real_escape_string($con, $_POST['kd']); // Dữ liệu nhập từ ô input
    
        if (!empty($phancong)) {
            // Cập nhật cột phancong trong bảng sanpham
            $updateQuery = "UPDATE sanpham SET phancong = ?, trangthai = 2 WHERE id = ?";

            // Sử dụng Prepared Statements
            $stmt = $con->prepare($updateQuery);
            $stmt->bind_param("si", $phancong, $product_id);

            if ($stmt->execute()) {
                echo "<script>alert('Phân công thành công!');
                                window.location.href = 'admin.php?tmuc=Phân công kiểm định';</script>";
            } else {
                echo "<script>alert('Phân công thất bại!');
                                window.location.href = 'admin.php?tmuc=Phân công kiểm định';</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Vui lòng chọn nhân viên kiểm định!');
                                window.location.href = 'admin.php?tmuc=Phân công kiểm định';</script>";
        }
    }

    if (isset($_POST['btn_pcvc'])) {
        $id = $_POST['id'];
        $phancong = isset($_POST['vc']) ? mysqli_real_escape_string($con, $_POST['vc']) : '';

        // Kiểm tra dữ liệu nhận được (debugging)
        // echo "ID: " . htmlspecialchars($id) . "<br>";
        // echo "Phân công: " . htmlspecialchars($phancong) . "<br>";
    
        // Cập nhật cơ sở dữ liệu
        $updateQuery = "UPDATE hoadon SET phancong = ?, deliveryStatus = 1 WHERE id = ?";
        if ($stmt = $con->prepare($updateQuery)) {
            $stmt->bind_param("si", $phancong, $id);

            if ($stmt->execute()) {
                echo "<script>alert('Phân công thành công!');
                                window.location.href = 'admin.php?tmuc=Phân công vận chuyển';</script>";
            } else {
                echo "<script>alert('Phân công thất bại! Error: " . $stmt->error . "');
                                window.location.href = 'admin.php?tmuc=Phân công vận chuyển';</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Lỗi chuẩn bị câu lệnh SQL: " . $con->error . "');
                            window.location.href = 'admin.php?tmuc=Phân công vận chuyển';</script>";
        }
    }

    if (isset($_POST['btndang'])) {
        // Kết nối cơ sở dữ liệu bằng MySQLi theo kiểu đối tượng
        $conn = new mysqli("localhost", "root", "", "bannuocdb");

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // Lấy id sản phẩm từ form
        $id = $_POST['id'];

        // Câu lệnh SQL để cập nhật trạng thái sản phẩm
        $sql = "UPDATE sanpham SET trangthai = 7 WHERE id = ?";

        // Chuẩn bị và thực thi câu lệnh
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            // Gán tham số cho câu lệnh SQL
            $stmt->bind_param("i", $id);

            // Thực thi câu lệnh
            if ($stmt->execute()) {
                echo "<script>
                    alert('Sản phẩm đã được đăng!');
                    window.location.href = 'admin.php?tmuc=Duyệt bài đăng';
                </script>";
            } else {
                echo "<script>
                    alert('Đăng sản phẩm thất bại!');
                    window.location.href = 'admin.php?tmuc=Duyệt bài đăng';
                </script>";
            }
        }
    }

    if (isset($_POST['btn_dt'])) {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Lấy giá trị hiện tại của doanh thu
            $selectQuery = "SELECT `doanhthu` FROM `khachhang` WHERE `id` = ?";
            if ($selectStmt = $con->prepare($selectQuery)) {
                $selectStmt->bind_param("i", $id);
                $selectStmt->execute();
                $selectStmt->bind_result($doanhthu);
                $selectStmt->fetch();
                $selectStmt->close();
            }

            // Cập nhật cột doanh thu và doanh thu_tt
            $updateQuery = "UPDATE `khachhang` SET `doanhthu` = 0, `doanhthu_tt` = `doanhthu_tt` + ? WHERE `id` = ?";

            if ($stmt = $con->prepare($updateQuery)) {
                $stmt->bind_param("ii", $doanhthu, $id); // Ràng buộc tham số (hai chỉ số nguyên)
    
                if ($stmt->execute()) {
                    echo "<script>alert('Thanh toán thành công!'); 
                                  window.location.href = 'admin.php?tmuc=Quản lý doanh thu';</script>";
                } else {
                    echo "<script>alert('Thanh toán thất bại! Lỗi: " . $stmt->error . "'); 
                                  window.location.href = 'admin.php?tmuc=Quản lý doanh thu';</script>";
                }

                $stmt->close();
            } else {
                echo "<script>alert('Lỗi chuẩn bị câu lệnh SQL: " . $con->error . "'); 
                              window.location.href = 'admin.php?tmuc=Quản lý doanh thu';</script>";
            }
        }
    }

    ?>
</body>

</html>