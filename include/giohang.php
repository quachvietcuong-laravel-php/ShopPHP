<?php
	$alert = '';
	if (isset($_POST['themgiohang'])) {
		$sanpham_name    = $_POST['sanpham_name'];
		$sanpham_id      = $_POST['sanpham_id'];
		$sanpham_price   = $_POST['sanpham_price'];
		$sanpham_image   = $_POST['sanpham_image'];
		$sanpham_total   = $_POST['sanpham_total'];

		// cập nhật số lượng giỏ hàng
		$sql_select_cart = mysqli_query($con , "SELECT * FROM tbl_cart WHERE product_id='$sanpham_id'");
		$count_product   = mysqli_num_rows($sql_select_cart);
		
		// nếu tồn tại sản phẩm
		if ($count_product > 0) {
			$row_product     = mysqli_fetch_array($sql_select_cart);
			$sanpham_total   = $row_product['product_total'] + 1; // số lượng + 1
			// update sản phẩm vào giỏ hàng 
			$sql_insert_cart = "UPDATE tbl_cart SET product_total='$sanpham_total' WHERE product_id='$sanpham_id'";
		}else{ 
			$sanpham_total   = $sanpham_total; // số lượng = 1
			// thêm sản phẩm vào giỏ hàng 
			$sql_insert_cart = "INSERT INTO tbl_cart(product_name,product_id,product_prire,product_image,product_total) values ('$sanpham_name','$sanpham_id','$sanpham_price','$sanpham_image','$sanpham_total')";
		}

		$insert_row = mysqli_query($con , $sql_insert_cart);
		if ($insert_row == 0) {
			header('Location:index.php?quanly=chitietsp&id='.$sanpham_id);
		}
	}elseif (isset($_POST['capnhatgiohang'])){
		// echo "<pre>";
		// print_r($_POST);
		// echo "<pre>";
		if (!isset($_POST['product_id_cart']) && !isset($_POST['sanpham_total'])) {
			$alert 	= '<div class="alert alert-danger" role="alert">Không có sản phẩm để cập nhật</div>';
		}else{
			for ($i = 0; $i < count($_POST['product_id_cart']) ; $i++) { 
				$sanpham_id     = $_POST['product_id_cart'][$i];
				$sanpham_total  = $_POST['sanpham_total'][$i];
			
				if ($sanpham_total <= 0) {
					$sql_delete = mysqli_query($con , "DELETE FROM tbl_cart WHERE product_id='$sanpham_id'");
					$alert 		= '<div class="alert alert-success" role="alert">Xóa sản phẩm thành công</div>';
				}else{
					$sql_update = mysqli_query($con , "UPDATE tbl_cart SET product_total='$sanpham_total' WHERE product_id='$sanpham_id'");
					$alert 		= '<div class="alert alert-success" role="alert">Cập nhật giỏ hàng thành công</div>';
				}
			}
		}
	}elseif (isset($_POST['xoatatcasanpham'])){
		$sql_check		= mysqli_query($con , "SELECT * FROM  tbl_cart");
		$sql_delete_all = mysqli_query($con , "DELETE FROM tbl_cart");

		if (mysqli_num_rows($sql_check) == 0) {
			$alert  = '<div class="alert alert-danger" role="alert">Giỏ hàng rỗng</div>';
		}else{
			if ($sql_delete_all == true) {
			$alert  = '<div class="alert alert-success" role="alert">Xóa tất cả sản phẩm thành công</div>';
			}
		}
	}elseif (isset($_POST['xoasanpham'])) {
		// echo "<pre>";
		// print_r($_POST);
		// echo "<pre>";
		$id 		= key($_POST['xoasanpham']); // lấy $key của xoasanpham = cart_id
		$sql_delete = mysqli_query($con , "DELETE FROM tbl_cart WHERE cart_id='$id'");
		if ($sql_delete == true) {
			$alert  = '<div class="alert alert-success" role="alert">Xóa sản phẩm thành công</div>';
		}
	}elseif (isset($_GET['dangxuat'])) {
		$id = $_GET['dangxuat'];
		if ($id == 1) {
			unset($_SESSION['dangnhap_home']);
		}
	}

