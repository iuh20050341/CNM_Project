<div class="main-content">
    <?php
    if (!empty($_GET['id'])) {
        $result = mysqli_query($con, "SELECT * FROM `phuongthucthanhtoan` WHERE `id` = " . $_GET['id']);
        $phuongthucthanhtoan = $result->fetch_assoc();
    }
    ?>
    <h1 style="color: #cebd79">Sửa PTTT</h1>
    <form name="ptvc-formsua" method="POST" action="./xulythem.php?id=<?= $_GET['id'] ?>" enctype="multipart/form-data">
        <div class="clear-both"></div>
        <div class="box-content">
            <label for="name">Tên PTTT:</label>
            <input type="text" id="name" name="name" value="<?= (!empty($phuongthucthanhtoan) ? $phuongthucthanhtoan['name'] : "") ?>"/>
            <input name="btnttsua" type="submit" title="Lưu" value="Lưu" />
            <div class="clear-both"></div>
        </div>
    </form>
</div><style>
    .box-content {
    margin: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-left: 380px;
}

label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="number"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

.clear-both {
    clear: both;
}

</style>