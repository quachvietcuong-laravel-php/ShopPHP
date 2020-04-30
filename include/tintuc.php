<?php 
	if (isset($_GET['id_news'])) {
		$id_news = $_GET['id_news'];
	}else{
		$id_news = '';
	}
	$sql_news = mysqli_query($con , "SELECT * FROM tbl_news WHERE news_id='$id_news' ");
	$row_news = mysqli_fetch_array($sql_news);
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
					<li><?php echo $row_news['news_name']; ?></li>
				</ul>
			</div>
		</div>
	</div>
<!-- //page -->
<!-- about -->
	<div class="welcome py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3"><?php echo $row_news['news_name']; ?></h3>
			<!-- //tittle heading -->

			<?php 
				$sql_news_post = mysqli_query($con, "SELECT * FROM tbl_news,tbl_news_post WHERE tbl_news.news_id=tbl_news_post.news_id AND tbl_news.news_id='$id_news' ORDER BY tbl_news_post.news_post_id ");
			?>
			<?php 
				while ($row_news_post = mysqli_fetch_array($sql_news_post)) {
			?>
			<div class="row">
				<div class="col-lg-4 welcome-right-top mt-lg-0 mt-sm-5 mt-4">
					<img src="images/<?php echo $row_news_post['image']; ?>" class="img-fluid" alt=" ">
				</div>
				<div class="col-lg-8 welcome-left">
					<h3><a href="index.php?quanly=chitiettin&id_post=<?php echo $row_news_post['news_post_id']; ?>"><?php echo $row_news_post['news_post_name']; ?></a></h3>
					<h4 class="my-sm-3 my-2"><?php echo $row_news_post['short_description']; ?></h4>
				</div>
			</div><br>
			<?php 
				}
			?>
		</div>
	</div>
<!-- //about -->