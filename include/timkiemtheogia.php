
<!-- top Products -->
	<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">Danh mục sản phẩm</h3>
			<!-- //tittle heading -->
			<div class="row">
				<!-- product left -->
				<?php 
					if (isset($_GET['maxgia']) && isset($_GET['mingia'])) {
						$maxgia = $_GET['maxgia'];
						$mingia = $_GET['mingia'];
					}else{
						$maxgia = '';
						$mingia = '';
					}
					if ($maxgia == 1000000 && $mingia == 0) {		
				?>
					<div class="agileinfo-ads-display col-lg-9">
						<div class="wrapper">
							<?php 
								$sql_category_home = mysqli_query($con , "SELECT * FROM tbl_category ORDER BY category_id DESC");
								while ($row_category_home = mysqli_fetch_array($sql_category_home)) {
									$id_category   = $row_category_home['category_id'];
							?>
							<!-- first section -->
							<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
								<h3 class="heading-tittle text-center font-italic"><?php echo $row_category_home['category_name']; ?></h3>
								<div class="row">
									<?php 
										$sql_product = mysqli_query($con , "SELECT * FROM tbl_product WHERE product_sale_price BETWEEN 0 AND '$maxgia' ORDER BY product_id DESC");
										while ($row_product = mysqli_fetch_array($sql_product)) {
											if ($row_product['category_id'] == $id_category) {
									?>
									<div class="col-md-4 product-men mt-5">
										<div class="men-pro-item simpleCart_shelfItem">
											<div class="men-thumb-item text-center">
												<img src="images/<?php echo $row_product['product_image']; ?>" alt="">
												<div class="men-cart-pro">
													<div class="inner-men-cart-pro">
														<a href="?quanly=chitietsp&id=<?php echo $row_product['product_id']; ?>" class="link-product-add-cart">Xem sản phẩm</a>
													</div>
												</div>
											</div>
											<div class="item-info-product text-center border-top mt-4">
												<h4 class="pt-1">
													<a href="?quanly=chitietsp&id=<?php echo $row_product['product_id']; ?>"><?php echo $row_product['product_name']; ?></a>
												</h4>
												<div class="info-product-price my-2">
													<span class="item_price"><?php echo number_format($row_product['product_sale_price']).' đ'; ?></span>
													<del><?php echo number_format($row_product['product_price']).' đ'; ?></del>
												</div>
												<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
													<form action="?quanly=giohang" method="post">
														<fieldset>
															<input type="hidden" name="sanpham_name" value="<?php echo $row_product['product_name']; ?>" />
															<input type="hidden" name="sanpham_id" value="<?php echo $row_product['product_id']; ?>" />
															<input type="hidden" name="sanpham_price" value="<?php echo $row_product['product_sale_price']; ?>" />
															<input type="hidden" name="sanpham_image" value="<?php echo $row_product['product_image']; ?>" />
															<input type="hidden" name="sanpham_total" value="1" />
															<input type="submit" name="themgiohang" value="Thêm vào giỏ hàng" class="button" />
														</fieldset>
													</form>
												</div>
											</div>
										</div>
									</div>
									<?php
											}
										}
									?>
								</div>
							</div>
							<?php 
								}
							?>
							<!-- end first section -->
						</div>
					</div>
				<?php 
					}elseif ($maxgia == 5000000 && $mingia == 1000000){
				?>
					<div class="agileinfo-ads-display col-lg-9">
						<div class="wrapper">
							<?php 
								$sql_category_home = mysqli_query($con , "SELECT * FROM tbl_category ORDER BY category_id DESC");
								while ($row_category_home = mysqli_fetch_array($sql_category_home)) {
									$id_category   = $row_category_home['category_id'];
							?>
							<!-- first section -->
							<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
								<h3 class="heading-tittle text-center font-italic"><?php echo $row_category_home['category_name']; ?></h3>
								<div class="row">
									<?php 
										$sql_product = mysqli_query($con , "SELECT * FROM tbl_product WHERE product_sale_price BETWEEN '$mingia' AND '$maxgia' ORDER BY product_id DESC");
										while ($row_product = mysqli_fetch_array($sql_product)) {
											if ($row_product['category_id'] == $id_category) {
									?>
									<div class="col-md-4 product-men mt-5">
										<div class="men-pro-item simpleCart_shelfItem">
											<div class="men-thumb-item text-center">
												<img src="images/<?php echo $row_product['product_image']; ?>" alt="">
												<div class="men-cart-pro">
													<div class="inner-men-cart-pro">
														<a href="?quanly=chitietsp&id=<?php echo $row_product['product_id']; ?>" class="link-product-add-cart">Xem sản phẩm</a>
													</div>
												</div>
											</div>
											<div class="item-info-product text-center border-top mt-4">
												<h4 class="pt-1">
													<a href="?quanly=chitietsp&id=<?php echo $row_product['product_id']; ?>"><?php echo $row_product['product_name']; ?></a>
												</h4>
												<div class="info-product-price my-2">
													<span class="item_price"><?php echo number_format($row_product['product_sale_price']).' đ'; ?></span>
													<del><?php echo number_format($row_product['product_price']).' đ'; ?></del>
												</div>
												<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
													<form action="?quanly=giohang" method="post">
														<fieldset>
															<input type="hidden" name="sanpham_name" value="<?php echo $row_product['product_name']; ?>" />
															<input type="hidden" name="sanpham_id" value="<?php echo $row_product['product_id']; ?>" />
															<input type="hidden" name="sanpham_price" value="<?php echo $row_product['product_sale_price']; ?>" />
															<input type="hidden" name="sanpham_image" value="<?php echo $row_product['product_image']; ?>" />
															<input type="hidden" name="sanpham_total" value="1" />
															<input type="submit" name="themgiohang" value="Thêm vào giỏ hàng" class="button" />
														</fieldset>
													</form>
												</div>
											</div>
										</div>
									</div>
									<?php
											}
										}
									?>
								</div>
							</div>
							<?php 
								}
							?>
							<!-- end first section -->
						</div>
					</div>
				<?php 
					}elseif ($maxgia == 10000000 && $mingia == 5000000){
				?>
					<div class="agileinfo-ads-display col-lg-9">
						<div class="wrapper">
							<?php 
								$sql_category_home = mysqli_query($con , "SELECT * FROM tbl_category ORDER BY category_id DESC");
								while ($row_category_home = mysqli_fetch_array($sql_category_home)) {
									$id_category   = $row_category_home['category_id'];
							?>
							<!-- first section -->
							<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
								<h3 class="heading-tittle text-center font-italic"><?php echo $row_category_home['category_name']; ?></h3>
								<div class="row">
									<?php 
										$sql_product = mysqli_query($con , "SELECT * FROM tbl_product WHERE product_sale_price BETWEEN 5000000 AND '$maxgia' ORDER BY product_id DESC");
										while ($row_product = mysqli_fetch_array($sql_product)) {
											if ($row_product['category_id'] == $id_category) {
									?>
									<div class="col-md-4 product-men mt-5">
										<div class="men-pro-item simpleCart_shelfItem">
											<div class="men-thumb-item text-center">
												<img src="images/<?php echo $row_product['product_image']; ?>" alt="">
												<div class="men-cart-pro">
													<div class="inner-men-cart-pro">
														<a href="?quanly=chitietsp&id=<?php echo $row_product['product_id']; ?>" class="link-product-add-cart">Xem sản phẩm</a>
													</div>
												</div>
											</div>
											<div class="item-info-product text-center border-top mt-4">
												<h4 class="pt-1">
													<a href="?quanly=chitietsp&id=<?php echo $row_product['product_id']; ?>"><?php echo $row_product['product_name']; ?></a>
												</h4>
												<div class="info-product-price my-2">
													<span class="item_price"><?php echo number_format($row_product['product_sale_price']).' đ'; ?></span>
													<del><?php echo number_format($row_product['product_price']).' đ'; ?></del>
												</div>
												<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
													<form action="?quanly=giohang" method="post">
														<fieldset>
															<input type="hidden" name="sanpham_name" value="<?php echo $row_product['product_name']; ?>" />
															<input type="hidden" name="sanpham_id" value="<?php echo $row_product['product_id']; ?>" />
															<input type="hidden" name="sanpham_price" value="<?php echo $row_product['product_sale_price']; ?>" />
															<input type="hidden" name="sanpham_image" value="<?php echo $row_product['product_image']; ?>" />
															<input type="hidden" name="sanpham_total" value="1" />
															<input type="submit" name="themgiohang" value="Thêm vào giỏ hàng" class="button" />
														</fieldset>
													</form>
												</div>
											</div>
										</div>
									</div>
									<?php
											}
										}
									?>
								</div>
							</div>
							<?php 
								}
							?>
							<!-- end first section -->
						</div>
					</div>
				<?php 
					}elseif ($maxgia == 100000000 && $mingia == 10000000){
				?>
					<div class="agileinfo-ads-display col-lg-9">
						<div class="wrapper">
							<?php 
								$sql_category_home = mysqli_query($con , "SELECT * FROM tbl_category ORDER BY category_id DESC");
								while ($row_category_home = mysqli_fetch_array($sql_category_home)) {
									$id_category   = $row_category_home['category_id'];
							?>
							<!-- first section -->
							<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
								<h3 class="heading-tittle text-center font-italic"><?php echo $row_category_home['category_name']; ?></h3>
								<div class="row">
									<?php 
										$sql_product = mysqli_query($con , "SELECT * FROM tbl_product WHERE product_sale_price BETWEEN 10000000 AND '$maxgia' ORDER BY product_id DESC");
										while ($row_product = mysqli_fetch_array($sql_product)) {
											if ($row_product['category_id'] == $id_category) {
									?>
									<div class="col-md-4 product-men mt-5">
										<div class="men-pro-item simpleCart_shelfItem">
											<div class="men-thumb-item text-center">
												<img src="images/<?php echo $row_product['product_image']; ?>" alt="">
												<div class="men-cart-pro">
													<div class="inner-men-cart-pro">
														<a href="?quanly=chitietsp&id=<?php echo $row_product['product_id']; ?>" class="link-product-add-cart">Xem sản phẩm</a>
													</div>
												</div>
											</div>
											<div class="item-info-product text-center border-top mt-4">
												<h4 class="pt-1">
													<a href="?quanly=chitietsp&id=<?php echo $row_product['product_id']; ?>"><?php echo $row_product['product_name']; ?></a>
												</h4>
												<div class="info-product-price my-2">
													<span class="item_price"><?php echo number_format($row_product['product_sale_price']).' đ'; ?></span>
													<del><?php echo number_format($row_product['product_price']).' đ'; ?></del>
												</div>
												<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
													<form action="?quanly=giohang" method="post">
														<fieldset>
															<input type="hidden" name="sanpham_name" value="<?php echo $row_product['product_name']; ?>" />
															<input type="hidden" name="sanpham_id" value="<?php echo $row_product['product_id']; ?>" />
															<input type="hidden" name="sanpham_price" value="<?php echo $row_product['product_sale_price']; ?>" />
															<input type="hidden" name="sanpham_image" value="<?php echo $row_product['product_image']; ?>" />
															<input type="hidden" name="sanpham_total" value="1" />
															<input type="submit" name="themgiohang" value="Thêm vào giỏ hàng" class="button" />
														</fieldset>
													</form>
												</div>
											</div>
										</div>
									</div>
									<?php
											}
										}
									?>
								</div>
							</div>
							<?php 
								}
							?>
							<!-- end first section -->
						</div>
					</div>
				<?php 
					}
				?>
				<!-- product right -->
				<div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
					<div class="side-bar p-sm-4 p-3">
						
						<!-- price -->
						<div class="range border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Giá</h3>
							<div class="w3l-range">
								<ul>
									<li>
										<a href="index.php?quanly=gia&mingia=0&maxgia=1000000">Dưới 1 triệu</a>
									</li>
									<li>
										<a href="index.php?quanly=gia&mingia=1000000&maxgia=5000000">Từ 1 triệu đến 5 triệu</a>
									</li>
									<li>
										<a href="index.php?quanly=gia&mingia=5000000&maxgia=10000000">Từ 5 triệu đến 10 triệu</a>
									</li>
									<li>
										<a href="index.php?quanly=gia&mingia=10000000&maxgia=100000000">Trên 10 triệu</a>
									</li>				
								</ul>
							</div>
						</div>
						<!-- //price -->
						<!-- reviews -->
						<div class="customer-rev border-bottom left-side py-2">
							<h3 class="agileits-sear-head mb-3">Khách hàng Review</h3>
							<ul>
								<li>
									<a href="#">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<span>5.0</span>
									</a>
								</li>
							</ul>
						</div>
						<!-- //reviews -->
						<!-- electronics -->
						<div class="left-side border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Danh mục sản phẩm</h3>
							<ul>
								<?php 
									$sql_category_sidebar = mysqli_query($con , "SELECT * FROM tbl_category ORDER BY category_id DESC");
									while ($row_category_sidebar = mysqli_fetch_array($sql_category_sidebar)) {
								?>
								<li>
									<span class="span">
										<a href="index.php?quanly=danhmuc&id=<?php echo $row_category_sidebar['category_id']; ?>"><?php echo $row_category_sidebar['category_name']; ?></a>
									</span>
								</li>
								<?php 
									}	
								?>
							</ul>
						</div>
						<!-- //electronics -->
			
						<!-- best seller -->
						<div class="f-grid py-2">
							<h3 class="agileits-sear-head mb-3">Sản phẩm bán chạy</h3>
							<div class="box-scroll">
								<div class="scroll">
									<?php 
										$sql_product_sidebar = mysqli_query($con , "SELECT * FROM tbl_product WHERE product_hot='1' ORDER BY product_id DESC");
										while ($row_product_sidebar = mysqli_fetch_array($sql_product_sidebar)) {
									?>
									<div class="row">
										<div class="col-lg-3 col-sm-2 col-3 left-mar">
											<img src="images/<?php echo $row_product_sidebar['product_image']; ?> " alt="" class="img-fluid">
										</div>
										<div class="col-lg-9 col-sm-10 col-9 w3_mvd">
											<a href=""><?php echo $row_product_sidebar['product_name']; ?></a>
											<a href="" class="price-mar mt-2"><?php echo number_format($row_product_sidebar['product_sale_price']).' đ'; ?></a>
											<del><?php echo number_format($row_product_sidebar['product_price']).' đ'; ?></del>
										</div>
									</div>
									<?php 
										}
									?>
								</div>
							</div>
						</div>
						<!-- //best seller -->
					</div>
					<!-- //product right -->
				</div>
			</div>
		</div>
	</div>
	<!-- //top products -->