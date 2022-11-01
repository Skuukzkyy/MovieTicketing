<?php
require 'connection.php';

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

<div class="container mb-3 mt-3">
        <div class="row m-auto">
            <div class="col-lg">
                <div class="card">
                    <div class="card-header">
                        <div class="card-body">
                            <h4 class="card-title">
                                <table class="table table-bordered">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th>Movie Title</th>
                                            <th>Banner1</th>
                                            <th>Banner2</th>
                                            <th>Description</th>
                                            <th>Trailer</th>
                                            <th>Category</th>
                                            <th>Number of tickets</th>
                                            <th>Price</th>
                                            <th>Starting Date</th>
                                            <th>Ending Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                        $i = 1;
                                        $rows = mysqli_query($conn, "SELECT * FROM movie_tbl ORDER BY movie_id DESC")
                                        ?>
                                        <?php foreach ($rows as $row) : ?>
                                        <tr>
                                            <!-- <td><?php echo $i++; ?></td> -->
                                            <td><?php echo $row["movie_title"]; ?></td>
                                            <td> <img src="img/<?php echo $row["banner1"]; ?>" width = 200 title="<?php echo $row['movie_title']; ?>"> </td>
                                            <td> <img src="img/<?php echo $row["banner2"]; ?>" width = 200 title="<?php echo $row['movie_title']; ?>"> </td>
                                            <td><?php echo $row["movie_description"]; ?></td>
                                            <td><?php echo $row["movie_trailer"]; ?></td>
                                            <td><?php echo $row["movie_category"]; ?></td>
                                            <td><?php echo $row["num_of_ticket"]; ?></td>
                                            <td><?php echo $row["ticket_price"]; ?></td>
                                            <td><?php echo $row["movie_start"]; ?></td>
                                            <td><?php echo $row["movie_end"]; ?></td>
                                            <!-- <td><a href='admin_update.php?movie_id=<?php echo $row['movie_id']; ?>'><button name='update' class='btn btn-primary w-100 text-white'>Update</button></a></td> -->
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>