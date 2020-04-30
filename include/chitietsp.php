<?php  

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}else{
		$id = '';
	}
	$sql_detail = mysqli_query($con , "SELECT * FROM tbl_product WHERE product_id='$id'");

?>

<!-- page -->
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="index.php">Trang chủ</a>
						<i>|</i>
					</li>
					<li>Single Product 1</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->
	<?php 
		while($row_detail = mysqli_fetch_array($sql_detail)){
	?>
	<!-- Single Page -->
	<div class="banner-bootom-w3-agileits py-5">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3"></h3>
			<!-- //tittle heading -->
			<div class="row">
				<div class="col-lg-5 col-md-8 single-right-left ">
					<div class="grid images_3_of_2">
						<div class="flexslider">
							<ul class="slides">
								<li data-thumb="images/<?php echo $row_detail['product_image']; ?>">
									<div class="thumb-image">
										<img src="images/<?php echo $row_detail['product_image']; ?>" data-imagezoom="true" class="img-fluid" alt=""> </div>
								</li>
								
							</ul>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>

				<div class="col-lg-7 single-right-left simpleCart_shelfItem">
					<h3 class="mb-3"><?php echo $row_detail['product_name']; ?></h3>
					<p class="mb-3">
						<span class="item_price"><?php echo number_format($row_detail['product_sale_price']).' đ'; ?></span>
						<del class="mx-2 font-weight-light"><?php echo number_format($row_detail['product_price']).' đ'; ?></del>
						<label>
							<?php
								$money = 2000000;
								if ($row_detail['product_sale_price'] > $money) {
									echo 'Miễn phí vận chuyển';
								}else{
									echo 'Không miễn phí vận chuyển';
								}
							?>	
						</label>
					</p>
					<p><?php echo $row_detail['product_short_description']; ?></p><br />
					<div class="product-single-w3l">
						<p><?php echo $row_detail['product_full_description']; ?></p><br />
					</div>
					<div class="occasion-cart">
						<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
							<form action="?quanly=giohang" method="post">
								<fieldset>
									<input type="hidden" name="sanpham_name" value="<?php echo $row_detail['product_name']; ?>" />
									<input type="hidden" name="sanpham_id" value="<?php echo $row_detail['product_id']; ?>" />
									<input type="hidden" name="sanpham_price" value="<?php echo $row_detail['product_sale_price']; ?>" />
									<input type="hidden" name="sanpham_image" value="<?php echo $row_detail['product_image']; ?>" />
									<input type="hidden" name="sanpham_total" value="1" />
									<input type="submit" name="themgiohang" value="Thêm vào giỏ hàng" class="button" />
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //Single Page -->
	<?php
		}
	?>