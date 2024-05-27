<?php
    include_once("./connect_db.php");
    if (!empty($_SESSION['nguoidung'])) {
        $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
        $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $offset = ($current_page - 1) * $item_per_page;
        $totalRecords = mysqli_query($con, "SELECT * FROM `theloai`");
        $totalRecords = $totalRecords->num_rows;
        $totalPages = ceil($totalRecords / $item_per_page);
        $theloai = mysqli_query($con, "SELECT * FROM `theloai` ORDER BY `id` ASC LIMIT " . $item_per_page . " OFFSET " . $offset);

        mysqli_close($con);
    ?>
<div class="main-content">
            <h1 style="color: white">Thể loại</h1>
            <div class="product-items">
                <div class="buttons" >
                    <a style="color: white; background-color:darkgreen;" href="admin.php?act=addtl">Thêm</a>
                </div>
                <div class="table-responsive-sm ">
                    <table class="table table-bordered table-striped table-hover" style="text-align: center;">
                        <thead >
                            <tr>
                                <th style="text-align: center;">Id</th>
                                <th style="text-align: center;">Tên thể loại</th>
                                <th style="text-align: center;">Số lượng sản phẩm</th>
                                <th style="text-align: center;">Sửa</th>
                                <th style="text-align: center;">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                            while ($row = mysqli_fetch_array($theloai)) {
                            ?>
                                <tr>            
                                    <td><?= $row['id'] ?></td>            
                                    <td><?= $row['ten_tl'] ?></td>
                                    <td><?= $row['tong_sp'] ?></td>
                                    <td class="buttons" style="text-align: center"><a style="color: white; background-color:darkgreen;" href="admin.php?act=suatl&id=<?= $row['id'] ?>" >Sửa</a></td>
                                    <td class="buttons" style="text-align: center"><a style="color: white; background-color:darkgreen;" href="admin.php?act=xoatl&id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this item?');">Xóa</a></td>                                  
                                    <div class="clear-both"></div>
                                </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php
        include './pagination.php';
        ?>
        <div class="clear-both"></div>
        </div>
    <?php
    }
    ?>