<?php
// Kết nối cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "bannuocdb");
$conn->set_charset("utf8mb4");
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
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">


    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="../../css/slick.css" />
    <link type="text/css" rel="stylesheet" href="../../css/slick-theme.css" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="../../css/nouislider.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="../../css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="../../css/style.css" />
    <style>
    .chatbox {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        border: 1px solid #ddd;
        border-radius: 5px;
        display: flex;
        flex-direction: column;
        max-height: 570px;
        min-height: 570px;
    }

    .chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 10px;
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
    <div id="top-header" style="background: #5fa533;align-items: center; display: flex">
        <a href="../../index.php" class="logo" style="margin-left: 10px">
            <div class="header-logo" style="padding: 10px; border: 2px solid white; color: white">
                <b>Trang chủ</b>
            </div>
        </a>

        <div class="btn-back" style="margin-left: 15px">
            <button onclick="goBack()" class="btn btn-secondary">Quay về</button>
        </div>

        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i> 0987654321</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> namphuc@email.com</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i> 256/126/33 Phan Huy Ích, Phường 12, Gò Vấp, Thành phố
                        Hồ
                        Chí Minh</a></li>
            </ul>

        </div>
    </div>

    <div class="container mt-5">
        <h3 class="text-center">Trò chuyện với <?php echo $ten_nhaban ?></h3>

        <div class="chatbox">
            <div id="chatMessages" class="chat-messages">
                <?php
                // Truy vấn tin nhắn
                $sql = "SELECT * FROM messages 
                        WHERE (sender_id = $sender_id AND receiver_id = $receiver_id)
                        OR (sender_id = $receiver_id AND receiver_id = $sender_id)
                        ORDER BY created_at ASC";

                $result = $conn->query($sql);

                $update_status_sql = "UPDATE messages 
                      SET status = 'seen' 
                      WHERE receiver_id = $sender_id AND status = 'unseen'";
                $conn->query($update_status_sql);

                // Kiểm tra và hiển thị các tin nhắn
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $is_sender = $row['sender_id'] == $sender_id;
                        $message = htmlspecialchars($row['content']);
                        $time = htmlspecialchars($row['created_at']);
                        $status = $row['status'];

                        echo "<div class='" . ($is_sender ? 'text-right' : 'text-left') . " mb-2'>";
                        echo "<strong>" . ($is_sender ? "" : $ten_nhaban . ' : ') . "</strong>";
                        echo "<div class='d-inline-block p-2 rounded-lg " . ($is_sender ? 'bg-primary text-white' : 'bg-light text-dark') . "' style='max-width: 75%;'>";
                        echo $message;
                        echo "</div>";
                        if ($is_sender && $status === 'seen') {
                            echo "<div class='text-muted' style='font-size: 12px;'>Đã xem</div>";
                        }
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
                        <input type="text" name="message" id="message-input" class="form-control col-md-7"
                            placeholder="Type a message" required>
                        <div class="col-md-2" style="padding: 6px; border: 1px solid black">
                            <span class="microphone" style="padding-bottom: 5px; padding-left:25px; cursor: pointer;">
                                <i class="fa fa-microphone"></i>
                                <span class="recording-icon"></span>
                            </span>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </div>


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

<script>
const APP_ID = 'cf26e7b2c25b5acd18ed5c3e836fb235';
const DEFAULT_VALUE = '--';
const messageInput = document.querySelector('#message-input');
var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;

const recognition = new SpeechRecognition();
const synth = window.speechSynthesis;
recognition.lang = "vi-VI";
recognition.continuous = false;

const microphone = document.querySelector(".microphone");

const speak = (text) => {
    if (synth.speaking) {
        console.error("Busy. Speaking...");
        return;
    }

    const utter = new SpeechSynthesisUtterance(text);

    utter.onend = () => {
        console.log("SpeechSynthesisUtterance.onend");
    };
    utter.onerror = (err) => {
        console.error("SpeechSynthesisUtterance.onerror", err);
    };

    synth.speak(utter);
};

const handleVoice = (text) => {
    console.log("text", text);
    // Hiển thị đầu vào giọng nói được nhận dạng trong trường tìm kiếm
    messageInput.value = text;
    console.log("messageInput.value", messageInput.value);
    // Tự động tải để tìm kiếm
    // const searchButton = document.querySelector(".search-btn");
    // searchButton.click();
};
microphone.addEventListener("click", (e) => {
    e.preventDefault();

    recognition.start();
    microphone.classList.add("recording");
});
//Dừng quá trình nhận dạng khi người dùng ngừng nói và loại bỏ class recording
recognition.onspeechend = () => {
    recognition.stop();
    microphone.classList.remove("recording");
};
//Xử lý lỗi trong quá trình nhận dạng và loại bỏ class recording
recognition.onerror = (err) => {
    console.error(err);
    microphone.classList.remove("recording");
};
//Xử lý kết quả nhận dạng giọng nói, lấy văn bản nhận dạng và gọi hàm 
recognition.onresult = (e) => {
    console.log("onresult", e);
    const text = e.results[0][0].transcript;
    handleVoice(text);
};
</script>