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


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
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

    // add a user
    function create_user(){

        $firstName = $this->firstName;
        $lastName = $this->lastName;
        $username = $this->username;
        $email = $this->email;
        $password = $this->password;
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

    // used when filling up the update user form
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
        $query = "UPDATE USERS
            SET
                firstName = :firstName,
                lastName = :lastName,
                email = :email,
                password = :password,
                username = :username
            WHERE id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind new values
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':firstName', $this->firstName);
        $stmt->bindParam(':lastName', $this->lastName);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

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
        $query = "DELETE FROM USERS WHERE id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind id of record to delete
        $stmt->bindParam(1, $this->id);

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
}