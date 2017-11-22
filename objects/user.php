<?php
class User{

    // database connection and table name
    private $conn;
    private $table_name = "USERS";

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

    public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // read users
    function read(){

        // select all query
         $query = "SELECT * FROM " . $this->table_name;
/*        $query = "SELECT * FROM " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            ORDER BY
                p.created DESC";*/

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // add a user
    function create(){

        $firstName = test_input($this->firstName);
        $lastName = test_input($this->lastName);
        $username = test_input($this->username);
        $email = test_input($this->email);
        $password = $this->password;
        try {
            $sql_add_user = "INSERT INTO USERS (id, firstName, lastName, username, email, password, joiningDate) VALUES (NULL , '$firstName' , '$lastName' , '$username' , '$email' , '$password' , CURRENT_TIMESTAMP )";
            $this->conn->exec($sql_add_user);
            $last_id = $this->conn->lastInsertId();

        } catch (PDOException $e) {
            return false;
        }

        $interest1 = test_input($this->interest1);
        $interest2 = test_input($this->interest2);
        $interest3 = test_input($this->interest3);
        try {
            $sql_add_user_interests = "INSERT INTO USER_TAG_MAP (id, interest1, interest1, interest1) VALUES ('$last_id' , '$interest1' , '$interest2' , '$interest3')";
            $this->conn->exec($sql_add_user_interests);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }


    // used when filling up the update product form
    function readOne(){

        // query to read single record
        $query = "SELECT * FROM " . $this->table_name . " WHERE p.id = ? LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
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
        $query = "UPDATE
                " . $this->table_name . "
            SET
                firstName = :firstName,
                lastName = :lastName,
                email = :email,
                password = :password,
                interest1 = :interest1,
                interest2 = :interest2,
                interest3 = :interest3,
            WHERE
                id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind new values
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':firstName', $this->firstName);
        $stmt->bindParam(':lastName', $this->lastName);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':interest1', $this->interest1);
        $stmt->bindParam(':interest2', $this->interest2);
        $stmt->bindParam(':interest3', $this->interest3);

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
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

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
        $query = "SELECT * FROM " . $this->table_name . " WHERE firstName LIKE ? OR lastName LIKE ? OR email LIKE ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
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