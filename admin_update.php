<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header("Location: admin_login.php");
    }

    require 'connection.php';
    include("dbconfig.php");
	$db = new MyDB();
    $id = $_GET['movie_id'];
    // $sql = "SELECT * FROM movie_tbl WHERE movie_id = '$id'";
    // $res = $conn->query($sql);
    $movie_info = $db->mysqli->query("SELECT * FROM movie_tbl INNER JOIN tickets_tbl ON movie_tbl.movie_id = tickets_tbl.movie_id WHERE movie_tbl.movie_id = '$id'");
    foreach ($movie_info as $info) {
        $movie_title_orig = $info['movie_title'];
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

    if(isset($_POST["btnSubmit"])){
        $movie_title = $_POST["Mtitle"];
        $movie_description = $_POST["Mdes"];
        $movie_trailer = $_POST['Mtrailer'];
        $ticket_to_sell = $_POST['ticket_to_sell'];
        $ticket_price = $_POST['Mprice'];
        $movie_start = $_POST['MSdate'];
        $movie_end = $_POST['MEdate'];

        if($_FILES['Mbanner']['name'] != ""){
            $fileName = $_FILES["Mbanner"]["name"];
            $fileSize = $_FILES["Mbanner"]["size"];
            $tmpName = $_FILES["Mbanner"]["tmp_name"];

            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));
            if ( !in_array($imageExtension, $validImageExtension) ){
            echo
            "
            <script>
                alert('Invalid Image Extension');
            </script>
            ";
            }
            else{
                if ($imageExtension == 'png') {
                    $image2 = imagecreatefrompng($tmpName); 
                }else{
                    $image2 = imagecreatefromjpeg($tmpName); 
                }
                    $banner1 = uniqid();
                    $banner1 .= '.' . $imageExtension;
                    imagejpeg($image2, 'img/' . $banner1, 50);
            }
        }

        if($_FILES["Mbanner2"]["name"] != ""){
            $fileName = $_FILES["Mbanner2"]["name"];
            $fileSize = $_FILES["Mbanner2"]["size"];
            $tmpName = $_FILES["Mbanner2"]["tmp_name"];

            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));
            if ( !in_array($imageExtension, $validImageExtension) ){
            echo
            "
            <script>
                alert('Invalid Image Extension');
            </script>
            ";
            }
            else{
                if ($imageExtension == 'png') {
                    $image = imagecreatefrompng($tmpName); 
                }else{
                    $image = imagecreatefromjpeg($tmpName); 
                }
                    $banner2 = uniqid();
                    $banner2 .= '.' . $imageExtension;
                    imagejpeg($image, 'img/' . $banner2, 50);
            }
        }

        if(is_uploaded_file($_FILES['Mbanner']['tmp_name']) && is_uploaded_file($_FILES['Mbanner2']['tmp_name'])){
            $query = "UPDATE movie_tbl SET movie_title = '$movie_title', movie_description = '$movie_description', movie_trailer = '$movie_trailer', movie_start = '$movie_start', movie_end = '$movie_end', banner1 = '$banner1', banner2 = '$banner2' WHERE movie_id = $id";
            $res = $conn->query($query);
        }elseif(!empty($_FILES["Mbanner"]["name"]) && empty($_FILES["Mbanner2"]["name"])){
            $query = "UPDATE movie_tbl SET movie_title = '$movie_title', movie_description = '$movie_description', movie_trailer = '$movie_trailer', movie_start = '$movie_start', movie_end = '$movie_end', banner1 = '$banner1' WHERE movie_id = $id";
            $res = $conn->query($query);
        }elseif(empty($_FILES["Mbanner"]["name"]) && !empty($_FILES["Mbanner2"]["name"])){
            $query = "UPDATE movie_tbl SET movie_title = '$movie_title', movie_description = '$movie_description', movie_trailer = '$movie_trailer', movie_start = '$movie_start', movie_end = '$movie_end', banner2 = '$banner2' WHERE movie_id = $id";
            $res = $conn->query($query);
        }else{
            $query = "UPDATE movie_tbl SET movie_title = '$movie_title', movie_description = '$movie_description', movie_trailer = '$movie_trailer', movie_start = '$movie_start', movie_end = '$movie_end' WHERE movie_id = $id";
            $res = $conn->query($query);
        }
        
        $query = "UPDATE movie_category SET movie_title = '$movie_title' WHERE movie_title = '$movie_title_orig'";
        $res = $conn->query($query);
        $query = "UPDATE tickets_tbl SET ticket_to_sell = '$ticket_to_sell', ticket_price = '$ticket_price' WHERE movie_id = '$id'";
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
                <li><a href="admin_view.php">HOME</a></li>
                <!-- <li><a href="movie.php">MOVIES</a></li>
                <li><a href="upcoming.php">UPCOMING</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="contact.php">CONTACT US</a></li> -->
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
                                <input type="text" name="Mtitle" value="<?php echo $movie_title_orig; ?>" class="form-control mr-2 form-control-lg" placeholder="Movie Title" required>
                            </div>

                            <h6>Movie Description:</h6>
                            <div class="mb-3">
                                <textarea name="Mdes" class="form-control mr-2" placeholder="Movie Description" rows="3" required><?php echo $movie_description; ?></textarea>
                            </div>
                            
                            <h6>Movie Trailer:</h6>
                            <div class="mb-3">
                                <input type="text" name="Mtrailer" value="<?php echo $movie_trailer ?>" class="form-control mr-2 form-control-lg" placeholder="Movie Trailer" required>
                            </div>

                            <h6>Number of tickets:</h6>
                            <div class="mb-3">
                                <input type="text" name="ticket_to_sell" value="<?php echo $ticket_to_sell ?>" class="form-control mr-2 form-control-lg" placeholder="Number of ticket to sell" required>
                            </div>

                            <h6>Price/ticket:</h6>
                            <div class="mb-3">
                                <input type="number" name="Mprice" value="<?php echo $ticket_price; ?>" class="form-control mr-2 form-control-lg" placeholder="Ticket Price" required>
                            </div>

                            <h6>Movie Showing Starting date:</h6>
                            <div class="mb-3">
                                <input type="date" name="MSdate" value="<?php echo $movie_start; ?>" class="form-control mr-2 form-control-lg" required>
                            </div>

                            <h6>Movie Showing Ending date:</h6>
                            <div class="mb-3">
                                <input type="date" name="MEdate" value="<?php echo $movie_end; ?>" class="form-control mr-2 form-control-lg" required>
                            </div>

                            <h6>Upload Movie Banner(Landscape):</h6>
                            <div class="mb-3">
                                <input type="file" name="Mbanner" accept=".jpg, .jpeg, .png"class="form-control mr-2">
                            </div>

                            <h6>Upload Movie Banner(Portrait):</h6>
                            <div class="mb-3">
                                <input type="file" name="Mbanner2" accept=".jpg, .jpeg, .png"class="form-control mr-2">
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