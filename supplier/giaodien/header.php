<!-- MAIN HEADER -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
	integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
	crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php
$user_id = $_SESSION['user_id'];
$con = mysqli_connect("localhost", "root", "", "bannuocdb");
$result = mysqli_query($con, "SELECT `diachivuon` FROM `khachhang` WHERE `id` = $user_id");
if ($result && mysqli_num_rows($result) > 0) {
	$row = $result->fetch_assoc();
	$diachi = $row['diachivuon'];
} else {
	$diachi = "Không có địa chỉ.";
}
?>

<div style="margin-left: 20px;">
	<h2 style="color: white;
					font-weight: 700;
					margin: 0 0 10px;
					display: inline-block;
					">TRANG NÔNG DÂN
	</h2>
	<form name="diachi-form" method="POST" action="./xulythem.php" enctype="multipart/form-data">
		<div>
			<b style="color: white;">Địa chỉ vườn: </b>
			<p style="color: black;">
				<input id="diachivuon" readonly style="width: 350px;" type="text" name="diachivuon"
					value="<?php echo $diachi != '' ? $diachi : 'Bạn chưa cập nhật địa chỉ vui lòng cập nhật!'; ?>">
				<input hidden name="id" value="<?php echo '' . $user_id . ''; ?>">
			</p>
			<input name="saveAdd" type="submit" id="saveBtn" style="display: none" value="Lưu" onclick="saveAddress()">
		</div>
	</form>
	<button id="updateBtn" onclick="enableEdit()">Cập nhật địa chỉ</button>

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