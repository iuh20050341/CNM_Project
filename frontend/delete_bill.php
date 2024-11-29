<?php
include('../db/dbhelper.php');
if (isset($_POST['id_hoadon'])) {
    $id_hoadon = $_POST['id_hoadon'];
    $sql = 'UPDATE hoadon SET `isDelete` = 1  WHERE id=' . $id_hoadon;
    execute($sql);
}
?>