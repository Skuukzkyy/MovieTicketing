<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
}
require 'connection.php';
// if (isset($_GET["movie_id"])) {
//     $movie_id = $_GET["movie_id"];
// }

if(isset($_POST["btnSubmit"])){
    // DATA FOR TICKETS_TBL 
    $ticket_to_sell = $_POST["ticket_to_sell"];
    $ticket_price = $_POST["Mprice"];
    mysqli_query($conn, "INSERT INTO tickets_tbl VALUES('', '$ticket_to_sell', '$ticket_price', '0')");
    
    
    // DATA FOR MOVIE_TBL
    $movie_title = $_POST["Mtitle"];
    $movie_description = $_POST["Mdes"];
    $movie_description = str_replace("'","",$movie_description);
    $movie_trailer = $_POST["Mtrailer"];
    $movie_start = $_POST["MSdate"];
    $movie_end = $_POST["MEdate"];
    $movie_category_list = $_POST['category'];
    foreach ($movie_category_list as $category) {
        $sql = "INSERT INTO movie_category VALUES ('$movie_title', '$category')";
        mysqli_query($conn, $sql);
    }
    //banner 2 portailrskfj
    if($_FILES["Mbanner2"]["error"] == 4){
        echo
        "<script> alert('Image Does Not Exist'); </script>"
        ;
    }
    else{
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
        // move_uploaded_file($tmpName, 'img/' . $banner2);
        }
    }



    if($_FILES["Mbanner"]["error"] == 4){
        echo
        "<script> alert('Image Does Not Exist'); </script>"
        ;
    }
    else{
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
        // move_uploaded_file($tmpName, 'img/' . $banner1);
        $query = "INSERT INTO movie_tbl VALUES('', '$movie_title', '$movie_description', '$movie_trailer', '$movie_start', '$movie_end', '$banner1', '$banner2')";
        mysqli_query($conn, $query);
        echo
        "
        <script>
            alert('Successfully Added');
        </script>
        ";
        }
    }
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
                        <form id='form1' action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <h6>Movie Title:</h6>
                            <div class="mb-3">
                                <input type="text" name="Mtitle" class="form-control mr-2 form-control-lg" placeholder="Movie Title" required>
                            </div>

                            <h6>Movie Description:</h6>
                            <div class="mb-3">
                                <textarea name="Mdes" class="form-control mr-2" placeholder="Movie Description" rows="3" required></textarea>
                            </div>

                            <h6>Movie Trailer:</h6>
                            <div class="mb-3">
                                <input type="text" name="Mtrailer" class="form-control mr-2 form-control-lg" placeholder="Movie Trailer" required>
                            </div>

                            <h6>Category:</h6>
                            <?php
                                $query = "SELECT * FROM category_tbl ORDER BY category";
                                $categories = mysqli_query($conn, $query);
                                foreach($categories as $category):?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="category[]" type="checkbox" id="<?php echo $category['category'] ?>" value="<?php echo $category['category_id'] ?>">
                                        <label class="form-check-label" for="<?php echo $category['category'] ?>"><?php echo $category['category'] ?></label>
                                    </div>
                                <?php endforeach; ?>
                            
                            <h6>Number of tickets:</h6>
                            <div class="mb-3">
                                <input type="text" name="ticket_to_sell" class="form-control mr-2 form-control-lg" placeholder="Number of ticket to sell" required>
                            </div>
                            
                            <h6>Price/ticket:</h6>
                            <div class="mb-3">
                                <input type="number" name="Mprice" class="form-control mr-2 form-control-lg" placeholder="Ticket Price" required>
                            </div>

                            <h6>Movie Showing Starting date:</h6>
                            <div class="mb-3">
                                <input type="date" name="MSdate" class="form-control mr-2 form-control-lg" required>
                            </div>

                            <h6>Movie Showing Ending date:</h6>
                            <div class="mb-3">
                                <input type="date" name="MEdate" class="form-control mr-2 form-control-lg" required>
                            </div>

                            <h6>Upload Movie Banner(Landscape):</h6>
                            <div class="mb-3">
                                <input type="file" name="Mbanner" accept=".jpg, .jpeg, .png"class="form-control mr-2" required>
                            </div>

                            <h6>Upload Movie Banner(Portrait):</h6>
                            <div class="mb-3">
                                <input type="file" name="Mbanner2" accept=".jpg, .jpeg, .png"class="form-control mr-2" required>
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