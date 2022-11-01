<?php
    require "connection.php";
    $id = $_GET['id'];
    $movie_info = mysqli_query($conn, "SELECT * FROM movie_tbl INNER JOIN tickets_tbl ON movie_tbl.movie_id = tickets_tbl.movie_id WHERE movie_tbl.movie_id = '$id'");
    foreach ($movie_info as $info) {
        $movie_title = $info['movie_title'];
        $movie_description = $info['movie_description'];
        $movie_trailer = $info['movie_trailer'];
        $ticket_to_sell = $info['ticket_to_sell'];
        $ticket_price = $info['ticket_price'];
        $sold_ticket = $info['sold_ticket'];
        $movie_start = $info['movie_start'];
        $movie_end = $info['movie_end'];
        $banner1 = $info['banner1'];
        $banner2 = $info['banner2'];
    }
    $movie_category = mysqli_query($conn, "SELECT movie_category.movie_title, category_tbl.category FROM movie_category INNER JOIN category_tbl ON movie_category.category_id = category_tbl.category_id INNER JOIN movie_tbl ON movie_category.movie_title = movie_tbl.movie_title WHERE movie_tbl.movie_id = '$id'");

    if (isset($_POST['buyBtn'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $num_of_ticket = $_POST['num_of_ticket'];
        $total_cost = $num_of_ticket * $ticket_price;
        $date = $_POST['date'];
        $view_time = $_POST['view_time'];


        if ($ticket_to_sell < ($sold_ticket + $num_of_ticket)) {
            echo "<script>alert('Sorry there is not enough ticket available as of now 😢')</script>";
        }elseif ($date < $movie_start || $date > $movie_end) {
            echo "<script>alert('ERROR⚠ This date is out of the showing range')</script>";
        }else{
            mysqli_query($conn, "INSERT INTO transaction_tbl VALUES ('', '$id', '$name', '$email', '$ticket_price', '$num_of_ticket', '$total_cost', '$date', '$view_time')");
            mysqli_query($conn, "UPDATE tickets_tbl SET sold_ticket = $sold_ticket + $num_of_ticket WHERE movie_id = '$id'");
            echo "<script>alert('Purchase Success! Please check your email for the receipt. 🤞')</script>";
        }

    }
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
                <img src="img/<?php echo $banner2 ?>" class="pic"><br><br><br><br>
                <h4>
                    <?php foreach ($movie_category as $category) {
                        echo $category['category']." ";
                    } ?>
                </h4>
                <h1><?php echo $movie_title ?></h1>
                    <h3><?php echo $movie_description ?><br></h3><br>
        </div><br>
                <h1>Official Trailer</h1>
                <iframe src="<?php echo $movie_trailer ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br>
                <hr>

    <div id="bottom">
        <div class="buy_form">
            <div class="contact-box">
                <div class="box">
                    <center>
                        <h2>Buy Tickets Now</h2>
                    <p class="Mtitle">One Piece Film Red</p>
                    </center>

                    <form action="" method="POST" class="formP">
                        Full Name :
                        <input type="text" name="name" class="field" placeholder="Full Name" required>
                        Email :
                        <input type="text" name="email" class="field" placeholder="Email" required>
                        No of Tickets :
                        <input type="number" name="num_of_ticket" class="field" placeholder="No of tickets" required>
                        Date :
                        <input type="date" name="date" class="field" placeholder="Date" required>
                        Time of Viewing <br>
                            <input name="view_time" type="radio" id="time1" value="10 AM" required>
                            <label for="time1"> 10 AM</label><br>
                            <input name="view_time" type="radio" id="time2" value="1 PM">
                            <label for="time2"> 1 PM</label><br>
                            <input name="view_time" type="radio" id="time3" value="4 PM">
                            <label for="time3"> 4 PM</label><br>
                        <input type="submit" name="buyBtn" value="Buy Tickets" class="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>