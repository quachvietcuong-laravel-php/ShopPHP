<?php 
	include ('../db/connect.php');
?>

<?php 
	$alert = '';
	if (isset($_POST['capnhatdonhang'])) {
		$xuly       = $_POST['xuly'];
		$mahang     = $_POST['mahang_xuly'];
		$sql_update = mysqli_query($con , "UPDATE tbl_order SET status='$xuly' WHERE order_cart_id='$mahang' ");
		$sql_update_giaodich = mysqli_query($con , "UPDATE tbl_transaction SET status='$xuly' WHERE transaction_code='$mahang' ");
		if ($sql_update) {
			$alert  = '<div class="alert alert-success" role="alert">Xử lý đơn hàng thành công</div>';
		}
	}

	if (isset($_GET['xoadonhang'])) {
		$mahang = $_GET['xoadonhang'];
		$sql_delete = mysqli_query($con , "DELETE FROM tbl_order WHERE order_cart_id='$mahang' ");
		if ($sql_delete) {
			$alert  = '<div class="alert alert-success" role="alert">Xóa đơn hàng thành công</div>';
		}
	}

	if (isset($_GET['xacnhanhuy']) && isset($_GET['mahang'])) {
		$huydon     = $_GET['xacnhanhuy'];
		$mahang     = $_GET['mahang'];
	}else{
		$huydon     = '';
		$mahang = '';
	}
	$sql_update_donhang  = mysqli_query($con , "UPDATE tbl_order SET cancel_order='$huydon' WHERE order_cart_id='$mahang' ");
	$sql_update_giaodich = mysqli_query($con , "UPDATE tbl_transaction SET cancel_order='$huydon' WHERE transaction_code='$mahang' ");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Đơn hàng</title>
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
				if (isset($_GET['quanly']) == 'xemdonhang') {
					$mahang      = $_GET['mahang'];
					$sql_chitiet = mysqli_query($con , "SELECT * FROM tbl_order,tbl_product WHERE tbl_order.product_id=tbl_product.product_id AND tbl_order.order_cart_id='$mahang' ");
					?>
						<div class="col-md-7">
							<p>Xem chi tiết đơn hàng</p>
							<form action="" method="POST">
								<table class="table table-bordered ">
									<tr>
										<th>Thứ tự</th>
										<th>Mã hàng</th>
										<th>Tên sản phẩm</th>
										<th>Số lượng</th>
										<th>Giá</th>
										<th>Tổng tiền</th>
										<th>Ngày đặt hàng</th>
										<!-- <th>Quản lý</th> -->
									</tr>
									<?php
										$i = 1;
										while ($row_chitiet = mysqli_fetch_array($sql_chitiet)) {
									?>
									<tr>
										<td><?php echo $i;  ?></td>
										<td><?php echo $row_chitiet['order_cart_id'];  ?></td>
										<td><?php echo $row_chitiet['product_name'];  ?></td>
										<td><?php echo $row_chitiet['order_total'];  ?></td>
										<td><?php echo number_format($row_chitiet['product_sale_price']).' đ';  ?></td>
										<td><?php echo number_format($row_chitiet['order_total']*$row_chitiet['product_sale_price']).' đ';  ?></td>
										<td><?php echo $row_chitiet['date_time'];  ?></td>
										<input type="hidden" name="mahang_xuly" value="<?php echo $row_chitiet['order_cart_id']; ?>">
										<!-- <td><a href="?xoa=<?php echo $row_order_select['order_id']; ?>">Xóa</a> || <a href="?quanly=xemdonhang&mahang=<?php echo $row_order_select['order_cart_id']; ?>">Xem đơn hàng</a></td> -->
									</tr>
									<?php
										$i++; 
										}
									?>
								</table>
								<select class="form-control" name="xuly">
									<option value="1">Đã xử lý</option>
									<option value="0">Chưa xử lý</option>
								</select><br>
								<input type="submit" value="Cập nhật đơn hàng" name="capnhatdonhang" class="btn btn-success">
							</form>							
						</div>
						<div class="col-md-5">
							<h4>Liệt kê đơn hàng</h4>
							<?php 
								$sql_order_select = mysqli_query($con , "SELECT * FROM tbl_product,tbl_order,tbl_customer WHERE tbl_order.product_id=tbl_product.product_id AND tbl_order.customer_id=tbl_customer.customer_id GROUP BY tbl_order.order_cart_id ORDER BY tbl_order.order_id DESC");
							?>
							<table class="table table-bordered ">
								<tr>
									<th>Thứ tự</th>
									<th>Mã hàng</th>
									<th>Tình trạng đơn hàng</th>
									<th>Tên khách hàng</th>
									<th>Ngày đặt hàng</th>
									<th>Ghi chú</th>
									<th>Hủy đơn hàng</th>
									<th>Phương thức thanh toán</th>
									<th>Quản lý</th>
								</tr>
								<?php
									$i = 1;
									while ($row_order_select = mysqli_fetch_array($sql_order_select)) {
								?>
								<tr>
									<td><?php echo $i;  ?></td>
									<td><?php echo $row_order_select['order_cart_id'];  ?></td>
									<td>
										<?php
											if ($row_order_select['status'] == 0) {
												echo 'Chưa xử lý';
											}else{
												echo 'Đã xử lý';
											}
										?>	
									</td>
									<td><?php echo $row_order_select['customer_name'];  ?></td>
									<td><?php echo $row_order_select['date_time'];  ?></td>
									<td><?php echo $row_order_select['customer_note'];  ?></td>
									<td>
										<?php
											if ($row_order_select['cancel_order'] == 0) {
												echo 'Không';
											}elseif ($row_order_select['cancel_order'] == 1){
												echo '<a href="xulydonhang.php?quanly=xemdonhang&mahang='.$row_order_select['order_cart_id'].'&xacnhanhuy=2">Xác nhận hủy</a>';
											}else{
												echo 'Đã hủy';
											}
										?>	
									</td>
									<td>
										<?php
											if ($row_order_select['customer_delivery'] == 1) {
												echo 'ATM';
											}else{
												echo 'Tại nhà';
											}
										?>			
									</td>
									<td><a href="?xoadonhang=<?php echo $row_order_select['order_cart_id']; ?>">Xóa</a> || <a href="?quanly=xemdonhang&mahang=<?php echo $row_order_select['order_cart_id']; ?>">Xem đơn hàng</a></td>
								</tr>
								<?php
									$i++; 
									}
								?>
							</table>
						</div>
					<?php
				}
				else{			
			?>
					<div class="col-md-7">
						<p>Đơn hàng</p>
					</div>
					<div class="col-md-12">
				<h4>Liệt kê đơn hàng</h4>
				<?php 
					$sql_order_select = mysqli_query($con , "SELECT * FROM tbl_product,tbl_order,tbl_customer WHERE tbl_order.product_id=tbl_product.product_id AND tbl_order.customer_id=tbl_customer.customer_id GROUP BY tbl_order.order_cart_id ORDER BY tbl_order.order_id DESC");
				?>
				<table class="table table-bordered ">
					<tr>
						<th>Thứ tự</th>
						<th>Mã hàng</th>
						<th>Tình trạng đơn hàng</th>
						<th>Tên khách hàng</th>
						<th>Ngày đặt hàng</th>
						<th>Ghi chú</th>
						<th>Hủy đơn hàng</th>
						<th>Quản lý</th>
					</tr>
					<?php
						$i = 1;
						while ($row_order_select = mysqli_fetch_array($sql_order_select)) {
					?>
					<tr>
						<td><?php echo $i;  ?></td>
						<td><?php echo $row_order_select['order_cart_id'];  ?></td>
						<td>
							<?php
								if ($row_order_select['status'] == 0) {
									echo 'Chưa xử lý';
								}else{
									echo 'Đã xử lý';
								}
							?>	
						</td>
						<td><?php echo $row_order_select['customer_name'];  ?></td>
						<td><?php echo $row_order_select['date_time'];  ?></td>
						<td><?php echo $row_order_select['customer_note'];  ?></td>
						<td>
							<?php
								if ($row_order_select['cancel_order'] == 0) {
									echo 'Không';
								}elseif ($row_order_select['cancel_order'] == 1){
									echo '<a href="xulydonhang.php?quanly=xemdonhang&mahang='.$row_order_select['order_cart_id'].'&xacnhanhuy=2">Xác nhận hủy</a>';
								}else{
									echo 'Đã hủy';
								}
							?>	
						</td>
						<td><a href="?xoadonhang=<?php echo $row_order_select['order_cart_id']; ?>">Xóa</a> || <a href="?quanly=xemdonhang&mahang=<?php echo $row_order_select['order_cart_id']; ?>">Xem đơn hàng</a></td>
					</tr>
					<?php
						$i++; 
						}
					?>
				</table>
			</div>
			<?php
				}
			?>

			
		</div>
	</div>
</body>
</html>