<?php 
	if (isset($_GET['huydon']) && isset($_GET['magiaodich'])) {
		$huydon     = $_GET['huydon'];
		$magiaodich = $_GET['magiaodich'];
	}else{
		$huydon     = '';
		$magiaodich = '';
	}
	$sql_update_donhang  = mysqli_query($con , "UPDATE tbl_order SET cancel_order='$huydon' WHERE order_cart_id='$magiaodich' ");
	$sql_update_giaodich = mysqli_query($con , "UPDATE tbl_transaction SET cancel_order='$huydon' WHERE transaction_code='$magiaodich' ");
?>
<!-- top Products -->
	<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<?php 
					if (isset($_SESSION['dangnhap_home'])) {
						echo 'Đơn hàng của: ' . $_SESSION['dangnhap_home'];
					}
				?>
			</h3>
			<!-- //tittle heading -->
			<div class="row">
				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">
						<!-- first section -->
						<div class="row">
							<div class="col-md-12">
								<h4>Liệt kê lịch sử mua hàng</h4><br>
								<?php
									if (isset($_GET['khachhang'])) {
										$customer_id = $_GET['khachhang'];
									}else{
										$customer_id = '';
									}
									
									$sql_order_select = mysqli_query($con , "SELECT * FROM tbl_transaction WHERE customer_id='$customer_id'  GROUP BY transaction_code ORDER BY transaction_id DESC");
								?>
								<table class="table table-bordered ">
									<tr>
										<th>Thứ tự</th>
										<th>Mã giao dịch</th>
										<th>Ngày đặt hàng</th>
										<th>Tình trạng</th>
										<th>Hủy đơn hàng</th>
										<th>Quản lý</th>
									</tr>
									<?php
										$i = 1;
										while ($row_order_select = mysqli_fetch_array($sql_order_select)) {
									?>
									<tr>
										<td><?php echo $i;  ?></td>
										<td><?php echo $row_order_select['transaction_code'];  ?></td>
										<td><?php echo $row_order_select['date_time'];  ?></td>
										<td>
											<?php 
												if ($row_order_select['status'] == 0) {
													echo 'Đang chờ xử lý';
												}else{
													echo 'Đã xử lý';
												}
											?>	
										</td>
										<td>
											<?php 
												if ($row_order_select['cancel_order'] == 0) {
											?>
											<a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['customer_id']; ?>&magiaodich=<?php echo $row_order_select['transaction_code']; ?>&huydon=1">	Yêu cầu hủy
											</a>
											<?php 
												}elseif ($row_order_select['cancel_order'] == 1){
													?>
													<p>Đang chờ hủy...</p>
													<?php
												}else{
													?>
													Đã hủy đơn
													<?php
												}
											?>
										</td>
										<td>
											<a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['customer_id']; ?>&magiaodich=<?php echo $row_order_select['transaction_code']; ?>">
												Xem chi tiết giao dịch
											</a>
										</td>
									</tr>
									<?php
										$i++; 
										}
									?>
								</table>
							</div>

							<div class="col-md-12">
								<p>Chi tiết đơn hàng</p><br>
								<?php
									if (isset($_GET['magiaodich'])) {
										$magiaodich = $_GET['magiaodich'];
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
										<th>Số lượng</th>
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
										<td><?php echo $row_order_select['product_total'];  ?></td>
										<td><?php echo $row_order_select['date_time'];  ?></td>

									</tr>
									<?php
										$i++; 
										}
									?>
								</table>
							</div>
						</div>
						<!-- //first section -->
					</div>
				</div>
				<!-- //product left -->
			</div>
		</div>
	</div>
	<!-- //top products -->	