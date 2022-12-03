<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
}
require 'connection.php';
include("dbconfig.php");
$db = new MyDB();

?>


<!DOCTYPE html>
<head>
    <title> MOVIETASTIC</title>
    <link rel="shortcut icon" href="media/favicon.ico" />
    <link rel=”stylesheet” href=”https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css”rel=”nofollow” integrity=”sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm” crossorigin=”anonymous”>
    <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>

</head>
<body>
<!-- navbar---------------------------------------------------------->
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
    <hr><br>

<!-- table view ------------------------------------------------------------------->
<h3 align="center" style="color: white;">MOVIE LIST</h3>
                <br/>
    <table class="table table-bordered bg-white text-dark">
            <tr class="text-white">
                <th scope="col" width="7%"> Movie Title</th>
                <th scope="col" width="8%">Banner1</th>
                <th scope="col" width="8%">Banner2</th>
                <th scope="col" width="20%">Description</th> 
                <th scope="col" width="8%">Trailer URL</th> 
                <th scope="col" width="8%">Category</th>
                <th scope="col" width="5%">No. of Tickets</th>
                <th scope="col" width="5%">Price</th>
                <th scope="col" width="5%">Sold Ticket</th>
                <th scope="col" width="5%">Starting Date</th> 
                <th scope="col" width="5%">Ending Date</th>
                <th scope="col" width="5%">Action</th> 
            </tr>
    <?php
        $i = 1;
        $rows = mysqli_query($conn, "SELECT * FROM `movie_tbl` INNER JOIN tickets_tbl ON movie_tbl.movie_id = tickets_tbl.movie_id")
        ?>
        <?php foreach ($rows as $row) : ?>
        <tr>
            <!-- <td><?php echo $i++; ?></td> -->
            <td class="td_title"><?php echo $row["movie_title"]; ?></td>
            <td> <img src="img/<?php echo $row["banner1"]; ?>" class=img-thumbnail width='130' height='150' title="<?php echo $row['movie_title']; ?>"> </td>
            <td> <img src="img/<?php echo $row["banner2"]; ?>" class=img-thumbnail width='130' height='150' title="<?php echo $row['movie_title']; ?>"> </td>
            <td class="td_descrip"><?php echo $row["movie_description"]; ?></td>
            <td class="td_trailer"><?php echo $row["movie_trailer"]; ?></td>
            <td>
                <?php 
                    $movie_category = $db->getCategory($row['movie_id']);
                    foreach ($movie_category as $category) {
                        echo $category['category']."  ";
                } ?>
            </td>
            <td><?php echo $row["ticket_to_sell"]; ?></td>
            <td><?php echo $row["ticket_price"]; ?></td>
            <td><?php echo $row["sold_ticket"]; ?></td>
            <td><?php echo $row["movie_start"]; ?></td>
            <td><?php echo $row["movie_end"]; ?></td>
            <!-- <td><button class="update">UPDATE</button></td> -->
            <td><a href='admin_update.php?movie_id=<?php echo $row['movie_id']; ?>'><button name='update' class='update'>Update</button></a></td>
        </tr>
        <?php endforeach; ?>
</table>
</html>