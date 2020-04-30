<?php 
	if (isset($_GET['id_post'])) {
		$id_post = $_GET['id_post'];
	}else{
		$id_post = '';
	}

	$sql_post = mysqli_query($con , "SELECT * FROM tbl_news_post WHERE news_post_id='$id_post' ");
	$row_post = mysqli_fetch_array($sql_post);
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
					<li><?php echo $row_post['news_post_name']; ?></li>
				</ul>
			</div>
		</div>
	</div>
<!-- //page -->
<!-- about -->
	<div class="welcome py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3"><?php echo $row_post['news_post_name']; ?></h3>
			<!-- //tittle heading -->

			<?php 
				$sql_news_post = mysqli_query($con, "SELECT * FROM tbl_news_post WHERE news_id='$id_post' ");
				$row_news_post = mysqli_fetch_array($sql_news_post);
			?>
			<div class="row">
				<div class="col-lg-12 welcome-right-top mt-lg-0 mt-sm-5 mt-4">
					<center><img src="images/<?php echo $row_news_post['image']; ?>" class="img-fluid" alt=" "></center>
				</div>
				<div class="col-lg-12 welcome-left">
					<h4 class="my-sm-3 my-2"><?php echo $row_news_post['short_description']; ?></h4>
					<p class=""><?php echo $row_news_post['contents']; ?></p>
				</div>
			</div><br>
		</div>
	</div>
<!-- //about -->