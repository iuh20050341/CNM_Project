<?php
session_start(); // Khởi tạo session để xử lý giỏ hàng
header('Content-type: text/html; charset=utf-8');

function execPostRequest($url, $data)
{
    $ch = curl_init($url); // Khởi tạo CURL với URL
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); // Cài đặt phương thức POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);// Dữ liệu cần gửi
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);// Trả về kết quả
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);// Giới hạn thời gian chờ
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    $result = curl_exec($ch);// Thực thi lệnh CURL
    curl_close($ch);
    return $result;
}

// Thông tin thanh toán MoMo
// Cấu hình thông tin MoMo API
$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
$orderInfo = "Thanh toán qua MoMo";

// Kiểm tra số tiền từ POST và đảm bảo tính hợp lệ
if (!isset($_POST['amount']) || !is_numeric($_POST['amount']) || floatval($_POST['amount']) <= 0) {
    die("Số tiền không hợp lệ.");
}
$amount = floatval($_POST['amount']);

// Cấu hình các thông số thanh toán
$orderId = uniqid();
$redirectUrl = "http://localhost:88/CNM_Project/"; // Đường dẫn sau khi thanh toán thành công
$ipnUrl = "http://localhost:88/CNM_Project/frontend/thanh_toan.php"; // Đường dẫn nhận thông báo IPN (chế độ Live sẽ nhận thông báo IPN)
$extraData = ""; // Thêm dữ liệu phụ (nếu cần)

// Tạo thông tin thanh toán và chữ ký
$requestId = time() . "";
$requestType = "payWithATM";
// Tạo chuỗi để ký
$rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . 
    "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . 
    "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . 
    "&requestType=" . $requestType;
// Ký chuỗi bằng HMAC SHA256
$signature = hash_hmac("sha256", $rawHash, $secretKey);

// Tạo dữ liệu yêu cầu để gửi cho MoMo
$data = array(
    'partnerCode' => $partnerCode,
    'partnerName' => "Test",
    'storeId' => "MomoTestStore",
    'requestId' => $requestId,
    'amount' => $amount,
    'orderId' => $orderId,
    'orderInfo' => $orderInfo,
    'redirectUrl' => $redirectUrl,
    'ipnUrl' => $ipnUrl,
    'lang' => 'vi', // Ngôn ngữ hiển thị trang thanh toán
    'extraData' => $extraData,
    'requestType' => $requestType,
    'signature' => $signature
);

// Gửi yêu cầu tới MoMo và nhận kết quả
$result = execPostRequest($endpoint, json_encode($data));
$jsonResult = json_decode($result, true);

// Kiểm tra kết quả và chuyển hướng tới MoMo
if (isset($jsonResult['payUrl'])) {
    // Trước khi chuyển hướng người dùng đến trang thanh toán, xóa giỏ hàng trong session
    unset($_SESSION['cart']); // Xóa giỏ hàng

    // Chuyển hướng đến URL thanh toán của MoMo
    header('Location: ' . $jsonResult['payUrl']);
    exit; // Dừng thực thi mã sau khi chuyển hướng
} else {
    // Hiển thị lỗi nếu không tạo được yêu cầu thanh toán
    echo "Lỗi khi tạo yêu cầu thanh toán: " . json_encode($jsonResult, JSON_UNESCAPED_UNICODE);
}
?>

<?php
// Xử lý thông báo thanh toán thành công sau khi người dùng quay lại từ MoMo
if (isset($_GET['status']) && $_GET['status'] == 'success') {
    // Nếu thanh toán thành công, bạn có thể xử lý các bước như lưu thông tin đơn hàng vào cơ sở dữ liệu.
    echo "Thanh toán thành công!";
    // Có thể chuyển hướng người dùng đến trang khác nếu cần
    header('Location: http://localhost:88/CNM_Project/frontend/success.php');
} elseif (isset($_GET['status']) && $_GET['status'] == 'fail') {
    // Nếu thanh toán thất bại, bạn có thể thông báo cho người dùng biết.
    echo "Thanh toán không thành công, vui lòng thử lại!";
    // Chuyển hướng người dùng về trang giỏ hàng hoặc trang thanh toán
    header('Location: http://localhost:88/CNM_Project/frontend/cart.php');
}
?>
