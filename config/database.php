<?php
class Database{

    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "wanderBTownTest";
    private $username = "root";
    private $password = "Jayendra_31";
    public $conn;

    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try{

            $this->conn= new PDO("mysql:host=" . $this->host . ";port=3307;dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            /*
                        $connect_pgsql='pgsql:dbname=jkhandar;user=jkhandar;password=8LCRWCzn;host=db.slis.indiana.edu;port=5433';
                        $this->conn = new PDO($connect_pgsql);

                        $this->conn = pg_connect("host=db.slis.indiana.edu port=5433 dbname=jkhandar user=jkhandar password=8LCRWCzn");
            */

        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        //	create a table for user data
        try {
            $sql_users_table = "CREATE TABLE IF NOT EXISTS USERS (userID INT AUTO_INCREMENT PRIMARY KEY, firstName VARCHAR(15) NOT NULL, lastName VARCHAR(15) NOT NULL, userName VARCHAR(15) NOT NULL UNIQUE, email VARCHAR(25) NOT NULL UNIQUE ,password VARCHAR(256) NOT NULL, pic VARCHAR (5), joiningDate TIMESTAMP )";
            $this->conn->exec($sql_users_table);
        }
        catch (PDOException $e)
        {
            echo "Failed to create users table : " . $e->getMessage();
        }


        // create table for posts
        try {
            $sql_posts_table = "CREATE TABLE IF NOT EXISTS POSTS (postID INT AUTO_INCREMENT PRIMARY KEY, venueName  VARCHAR(30) NOT NULL, userID INT NOT NULL, content VARCHAR(50) NOT NULL, likes INT , tag1 VARCHAR(7), tag2 VARCHAR(7), tag3 VARCHAR(7), postingDate TIMESTAMP)";
            $this->conn->exec($sql_posts_table);
        }
        catch (PDOException $e)
        {
            echo "Failed to create posts table : " . $e->getMessage();
        }

        // create table for replies
        try {
            $sql_replies_table = "CREATE TABLE IF NOT EXISTS REPLIES (replyID INT AUTO_INCREMENT PRIMARY KEY, postID INT , userID INT , content VARCHAR(50) NOT NULL, replyDate TIMESTAMP)";
            $this->conn->exec($sql_replies_table);
        }
        catch (PDOException $e)
        {
            echo "Failed to create replies table : " . $e->getMessage();
        }


        //	create a table for venues
        try {
            $sql_users_table = "CREATE TABLE IF NOT EXISTS VENUES (venueName  VARCHAR(30) NOT NULL, details VARCHAR(256) NOT NULL, contact VARCHAR(256) NOT NULL)";
            $this->conn->exec($sql_users_table);
        }
        catch (PDOException $e)
        {
            echo "Failed to create venues table : " . $e->getMessage();
        }

        return $this->conn;

        /*
                //	create a table for user interests
                try {
                    $sql_users_table = "CREATE TABLE IF NOT EXISTS USER_INTERESTS (userID INT, interestName VARCHAR(15) NOT NULL)";
                    $this->conn->exec($sql_users_table);
                }
                catch (PDOException $e)
                {
                    echo "Failed to create userInterest table : " . $e->getMessage();
                }

                //	create a table for tags
                try {
                    $sql_users_table = "CREATE TABLE IF NOT EXISTS TAGS (postID INT(6), tagName VARCHAR(15) NOT NULL)";
                    $this->conn->exec($sql_users_table);
                }
                catch (PDOException $e)
                {
                    echo "Failed to create tags table : " . $e->getMessage();
                }
                //	create a table for venuePics
                try {
                    $sql_users_table = "CREATE TABLE IF NOT EXISTS VENUE_PICS (venueName  VARCHAR(30) NOT NULL, pic VARCHAR(100) NOT NULL, postedBy VARCHAR(15) NOT NULL)";
                    $this->conn->exec($sql_users_table);
                }
                catch (PDOException $e)
                {
                    echo "Failed to create venues table : " . $e->getMessage();
                }
        */
    }
}