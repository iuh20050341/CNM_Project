<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu về chúng tôi</title>
    <link rel="stylesheet" href="styles.css"> <!-- Thêm đường dẫn đến file CSS nếu cần -->
    <style>
        body {
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        #breadcrumb {
            background-color: #f9f9f9;
            padding: 20px;
        }
        .container {
            margin: 0 auto; /* Giữa trang */
        }
        section {
            display: flex;
            align-items: center;
            margin-bottom: 20px; /* Khoảng cách giữa các section */
        }
        section img {
            max-width: 300px; /* Đặt chiều rộng tối đa cho hình ảnh */
            margin-right: 20px; /* Khoảng cách giữa hình ảnh và nội dung */
            flex-shrink: 0; /* Không thu nhỏ hình ảnh */
            object-fit: cover; /* Đảm bảo hình ảnh được cắt phù hợp */
        }
        .img-container {
            display: flex; /* Sử dụng Flexbox để căn giữa */
            justify-content: center; /* Căn giữa theo chiều ngang */
            margin-top: 10px; /* Khoảng cách trên hình ảnh */
        }

        .member {
            text-align: center; /* Canh giữa tên bên dưới hình ảnh */
            margin: 0 15px; /* Thêm khoảng cách giữa các thành viên */
        }

        .img1 {
            width: 150px; /* Chiều rộng hình ảnh */
            height: 150px; /* Chiều cao hình ảnh */
            border-radius: 50%; /* Tạo khung hình tròn */
            object-fit: cover; /* Đảm bảo hình ảnh được cắt phù hợp */
            border: 2px solid #ccc; /* Nếu muốn thêm viền cho hình tròn */
            margin: 20px;
        }

        h2 {
            margin-top: 0; /* Bỏ margin trên tiêu đề */
        }
    </style>
</head>
<body>
<div id="breadcrumb" class="section">
    <div class="container">
        <h1 style="text-align: center;">Giới thiệu về chúng tôi</h1>
        
        <section id="vision-mission">
            <div>
                <h2>Tầm nhìn và Sứ mệnh</h2>
                <p>
                    Chúng tôi hướng tới việc trở thành nhà phân phối nông sản sạch hàng đầu tại Việt Nam, cung cấp sản phẩm chất lượng cao, an toàn cho sức khỏe người tiêu dùng và bảo vệ môi trường. Sứ mệnh của chúng tôi là kết nối nông dân với người tiêu dùng, mang lại giá trị tốt nhất cho cả hai bên. Chúng tôi tin rằng, bằng cách cung cấp những sản phẩm nông sản sạch, chúng tôi không chỉ hỗ trợ nông dân địa phương mà còn góp phần nâng cao nhận thức cộng đồng về giá trị của thực phẩm sạch. Đội ngũ của chúng tôi không ngừng nỗ lực để tạo ra các kênh phân phối hiệu quả, nhằm đảm bảo rằng sản phẩm đến tay người tiêu dùng một cách nhanh chóng và tiện lợi nhất. 
                </p>
                <p>
                    Chúng tôi cũng cam kết thúc đẩy các hoạt động giáo dục về dinh dưỡng và an toàn thực phẩm, để mọi người có thể đưa ra những lựa chọn thông minh cho sức khỏe của mình. Với sự phát triển bền vững làm kim chỉ nam, chúng tôi hy vọng sẽ góp phần vào việc bảo vệ môi trường và phát triển cộng đồng nông thôn thông qua các chương trình hỗ trợ và hợp tác với nông dân.
                </p>
            </div>
            <img src="img/ct1.png" alt="Tầm nhìn và Sứ mệnh" />
        </section>

        <section id="core-values">
            <img src="img/ct2.png" alt="Giá trị cốt lõi" />
            <div>
                <h2>Giá trị cốt lõi</h2>
                <ul>
                    <li><strong>Chất lượng:</strong> Chúng tôi cam kết mang đến sản phẩm nông sản sạch với chất lượng tốt nhất. Chúng tôi áp dụng các tiêu chuẩn kiểm định nghiêm ngặt và thực hiện các quy trình chất lượng để đảm bảo mọi sản phẩm đều đạt yêu cầu cao nhất trước khi đến tay người tiêu dùng.</li>
                    <li><strong>An toàn:</strong> Sản phẩm của chúng tôi được kiểm định và đảm bảo an toàn cho sức khỏe. Chúng tôi không chỉ cung cấp thực phẩm sạch mà còn cam kết loại bỏ tất cả các yếu tố gây hại, giúp khách hàng yên tâm khi tiêu thụ sản phẩm của chúng tôi.</li>
                    <li><strong>Minh bạch:</strong> Chúng tôi cung cấp thông tin rõ ràng về nguồn gốc và quy trình sản xuất của sản phẩm. Chúng tôi tin rằng sự minh bạch trong mọi hoạt động sẽ tạo dựng niềm tin vững chắc từ phía người tiêu dùng, từ đó xây dựng mối quan hệ lâu dài và bền vững.</li>
                    <li><strong>Hợp tác:</strong> Chúng tôi xây dựng mối quan hệ bền vững với nông dân và đối tác. Chúng tôi tin rằng sự hợp tác và hỗ trợ lẫn nhau là chìa khóa để phát triển bền vững. Chúng tôi luôn tìm kiếm những cơ hội hợp tác mới để tối ưu hóa chuỗi cung ứng và mang lại lợi ích cho tất cả các bên liên quan.</li>
                    <li><strong>Đổi mới:</strong> Chúng tôi không ngừng tìm kiếm và áp dụng những phương pháp mới trong việc sản xuất, phân phối và tiếp thị sản phẩm. Chúng tôi tin rằng sự đổi mới sẽ giúp nâng cao hiệu quả hoạt động và đáp ứng tốt hơn nhu cầu ngày càng đa dạng của người tiêu dùng.</li>
                </ul>
            </div>
        </section>

        <section id="development-team">
            <div>
                <h2>Đội ngũ phát triển</h2>
                <div class="img-container">
                    <div class="member">
                        <img src="img/nam.jpg" alt="Đội ngũ phát triển" class="img1" />
                        <p>Trần Quỳnh Nam</p>
                    </div>
                    <div class="member">
                        <img src="img/phuc.jpg" alt="Đội ngũ phát triển" class="img1" />
                        <p>Huỳnh Đình Phúc</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
</body>
</html>
