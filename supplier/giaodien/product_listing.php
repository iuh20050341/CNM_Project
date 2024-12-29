<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/admin_style.css">
</head>

<body>
    <?php
    include_once("./connect_db.php");

    if (isset($_SESSION['ten_dangnhap']) && !empty($_SESSION['ten_dangnhap']) && isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 6;
        $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($current_page - 1) * $item_per_page;

        // Chỉ hiển thị trạng thái = 7
        $status_filter = "trangthai = 7";
        $sql_base = "SELECT * FROM `sanpham` WHERE id_nhaban = $user_id AND $status_filter";

        // Xử lý tìm kiếm
        if (isset($_POST['search'])) {
            if (!empty($_POST['productId'])) {
                $sql_base .= " AND `id` = '" . $_POST['productId'] . "'";
            }
            if (!empty($_POST['productName'])) {
                $sql_base .= " AND `ten_sp` LIKE '%" . $_POST['productName'] . "%'";
            }
            if (!empty($_POST['statusInventory'])) {
                if ($_POST['statusInventory'] == 1) {
                    $sql_base .= " AND `so_luong` < 10";
                } elseif ($_POST['statusInventory'] == 2) {
                    $sql_base .= " AND `so_luong` = 0";
                } else {
                    $sql_base .= " AND `so_luong` > 0";
                }
            }
        }


        $totalRecords = mysqli_query($con, $sql_base);
        $totalRecordsCount = $totalRecords->num_rows;
        $totalPages = ceil($totalRecordsCount / $item_per_page);

        // Xử lý sắp xếp
        $order = "ORDER BY `id` ASC";
        if (isset($_GET['sapxep'])) {
            switch ($_GET['sapxep']) {
                case 'idgiam':
                    $order = "ORDER BY `id` DESC";
                    break;
                case 'idtang':
                    $order = "ORDER BY `id` ASC";
                    break;
                case 'tengiam':
                    $order = "ORDER BY `ten_sp` DESC";
                    break;
                case 'tentang':
                    $order = "ORDER BY `ten_sp` ASC";
                    break;
                case 'tongiam':
                    $order = "ORDER BY `so_luong` DESC";
                    break;
                case 'tontang':
                    $order = "ORDER BY `so_luong` ASC";
                    break;
                case 'bangiam':
                    $order = "ORDER BY `sl_da_ban` DESC";
                    break;
                case 'bantang':
                    $order = "ORDER BY `sl_da_ban` ASC";
                    break;
            }
        }

        $products = mysqli_query($con, $sql_base . " " . $order . " LIMIT $item_per_page OFFSET $offset");
        mysqli_close($con);
        ?>
    <div class="main-content" style="color: green">
        <h1>Danh sách sản phẩm đã đăng bán</h1>
        <form method="POST" action="./supplier.php?muc=7&tmuc=Sản%20phẩm">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="productId">Mã sản phẩm:</label>
                    <input type="text" class="form-control" id="productId" name="productId"
                        placeholder="Nhập Mã sản phẩm">
                </div>
                <div class="form-group col-md-3">
                    <label for="productName">Tên sản phẩm:</label>
                    <input type="text" class="form-control" id="productName" name="productName"
                        placeholder="Nhập Tên sản phẩm">
                </div>
                <div class="form-group col-md-3">
                    <label for="statusInventory">Trạng thái tồn kho:</label>
                    <select id="statusInventory" name="statusInventory" class="form-control">
                        <option value="99">Chọn trạng thái tồn kho</option>
                        <option value="1">Sắp hết hàng</option>
                        <option value="2">Đang hết hàng</option>
                    </select>
                </div>
            </div>
            <input name="search" type="submit" class="btn btn-primmary" value="SEARCH">
        </form>

        <div class="product-items">
            <div class="table-responsive-sm">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="text-align:center">ID</th>
                            <th style="text-align:center">Ảnh</th>
                            <th style="text-align:center">Tên sản phẩm</th>
                            <th style="text-align:center">Số lượng tồn</th>
                            <th style="text-align:center">Số lượng bán</th>
                            <th style="text-align:center">Trạng thái</th>
                            <th style="text-align:center">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($products)) { ?>
                        <tr>
                            <td style="text-align:center"><?= $row['id'] ?></td>
                            <td><img style="width: 100px; height: 100px;" src="../img/<?= $row['hinh_anh'] ?>" /></td>
                            <td style="text-align:center"><?= $row['ten_sp'] ?></td>
                            <td style="text-align:center"><?= $row['so_luong'] ?></td>
                            <td style="text-align:center"><?= $row['sl_da_ban'] ?></td>
                            <td style="text-align:center">
                                <?php
                                        switch ($row['trangthai']) {
                                            case '7':
                                                echo "Đã đăng";
                                                break;
                                            case '6':
                                                echo "Chờ duyệt bài đăng";
                                                break;
                                            case '5':
                                                echo "Sản phẩm chưa đạt chuẩn";
                                                break;
                                            case '4':
                                                echo "Sản phẩm đạt chuẩn";
                                                break;
                                            case '3':
                                                echo "Đang chờ tạo mã QR";
                                                break;
                                            case '2':
                                                echo "Đang chờ kiểm định";
                                                break;
                                            case '1':
                                                echo "Đang chờ phân công kiểm định";
                                                break;
                                            case '0':
                                                echo "Chưa kiểm định";
                                                break;
                                        }
                                        ?>
                            </td>
                            <td style="text-align:center">
                                <a href="supplier.php?act=sua&id=<?= $row['id'] ?>">Sửa</a> |
                                <?php if ($row['trangthai'] == '7') { ?>
                                <a href="supplier.php?act=xoa&id=<?= $row['id'] ?>"
                                    onclick="return confirm('Bạn có muốn xóa sản phẩm?');">Xóa</a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include './pagination.php'; ?>
    </div>
    <?php
    }
    ?>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>