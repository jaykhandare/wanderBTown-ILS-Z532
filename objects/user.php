<?php
class User{

    // database connection and table name
    public $conn;

    // object properties
    public $userID;
    public $firstName;
    public $lastName;
    public $userName;
    public $email;
    public $password;
    public $joiningDate;
    public $pic;

    public $passwordHash;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // add a user
    function create(){

        $firstName = $this->firstName;
        $lastName = $this->lastName;
        $userName = $this->userName;
        $email = $this->email;
        $password = $this->password;
        $pic = "false";
        $password = hash('whirlpool',$password);


        try {
            $sql_add_user = "INSERT INTO USERS (userID, firstName, lastName, userName, email, password, pic, joiningDate) VALUES (NULL , '$firstName' , '$lastName' , '$userName' , '$email' , '$password' , '$pic ', CURRENT_TIMESTAMP )";
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
            $sql_add_user_interests = "INSERT INTO USER_INTERESTS (userID, interest1, interest2, interest3) VALUES ('$userID' , '$interest1' , '$interest2' , '$interest3')";
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
        $query = "SELECT * FROM USERS WHERE userID = :userID LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of user to be updated
        $stmt->bindParam(':userID',$this->userID);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->firstName = $row['firstName'];
        $this->lastName = $row['lastName'];
        $this->userName = $row['userName'];
        $this->email = $row['email'];
        $this->joiningDate = $row['joiningDate'];
    }

    // update userInfo
    function update(){

        // update query


        $query = "UPDATE USERS SET firstName = :firstName, lastName = :lastName, email = :email
                  WHERE userName = :userName";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind new values
        $stmt->bindParam(':firstName', $this->firstName);
        $stmt->bindParam(':lastName', $this->lastName);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':userName', $this->userName);

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
        $query = "DELETE FROM USERS WHERE userName = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind id of record to delete
        $stmt->bindParam(1, $this->userName);

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
        $query = "SELECT * FROM USERS WHERE userName = :userName LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of user to be updated
        $stmt->bindParam(':userName', $this->userName);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->userName = $row['userName'];
        $this->passwordHash = $row['password'];
        $this->userID = $row['userID'];

        if(isset($this->userName)){
            return(hash_equals($this->passwordHash,hash('whirlpool',$this->password)));
        }
        else{
            return false;
        }
    }

    function getUserInfo(){
        // query to read single record
        $query = "SELECT * FROM USERS WHERE userName = ? LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of user to be updated
        $stmt->bindParam(1, $this->userName);
        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->userID = $row['userID'];
        $this->firstName = $row['firstName'];
        $this->lastName = $row['lastName'];
        $this->email = $row['email'];
        $this->joiningDate = $row['joiningDate'];
        $this->pic = $row['pic'];
        return true;
    }

    function picSet(){

        // update query
        $query = "UPDATE USERS SET pic = :pic
                  WHERE userName = :userName";

        // prepare query statement
        $stmt = $this->conn->prepare($query);


        // bind new values
        $stmt->bindParam(':userName', $this->userName);
        $stmt->bindParam(':pic', $this->pic);

        // execute the query
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
        // query to read single record
        $query = "SELECT * FROM USERS WHERE userName = ? LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of user to be updated
        $stmt->bindParam(1, $this->userName);
        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->pic = "true";
        return true;
    }

    function changePassword(){
        // query to read single record
        $query = "SELECT * FROM USERS WHERE userName = ? LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of user to be updated
        $stmt->bindParam(1, $this->userName);
        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->passwordHash = $row['password'];

        if(!hash_equals($this->passwordHash,hash('whirlpool',$this->password))){

            $this->password = hash('whirlpool',$this->password);

            $query = "UPDATE USERS SET password = :password
                  WHERE userName = :userName";

            // prepare query statement
            $stmt = $this->conn->prepare($query);

            // bind new values
            $stmt->bindParam(':userName', $this->userName);
            $stmt->bindParam(':password', $this->password);

            // execute the query
            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }

        }
        else{
            return false;
        }

    }
}
