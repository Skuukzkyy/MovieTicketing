<?php
    require "connection.php";
    $id = $_GET['id'];
    $movie_info = mysqli_query($conn, "SELECT * FROM movie_tbl WHERE movie_id = '$id'");
    $movie_category = mysqli_query($conn, "SELECT movie_category.movie_title, category_tbl.category FROM movie_category INNER JOIN category_tbl ON movie_category.category_id = category_tbl.category_id INNER JOIN movie_tbl ON movie_category.movie_title = movie_tbl.movie_title WHERE movie_tbl.movie_id = '$id'");
?>

<!DOCTYPE html>
<head>
    <title> MOVIETASTIC</title>
    <link rel="shortcut icon" href="media/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="css/movie_tab.css">
    <script src="js/JQuery3.3.1.js"></script>
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
            <?php foreach ($movie_info as $data) : ?>
                <img src="img/<?php echo $data['banner2'] ?>" class="pic"><br><br><br><br>
                <h4>
                    <?php foreach ($movie_category as $category) {
                        echo $category['category']." ";
                    } ?>
                </h4>
                <h1><?php echo $data['movie_title'];?></h1>
                    <h3><?php echo $data['movie_description'];?><br></h3><br>
        </div><br>
                <h1>Official Trailer</h1>
                <iframe src="<?php echo $data['movie_trailer'];?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br>
                <hr>
            <?php endforeach; ?>

    <div id="bottom">
        <div class="buy_form">
            <div class="contact-box">
                <div class="box">
                    <center>
                        <h2>Buy Tickets Now</h2>
                    <p class="Mtitle">One Piece Film Red</p>
                    </center>

                    <p class="formP">Full Name :
                        <input type="text" class="field" placeholder="Full Name" required>
                        Email :
                        <input type="text" class="field" placeholder="Email" required>
                        No of Tickets :
                        <input type="number" class="field" placeholder="No of tickets" required>
                        Date :
                        <input type="date" class="field" placeholder="Date" required>
                        Time of Viewing <br>
                            <input type="checkbox" id="time1" value="10 AM">
                            <label for="time1"> 10 AM</label><br>
                            <input type="checkbox" id="time2" value="1 PM">
                            <label for="time2"> 1 PM</label><br>
                            <input type="checkbox" id="time3" value="4PM">
                            <label for="time3"> 4 PM</label><br>
                    <input type="submit" value="Buy Tickets" class="submit">
                </div>
            </div>
        </div>
    </div>

</body>

</html>