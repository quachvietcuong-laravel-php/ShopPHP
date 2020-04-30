<?php 
	include ('../db/connect.php');
?>

<?php 
	$alert = '';

	if (isset($_POST['themsanpham'])) {
		$tensanpham   = $_POST['tensanpham'];
		$hinhanh   	  = $_FILES['hinhanh']['name'];
		$hinhanh_tmp  = $_FILES['hinhanh']['tmp_name'];
		$soluong   	  = $_POST['soluong'];
		$gia   		  = $_POST['giasanpham'];
		$giakhuyenmai = $_POST['giakhuyenmai'];
		$danhmuc      = $_POST['danhmuc'];
		$chitiet      = $_POST['chitiet'];
		$mota   	  = $_POST['mota'];
		$path		  = '../uploads/';

		if (empty($tensanpham) && empty($hinhanh) && empty($soluong) && empty($gia) && empty($danhmuc) && empty($chitiet) && empty($mota)) {
			$alert = '<div class="alert alert-danger" role="alert">Xin nhập đầy đủ</div>';
		}else{
			if (empty($tensanpham)) {
				$alert = '<div class="alert alert-danger" role="alert">Tên sản phẩm không được bỏ trống</div>';
			}elseif (empty($hinhanh)) {
				$alert = '<div class="alert alert-danger" role="alert">Hình ảnh không được bỏ trống</div>';
			}elseif (empty($soluong)) {
				$alert = '<div class="alert alert-danger" role="alert">Số lượng không được bỏ trống</div>';
			}elseif (empty($gia)) {
				$alert = '<div class="alert alert-danger" role="alert">Giá không được bỏ trống</div>';
			}elseif (empty($danhmuc)) {
				$alert = '<div class="alert alert-danger" role="alert">Danh mục không được bỏ trống</div>';
			}elseif (empty($chitiet)) {
				$alert = '<div class="alert alert-danger" role="alert">Chi tiết sản phẩm không được bỏ trống</div>';
			}elseif (empty($mota)) {
				$alert = '<div class="alert alert-danger" role="alert">Mô tả sản phẩm không được bỏ trống</div>';
			}else{
				$tensanpham = trim($tensanpham);
				$sql_check_name = mysqli_query($con, "SELECT * FROM tbl_product WHERE product_name='$tensanpham' ");
				if (mysqli_num_rows($sql_check_name) == 1) {
					$alert = '<div class="alert alert-danger" role="alert">Tên sản phẩm đã tồn tại</div>';
				}else{
					if (!is_numeric($gia)) {
						$alert = '<div class="alert alert-danger" role="alert">Giá sản phẩm phải là số</div>';
					}else{
						if ($gia <= 1000) {
							$alert = '<div class="alert alert-danger" role="alert">Giá sản phẩm phải lớn hơn 1.000 đ</div>';
						}else{
							if (!empty($giakhuyenmai)) {
								if (!is_numeric($giakhuyenmai)) {
									$alert = '<div class="alert alert-danger" role="alert">Giá sản phẩm phải là số</div>';
								}else{
									if ($giakhuyenmai >= $gia) {
										$alert = '<div class="alert alert-danger" role="alert">Giá khuyến mãi phải nhỏ hơn giá</div>';
									}else{
										if (!is_numeric($soluong)) {
											$alert = '<div class="alert alert-danger" role="alert">Số lượng phải là số</div>';
										}else{
											if (strlen($mota) >= strlen($chitiet)) {
												$alert = '<div class="alert alert-danger" role="alert">Mô tả sản phẩm phải ít hơn chi tiết sản phẩm</div>';
											}else{
												$sql_product_insert = mysqli_query($con , "INSERT INTO tbl_product(category_id,product_name,product_short_description,	product_full_description,product_price,product_sale_price,product_quantity,product_image) values ('$danhmuc','$tensanpham','$mota','$chitiet','$gia','$giakhuyenmai','$soluong','$hinhanh') ");
												move_uploaded_file($hinhanh_tmp , $path.$hinhanh);
												$alert = '<div class="alert alert-success" role="alert">Thêm sản phẩm thành công</div>';
											}
										}
									}
								}
							}else{
								if (!is_numeric($soluong)) {
									$alert = '<div class="alert alert-danger" role="alert">Số lượng phải là số</div>';
								}else{
									if (strlen($mota) >= strlen($chitiet)) {
										$alert = '<div class="alert alert-danger" role="alert">Mô tả sản phẩm phải ít hơn chi tiết sản phẩm</div>';
									}else{
										$sql_product_insert = mysqli_query($con , "INSERT INTO tbl_product(category_id,product_name,product_short_description,	product_full_description,product_price,product_quantity,product_image) values ('$danhmuc','$tensanpham','$mota','$chitiet','$gia','$soluong','$hinhanh') ");
										move_uploaded_file($hinhanh_tmp , $path.$hinhanh);
										$alert = '<div class="alert alert-success" role="alert">Thêm sản phẩm thành công</div>';
									}
								}
							}		
						}
					}
				}		
			}
		}		
	}elseif (isset($_POST['capnhatsanpham'])) {
		$id_update    = $_POST['id_update'];
		$tensanpham   = $_POST['tensanpham'];
		$hinhanh   	  = $_FILES['hinhanh']['name'];
		$hinhanh_tmp  = $_FILES['hinhanh']['tmp_name'];
		$soluong   	  = $_POST['soluong'];
		$gia   		  = $_POST['giasanpham'];
		$giakhuyenmai = $_POST['giakhuyenmai'];
		$danhmuc      = $_POST['danhmuc'];
		$chitiet      = $_POST['chitiet'];
		$mota   	  = $_POST['mota'];
		$path		  = '../uploads/';

		if ($hinhanh == '') {
			$sql_update_img = "UPDATE tbl_product SET category_id='$danhmuc',product_name='$tensanpham',product_short_description='$mota',product_full_description='$chitiet',product_price='$gia',product_sale_price='$giakhuyenmai',product_quantity='$soluong' WHERE product_id='$id_update' ";
			$alert 			= '<div class="alert alert-success" role="alert">Cập nhật sản phẩm thành công</div>';
		}else{
			move_uploaded_file($hinhanh_tmp , $path.$hinhanh);
			$sql_update_img = "UPDATE tbl_product SET category_id='$danhmuc',product_name='$tensanpham',product_short_description='$mota',product_full_description='$chitiet',product_price='$gia',product_sale_price='$giakhuyenmai',product_quantity='$soluong',product_image='$hinhanh' WHERE product_id='$id_update' ";
			$alert 			= '<div class="alert alert-success" role="alert">Cập nhật sản phẩm thành công</div>';
		}
		mysqli_query($con , $sql_update_img);
	}

	if (isset($_GET['xoa'])) {
		$product_id         = $_GET['xoa'];
		$sql_product_delete = mysqli_query($con , "DELETE FROM tbl_product WHERE product_id='$product_id' ");
		$alert  		    = '<div class="alert alert-success" role="alert">Xóa sản phẩm thành công</div>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sản phẩm</title>
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
				if (isset($_GET['quanly']) == 'capnhat') {
					$id_capnhat   = $_GET['capnhat_id'];
					$sql_capnhap  = mysqli_query($con , "SELECT * FROM tbl_product WHERE product_id='$id_capnhat' ");
					$row_capnhap  = mysqli_fetch_array($sql_capnhap);
					$id_category  = $row_capnhap['category_id'];
				}else{
					$id_capnhat = '';
				}

				if ($id_capnhat) {
					?>
						<div class="col-md-4">
						<h4>Cập nhật sản phẩm</h4>
						<form action="" method="POST" enctype="multipart/form-data">
							<label>Tên sản phẩm</label>
							<input type="text" class="form-control" value="<?php echo $row_capnhap['product_name']; ?>" name="tensanpham"><br>
							<input type="hidden" class="form-control" value="<?php echo $row_capnhap['product_id']; ?>" name="id_update">
							<label>Hình ảnh</label>
							<input type="file" class="form-control" name="hinhanh"><br>
							<img src="../uploads/<?php echo $row_capnhap['product_image']; ?>" height="80px;" width="50px;"><br><br>
							<label>Giá</label>
							<input type="text" class="form-control" name="giasanpham" value="<?php echo $row_capnhap['product_price']; ?>" ><br>
							<label>Giá khuyến mãi</label>
							<input type="text" class="form-control" name="giakhuyenmai" value="<?php echo $row_capnhap['product_sale_price']; ?>" ><br>
							<label>Số lượng sản phẩm</label>
							<input type="text" class="form-control" name="soluong" value="<?php echo $row_capnhap['product_quantity']; ?>" ><br>
							<label>Mô tả sản phẩm</label>
							<textarea class="form-control" rows="10" name="mota"><?php echo $row_capnhap['product_short_description']; ?></textarea><br>
							<label>Chi tiết sản phẩm</label>
							<textarea class="form-control" rows="10" name="chitiet"><?php echo $row_capnhap['product_full_description']; ?></textarea><br>
							<label>Danh mục sản phẩm</label>
							<?php
								$sql_danhmuc  = mysqli_query($con , "SELECT * FROM tbl_category ORDER BY category_id DESC");
							?>
							<select name="danhmuc" class="form-control">
								<option value="0">----Chọn danh mục----</option>
								<?php 
									while ($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
										if ($id_category == $row_danhmuc['category_id']) {

								?>
								<option selected="" value="<?php echo $row_danhmuc['category_id']; ?>"><?php echo $row_danhmuc['category_name']; ?></option>
								<?php 
										}else{
								?>
								<option value="<?php echo $row_danhmuc['category_id']; ?>"><?php echo $row_danhmuc['category_name']; ?></option>
								<?php			
										}
									}
								?>
							</select><br>
							<input type="submit" name="capnhatsanpham" value="Cập nhật sản phẩm" class="btn btn-default">
						</form>
					</div>
					<?php
				}else{			
			?>
					<div class="col-md-4">
						<h4>Thêm sản phẩm</h4>
						<form action="" method="POST" enctype="multipart/form-data">
							<label>Tên sản phẩm</label>
							<input type="text" class="form-control" placeholder="Tên sản phẩm" name="tensanpham"><br>
							<label>Hình ảnh</label>
							<input type="file" class="form-control" name="hinhanh"><br>
							<label>Giá</label>
							<input type="text" class="form-control" name="giasanpham" placeholder="Giá sản phẩm"><br>
							<label>Giá khuyến mãi</label>
							<input type="text" class="form-control" name="giakhuyenmai" placeholder="Giá khuyến mãi"><br>
							<label>Số lượng sản phẩm</label>
							<input type="text" class="form-control" name="soluong" placeholder="Số lượng"><br>
							<label>Mô tả sản phẩm</label>
							<textarea class="form-control" rows="10" name="mota"></textarea><br>
							<label>Chi tiết sản phẩm</label>
							<textarea class="form-control" rows="10" name="chitiet"></textarea><br>
							<label>Danh mục sản phẩm</label>
							<?php
								$sql_danhmuc  = mysqli_query($con , "SELECT * FROM tbl_category ORDER BY category_id DESC");
							?>
							<select name="danhmuc" class="form-control">
								<option value="0">----Chọn danh mục----</option>
								<?php 
									while ($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
								?>
								<option value="<?php echo $row_danhmuc['category_id']; ?>"><?php echo $row_danhmuc['category_name']; ?></option>
								<?php 
									}
								?>
							</select><br>
							<input type="submit" name="themsanpham" value="Thêm sản phẩm" class="btn btn-default">
						</form>
					</div>
			<?php
				}
			?>

			<div class="col-md-8">
				<h4>Liệt kê sản phẩm</h4>
				<?php 
					$sql_product_select = mysqli_query($con , "SELECT * FROM tbl_product,tbl_category WHERE tbl_product.category_id=tbl_category.category_id ORDER BY tbl_product.product_id DESC");
				?>
				<table class="table table-bordered ">
					<tr>
						<th>Thứ tự</th>
						<th>Tên sản phẩm</th>
						<th>Hình ảnh</th>
						<th>Số lượng</th>
						<th>Danh mục sản phẩm</th>
						<th>Giá sản phẩm</th>
						<th>Giá khuyến mãi</th>
						<th>Quản lý</th>
					</tr>
					<?php
						$i = 1;
						while ($row_product_select = mysqli_fetch_array($sql_product_select)) {
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $row_product_select['product_name']; ?></td>
						<td><img src="../uploads/<?php echo $row_product_select['product_image']; ?>" height="80px;" width="50px;" ></td>
						<td><?php echo $row_product_select['product_quantity']; ?></td>
						<td><?php echo $row_product_select['category_name']; ?></td>
						<td><?php echo number_format($row_product_select['product_price']).' đ'; ?></td>
						<td><?php echo number_format($row_product_select['product_sale_price']).' đ'; ?></td>
						<td><a href="?xoa=<?php echo $row_product_select['product_id']; ?>">Xóa</a> || <a href="xulysanpham.php?quanly=capnhat&capnhat_id=<?php echo $row_product_select['product_id']; ?>">Cập nhật</a></td>
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