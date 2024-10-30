<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin Tức</title>
    <link rel="stylesheet" href="styles.css"> <!-- Thêm đường dẫn tới tệp CSS nếu cần -->
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .article {
            display: flex;
            background: white;
            margin: 10px;
            border-radius: 5px;
            overflow: hidden;
            width: calc(80% - 20px); /* Chiếm 1/3 chiều rộng của container trừ đi khoảng cách */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s; /* Hiệu ứng khi hover */
        }
        .article:hover {
            transform: scale(1.02); /* Tăng kích thước khi hover */
        }
        .article img {
            width: 300px;
            height: 200px;
            object-fit: cover;
        }
        .content {
            padding: 15px;
        }
        .content h2 {
            font-size: 1.2em;
            margin: 0;
        }
        .content p {
            margin: 5px 0;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="article">
            <a href="index.php?act=tintuc1"> <!-- Thay đổi liên kết ở đây -->
                <img src="img/tt1.png" alt="Bài viết 1">
            </a>
            <div class="content">
                <h2><a href = "index.php?act=tintuc1"><b>Mật Ong Hoa Bạc Hà có tác dụng gì?</b></a></h2>
                <p>Mật ong nguyên chất hoa bạc hà có màu vàng xanh tự nhiên rất đẹp. Màu của mật phụ thuộc vào tỷ lệ hạt phấn bạc hà có trong mật ong. Với mỗi tỉ lệ khác nhau, mật ong bạc hà có màu từ vàng chanh nhạt tới vàng chanh, vàng...</p>
            </div>
        </div>

        <div class="article">
            <a href="index.php?act=tintuc2"> <!-- Thay đổi liên kết ở đây -->
                <img src="img/tt2.jpg" alt="Bài viết 2">
            </a>
            <div class="content">
            <h2><a href = "index.php?act=tintuc2"><b>Cách chọn rau, củ, quả tốt cho sức khỏe gia đình</b></a></h2>
                <p>Cách chọn rau củ quả tươi ngon, nguồn gốc rõ ràng là câu hỏi chung của đa số người lần đầu làm nội trợ. Chonongsanonline xin chia sẻ một số điểm chung để lựa chọn rau củ quả tốt cho sức khỏe gia đình sau. Mời bạn cùng tham khảo nhé!</p>
            </div>
        </div>

        <div class="article">
            <a href="index.php?act=tintuc3"> <!-- Thay đổi liên kết ở đây -->
                <img src="img/tt3.jpg" alt="Bài viết 3">
            </a>
            <div class="content">
                <h2><a href = "index.php?act=tintuc3"><b>5 loại rau củ quả giúp giảm cân “cấp tốc” an toàn sức khỏe</b></a></h2>
                <p>Bạn đang quan tâm về vấn đề giảm cân. Không biết làm thế nào để giảm cân hiệu quả? Bài viết này sẽ gợi ý cho bạn về 5 loại rau củ quả giúp bạn giảm cân "cấp tốc" nhưng vẫn an toàn cho sức khỏe.</p>
            </div>
        </div>

        <div class="article">
            <a href="index.php?act=tintuc4"> <!-- Thay đổi liên kết ở đây -->
                <img src="img/tt4.jpg" alt="Bài viết 3">
            </a>
            <div class="content">
                <h2><a href = "index.php?act=tintuc4"><b>Gạo Hữu Cơ Thực Phẩm Tốt Cho Sức Khỏe và Môi Trường</b></a></h2>
                <p>Gạo hữu cơ là loại gạo được trồng và sản xuất theo các nguyên tắc và quy trình hữu cơ. Điều này có nghĩa là không sử dụng các loại phân bón hóa học hay thuốc trừ sâu tổng hợp trong quá trình trồng trọt và sản xuất gạo</p>
            </div>
        </div>
    </div>
</body>
</html>
