<?php
    require_once 'phpqrcode/qrlib.php';
    $path = 'images/';
    $qrcode = $path.time().".png";
    
    QRcode::png("https://www.youtube.com/watch?v=6a_9MIItrig", $qrcode, 4, 4);
    echo "<img src='".$qrcode."'>";
?>