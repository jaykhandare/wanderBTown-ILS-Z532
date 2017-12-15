<?php
class Reply
{
    // database connection
    private $conn;

    // object properties
    public $replyID;
    public $postID;
    public $userID;
    public $content;
    public $replyDate;


    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //  create a reply
    function create(){

        $content = $this->content;
        $userID = $this->userID;
        $postID = $this->postID;


        try {
            $sql_add_reply = "INSERT INTO REPLIES (replyID,postID,userID,content,replyDate) VALUES (NULL,'$postID','$userID','$content',CURRENT_TIMESTAMP )";
            $this->conn->exec($sql_add_reply);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    //  delete a reply
    function delete(){
        // delete query
        $query = "DELETE FROM REPLIES WHERE replyID = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind id of record to delete
        $stmt->bindParam(1, $this->replyID);

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
        $query = "UPDATE REPLIES SET content = :content 
                  WHERE replyID = :replyID";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind new values
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':replyID', $this->replyID);

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
        $query = "SELECT * FROM REPLIES";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;

    }

    //  read all replies to a post
    function allRepliesForAPost(){

        // query to read single record
        $query = "SELECT USERS.userName,REPLIES.content,REPLIES.replyDate FROM USERS, REPLIES 
                  WHERE postID = ? AND USERS.userID = REPLIES.userID";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of user to be updated
        $stmt->bindParam(1, $this->postID);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}