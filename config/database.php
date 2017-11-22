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
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        //	create a table for user data
        try {
            $sql_users_table = "CREATE TABLE IF NOT EXISTS USERS (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, firstName VARCHAR(15) NOT NULL, lastName VARCHAR(15) NOT NULL, username VARCHAR(15) NOT NULL, email VARCHAR(25) NOT NULL,password VARCHAR(256) NOT NULL, joiningDate TIMESTAMP )";
            $this->conn->exec($sql_users_table);
        }
        catch (PDOException $e)
        {
            echo "Failed to create users table : " . $e->getMessage();
        }

        return $this->conn;
    }
}