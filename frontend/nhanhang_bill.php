<?php
include('../db/dbhelper.php');
if (isset($_POST['id_hoadon'])) {
    $id_hoadon = $_POST['id_hoadon'];
    $sql = 'UPDATE hoadon SET deliveryStatus = 3 where id =' . $id_hoadon;
    execute($sql);
}
?>