<?php
    class MyDB{
        private $servername = "localhost";
        private $username = "root";
        private $password = ""; //2/OeEm8#z=+Gi9b#
        private $dbname = "movies";
        public $res;


        public function __construct(){
            $this->mysqli = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        }

        public function newTransaction($id, $name, $email, $ticket_price, $num_of_ticket, $total_cost, $date, $view_time){
            $this->mysqli->query("INSERT INTO transaction_tbl VALUES ('', '$id', MD5('$name'), MD5('$email'), '$ticket_price', '$num_of_ticket', '$total_cost', '$date', '$view_time')");
        }

        public function countSoldTickets($sold_ticket, $num_of_ticket, $id){
            $this->mysqli->query($conn, "UPDATE tickets_tbl SET sold_ticket = $sold_ticket + $num_of_ticket WHERE movie_id = '$id'");
        }
        
        public function getCategory($id){
            $this->res = $this->mysqli->query("SELECT movie_category.movie_title, category_tbl.category FROM movie_category INNER JOIN category_tbl ON movie_category.category_id = category_tbl.category_id INNER JOIN movie_tbl ON movie_category.movie_title = movie_tbl.movie_title WHERE movie_tbl.movie_id = '$id'");
            return $this->res;
        }

        public function getMovies(){
            $this->res = $this->mysqli->query("SELECT * FROM movie_tbl ORDER BY movie_title");
            return $this->res; 
        }
    }