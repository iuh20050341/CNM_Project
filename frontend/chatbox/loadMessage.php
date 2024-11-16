<?php
// Kết nối cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "bannuocdb");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy receiver_id và sender_id từ GET
$receiver_id = isset($_GET['receiver_id']) ? $_GET['receiver_id'] : null;
$sender_id = isset($_GET['sender_id']) ? $_GET['sender_id'] : null;

// Kiểm tra nếu các tham số cần thiết không có
if ($receiver_id === null || $sender_id === null) {
    die("Thiếu receiver_id hoặc sender_id");
}

// Truy vấn tin nhắn
$sql = "SELECT * FROM messages 
        WHERE (sender_id = $sender_id AND receiver_id = $receiver_id)
        OR (sender_id = $receiver_id AND receiver_id = $sender_id)
        ORDER BY created_at ASC";

$result = $conn->query($sql);

// Kiểm tra và hiển thị các tin nhắn
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $is_sender = $row['sender_id'] == $sender_id;
        $message = htmlspecialchars($row['content']);  // Đảm bảo an toàn khi hiển thị tin nhắn

        // Hiển thị tin nhắn với định dạng tùy thuộc vào người gửi
        echo "<div class='" . ($is_sender ? 'text-right' : 'text-left') . " mb-2'>";
        echo "<strong>" . ($is_sender ? "You" : "Partner") . ":</strong> ";
        echo $message;
        echo "</div>";
    }
} else {
    echo "<div class='text-muted'>Chưa có tin nhắn nào.</div>";
}

$conn->close();
?>