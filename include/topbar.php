<?php
	if (isset($_POST['dangnhap_home'])) {
		$taikhoan = $_POST['email_login'];
		$matkhau  = md5($_POST['password_login']);
		
		if ($taikhoan == '' || $matkhau == '') {
			echo '<script>alert("Vui lòng nhập đủ thông tin")</script>';
		}else{
			$sql_select_admin = mysqli_query($con , "SELECT * FROM tbl_customer WHERE customer_email='$taikhoan' AND customer_password='$matkhau' LIMIT 1 ");
			$count 			  = mysqli_num_rows($sql_select_admin);
			$row_login		  = mysqli_fetch_array($sql_select_admin);
			if ($count > 0) {
				$_SESSION['dangnhap_home'] = $row_login['customer_name'];
				$_SESSION['customer_id']   = $row_login['customer_id'];
				//$_SESSION['customer_name'] = $row_login['customer_id'];
				header('Location: index.php?quanly=giohang');
			}else{
				echo '<script>alert("Tài khoản hoặc Mật khẩu sai")</script>';
			}
		}
	}elseif (isset($_POST['dangky'])) {
		$customer_name     = $_POST['name'];
		$customer_phone	   = $_POST['phone'];
		$customer_address  = $_POST['address'];
		$customer_note	   = $_POST['note'];
		$customer_email	   = $_POST['email'];
		$customer_password = md5($_POST['password']);
		$customer_delivery = $_POST['giaohang'];

		if (!is_numeric($customer_phone)) {
			echo '<script>alert("Số điện thoại phải là kí tự số")</script>';
		}else{
			if (strlen($customer_phone) != 10) {
				echo '<script>alert("Số điện thoại phải là 10 số")</script>';
			}else{
				if ($customer_phone[0] != 0) {
					echo '<script>alert("Số phone phải được bắt đầu bằng số 0")</script>';
				}else{
					$customer_phone  = trim($customer_phone);
					$sql_check_phone = mysqli_query($con, "SELECT * FROM tbl_customer WHERE customer_phone='$customer_phone' ");
					if (mysqli_num_rows($sql_check_phone)) {
						echo '<script>alert("Số thoại đã tồn tại")</script>';
					}else{
						$sql_check_email = mysqli_query($con, "SELECT * FROM tbl_customer WHERE customer_email='$customer_email' ");
						if (mysqli_num_rows($sql_check_email)) {
							echo '<script>alert("Email đã tồn tại")</script>';
						}else{
							if (strlen($customer_password >= 6)) {
								echo '<script>alert("Mật khẩu phải từ 6 kí tự trở lên")</script>';
							}else{
								$sql_customer      = mysqli_query($con , "INSERT INTO tbl_customer(customer_name,customer_phone,customer_address,customer_note,customer_email,customer_password,customer_delivery) values ('$customer_name','$customer_phone','$customer_address','$customer_note','$customer_email','$customer_password','$customer_delivery')");
								$sql_select_custom = mysqli_query($con , "SELECT * FROM tbl_customer ORDER BY customer_id DESC LIMIT 1");
								$row_select_custom = mysqli_fetch_array($sql_select_custom);
								$_SESSION['dangnhap_home'] = $customer_name;
								$_SESSION['customer_id']   = $row_select_custom['customer_id'];
								header('Location: index.php?quanly=giohang');
							}
						}
					}
				}
			}
		}
	}elseif (isset($_GET['dangxuat'])) {
		$id = $_GET['dangxuat'];
		if ($id == 1) {
			unset($_SESSION['dangnhap_home']);
		}
	}
