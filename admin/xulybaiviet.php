<?php 
	include ('../db/connect.php');
?>

<?php 
	$alert = '';

	if (isset($_POST['thembaiviet'])) {
		$tenbaiviet   = $_POST['tenbaiviet'];
		$hinhanh   	  = $_FILES['hinhanh']['name'];
		$hinhanh_tmp  = $_FILES['hinhanh']['tmp_name'];
		$danhmuc      = $_POST['danhmuc'];
		$chitiet      = $_POST['chitiet'];
		$mota   	  = $_POST['mota'];
		$path		  = '../uploads/';

		$sql_product_insert = mysqli_query($con , "INSERT INTO tbl_news_post(news_id,news_post_name,short_description,contents,image) values ('$danhmuc','$tenbaiviet','$mota','$chitiet','$hinhanh') ");
		move_uploaded_file($hinhanh_tmp , $path.$hinhanh);
		$alert  		    = '<div class="alert alert-success" role="alert">Thêm sản phẩm thành công</div>';
	}elseif (isset($_POST['capnhatbaiviet'])) {
		$id_update    = $_POST['id_update'];
		$tenbaiviet   = $_POST['tenbaiviet'];
		$hinhanh   	  = $_FILES['hinhanh']['name'];
		$hinhanh_tmp  = $_FILES['hinhanh']['tmp_name'];
		$danhmuc      = $_POST['danhmuc'];
		$chitiet      = $_POST['chitiet'];
		$mota   	  = $_POST['mota'];
		$path		  = '../uploads/';

		if ($hinhanh == '') {
			$sql_update_img = "UPDATE tbl_news_post SET news_id='$danhmuc',news_post_name='$tenbaiviet',short_description='$mota',contents='$chitiet' WHERE news_post_id='$id_update' ";
			$alert 			= '<div class="alert alert-success" role="alert">Cập nhật sản phẩm thành công</div>';
		}else{
			move_uploaded_file($hinhanh_tmp , $path.$hinhanh);
			$sql_update_img = "UPDATE tbl_news_post SET news_id='$danhmuc',news_post_name='$tenbaiviet',short_description='$mota',contents='$chitiet',image='$hinhanh' WHERE news_post_id='$id_update' ";
			$alert 			= '<div class="alert alert-success" role="alert">Cập nhật sản phẩm thành công</div>';
		}
		mysqli_query($con , $sql_update_img);
	}

	if (isset($_GET['xoa'])) {
		$news_post          = $_GET['xoa'];
		$sql_product_delete = mysqli_query($con , "DELETE FROM tbl_news_post WHERE news_post_id='$news_post' ");
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
					$sql_capnhap  = mysqli_query($con , "SELECT * FROM tbl_news_post WHERE news_post_id='$id_capnhat' ");
					$row_capnhap  = mysqli_fetch_array($sql_capnhap);
					$id_news      = $row_capnhap['news_id'];
				}else{
					$id_capnhat = '';
				}

				if ($id_capnhat) {
					?>
						<div class="col-md-4">
						<h4>Cập nhật bài viết</h4>
						<form action="" method="POST" enctype="multipart/form-data">
							<label>Tên bài viết</label>
							<input type="text" class="form-control" value="<?php echo $row_capnhap['news_post_name']; ?>" name="tenbaiviet"><br>
							<input type="hidden" class="form-control" value="<?php echo $row_capnhap['news_post_id']; ?>" name="id_update">
							<label>Hình ảnh</label>
							<input type="file" class="form-control" name="hinhanh"><br>
							<img src="../uploads/<?php echo $row_capnhap['image']; ?>" height="80px;" width="50px;"><br><br>
							<label>Mô tả</label>
							<textarea class="form-control" rows="10" name="mota"><?php echo $row_capnhap['short_description']; ?></textarea><br>
							<label>Chi tiết</label>
							<textarea class="form-control" rows="10" name="chitiet"><?php echo $row_capnhap['contents']; ?></textarea><br>
							<label>Danh mục bài viết</label>
							<?php
								$sql_danhmuc  = mysqli_query($con , "SELECT * FROM tbl_news ORDER BY news_id DESC");
							?>
							<select name="danhmuc" class="form-control">
								<option value="0">----Chọn danh mục----</option>
								<?php 
									while ($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
										if ($id_news == $row_danhmuc['news_id']) {

								?>
								<option selected="" value="<?php echo $row_danhmuc['news_id']; ?>"><?php echo $row_danhmuc['news_name']; ?></option>
								<?php 
										}else{
								?>
								<option value="<?php echo $row_danhmuc['news_id']; ?>"><?php echo $row_danhmuc['news_name']; ?></option>
								<?php			
										}
									}
								?>
							</select><br>
							<input type="submit" name="capnhatbaiviet" value="Cập nhật bài viết" class="btn btn-default">
						</form>
					</div>
					<?php
				}else{			
			?>
					<div class="col-md-4">
						<h4>Thêm bài viết</h4>
						<form action="" method="POST" enctype="multipart/form-data">
							<label>Tên bài viết</label>
							<input type="text" class="form-control" placeholder="Tên bài viết" name="tenbaiviet"><br>
							<label>Hình ảnh</label>
							<input type="file" class="form-control" name="hinhanh"><br>
							<label>Mô tả</label>
							<textarea class="form-control" rows="10" name="mota"></textarea><br>
							<label>Chi tiết</label>
							<textarea class="form-control" rows="10" name="chitiet"></textarea><br>
							<label>Danh mục sản phẩm</label>
							<?php
								$sql_danhmuc  = mysqli_query($con , "SELECT * FROM tbl_news ORDER BY news_id DESC");
							?>
							<select name="danhmuc" class="form-control">
								<option value="0">----Chọn danh mục----</option>
								<?php 
									while ($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
								?>
								<option value="<?php echo $row_danhmuc['news_id']; ?>"><?php echo $row_danhmuc['news_name']; ?></option>
								<?php 
									}
								?>
							</select><br>
							<input type="submit" name="thembaiviet" value="Thêm bài viết" class="btn btn-default">
						</form>
					</div>
			<?php
				}
			?>

			<div class="col-md-8">
				<h4>Liệt kê bài viết</h4>
				<?php 
					$sql_post_select = mysqli_query($con , "SELECT * FROM tbl_news_post,tbl_news WHERE tbl_news_post.news_id=tbl_news.news_id ORDER BY tbl_news_post.news_post_id DESC");
				?>
				<table class="table table-bordered ">
					<tr>
						<th>Thứ tự</th>
						<th>Tên sản phẩm</th>
						<th>Hình ảnh</th>
						<th>Danh mục sản phẩm</th>
						<th>Quản lý</th>
					</tr>
					<?php
						$i = 1;
						while ($row_post_select = mysqli_fetch_array($sql_post_select)) {
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $row_post_select['news_post_name']; ?></td>
						<td><img src="../uploads/<?php echo $row_post_select['image']; ?>" height="80px;" width="50px;" ></td>
						<td><?php echo $row_post_select['news_name']; ?></td>
						<td><a href="?xoa=<?php echo $row_post_select['news_post_id']; ?>">Xóa</a> || <a href="xulybaiviet.php?quanly=capnhat&capnhat_id=<?php echo $row_post_select['news_post_id']; ?>">Cập nhật</a></td>
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