?>
<?php 
	$alert1 = '';
	if (isset($_POST['thanhtoan'])) {
		$customer_name     = $_POST['name'];
		$customer_phone	   = $_POST['phone'];
		$customer_address  = $_POST['address'];
		$customer_note	   = $_POST['note'];
		$customer_email	   = $_POST['email'];
		$customer_password = md5($_POST['password']);
		$customer_delivery = $_POST['giaohang'];
		if (!is_numeric($customer_phone)) {
			$alert1 = '<div class="alert alert-danger" role="alert">Số điện thoại phải là kí tự số</div>';
		}else{
			if (strlen($customer_phone) != 10) {
				$alert1 = '<div class="alert alert-danger" role="alert">Số điện thoại phải là 10 số</div>';
			}else{
				if ($customer_phone[0] != 0) {
					$alert1 = '<div class="alert alert-danger" role="alert">Số phone phải được bắt đầu bằng số 0</div>';
				}else{
					$customer_phone  = trim($customer_phone);
					$sql_check_phone = mysqli_query($con, "SELECT * FROM tbl_customer WHERE customer_phone='$customer_phone' ");
					if (mysqli_num_rows($sql_check_phone)) {
						$alert1 = '<div class="alert alert-danger" role="alert">Số thoại đã tồn tại</div>';
					}else{
						$sql_check_email = mysqli_query($con, "SELECT * FROM tbl_customer WHERE customer_email='$customer_email' ");
						if (mysqli_num_rows($sql_check_email)) {
							$alert1 = '<div class="alert alert-danger" role="alert">Email đã tồn tại</div>';
						}else{
							if (strlen($customer_password >= 6)) {
								$alert1 = '<div class="alert alert-danger" role="alert">Mật khẩu phải từ 6 kí tự trở lên</div>';
							}else{
								if ($customer_delivery == 2) {
									$alert1 = '<div class="alert alert-danger" role="alert">Vui lòng nhập phương thức giao hàng</div>';
								}else{
									$sql_customer      = mysqli_query($con ,"INSERT INTO tbl_customer(customer_name,customer_phone,customer_address,customer_note,customer_email,customer_password,customer_delivery) values ('$customer_name','$customer_phone','$customer_address','$customer_note','$customer_email','$customer_password','$customer_delivery')");
									if ($sql_customer == true) {
										$sql_select_customer = mysqli_query($con , "SELECT * FROM tbl_customer ORDER BY customer_id DESC LIMIT 1");
										$order_cart_id		 = rand(0,99999);
										$row_customer	     = mysqli_fetch_array($sql_select_customer);
										$customer_id 	     = $row_customer['customer_id'];
										
										$_SESSION['dangnhap_home'] = $row_customer['customer_name'];
										$_SESSION['customer_id']   = $customer_id;

										for ($i = 0 ; $i < count($_POST['thanhtoan_product_id_cart']) ; $i++) { 
											$sanpham_id      = $_POST['thanhtoan_product_id_cart'][$i];
											$sanpham_total   = $_POST['thanhtoan_sanpham_total'][$i];
											$sql_order       = mysqli_query($con , "INSERT INTO tbl_order(product_id,order_total,order_cart_id,customer_id) values ('$sanpham_id','$sanpham_total','$order_cart_id','$customer_id')");
											$sql_transaction = mysqli_query($con , "INSERT INTO tbl_transaction(customer_id,product_id,product_total,transaction_code) values ('$customer_id','$sanpham_id','$sanpham_total','$order_cart_id')");
											$sql_delete_thanhtoan = mysqli_query($con , "DELETE FROM tbl_cart WHERE product_id='$sanpham_id'");
										}
										$alert1 = '<div class="alert alert-success" role="alert">Thanh toán thành công</div>';
									}
								}
							}
						}
					}
				}
			}
		}	
	}elseif (isset($_POST['thanhtoandangnhap'])) {
		$customer_delivery = $_POST['giaohang'];
		$customer_id   	   = $_SESSION['customer_id'];
		$order_cart_id 	   = rand(0,99999);
		if ($customer_delivery == 2) {
			$alert = '<div class="alert alert-danger" role="alert">Vui lòng nhập phương thức giao hàng</div>';
		}else{
			// if ($customer_delivery == 1) {
			// 	$thanhtoanATM = '';
			// }else{
				$sql_check         = mysqli_query($con , "SELECT * FROM tbl_customer WHERE customer_id='$customer_id' ORDER BY customer_id DESC LIMIT 1");
				if (mysqli_num_rows($sql_check)) {
					$sql_customer      = mysqli_query($con , "UPDATE tbl_customer SET customer_delivery='$customer_delivery' WHERE customer_id='$customer_id' ");
					if ($sql_customer == true) {
						for ($i = 0 ; $i < count($_POST['thanhtoan_product_id_cart']) ; $i++) { 
							$sanpham_id      = $_POST['thanhtoan_product_id_cart'][$i];
							$sanpham_total   = $_POST['thanhtoan_sanpham_total'][$i];
							$sql_order       = mysqli_query($con ,"INSERT INTO tbl_order(product_id,order_total,order_cart_id,customer_id) values ('$sanpham_id','$sanpham_total','$order_cart_id','$customer_id')");
							$sql_transaction = mysqli_query($con ,"INSERT INTO tbl_transaction(customer_id,product_id,product_total,transaction_code) values ('$customer_id','$sanpham_id','$sanpham_total','$order_cart_id')");
							$sql_delete_thanhtoan = mysqli_query($con , "DELETE FROM tbl_cart WHERE product_id='$sanpham_id'");
						}
						$alert = '<div class="alert alert-success" role="alert">Thanh toán thành công</div>';
					}
				}
			//}
		}
	}

