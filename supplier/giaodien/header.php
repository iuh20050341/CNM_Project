<!-- MAIN HEADER -->
<style>
.dropdown-mess {
    position: relative;
    /* Để chứa các thành phần con */
    display: inline-block;
}

.dropdown-toggle-mess {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 16px;
    text-decoration: none;
    color: black;
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.dropdown-toggle-mess:hover {
    background-color: darkgreen;
}

/* Style cho dropdown nội dung */
.cart-dropdown-mess {
    position: absolute;
    top: 100%;
    /* Đặt ngay dưới nút dropdown */
    left: 0;
    width: 250px;
    background-color: #ffffff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    display: none;
    /* Ẩn mặc định */
    padding: 10px 0;
}

/* Hiển thị dropdown khi hover */
.dropdown-mess:hover .cart-dropdown-mess {
    display: block;
    /* Hiển thị khi hover vào dropdowna */
}

/* Style cho danh sách các liên kết */
.cart-dropdown-mess .list-group {
    list-style: none;
    margin: 0;
    padding: 0;
}

.cart-dropdown-mess .list-group-item {
    padding: 10px 15px;
    border-bottom: 1px solid #eee;
}

.cart-dropdown-mess .list-group-item:last-child {
    border-bottom: none;
    /* Bỏ viền cuối cùng */
}

.cart-dropdown-mess .list-group-item a {
    text-decoration: none;
    color: #333;
    font-size: 14px;
    transition: color 0.3s ease;
}

.cart-dropdown-mess .list-group-item a:hover {
    color: #007bff;
}

/* Style cho thông báo "Không có tin nhắn nào" */
.cart-dropdown-mess p {
    text-align: center;
    color: #888;
    font-size: 14px;
    margin: 0;
    padding: 10px;
}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php
$user_id = $_SESSION['user_id'];
$con = mysqli_connect("localhost", "root", "", "bannuocdb");
// Thiết lập mã hóa UTF-8
mysqli_set_charset($con, "utf8");

$result = mysqli_query($con, "SELECT `diachivuon` FROM `khachhang` WHERE `id` = $user_id");
if ($result && mysqli_num_rows($result) > 0) {
    $row = $result->fetch_assoc();
    $diachi = htmlspecialchars($row['diachivuon']);
} else {
    $diachi = "Không có địa chỉ.";
}

$sql = "
SELECT DISTINCT 
CASE 
    WHEN messages.receiver_id = $_SESSION[user_id] THEN messages.sender_id
    WHEN messages.sender_id = $_SESSION[user_id] THEN messages.receiver_id
END AS user_id,
khachhang.ten_kh,
messages.status
FROM messages
JOIN khachhang
    ON (messages.sender_id = khachhang.id OR messages.receiver_id = khachhang.id)
WHERE 
    (messages.sender_id = $_SESSION[user_id] OR messages.receiver_id = $_SESSION[user_id])
    AND khachhang.id != $_SESSION[user_id]
ORDER BY messages.created_at DESC;
";

$result1 = $con->query($sql);
if (!$result1) {
    // Hiển thị lỗi SQL
    die("Lỗi SQL: " . $con->error);
}
?>

<div style="display: flex; align-items: flex-start; gap: 20px; margin: 20px;">
    <!-- Div đầu tiên -->
    <div style="margin-left: 20px;">
        <h2 style="color: white; font-weight: 700; margin: 0 0 10px; display: inline-block;">
            TRANG NÔNG DÂN
        </h2>
        <form name="diachi-form" method="POST" action="./xulythem.php" enctype="multipart/form-data">
            <div>
                <b style="color: white;">Địa chỉ vườn: </b>
                <p style="color: black;">
                    <input id="diachivuon" readonly style="width: 350px;" type="text" name="diachivuon"
                        value="<?php echo $diachi != '' ? $diachi : 'Bạn chưa cập nhật địa chỉ vui lòng cập nhật!'; ?>">
                    <input hidden name="id" value="<?php echo '' . $user_id . ''; ?>">
                </p>
                <input name="saveAdd" type="submit" id="saveBtn" style="display: none" value="Lưu"
                    onclick="saveAddress()">
            </div>
        </form>
        <button id="updateBtn" onclick="enableEdit()">Cập nhật địa chỉ</button>
    </div>

    <!-- Div thứ hai -->
    <div style="margin-top: 50px;" class="dropdown-mess">
        <a class="dropdown-toggle-mess" data-toggle="dropdown" aria-expanded="true" style="cursor: pointer">
            <i class="fa-regular fa-comments" style="color:white; font-size: 16px"></i>
            <span style="color: white;">Trò chuyện</span>
        </a>

        <div class="cart-dropdown-mess">
            <?php
            if ($result1->num_rows > 0) {
                echo '<ul class="list-group">';
                while ($row = $result1->fetch_assoc()) {
                    $user_id = htmlspecialchars($row['user_id']);
                    $ten_kh = htmlspecialchars($row['ten_kh']);
                    $status = htmlspecialchars($row['status']);
                    $notificationBadge = ($status === 'unseen') ? "<i class='fa-regular fa-bell text-danger ms-auto'></i>" : "";

                    echo "
                    <li class='list-group-item'>
                        <a href='../frontend/chatbox/index.php?receiver_id=$user_id&sender_id={$_SESSION['user_id']}'
                           class='text-decoration-none text-dark'>
                            $ten_kh
                            $notificationBadge
                        </a>
                    </li>";
                }
                echo '</ul>';
            } else {
                echo "<p class='text-muted'>Không có tin nhắn nào.</p>";
            }
            ?>
        </div>
    </div>
</div>

<script>
function enableEdit() {
    const input = document.getElementById("diachivuon");
    input.removeAttribute("readonly");
    document.getElementById("updateBtn").style.display = "none"
    document.getElementById("saveBtn").style.display = "inline";

}

function saveAddress() {
    const input = document.getElementById("diachivuon");
    input.setAttribute("readonly", true); // Đặt lại readonly cho input
    document.getElementById("updateBtn").style.display = "inline"; // Hiển thị lại nút Cập nhật
    document.getElementById("saveBtn").style.display = "none"; // Ẩn nút Lưu
}
</script>
<div id="nd">

    <?php
    include('./connect_db.php');
    include('./function.php');
    ?>
    <div class="logout_top" style="margin-top: -8px;
                padding-bottom: 5px; color: white;">
        <?php
        echo '<i style="color: white;" class="fa-regular fa-user"></i>' . $text = " Tài Khoản: " . $_SESSION['ten_dangnhap'];
        //echo '<div  style="text-transform:uppercase;margin-right:5px" >' .$text ."</div>";
        ?>
    </div>
    <div class="inline-block-div">
        <a style="color: white;padding-top: 5px" href="./../index.php">Trở về trang chủ</a>
    </div>
    <div class="inline-block-div logout_bottom">
        <a style="color: white; padding-top: 5px" href="../frontend/logout.php">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
    </div>

    <style>
    .inline-block-div {
        display: inline-block;
        vertical-align: top;
    }
    </style>


</div>