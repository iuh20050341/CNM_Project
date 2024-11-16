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

if ($receiver_id !== null) {
    $sql = 'SELECT ten_kh FROM khachhang WHERE id = ' . intval($receiver_id);
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $ten_nhaban = $row['ten_kh'];
    } else {
        echo "Không tìm thấy người bán.";
    }

    // Giải phóng kết quả
    mysqli_free_result($result);
} else {
    echo "Thiếu receiver_id.";
}

// Kiểm tra nếu các tham số cần thiết không có
if ($receiver_id === null || $sender_id === null) {
    die("Thiếu receiver_id hoặc sender_id");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbox</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .chatbox {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        border: 1px solid #ddd;
        border-radius: 5px;
        height: 500px;
        display: flex;
        flex-direction: column;
    }

    .chat-messages {
        flex: 1;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .chat-input {
        padding: 10px;
        border-top: 1px solid #ddd;
    }

    .text-right {
        text-align: right;
    }

    .text-left {
        text-align: left;
    }

    .mb-2 {
        margin-bottom: 10px;
    }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h3 class="text-center">Trò chuyện với nông dân <?php echo $ten_nhaban ?></h3>
        <div class="mb-3">
            <button onclick="goBack()" class="btn btn-secondary">Quay về</button>
        </div>
        <div class="chatbox">
            <div id="chatMessages" class="chat-messages">
                <?php
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
                        $message = htmlspecialchars($row['content']);

                        // Hiển thị tin nhắn với định dạng tùy thuộc vào người gửi
                        echo "<div class='" . ($is_sender ? 'text-right' : 'text-left') . " mb-2'>";
                        echo "<div class='d-inline-block p-2 rounded-lg " . ($is_sender ? 'bg-primary text-white' : 'bg-light text-dark') . "' style='max-width: 75%;'>";
                        echo $message;
                        echo "</div>";
                        echo "<strong> :" . ($is_sender ? "Bạn" : '' . $ten_nhaban . '') . "</strong> ";

                        echo "</div>";
                    }
                } else {
                    echo "<div class='text-muted'>Chưa có tin nhắn nào.</div>";
                }
                ?>
            </div>
            <div class="chat-input">
                <form id="chatForm" action="sendMessage.php" method="POST">
                    <input type="hidden" name="sender_id" value="<?php echo $sender_id; ?>">
                    <input type="hidden" name="receiver_id" value="<?php echo $receiver_id; ?>">
                    <div class="input-group">
                        <input type="text" name="message" class="form-control" placeholder="Type a message" required>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function() {
        // Tự động tải lại tin nhắn mỗi 2 giây
        setInterval(function() {
            $('#chatMessages').load(window.location.href + ' #chatMessages');
        }, 2000);

        // Gửi tin nhắn qua AJAX
        $('#chatForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'sendMessage.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function() {
                    $('#chatForm')[0].reset();
                    $('#chatMessages').load(window.location.href + ' #chatMessages');
                }
            });
        });
    });

    // Hàm quay lại trang trước
    function goBack() {
        window.history.back();
    }
    </script>

</body>

</html>

<?php $conn->close(); ?>