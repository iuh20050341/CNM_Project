<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./css/bootstrap-5.1.3-dist/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script>src="./css/bootstrap-5.1.3-dist/js/bootstrap.min.js"</script>
<title>Trang nông dân</title>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    header {
        color: #fff;
        padding: 10px;
    }
    .left-menu {
        background-color: #f4f4f4;
        width: 250px;
        float: left;
        padding: 20px;
    }
    .left-menu ul {
        list-style-type: none;
        padding: 0;
    }
    .left-menu li {
        margin-bottom: 10px;
    }
    .left-menu a {
        text-decoration: none;
        color: #333;
        font-weight: bold;
    }
    .content {
        margin-left: 270px;
        padding: 20px;
    }
    h2 {
        color: #333;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    .hidden {
        display: none;
    }
</style>
</head>
<body>

<header>
    <div class="row">
        <div class="col-md-3">
            <a href="../../index.php"><img style="width:125px;" src="../../img/logo2.png" alt=""></a>
        </div>
        <div class="col-md-9">
            <h1>TRANG NÔNG DÂN</h1>
        </div>

    </div>

</header>

<div class="left-menu">
    <ul>
        <li><a href="#" onclick="showContent('product')">Quản lý sản phẩm</a></li>
    </ul>
</div>

<div id="product" class="content hidden">
    <h2>Quản lý sản phẩm</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Hình ảnh</th>
                <th>Thể loại</th>
                <th>Số lượng</th>
            </tr>
        </thead>
        <tbody>
            <!-- Thêm các hàng dữ liệu ở đây -->
        </tbody>
    </table>
</div>



<script>
    function showContent(contentId) {
        var contents = document.getElementsByClassName('content');
        for (var i = 0; i < contents.length; i++) {
            if (contents[i].id === contentId) {
                contents[i].classList.remove('hidden');
            } else {
                contents[i].classList.add('hidden');
            }
        }
    }
</script>

</body>
</html>