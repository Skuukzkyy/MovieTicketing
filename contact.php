<?php
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    //Load Composer's autoloader
    require 'vendor/autoload.php';


    session_start();
    session_destroy();

    if(isset($_POST['send'])){
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $message = $_POST['message'];


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

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Message';
            $mail->Body    = 'THANK YOU FOR REACHING OUT TO US <strong>'.$full_name.'</strong>!<br>
            We have received your message.';
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            // echo '<script>alert(Email sent.)</script>';
            echo '<script>alert("Email sent. 👌")</script>';
            header("Location: contact.php");
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>
<!DOCTYPE html>
<head>
    <title> MOVIETASTIC</title>
    <link rel="shortcut icon" href="media/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/contact.css">
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
                <li><a href="contact.php" class="active">CONTACT US</a></li>
            </ul>
        </nav>
    </header><hr>

<div class="container1">
    <div class="box1">
        <img src="media/p1.png" alt="" class="box-img">
        <h1 style="color: #00ffff;">Hi I'm Jerick</h1>
        <h5>Web Devloper - Back-end Developer</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis a libero a leo lobortis posuere. In imperdiet justo sit amet ante sagittis varius.Ut et nisi suscipit, congue magna dapibus, vehicula enim.</p>
        <br><p style="color: #00ffff;">EMAIL: movie.tastic69@gmail</p>
    </div>
    <div class="box2">
        <img src="media/p2.png" alt="" class="box-img">
        <h1 style="color: #00ffff;">Hi I'm Ralf</h1>
        <h5>Web Devloper - Front-end Developer</h5>
        <p>Nulla lacinia est vel convallis aliquet. Vivamus tincidunt pretium arcu, sit amet aliquam orci congue a. Aenean finibus massa ac fringilla convallis. Sed condimentum ultrices pretium. </p>
        <br><p style="color: #00ffff;">EMAIL: movie.tastic69@gmail</p>
    </div>
</div><hr>

<div class="container3">
		<div class="contact-box">
			<form method="POST" action="" class="box">
                    <h2>Contact Us</h2>
                    <input type="text" name="full_name" class="field" placeholder="Full Name">
                    <input type="text" name="email" class="field" placeholder="Email">
                    <textarea placeholder="Send us a Message" name="message" class="field"></textarea>
                    <input type="submit" name="send" value="Send" class="btn">
			</form>
		</div>
	</div>

</body>
</html>