?>
<!-- top-header -->
	<div class="agile-main-top">
		<div class="container-fluid">
			<div class="row main-top-w3l py-2">
				<div class="col-lg-4 header-most-top">
					<p class="text-white text-lg-left text-center">
						<i class="fas fa-shopping-cart ml-1"></i> Ưu đãi & Giảm giá hàng đầu khu vực
					</p>
				</div>
				<div class="col-lg-8 header-right mt-lg-0 mt-2">
					<!-- header lists -->
					<ul>
						<li class="text-center border-right text-white">
							<i class="fas fa-phone mr-2"></i> 001 234 5678
						</li>
						<?php 
							if (isset($_SESSION['dangnhap_home'])) {
						?>
						<li class="text-center border-right text-white">
							<a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['customer_id']; ?>" class="text-white">
								<i class="fas fa-truck mr-2"></i>Xem đơn hàng</a>
						</li>
						<li class="text-center border-right text-white">
							Xin chào: <?php echo $_SESSION['dangnhap_home']; ?>
						</li>
						<li class="text-center text-white">
							<a href="index.php?dangxuat=1" class="text-white"> Đăng xuất</a></p>
						</li>
						<?php 
							}else{
						?>
						<li class="text-center border-right text-white">
							<a href="#" data-toggle="modal" data-target="#dangnhap" class="text-white">
								<i class="fas fa-sign-in-alt mr-2"></i>Đăng nhập </a>
						</li>
						<li class="text-center text-white">
							<a href="#" data-toggle="modal" data-target="#dangky" class="text-white">
								<i class="fas fa-sign-out-alt mr-2"></i>Đăng ký </a>
						</li>
						<?php 
							}
						?>
					</ul>
					<!-- //header lists -->
				</div>
			</div>
		</div>
	</div>


	<!-- modals -->
	<!-- log in -->
	<div class="modal fade" id="dangnhap" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-center">Đăng nhập</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="" method="post">
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="text" class="form-control" placeholder=" " name="email_login" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Mật khẩu</label>
							<input type="password" class="form-control" placeholder=" " name="password_login" required="">
						</div>
						<div class="right-w3l">
							<input type="submit" class="form-control" name="dangnhap_home" value="Đăng nhập">
						</div>
						<p class="text-center dont-do mt-3">Chưa có tài khoản?
							<a href="#" data-toggle="modal" data-target="#dangky">
								Đăng ký ngay</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- register -->
	<div class="modal fade" id="dangky" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Đăng ký</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="" method="post">
						<div class="form-group">
							<label class="col-form-label">Tên của bạn</label>
							<input type="text" class="form-control" placeholder=" " name="name" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="email" class="form-control" placeholder=" " name="email" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Phone</label>
							<input type="text" class="form-control" placeholder=" " name="phone" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Address</label>
							<input type="text" class="form-control" placeholder=" " name="address" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Mật khẩu</label>
							<input type="password" class="form-control" placeholder=" " name="password" required="">
							<input type="hidden" class="form-control" placeholder="" name="giaohang" value="0">
						</div>
						<div class="form-group">
							<label class="col-form-label">Ghi chú</label>
							<textarea class="form-control" name="note"></textarea>
						</div>
						<div class="right-w3l">
							<input type="submit" class="form-control" value="Đăng ký" name="dangky">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- //modal -->
	<!-- //top-header -->
	<!-- header-bottom-->
	<div class="header-bot">
		<div class="container">
			<div class="row header-bot_inner_wthreeinfo_header_mid">
				<!-- logo -->
				<div class="col-md-3 logo_agile">
					<h1 class="text-center">
						<a href="index.php" class="font-weight-bold font-italic">
							<img src="images/logo2.png" alt=" " class="img-fluid">Electro Store
						</a>
					</h1>
				</div>
				<!-- //logo -->
				<!-- header-bot -->
				<div class="col-md-9 header mt-4 mb-md-0 mb-4">
					<div class="row">
						<!-- search -->
						<div class="col-10 agileits_search">
							<form class="form-inline" action="index.php?quanly=timkiem" method="POST">
								<input class="form-control mr-sm-2" type="search" name="search_product" placeholder="Tìm kiếm sản phẩm" aria-label="Search" required>
								<button class="btn my-2 my-sm-0" name="search_button" type="submit">Tìm kiếm</button>
							</form>
						</div>
						<!-- //search -->
						
						<!-- cart details -->
						<div class="col-2 top_nav_right text-center mt-sm-0 mt-2">
							<a href="index.php?quanly=giohang">
								<img src="images/logo2.png" style="width: 60%; height: 60%; position: relative;">
							</a>
							<?php  
								$sql_check_cart = mysqli_query($con , "SELECT *FROM tbl_cart");
								$row_check_cart = mysqli_num_rows($sql_check_cart);
								if ($row_check_cart >= 1) {
							?>
							<span style="color: red; font-size: 20px; position: absolute; right: 35px;">
								<sup>
									<strong><?php echo $row_check_cart; ?></strong>
								</sup>
							</span>
							<?php 
								}else{
									echo "";
								}
							?>

						</div>
						<!-- //cart details -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- shop locator (popup) -->
	<!-- //header-bottom -->
	<!-- navigation -->
