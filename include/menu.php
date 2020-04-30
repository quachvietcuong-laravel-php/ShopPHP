	<?php
		$sql_category = mysqli_query($con , "SELECT * FROM tbl_category ORDER BY category_id DESC");
	?>

	<div class="navbar-inner">
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="agileits-navi_search">
					<form action="#" method="post">
						<script>
							function gosort(url) {
							  	window.location.href = url;
							}                                                
						</script>
						<select id="agileinfo-nav_search" name="agileinfo_search" class="border" onchange="gosort(this.value);" required="">
							<option value="">Danh mục sản phẩm</option>
							<?php
								while ($row_category = mysqli_fetch_array($sql_category)) {
									echo 	'<option value="?quanly=danhmuc&id='.$row_category['category_id'].'">
												'.$row_category['category_name'].'								
											</option>';
								}
							?>	
						</select>
					</form>
				</div>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
				    aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto text-center mr-xl-5">
						<li class="nav-item active mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link" href="index.php">Trang chủ
								<span class="sr-only">(current)</span>
							</a>
						</li>

						<?php
							$sql_category_danhmuc   = 'SELECT * FROM tbl_category ORDER BY category_id DESC';	
							$fetch_category_danhmuc = mysqli_query($con , $sql_category_danhmuc);
								
							while ($row_category_danhmuc = mysqli_fetch_array($fetch_category_danhmuc)) {
								echo 	'<li class="nav-item  mr-lg-2 mb-lg-0 mb-2">
											<a class="nav-link " href="?quanly=danhmuc&id='.$row_category_danhmuc['category_id'].'" role="button" aria-haspopup="true" aria-expanded="false">
												'.$row_category_danhmuc['category_name'].'
											</a>						
										</li>';
							}
						?>

						<li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
							<?php 
								$sql_news = mysqli_query($con , "SELECT * FROM tbl_news ORDER BY news_id DESC");
							?>
							<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Tin tức
							</a>
							<div class="dropdown-menu">
								<?php 
									while ($row_news = mysqli_fetch_array($sql_news)) {
								?>
								<a class="dropdown-item" href="?quanly=tintuc&id_news=<?php echo $row_news['news_id']; ?>"><?php echo $row_news['news_name']; ?></a>
								<?php 
									}
								?>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</div>
	<!-- //navigation -->