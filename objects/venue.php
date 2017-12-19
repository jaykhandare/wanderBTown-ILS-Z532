<?php
class Venue
{
    // database connection
    private $conn;

    // object properties
    public $venueName;
    public $details;
    public $contact;


    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //  create a reply
    function create(){
        $venueName = $this->venueName;
        $details = $this->details;
        $contact = $this->contact;

        try {
            $sql_add_reply = "INSERT INTO VENUES (venueName,details,contact) VALUES ('$venueName','$details','$contact')";
            $this->conn->exec($sql_add_reply);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    //  delete a reply
    function delete(){
        // delete query
        $query = "DELETE FROM VENUES WHERE venueName = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind id of record to delete
        $stmt->bindParam(1, $this->venueName);

        // execute query
        if($stmt->execute()){
            return true;
        }
        else {
            return false;
        }

    }

    //  update a reply
    function update(){
        // update query
        $query = "UPDATE VENUES SET details = :details, contact = :contact 
                  WHERE venueName = :venueName";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind new values
        $stmt->bindParam(':details', $this->details);
        $stmt->bindParam(':contact', $this->contact);
        $stmt->bindParam(':venueName', $this->venueName);

        // execute the query
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    //  read replies
    function read(){
        // select all query
        $query = "SELECT * FROM VENUES";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;

    }

    function readOne(){

        // query to read single record
        $query = "SELECT * FROM VENUES WHERE venueName = :venueName LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of user to be updated
        $stmt->bindParam(':venueName',$this->venueName);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->venueName = $row['venueName'];
        $this->details = $row['details'];
        $this->contact = $row['contact'];
    }


    //  read all replies to a post
    function allPostsForAVenue(){

        // query to read single record
        $query = "SELECT * FROM POSTS WHERE venueName = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of user to be updated
        $stmt->bindParam(1, $this->venueName);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}