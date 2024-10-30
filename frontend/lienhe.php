<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ</title>
    <link rel="stylesheet" href="styles.css"> <!-- Thêm đường dẫn tới tệp CSS nếu cần -->
    <style>
        body {
            background-color: #f4f4f4; /* Màu nền */
        }
        h1 {
            margin-top: 20px;
            margin-bottom: 20px; /* Khoảng cách dưới cho tiêu đề */
            text-align: center; /* Căn giữa tiêu đề */
        }
        .form1 {
            width: 30%; /* Chiều rộng của form */
            margin: auto; /* Căn giữa form */
        }
        label {
            display: block; /* Hiển thị label dưới dạng block */
            margin-bottom: 5px; /* Khoảng cách dưới cho label */
        }
        input[type="text"], input[type="email"], input[type="tel"], textarea {
            width: 100%; /* Chiều rộng 100% */
            padding: 10px; /* Padding cho các trường nhập */
            margin-bottom: 15px; /* Khoảng cách dưới cho các trường nhập */
            border: 1px solid #ccc; /* Đường viền cho các trường nhập */
            border-radius: 4px; /* Bo tròn các góc */
            box-sizing: border-box; /* Tính toán padding vào chiều rộng */
        }
        button {
            margin: auto;
            background-color: #4CAF50; /* Màu nền cho nút */
            color: white; /* Màu chữ cho nút */
            padding: 10px 15px; /* Padding cho nút */
            border: none; /* Không có đường viền */
            border-radius: 4px; /* Bo tròn các góc */
            cursor: pointer; /* Con trỏ chuột */
            width: 20%; /* Chiều rộng nút bằng 100% */
        }
        button:hover {
            background-color: #45a049; /* Màu nền khi hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Liên Hệ Với Chúng Tôi</h1>
        <form action="submit_form.php" method="POST" class = "form1"> <!-- Đường dẫn xử lý form -->
            <label for="name">Họ và Tên:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Số Điện Thoại:</label>
            <input type="tel" id="phone" name="phone">

            <label for="subject">Chủ Đề:</label>
            <input type="text" id="subject" name="subject" required>

            <label for="message">Nội Dung Tin Nhắn:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <button type="submit">Gửi</button>
        </form>
    </div>
</body>
</html>
