<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo QR</title>
    <style>
        .box-contentt {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .wrap-field {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .clear-both {
            clear: both;
        }
        /* CSS for modal */
        .qr-content-modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Tạo QR</h1>
    <div class="box-contentt">
        <form name="product-formadd" method="POST" action="./xulythem.php">
            <input type="hidden" name="id" value="<?= htmlspecialchars(isset($_GET['id']) ? $_GET['id'] : '') ?>">
            <div class="wrap-field">
                <label id="toggle-qrcode-label" class="toggle-button">Nội dung QRCode</label>
                <div class="modal-content">
                    <span class="close" id="modal-close">&times;</span>
                    <div class="qr-field">
                        <label>Xuất xứ:</label>
                        <input type="text" name="xuatsu" />
                    </div>
                    <div class="qr-field">
                        <label>Phân bón:</label>
                        <input type="text" name="phanbon" />
                    </div>
                    <div class="qr-field">
                        <label>Chất lượng sản phẩm:</label>
                        <input type="text" name="chatluong" />
                    </div>
                    <div class="qr-field">
                        <label>Độ tươi:</label>
                        <input type="text" name="dotuoi" />
                    </div>
                    <div class="qr-field">
                        <label>An toàn thực phẩm:</label>
                        <input type="text" name="antoanthucpham" />
                    </div>
                    <div class="qr-field">
                        <label>Tính hợp pháp và nguồn gốc:</label>
                        <input type="text" name="tinhhopphapnguongoc" />
                    </div>
                    <div class="qr-field">
                        <label>Điều kiện bảo quản:</label>
                        <input type="text" name="dieukienbaoquan" />
                    </div>
                    <div class="qr-field">
                        <label>Phân tích vi sinh vật:</label>
                        <input type="text" name="phantichvisinhvat" />
                    </div>
                </div>
                <div class="clear-both"></div>
            </div>
            <input name="btnadd_qr" type="submit" title="Lưu sản phẩm" value="Lưu" />
        </form>
        <div class="clear-both"></div>
    </div>
</body>
</html>


<script>
document.addEventListener("DOMContentLoaded", function() {
    var toggleLabel = document.getElementById("toggle-qrcode-label");
    var modal = document.getElementById("qr-modal");
    var modalClose = document.getElementById("modal-close");

    toggleLabel.addEventListener("click", function() {
        modal.style.display = "block";
    });

    modalClose.addEventListener("click", function() {
        modal.style.display = "none";
    });

    window.addEventListener("click", function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });
});
</script>
