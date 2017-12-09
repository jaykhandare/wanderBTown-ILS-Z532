<?php
class User{

    // database connection and table name
    private $conn;

    // object properties
    public $id;
    public $firstName;
    public $lastName;
    public $username;
    public $email;
    public $password;
    public $interest1;
    public $interest2;
    public $interest3;
    public $joiningDate;
    public $passwordHash;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // add a user
    function create(){

        $firstName = $this->firstName;
        $lastName = $this->lastName;
        $username = $this->username;
        $email = $this->email;
        $password = $this->password;
        $password = hash('whirlpool',$password);
        try {
            $sql_add_user = "INSERT INTO USERS (id, firstName, lastName, username, email, password, joiningDate) VALUES (NULL , '$firstName' , '$lastName' , '$username' , '$email' , '$password' , CURRENT_TIMESTAMP )";
            $this->conn->exec($sql_add_user);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // add user interests
    function add_interests(){

        $username = $this->username;
        $interest1 = $this->interest1;
        $interest2 = $this->interest2;
        $interest3 = $this->interest3;

        $query = "SELECT * FROM USERS WHERE username = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);

        // bind username of user to be updated
        $stmt->bindParam(1, $username);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $userID = $row["id"];

        try {
            $sql_add_user_interests = "INSERT INTO USER_INTERESTS (id, interest1, interest2, interest3) VALUES ('$userID' , '$interest1' , '$interest2' , '$interest3')";
            $this->conn->exec($sql_add_user_interests);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // read users
    function read(){

        // select all query
        $query = "SELECT * FROM USERS";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function readOne(){

        // query to read single record
        $query = "SELECT * FROM USERS WHERE id = ? LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of user to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->firstName = $row['firstName'];
        $this->lastName = $row['lastName'];
        $this->username = $row['username'];
        $this->email = $row['email'];
        $this->joiningDate = $row['joiningDate'];
    }

    // update userInfo
    function update(){

        // update query
        $query = "UPDATE USERS SET firstName = :firstName, lastName = :lastName, email = :email, password = :password
                  WHERE username = :username";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $this->password = hash('whirlpool',$this->password);

        // bind new values
        $stmt->bindParam(':firstName', $this->firstName);
        $stmt->bindParam(':lastName', $this->lastName);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':username', $this->username);

        // execute the query
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    // delete the user
    function delete(){

        // delete query
        $query = "DELETE FROM USERS WHERE username = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind id of record to delete
        $stmt->bindParam(1, $this->username);

        // execute query
        if($stmt->execute()){
            return true;
        }
        else {
            return false;
        }
    }

    // search users
    function search($keywords){

        // select all query
        $query = "SELECT * FROM USERS WHERE firstName LIKE ? OR lastName LIKE ? OR email LIKE ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // some mumbo jumbo
        $keywords = "%{$keywords}%";
        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    function login(){

        // query to read single record
        $query = "SELECT * FROM USERS WHERE username = ? LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of user to be updated
        $stmt->bindParam(1, $this->username);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->username = $row['username'];
        $this->passwordHash = $row['password'];

        return(hash_equals($this->passwordHash,hash('whirlpool',$this->password)));
    }

    function getUserInfo(){

        // query to read single record
        $query = "SELECT * FROM USERS WHERE username = ? LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of user to be updated
        $stmt->bindParam(1, $this->username);
        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->id = $row['id'];
        $this->firstName = $row['firstName'];
        $this->lastName = $row['lastName'];
        $this->email = $row['email'];
        $this->joiningDate = $row['joiningDate'];
        return true;
    }
}
