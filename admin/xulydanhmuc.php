<?php 
	include ('../db/connect.php');
?>

<?php 
	$alert = '';

	if (isset($_POST['themdanhmuc'])) {
		$category_name   = $_POST['danhmuc'];
		if (trim($category_name) == '') {
			$alert = '<div class="alert alert-danger" role="alert">Tên danh mục không được rỗng</div>';
		}else{
			$category_name   = trim($category_name);
			$sql_cate_check  = mysqli_query($con , "SELECT * FROM tbl_category WHERE category_name='$category_name' ");
			if (mysqli_num_rows($sql_cate_check) == 1) {
				$alert       = '<div class="alert alert-danger" role="alert">Tên danh mục đã tồn tại</div>';
			}else{
				$sql_cate_insert = mysqli_query($con , "INSERT INTO tbl_category(category_name) values ('$category_name') ");
				$alert  		 = '<div class="alert alert-success" role="alert">Thêm danh mục thành công</div>';
			}
		}
	}elseif (isset($_POST['capnhatdanhmuc'])) {
		$category_id	 = $_POST['iddanhmuc'];
		$category_name   = $_POST['tendanhmuc'];
		$sql_cate_check  = mysqli_query($con , "SELECT * FROM tbl_category WHERE category_name='$category_name' ");
		if (mysqli_num_rows($sql_cate_check) == 1) {
			$alert       = '<div class="alert alert-danger" role="alert">Tên danh mục không thay đổi</div>';
		}else{
			$sql_cate_update = mysqli_query($con , "UPDATE tbl_category SET category_name='$category_name' WHERE category_id='$category_id' ");
			$alert 			 = '<div class="alert alert-success" role="alert">Cập nhật danh mục thành công</div>';
		}
	}

	if (isset($_GET['xoa'])) {
		$category_id     = $_GET['xoa'];
		$sql_cate_delete = mysqli_query($con , "DELETE FROM tbl_category WHERE category_id='$category_id' ");
		$alert  		 = '<div class="alert alert-success" role="alert">Xóa danh mục thành công</div>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Danh mục sản phẩm</title>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	    <div class="collapse navbar-collapse" id="navbarNav">
	        <ul class="navbar-nav">
	        	<li class="nav-item active">
	                <a class="nav-link" href="dashboard.php">Admin Home</a>
	            </li>
	            <li class="nav-item active">
	                <a class="nav-link" href="xulydonhang.php">Đơn hàng</a>
	            </li>
	            <li class="nav-item">
	                <a class="nav-link" href="xulydanhmuc.php">Danh mục</a>
	            </li>
	            <li class="nav-item">
	                <a class="nav-link" href="xulysanpham.php">Sản phẩm</a>
	            </li>
	            <li class="nav-item">
	                <a class="nav-link" href="xulydanhmucbaiviet.php">Danh mục bài viết</a>
	            </li>
	            <li class="nav-item">
	                <a class="nav-link" href="xulybaiviet.php">Bài viết</a>
	            </li>
	            <li class="nav-item">
	                <a class="nav-link" href="xulykhachhang.php">Khách hàng</a>
	            </li>
	        </ul>
	    </div>
	</nav><br>
	<div class="container">
		<?php echo $alert; ?>
		<div class="row">
			<?php 
				if (isset($_GET['capnhat'])) {
					$id_capnhat   = $_GET['capnhat'];
					$sql_capnhap  = mysqli_query($con , "SELECT * FROM tbl_category WHERE category_id='$id_capnhat' ");
					$row_capnhap  = mysqli_fetch_array($sql_capnhap);
				}else{
					$id_capnhat = '';
				}

				if ($id_capnhat) {
					?>
						<div class="col-md-4">
							<h4>Cập nhật danh mục</h4>
							<label>Tên danh mục</label>
							<form action="" method="POST">
								<input type="text" class="form-control" value="<?php echo $row_capnhap['category_name'] ?>" name="tendanhmuc"><br>
								<input type="hidden" name="iddanhmuc" value="<?php echo $row_capnhap['category_id'] ?>" name="">
								<input type="submit" name="capnhatdanhmuc" value="Cập nhật danh mục" class="btn btn-default">
							</form>
						</div>
					<?php
				}else{			
			?>
					<div class="col-md-4">
						<h4>Thêm danh mục</h4>
						<label>Tên danh mục</label>
						<form action="" method="POST">
							<input type="text" class="form-control" placeholder="Tên danh mục" name="danhmuc"><br>
							<input type="submit" name="themdanhmuc" value="Thêm danh mục" class="btn btn-default">
						</form>
					</div>
			<?php
				}
			?>

			<div class="col-md-8">
				<h4>Liệt kê danh mục</h4>
				<?php 
					$sql_cate_select = mysqli_query($con , "SELECT * FROM tbl_category ORDER BY category_id DESC");
				?>
				<table class="table table-bordered ">
					<tr>
						<th>Thứ tự</th>
						<th>Tên danh mục</th>
						<th>Quản lý</th>
					</tr>
					<?php
						$i = 1;
						while ($row_cate_select = mysqli_fetch_array($sql_cate_select)) {
					?>
					<tr>
						<td><?php echo $i;  ?></td>
						<td><?php echo $row_cate_select['category_name'];  ?></td>
						<td><a href="?xoa=<?php echo $row_cate_select['category_id']; ?>">Xóa</a> || <a href="?capnhat=<?php echo $row_cate_select['category_id']; ?>">Cập nhật</a></td>
					</tr>
					<?php
						$i++; 
						}
					?>
				</table>
			</div>
		</div>
	</div>
</body>
</html>