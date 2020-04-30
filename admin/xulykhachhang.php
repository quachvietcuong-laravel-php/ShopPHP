<?php 
	include ('../db/connect.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Khách hàng</title>
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
		<div class="row">
			<div class="col-md-12">
				<h4>Danh sách khách hàng</h4>
				<?php 
					$sql_customer = mysqli_query($con , "SELECT * FROM tbl_customer,tbl_transaction WHERE tbl_customer.customer_id=tbl_transaction.customer_id GROUP BY tbl_transaction.transaction_code ORDER BY tbl_customer.customer_id DESC");
				?>
				<table class="table table-bordered ">
					<tr>
						<th>Thứ tự</th>
						<th>Tên khách hàng</th>
						<th>Số điện thoại</th>
						<th>Địa chỉ</th>
						<th>Email</th>
						<th>Ngày mua hàng</th>
						<th>Quản lý</th>
					</tr>
					<?php
						$i = 1;
						while ($row_customer = mysqli_fetch_array($sql_customer)) {
					?>
					<tr>
						<td><?php echo $i;  ?></td>
						<td><?php echo $row_customer['customer_name'];  ?></td>
						<td><?php echo $row_customer['customer_phone'];  ?></td>
						<td><?php echo $row_customer['customer_address'];  ?></td>
						<td><?php echo $row_customer['customer_email'];  ?></td>
						<td><?php echo $row_customer['date_time'];  ?></td>
						<td><a href="?quanly=xemgiaodich&khachhang=<?php echo $row_customer['transaction_code']; ?>">Xem giao dịch</a></td>
					</tr>
					<?php
						$i++; 
						}
					?>
				</table>
			</div>
			<div class="col-md-12">
				<h4>Liệt kê lịch sử đơn hàng</h4>
				<?php
					if (isset($_GET['khachhang'])) {
						$magiaodich = $_GET['khachhang'];
					}else{
						$magiaodich = '';
					}
					$sql_order_select = mysqli_query($con , "SELECT * FROM tbl_transaction,tbl_customer,tbl_product WHERE tbl_transaction.product_id=tbl_product.product_id AND tbl_customer.customer_id=tbl_transaction.customer_id AND tbl_transaction.transaction_code='$magiaodich' ORDER BY tbl_transaction.transaction_id DESC");
				?>
				<table class="table table-bordered ">
					<tr>
						<th>Thứ tự</th>
						<th>Mã giao dịch</th>
						<th>Tên sản phẩm</th>
						<th>Ngày đặt hàng</th>
					</tr>
					<?php
						$i = 1;
						while ($row_order_select = mysqli_fetch_array($sql_order_select)) {
					?>
					<tr>
						<td><?php echo $i;  ?></td>
						<td><?php echo $row_order_select['transaction_code'];  ?></td>
						<td><?php echo $row_order_select['product_name'];  ?></td>
						<td><?php echo $row_order_select['date_time'];  ?></td>
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