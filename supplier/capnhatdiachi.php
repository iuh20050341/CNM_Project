<?php
include('../db/dbhelper.php');
if (isset($_POST['diachivuon'])) {
    $diachivuon = $_POST['diachivuon'];
    $sql = 'UPDATE khachang SET diachivuon = ' . $diachivuon . ' where id =' . $_SESSION['user_id'];
    execute($sql);
}
?>