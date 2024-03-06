<?php

session_start();
include('../db/dbhelper.php'); // Assuming the function is defined in a file named 'dbhelper.php' in the same directory as 'create_order.php'

  // Xóa giỏ hàng sau khi thanh toán
  unset($_SESSION['cart']);

  // Hiển thị thông báo đặt hàng thành công
  echo '<script>alert("Đặt hàng thành công");</script>';
  $orderStatus = 'success';

  // Chuyển về trang index.php
  header('Location:../index.php');
?>