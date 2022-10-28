<?php
    require "connection.php";
    $id = $_GET['id'];
    $rows = mysqli_query($conn, "SELECT * FROM movie_tbl WHERE movie_id = '$id'");
?>

<!DOCTYPE html>
<head>
    <title> MOVIETASTIC</title>
    <link rel="shortcut icon" href="media/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/movie_tab.css">
</head>
<body>
<!-- navbar---------------------------------------------------------->
    <header>
    <img class="logo" src="media/logo.png" alt="logo">
        <nav>
            <ul class="nav_links">
            <li><a href="index.php">HOME</a></li>
                <li><a href="movie.php">MOVIES</a></li>
                <li><a href="upcoming.php">UPCOMING</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="contact.php">CONTACT US</a></li>
            </ul>
        </nav>
    </header>
<hr>

        <div class="descrip">
            <?php foreach ($rows as $row) : ?>
                <img src="img/<?php echo $row['banner2'] ?>" class="pic"><br><br><br><br>
                <h4><?php echo $row['movie_category'];?></h4>
                <h1><?php echo $row['movie_title'];?></h1>
                    <h3><?php echo $row['movie_description'];?><br></h3><br>
        </div><br>
                <h1>Official Trailer</h1>
                <iframe src="<?php echo $row['movie_trailer'];?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br>
                <hr>
            <?php endforeach; ?>
</body>
</html>