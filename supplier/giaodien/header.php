		<!-- MAIN HEADER -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />		
		<div style="margin-left: 20px">
			<h2 style="color: white;
					font-weight: 700;
					margin: 0 0 10px;
					display: inline-block;	">TRANG NHÀ BÁN
			</h2>
		</div>

<div id="nd">
		
		<?php 
			include('./connect_db.php');
			include('./function.php');	
		?>
		<div class="logout_top" style="margin-top: -8px;
    			padding-bottom: 5px; color: white;">
		<?php
			echo '<i style="color: white;" class="fa-regular fa-user"></i>'. $text = " Tài Khoản: " . $_SESSION['ten_dangnhap'];
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
		