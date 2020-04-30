<?php 
	session_start();
	include ('../db/connect.php');
?>
<?php 
	// session_destroy();
	if (isset($_POST['dangnhap'])) {
		$taikhoan = $_POST['taikhoan'];
		$matkhau  = md5($_POST['matkhau']);
		
		if ($taikhoan == '' || $matkhau == '') {
			echo 'xin nhập đủ';
		}else{
			$sql_select_admin = mysqli_query($con , "SELECT * FROM tbl_admin WHERE email='$taikhoan' AND password='$matkhau' LIMIT 1 ");
			$count 			  = mysqli_num_rows($sql_select_admin);
			$row_login		  = mysqli_fetch_array($sql_select_admin);
			if ($count > 0) {
				$_SESSION['dangnhap'] = $row_login['admin_name'];
				$_SESSION['admin_id'] = $row_login['admin_id'];
				header('Location: dashboard.php');
			}else{
				echo 'Tài khoản hoặc Mật khẩu sai';
			}
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Đăng nhập Admin</title>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<h2 align="center">Đăng nhập Admin</h2>
	<div class="col-md-6">
		<div class="form-group">
			<form action="" method="POST">
				<label>Tài khoản</label>
				<input type="text" name="taikhoan" placeholder="Điền Email" class="form-control"><br>
				<label>Mật khẩu</label>
				<input type="password" name="matkhau" placeholder="Điền mật khẩu" class="form-control"><br>
				<input type="submit" name="dangnhap" class="btn btn-primary" value="Đăng nhập">
			</form>
		</div>
	</div>
</body>
</html>