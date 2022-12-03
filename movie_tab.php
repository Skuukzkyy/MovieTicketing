<?php
    // require "connection.php";
    include("dbconfig.php");
	$db = new MyDB();
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    //Load Composer's autoloader
    require 'vendor/autoload.php';


    $id = $_GET['id'];
    $movie_info = $db->mysqli->query("SELECT * FROM movie_tbl INNER JOIN tickets_tbl ON movie_tbl.movie_id = tickets_tbl.movie_id WHERE movie_tbl.movie_id = '$id'");
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
    $movie_category = $db->getCategory($id);

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
            $db->newTransaction($id, $name, $email, $ticket_price, $num_of_ticket, $total_cost, $date, $view_time);
            // mysqli_query($conn, "INSERT INTO transaction_tbl VALUES ('', '$id', MD5('$name'), MD5('$email'), '$ticket_price', '$num_of_ticket', '$total_cost', '$date', '$view_time')");
            $db->countSoldTickets($sold_ticket, $num_of_ticket, $id);
            // mysqli_query($conn, "UPDATE tickets_tbl SET sold_ticket = $sold_ticket + $num_of_ticket WHERE movie_id = '$id'");
            echo "<script>alert('Purchase Success! Please check your email for the receipt. 🤞')</script>";
            
            // SEND EMAIL WHEN SUCCESS
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'movie.tastic69@gmail.com';                     //SMTP username
                $mail->Password   = 'mvtuhmbdywpiivjt';                               //SMTP password
                $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('movie.tastic69@gmail.com', 'Movie Tastic');
                $mail->addAddress($email);               //Name is optional
                $mail->addReplyTo('movie.tastic69@gmail.com');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                //Attachments
                $mail->AddEmbeddedImage('img/'.$banner1.'', 'movie_banner');
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Ticket Receipt';
                $mail->Body    = 'THANK YOU FOR BUYING <strong>'.$name.'</strong>!<br>
                You bought <strong>'.$num_of_ticket.'</strong> tickets for the movie <strong>'.$movie_title.'</strong> for <strong>PHP'.$total_cost.'<strong>
                <br>Date: '.$date.' '.$view_time.'
                <br><br><img src="cid:movie_banner" width="800" height="600">';
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Message has been sent';
                header("Location: index.php");
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
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
                        echo $category['category']." - ";
                    } ?>
                </h4><br>
                <h4 class="showing">SHOWING: <?php echo $movie_start ?> <strong>TO</strong> <?php echo $movie_end ?></h4>
                <br>
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
                    <p class="Mtitle"><?php echo $movie_title?></p>
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