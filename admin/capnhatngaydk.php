<?php
include('../db/dbhelper.php');
if (isset($_POST['id']) && isset($_POST['ngaynhandukien'])) {
    $id_hoadon = $_POST['id'];
    $ngaynhandk = $_POST['ngaynhandukien'];

    $sql = 'UPDATE hoadon SET ngaynhandukien = ' . $ngaynhandk . ' WHERE id =' . $id_hoadon;
    execute($sql);
}
?>