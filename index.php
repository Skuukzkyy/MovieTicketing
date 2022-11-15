<?php
	require "connection.php";
?>

<!DOCTYPE html>
<head>
	<title> MOVIETASTIC</title>
	<link rel="shortcut icon" href="media/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" href="css/lightslider.css">
	<script src="js/JQuery3.3.1.js"></script>
	<script src="js/lightslider.js"></script>
</head>
<body>
<!-- navbar---------------------------------------------------------->
    <header>
        <img class="logo" src="media/logo.png" alt="logo">
        <nav>
            <ul class="nav_links">
                <li><a href="index.php" class="active">HOME</a></li>
                <li><a href="movie.php">MOVIES</a></li>
                <li><a href="upcoming.php">UPCOMING</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="contact.php">CONTACT US</a></li>
            </ul>
        </nav>
    </header>


<!-- bg movie section---------------------------------------------------------->
    <hr><br>
    <p class="head">FEATURED MOVIES</p>
    <div class="picture">
		<!-- QUERY FOR FEATURES MOVIES -->
		<?php 
			$rows = mysqli_query($conn, "SELECT * FROM movie_tbl LIMIT 5");
			$count = 0;
		?>
		<?php foreach ($rows as $row) : 
			if ($count == 0) {
				echo "
				<div class='image active'>
					<a href='movie_tab.php?id=".$row['movie_id']."'><img src='img/".$row['banner1']."' title='".$row['movie_title']."'></a>
				</div>";
				$count++;
			} else{
		?>
			<div class="image">
			<a href="movie_tab.php?id=<?php echo $row['movie_id']; ?>"><img src="img/<?php echo $row["banner1"]; ?>" title="<?php echo $row['movie_title']; ?>"></a>
			</div>
		<?php } endforeach; ?>
    
    </div><br><br>
    <hr>    
    <a href="movie.php"><button class="btn_viewmore">view more</button></a><br>


<!-- latest movie section---------------------------------------------------------->
    <p class="head">LATEST MOVIES</p>
    <section id="main">
		<ul id="autoWidth" class="cs-hidden">
        <!--box---------------------------->
		<?php 
			$rows = mysqli_query($conn, "SELECT * FROM movie_tbl WHERE CURDATE() >= movie_start ORDER BY movie_start DESC LIMIT 10");
			foreach ($rows as $row) : ?>
				
				<li class="item">
					<!--showcase-box------------------->
					<div class="showcase-box">
						<a href="movie_tab.php?id=<?php echo $row['movie_id']; ?>"><img src="img/<?php echo $row["banner1"]; ?>" title="<?php echo $row['movie_title']; ?>"></a>
					</div>
				</li>

		<?php endforeach; ?>
		</ul>
        
    </section>
    <!--Slider script------------------->
    <script>
        $(document).ready(function() {
    $('#autoWidth').lightSlider({
        autoWidth:true,
        loop:true,
        onSliderLoad: function() {
            $('#autoWidth').removeClass('cS-hidden');
        } 
    });  
	});
    </script>


<!-- upcoming movie section---------------------------------------------------------->
    <hr>
	<a href="upcoming.php"><button class="btn_viewmore">view more</button></a><br>
    <p class="head">UPCOMING MOVIES</p>
    <div class="container">
	<?php 
		$rows = mysqli_query($conn, "SELECT * FROM movie_tbl WHERE CURDATE() <= movie_start ORDER BY movie_start DESC LIMIT 10");
		foreach ($rows as $row) : ?>
			<div class="box">
				<div class="imgBox">
				<img src="img/<?php echo $row["banner2"]; ?>" title="<?php echo $row['movie_title']; ?>">
				</div>  
				<div class="details">
					<div class="content">
						<h2><?php echo $row["movie_title"]; ?></h2>
						<p><?php echo $row["movie_start"]; ?></p><br>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
<!--Footer----------------------------------------------------------------->

</body>
</html>