?>
<!-- checkout page -->
	<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>Đ</span>ơn hàng của bạn
			</h3>
			<div class="search">
                <input type="text" id="myInput" placeholder="Tên sản phẩm" title="">
                <!-- thành phần của nút search -->
                <div class="search-name">
                    <ul id="myUL">
	                    <?php 
	                    	$sql_search_product = mysqli_query($con , "SELECT * FROM tbl_product ORDER BY product_id");
	                    	while ($row_search_product = mysqli_fetch_array($sql_search_product)) {
	                    ?>
                    	   	<li>
                    	   		<a href="?quanly=chitietsp&id=<?php echo $row_search_product['product_id'] ?>">
                    	   			<img src="images/<?php echo $row_search_product['product_image']; ?>">
                    	   			<?php echo $row_search_product['product_name']; ?>						
                    	   		</a>    

	                    	   	<div class="occasion-cart">
									<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
										<form action="?quanly=giohang" method="post">
											<fieldset>
												<input type="hidden" name="sanpham_name" value="<?php echo $row_search_product['product_name']; ?>" />
												<input type="hidden" name="sanpham_id" value="<?php echo $row_search_product['product_id']; ?>" />
												<input type="hidden" name="sanpham_price" value="<?php echo $row_search_product['product_sale_price']; ?>" />
												<input type="hidden" name="sanpham_image" value="<?php echo $row_search_product['product_image']; ?>" />
												<input type="hidden" name="sanpham_total" value="1" />
												<input type="submit" name="themgiohang" value="Thêm vào giỏ hàng" class="button" />
											</fieldset>
										</form>
									</div>
								</div>
							</li>
                      	<?php  
                      		}
                      	?>
                    </ul>
                </div>
            </div>

            <!-- javascr của nút search -->
            <script>
			  	// lấy thẻ input
				  var input = document.getElementById("myInput");
				  // định nghĩa hàm xử lý myFunction
				  function myFunction() {
					var filter, ul, li, a, i;
					// lấy giá trị người dùng nhập
					filter = input.value.toUpperCase();
					ul = document.getElementById("myUL");
					li = ul.getElementsByTagName("li");
					// Nếu filter không có giá trị thị ẩn phần kết quare
					if (!filter) {
						ul.style.display = "none";
					}else{
						// lặp qua tất cả các thẻ li chứa kết quả
						for (i = 0; i < li.length; i++) {
							// lấy thẻ a trong các thẻ li
							a = li[i].getElementsByTagName("a")[0];
							// kiểm tra giá trị nhập có tôn tại trong nội dung thẻ a
							if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
							  	//nếu có hiển thị phàn tử	 ul và các thẻ li đó
								ul.style.display = "block";
								li[i].style.display = "";
							} else {
							  	// nếu không ẩn các thẻ li
								li[i].style.display = "none";
							}
						}
					}
				 }
			  	//gán sự kiện cho thẻ input
			  	input.addEventListener("keyup", myFunction);
			</script>
			<?php 
				if (isset($_SESSION['dangnhap_home'])) {
					echo '<p style="color:black;">Xin chào bạn: '.$_SESSION['dangnhap_home'].'<a href="index.php?quanly=giohang&dangxuat=1"> Đăng xuất</a></p>';					
				}else{
					echo '';
				}
			?>
			<!-- //tittle heading -->
			<div class="checkout-right">
				<!-- <h4 class="mb-sm-4 mb-3">Your shopping cart contains:
					<span>3 Products</span>
				</h4>  -->
				<?php 
					$sql_get_cart = mysqli_query($con , "SELECT * FROM tbl_cart ORDER BY cart_id DESC");
				?>
				<div class="table-responsive">
					<form action="" method="POST">
						<?php echo $alert; ?>
						
						<!-- <?php 
							if (isset($_POST['giaohang']) == 1) {
								echo $thanhtoanATM;
							}
						?> -->

						<?php
							if (isset($_SESSION['dangnhap_home'])) {
						?>
						<div class="controls form-group" >
							<select class="option-w3ls" name="giaohang">
								<option value="2">Chọn hình thức giao hàng</option>
								<option value="1">ATM</option>
								<option value="0">Nhận tiền trực tiếp tại nhà</option>
							</select>
						</div>
						<?php 
							}
						?>	
						<table class="timetable_sub">
							<thead>
								<tr>
									<th>Thứ tự</th>
									<th>Sản phẩm</th>
									<th>Số lượng</th>
									<th>Tên sản phẩm</th>
									<th>Giá</th>
									<th>Giá tổng</th>
									<th>Xóa sản phẩm</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$i     = 0;
									$total = 0;
									while ($row_get_cart = mysqli_fetch_array($sql_get_cart)) {
										$subtotal = $row_get_cart['product_total'] * $row_get_cart['product_prire'];
										$total    = $total + $subtotal;
										$i++;
								?>
								<tr class="rem1">
									<td class="invert"><?php echo $i; ?></td>
									<td class="invert-image">
										<a href="?quanly=chitietsp&id=<?php echo $row_get_cart['product_id']; ?>">
											<img src="images/<?php echo $row_get_cart['product_image']; ?>" alt=" " class="img-responsive">
										</a>
									</td>
									<td class="invert">
										<input type="number" min="0" value="<?php echo $row_get_cart['product_total']; ?>" name="sanpham_total[]">
										<input type="hidden"value="<?php echo $row_get_cart['product_id']; ?>" name="product_id_cart[]">
									</td>
									<td class="invert"><?php echo $row_get_cart['product_name']; ?></td>
									<td class="invert"><?php echo number_format($row_get_cart['product_prire']).' đ'; ?></td>
									<td class="invert"><?php echo number_format($subtotal).' đ'; ?></td>
									<td class="invert">
										<input type="submit" class="btn btn-danger" value="Xóa" name="xoasanpham[<?php echo $row_get_cart['cart_id']; ?>]">
									</td>
								</tr>
								<?php 
									}
								?>
								<tr>
									<td colspan="7">Tổng tiền cần thanh toán: <?php echo number_format($total).' đ'; ?></td>
								</tr>
								<tr>								
									<td colspan="7">
										<input type="submit" class="btn btn-success" value="Cập nhật giỏ hàng" name="capnhatgiohang">
									</td>
								</tr>
								<tr>								
									<td colspan="7">
										<input type="submit" class="btn btn-danger" value="Xóa tất cả sản phẩm" name="xoatatcasanpham">
									</td>
								</tr>
								<?php
									$sql_cart_select = mysqli_query($con , "SELECT * FROM tbl_cart");
									$count_cart      = mysqli_num_rows($sql_cart_select);
									
									if (isset($_SESSION['dangnhap_home']) && $count_cart > 0) {
										while ($row_cart_select = mysqli_fetch_array($sql_cart_select)) {
								?>
								<input type="hidden" value="<?php echo $row_cart_select['product_total']; ?>" name="thanhtoan_sanpham_total[]">
								<input type="hidden" value="<?php echo $row_cart_select['product_id']; ?>" name="thanhtoan_product_id_cart[]">
								<?php 
										}
								?>
								<tr>
									<td colspan="7">
										<input type="submit" class="btn btn-primary" value="Thanh toán giỏ hàng" name="thanhtoandangnhap">
									</td>
								</tr>
								<?php
									}
								?>
							</tbody>
						</table>
					</form>
				</div>
			</div>
			<?php 
				if (!isset($_SESSION['dangnhap_home'])) {
			?>
			<div class="checkout-left">
				<div class="address_form_agile mt-sm-5 mt-4">
					<?php echo $alert1; ?>
					<h4 class="mb-sm-4 mb-3">Thêm địa chỉ giao hàng</h4>
					<form action="" method="POST" class="creditly-card-form agileinfo_form">
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<div class="first-row">
									<div class="controls form-group">
										<input class="billing-address-name form-control" type="text" name="name" placeholder="Điền tên của bạn..." required="">
									</div>
									<div class="w3_agileits_card_number_grids">
										<div class="w3_agileits_card_number_grid_left form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Số phone..." name="phone" required="">
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Địa chỉ..." name="address" required="">
											</div>
										</div>
									</div>
									<div class="controls form-group">
										<input type="text" class="form-control" placeholder="Email..." name="email" required="">
									</div>
									<div class="controls form-group">
										<input type="password" class="form-control" placeholder="Password..." name="password" required="">
									</div>
									<div class="controls form-group">
										<TEXTAREA style="resize:none;" class="form-control" placeholder="Ghi chú..." name="note" required=""></TEXTAREA>
									</div>
									<div class="controls form-group" >
										<select class="option-w3ls" name="giaohang">
											<option value="2">Chọn hình thức giao hàng</option>
											<option value="1">Atm</option>
											<option value="0">Nhận tiền trực tiếp tại nhà</option>
										</select>
									</div>
								</div>
								<?php 
									$sql_lay_giohang = mysqli_query($con , "SELECT * FROM tbl_cart ORDER BY cart_id DESC");
									while ($row_cart = mysqli_fetch_array($sql_lay_giohang)) {
								?>
										<input type="hidden" value="<?php echo $row_cart['product_total']; ?>" name="thanhtoan_sanpham_total[]">
										<input type="hidden" value="<?php echo $row_cart['product_id']; ?>" name="thanhtoan_product_id_cart[]">
								<?php 
									}
								?>
								<input type="submit" name="thanhtoan" class="btn btn-success" style="width: 20%" value="Thanh toán">
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php 
				}
			?>
		</div>
	</div>
	<!-- //checkout page