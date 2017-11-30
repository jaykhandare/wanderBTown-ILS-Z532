<?php
class Database{

    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "wanderBTown";
    private $username = "root";
    private $password = "Jayendra_31";
    public $conn;

    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        //	create a table for user data
        try {
            $sql_users_table = "CREATE TABLE IF NOT EXISTS USERS (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, firstName VARCHAR(15) NOT NULL, lastName VARCHAR(15) NOT NULL, username VARCHAR(15) NOT NULL UNIQUE, email VARCHAR(25) NOT NULL UNIQUE ,password VARCHAR(256) NOT NULL, joiningDate TIMESTAMP )";
            $this->conn->exec($sql_users_table);
        }
        catch (PDOException $e)
        {
            echo "Failed to create users table : " . $e->getMessage();
        }

        //	create a table for user interests
        try {
            $sql_users_table = "CREATE TABLE IF NOT EXISTS USER_INTERESTS (id INT(6) UNSIGNED PRIMARY KEY, interest1 VARCHAR(15) NOT NULL, interest2 VARCHAR(15) NOT NULL, interest3 VARCHAR(15) NOT NULL)";
            $this->conn->exec($sql_users_table);
        }
        catch (PDOException $e)
        {
            echo "Failed to create users table : " . $e->getMessage();
        }

        // create table for posts and tags
        try {
            $sql_posts_table = "CREATE TABLE IF NOT EXISTS POSTS_TAGS (postID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, content VARCHAR(50) NOT NULL, userID INT(6) UNSIGNED, tag1 VARCHAR(15) NOT NULL, tag2 VARCHAR(15) NOT NULL, tag3 VARCHAR(15) NOT NULL, venue VARCHAR(20) NOT NULL, pic1 VARCHAR(30), pic2 VARCHAR(30), pic3 VARCHAR(30), likes INT(6) UNSIGNED, postDate TIMESTAMP)";
            $this->conn->exec($sql_posts_table);
        }
        catch (PDOException $e)
        {
            echo "Failed to create posts table : " . $e->getMessage();
        }

        return $this->conn;
    }
}