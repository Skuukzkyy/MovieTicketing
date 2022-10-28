<?php
    require 'connection.php';
    $id = $_GET['movie_id'];
    $sql = "SELECT * FROM movie_tbl WHERE movie_id = '$id'";
    $res = $conn->query($sql);
    while ($row = $res->fetch_assoc()) {
                    $mtitle = $row['movie_title'];
                    $mdesc = $row['movie_description'];
                    $price = $row['ticket_price'];
                    $start = $row['start'];
                    $end = $row['end'];
                    $banner = $row['banner'];
    }

    if(isset($_POST["btnSubmit"])){
        $movie_title = $_POST["Mtitle"];
        $movie_description = $_POST["Mdes"];
        $movie_price = $_POST["Mprice"];
        $movie_start = $_POST["MSdate"];
        $movie_end = $_POST["MEdate"];

        $query = "UPDATE movie_tbl SET movie_title = '$movie_title' WHERE movie_id = $id";
        $res = $conn->query($query);
        echo
        "
        <script>
            document.location.href = 'admin_view.php';
        </script>
        ";

    }
?>

<!DOCTYPE html>
<head>
    <title> MOVIETASTIC</title>
    <link rel="shortcut icon" href="media/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>

</head>
<body>
<!-- navbar--------------------------------------------------------------------------------->
    <header>
        <img class="logo" src="media/logo.png" alt="logo">
        <nav>
            <ul class="nav_links">
            <li><a href="index.php">HOME</a></li>
                <li><a href="movie.php">MOVIES</a></li>
                <li><a href="upcoming.php">UPCOMING</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="contact.php">CONTACT US</a></li>
                <li class="admin">ADMINISTRATOR</li>
            </ul>
        </nav>
    </header>

<!-----Upload new movie form---------------------------------------------------------------->
    <hr><br>
	<div class="container mb-3 mt-3">
        <div class="row m-auto">
            <div class="col-lg-10 m-auto">
                <div class="card">
                    <div class="card-header bg-info text-light">
                    <h4> REGISTER NEW MOVIES</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <h6>Movie Title:</h6>
                            <div class="mb-3">
                                <input type="text" name="Mtitle" value=<?php echo $mtitle; ?> class="form-control mr-2 form-control-lg" placeholder="Movie Title" required>
                            </div>

                            <h6>Movie Description:</h6>
                            <div class="mb-3">
                                <textarea name="Mdes" class="form-control mr-2" placeholder="Movie Description" rows="3" required><?php echo $mdesc; ?></textarea>
                            </div>
                            
                            <h6>Price/ticket:</h6>
                            <div class="mb-3">
                                <input type="number" name="Mprice" value=<?php echo $price; ?> class="form-control mr-2 form-control-lg" placeholder="Ticket Price" required>
                            </div>

                            <h6>Movie Showing Starting date:</h6>
                            <div class="mb-3">
                                <input type="date" name="MSdate" value=<?php echo $start; ?> class="form-control mr-2 form-control-lg" required>
                            </div>

                            <h6>Movie Showing Ending date:</h6>
                            <div class="mb-3">
                                <input type="date" name="MEdate" value=<?php echo $end; ?> class="form-control mr-2 form-control-lg" required>
                            </div>

                            <div class="mb-3">
                                <input type="submit" name="btnSubmit" class="btn btn-info mr-2 w-100 text-light" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
<hr><br>

</body>
</html>