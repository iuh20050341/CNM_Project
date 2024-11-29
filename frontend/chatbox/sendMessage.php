<?php
// Kết nối cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "bannuocdb");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy nội dung tin nhắn, sender_id, và receiver_id từ form và lưu vào cơ sở dữ liệu
if (isset($_POST['message'], $_POST['sender_id'], $_POST['receiver_id'])) {
    $message = $conn->real_escape_string($_POST['message']);
    $sender_id = (int) $_POST['sender_id'];
    $receiver_id = (int) $_POST['receiver_id'];

    $sql = "INSERT INTO messages (content, sender_id, receiver_id, status) VALUES ('$message', $sender_id, $receiver_id, 'unseen')";
    $conn->query($sql);
}

$conn->close();
?>