<?php
	require "connection.php";

    if(isset($_POST['searchMovie'])){
        $keyword = $_POST['keyword'];
        $rows = mysqli_query($conn, "SELECT * FROM movie_tbl WHERE movie_title LIKE '%$keyword%'");
        foreach($rows as $row){
            $id = $row['movie_id'];
            echo"
                <div class='box'>
                    <div class='imgBox'>
                        <img src='img/".$row['banner2']."'>
                    </div>
                    <div class='details'>
                        <div class='content'>
                            <h2>".$row['movie_title']."</h2>
                            <p>";
                                $movie_category = mysqli_query($conn, "SELECT movie_category.movie_title, category_tbl.category FROM movie_category INNER JOIN category_tbl ON movie_category.category_id = category_tbl.category_id INNER JOIN movie_tbl ON movie_category.movie_title = movie_tbl.movie_title WHERE movie_tbl.movie_id = '$id'");
                                foreach ($movie_category as $category) {
                                    echo $category['category'].", ";
                                }
                            echo "</p><br>
                            <a href='movie_tab.php?id=".$row['movie_id']."'><button class='btn_buy'> Buy Tickets</button></a>
                        </div>
                    </div>
                </div>
            ";
        }
    }
?>