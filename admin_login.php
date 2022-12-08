<?php 
    session_start();

    if(isset($_POST["login"])) {
        $name = $_POST['name'];
        $pass = $_POST['pass'];
        if ($name == "admin" && $pass == "admin") {
            $_SESSION['admin'] = $_POST['name'];
            header("Location: admin_view.php");
        }else{
            echo"<script>alert('WRONG')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="media/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="css/admin_login.css">
    <title>ADMIN LOGIN</title>
</head>
<body>
<header>
        <img class="logo" src="media/logo.png" alt="logo">
        <nav>
            <ul class="nav_links">
                <li><a href="index.php">HOME</a></li>
            </ul>
        </nav>
</header>
    <hr><br>

    <center><h1>-- PLEASE INPUT ADMINISTRATOR'S CREDENTIAL --</h1></center>
    <div class="form-container">
        <div class="form">
            <form action="" method="POST" class="adminForm">
            <fieldset>
                    <legend>ADMINISTRATOR</legend>
                    USERNAME:<input type="text" name="name" id="">
                    PASSWORD:<input type="password" name="pass" id="">
                    <input type="submit" name="login" value="LOGIN">
                </fieldset>
            </form>
        </div>
</body>
</html>