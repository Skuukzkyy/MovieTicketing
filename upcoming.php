<?php require("connection.php") ?>
<!DOCTYPE html>
<head>
    <title> MOVIETASTIC</title>
    <link rel="shortcut icon" href="media/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/upcoming.css">
</head>
<body>
<!-- navbar---------------------------------------------------------->
    <header>
    <img class="logo" src="media/logo.png" alt="logo">
        <nav>
            <ul class="nav_links">
            <li><a href="index.php">HOME</a></li>
            <li><a href="movie.php">MOVIES</a></li>
            <li><a href="upcoming.php" class="active">UPCOMING</a></li>
            <li><a href="about.php">ABOUT</a></li>
            <li><a href="contact.php">CONTACT US</a></li>
            </ul>
        </nav>
    </header>

<!-- Movies tab---------------------------------------------------------->
	<hr><br>
	<p class="head">COMING THIS MONTH</p>
	<?php
		// query for this month
		$current_month = date('m');
		$sql = "SELECT * FROM movie_tbl WHERE MONTH(movie_start) = $current_month";
		$rows = mysqli_query($conn, $sql)
	?>
		<div class="container">
			<?php foreach ($rows as $row):  $id = $row['movie_id']?>
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
			<?php endforeach; ?>
		</div>
		<br><br><hr><br>


<!-- Movies tab---------------------------------------------------------->
		<p class="head">COMING THIS YEAR</p>
		<div class="container">
		<?php 
			// query for this year
			$current_year =  date("Y");
			$sql = "SELECT * FROM movie_tbl WHERE movie_start >= CURDATE() AND  YEAR(movie_start) = $current_year";
			$rows = mysqli_query($conn, $sql);
		?>
		<?php foreach ($rows as $row): $id = $row['movie_id']?>
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
		<?php endforeach;?>
		</div>
		<br><br><hr><br>

</body>
</html>