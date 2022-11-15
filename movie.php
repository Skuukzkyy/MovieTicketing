<?php
require "connection.php";
$current_date = date('Y-m-d');
$next_month_date = date('Y-m-d', strtotime('+1 month'));
?>

<!DOCTYPE html>
<head>
		<title> MOVISTASTIC</title>
		<link rel="shortcut icon" href="media/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/movie.css">
	<script src="js/jquery-3.6.1.min.js"></script>
	<script src="js/movie.js"></script>
</head>
<body>
	<!-- navbar---------------------------------------------------------->
			<header>
			<img class="logo" src="media/logo.png" alt="logo">
					<nav>
							<ul class="nav_links">
								<li><a href="index.php">HOME</a></li>
								<li><a href="movie.php" class="active">MOVIES</a></li>
								<li><a href="upcoming.php">UPCOMING</a></li>
								<li><a href="about.php">ABOUT</a></li>
								<li><a href="contact.php">CONTACT US</a></li>
							</ul>
					</nav>
			</header>

	<!-- TOP PICKS---------------------------------------------------------->
	<div class="search-container">
		<input id="searchBar" type="search" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
	</div>
		<hr><br>
	<p class="head">TOP PICKS</p>
	<div class="container top-picks-container">
		<?php
			$rows = mysqli_query($conn, "SELECT * FROM tickets_tbl INNER JOIN movie_tbl ON tickets_tbl.movie_id = movie_tbl.movie_id ORDER BY tickets_tbl.sold_ticket DESC LIMIT 10");
			foreach ($rows as $row): $id = $row['movie_id']?>
				<div class="box"></a>
					<div class="imgBox">
						<img src="img/<?php echo $row['banner2'] ?>">
					</div>
					<div class="details">
						<div class="content">
							<h2><?php echo $row['movie_title'] ?></h2>
							<p>
								<?php $movie_category = mysqli_query($conn, "SELECT movie_category.movie_title, category_tbl.category FROM movie_category INNER JOIN category_tbl ON movie_category.category_id = category_tbl.category_id INNER JOIN movie_tbl ON movie_category.movie_title = movie_tbl.movie_title WHERE movie_tbl.movie_id = '$id'"); ?>
								<?php foreach ($movie_category as $category) {
									echo $category['category'].", ";
								} ?>  
							</p><br>
							<a href="movie_tab.php?id=<?php echo $row['movie_id'] ?>"><button class="btn_buy"> Buy Tickets</button></a>
						</div>
					</div>
				</div>
			<?php endforeach?>
	</div>

	<!-- NEW RELEASES---------------------------------------------------------->
	<hr><br>
	<p class="head">NEW RELEASES</p>
	<div class="container new-releases-container">
	<?php
			$rows = mysqli_query($conn, "SELECT * FROM movie_tbl WHERE movie_start <= CURDATE() AND movie_start + interval 1 month >= CURDATE()");
			foreach ($rows as $row): $id = $row['movie_id']?>
				<div class="box"></a>
					<div class="imgBox">
						<img src="img/<?php echo $row['banner2'] ?>">
					</div>
					<div class="details">
						<div id="content" class="content">
							<h2><?php echo $row['movie_title'] ?></h2>
							<p>
								<?php $movie_category = mysqli_query($conn, "SELECT movie_category.movie_title, category_tbl.category FROM movie_category INNER JOIN category_tbl ON movie_category.category_id = category_tbl.category_id INNER JOIN movie_tbl ON movie_category.movie_title = movie_tbl.movie_title WHERE movie_tbl.movie_id = '$id'"); ?>
								<?php foreach ($movie_category as $category) {
									echo $category['category'].", ";
								} ?> 
							</p><br>
							<a href="movie_tab.php?id=<?php echo $row['movie_id'] ?>"><button class="btn_buy"> Buy Tickets</button></a>
						</div>
					</div>
				</div>
			<?php endforeach?>
	</div>

	<!-- ALL MOVIES---------------------------------------------------------->
	<hr><br>
	<p class="head">ALL MOVIES</p>
	<p id="search-title"></p>
	<div class="container all-movies-container">
		<?php
			$rows = mysqli_query($conn, "SELECT * FROM movie_tbl ORDER BY movie_title");
			foreach ($rows as $row): $id = $row['movie_id']?>
				<div class="box">
					<div class="imgBox">
						<img src="img/<?php echo $row['banner2'] ?>">
					</div>
					<div class="details">
						<div class="content">
							<h2><?php echo $row['movie_title'] ?></h2>
							<p>
								<?php $movie_category = mysqli_query($conn, "SELECT movie_category.movie_title, category_tbl.category FROM movie_category INNER JOIN category_tbl ON movie_category.category_id = category_tbl.category_id INNER JOIN movie_tbl ON movie_category.movie_title = movie_tbl.movie_title WHERE movie_tbl.movie_id = '$id'"); ?>
								<?php foreach ($movie_category as $category) {
									echo $category['category'].", ";
								} ?>  
							</p><br>
							<a href="movie_tab.php?id=<?php echo $row['movie_id'] ?>"><button class="btn_buy"> Buy Tickets</button></a>
						</div>
					</div>
				</div>
			<?php endforeach?>
	</div><hr>
</body>
</html>
