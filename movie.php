<?php
require "connection.php";
?>

<!DOCTYPE html>
<head>
    <title> MOVISTASTIC</title>
    <link rel="shortcut icon" href="media/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/movie.css">
  <script src="js/jquery-3.6.1.min.js"></script>
  <script src="js/movie.js"></script>
</head>
<body>
  <!-- navbar---------------------------------------------------------->
      <header>
      <img class="logo" src="media/logo.png" alt="logo">
          <nav>
              <ul class="nav_links">
                <li><a href="index.php">HOME</a></li>
                <li><a href="movie.php" class="active">MOVIES</a></li>
                <li><a href="upcoming.php">UPCOMING</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="contact.php">CONTACT US</a></li>
              </ul>
          </nav>
      </header>

  <!-- Movies tab---------------------------------------------------------->
  <div class="search-container">
    <input id="searchBar" type="search" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
  </div>
    <hr><br>
  <p class="head">TOP PICKS</p>
  <div class="container">
    <?php
      $rows = mysqli_query($conn, "SELECT * FROM tickets_tbl INNER JOIN movie_tbl ON tickets_tbl.movie_id = movie_tbl.movie_id ORDER BY tickets_tbl.sold_ticket DESC LIMIT 10");
      foreach ($rows as $row): ?>
        <div class="box"></a>
          <div class="imgBox">
            <img src="img/<?php echo $row['banner2'] ?>">
          </div>
          <div class="details">
            <div class="content">
              <h2><?php echo $row['movie_title'] ?></h2>
              <p><?php echo $row['movie_description'] ?></p><br>
              <a href="movie_tab.php?id=<?php echo $row['movie_id'] ?>"><button class="btn_buy"> Buy Tickets</button></a>
            </div>
          </div>
        </div>
      <?php endforeach?>

  </div>

  <!-- NEW RELEASES---------------------------------------------------------->
  <hr><br>
  <p class="head">NEW RELEASES</p>
  <div class="container">
        <div class="box">
          <div class="imgBox">
            <img src="media/m1.jpg">
          </div>
          <div class="details">
            <div class="content">
              <h2>One Pice Film Red </h2>
              <p> One Piece Film: Red is a 2022 Japanese animated fantasy action-adventure film directed by Gorō Taniguchi and produced by Toei Animation.</p><br>
              <button class="btn_buy"> Buy Tickets</button>
            </div>
          </div>
        </div>

        <div class="box">
          <div class="imgBox">
            <img src="media/m5.jpeg">
          </div>
          <div class="details">
            <div class="content">
              <h2>Armin Arlelt </h2>
              <p> a soldier in the Scout Regiment. He is also a childhood friend of Eren Jaeger and Mikasa Ackermann, and is one of the two deuteragonists of the series.</p>
              <button class="btn_buy"> Buy Tickets</button>
            </div>
          </div>
        </div>
        </div>

  <!-- ALL MOVIES---------------------------------------------------------->
  <hr><br>
  <p class="head">ALL MOVIES</p>
  <div class="container">
        <div class="box">
          <div class="imgBox">
            <img src="media/m6.jfif">
          </div>
          <div class="details">
            <div class="content">
              <h2>One Pice Film Red </h2>
              <p> One Piece Film: Red is a 2022 Japanese animated fantasy action-adventure film directed by Gorō Taniguchi and produced by Toei Animation.</p><br>
              <button class="btn_buy"> Buy Tickets</button>
            </div>
          </div>
        </div>

        <div class="box">
          <div class="imgBox">
            <img src="media/m10.jpg">
          </div>
          <div class="details">
            <div class="content">
              <h2>Armin Arlelt </h2>
              <p> a soldier in the Scout Regiment. He is also a childhood friend of Eren Jaeger and Mikasa Ackermann, and is one of the two deuteragonists of the series.</p>
              <button class="btn_buy"> Buy Tickets</button>
            </div>
          </div>
        </div>
        </div><hr>
</body>
</html>
