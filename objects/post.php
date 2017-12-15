<?php
class Post
{
    // database connection
    public $conn;

    // object properties
    public $postID;
    public $venueName;
    public $userID;
    public $content;
    public $pic;
    public $tag1;
    public $tag2;
    public $tag3;
    public $likes;
    public $postDate;


    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //  create a post
    function create(){

        $venueName = $this->venueName;
        $userID = $this->userID;
        $content = $this->content;
        $pic = $this->pic;
        $likes = $this->likes;

        try {
            $sql_add_post = "INSERT INTO POSTS (postID,venueName,userID,content,pic,likes,postDate) VALUES (NULL,'$venueName','$userID','$content','$pic','$likes', CURRENT_TIMESTAMP )";
            $this->conn->exec($sql_add_post);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    //  delete a post
    function delete(){
        // delete query
        $query = "DELETE FROM POSTS WHERE postID = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind id of record to delete
        $stmt->bindParam(1, $this->postID);

        // execute query
        if($stmt->execute()){
            return true;
        }
        else {
            return false;
        }

    }

    //  update a post
    function update(){
        // update query
        $query = "UPDATE POSTS SET content = :content, venueName = :venueName, pic = :pic
                  WHERE postID = :postID AND userID = :userID";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind new values
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':userID', $this->userID);
        $stmt->bindParam(':venueName', $this->venueName);
        $stmt->bindParam(':pic', $this->pic);
        $stmt->bindParam(':postID', $this->postID);

        // execute the query
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    //  read posts
    function read(){
        // select all query
        $query = "SELECT * FROM POSTS";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;

    }
    //  read a post
    function readOne(){

        // query to read single record
        $query = "SELECT * FROM POSTS WHERE postID = ? LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of user to be updated
        $stmt->bindParam(1, $this->postID);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set post property values
        $this->content = $row["content"];
        $this->tag1 = $row["tag1"];
        $this->tag2 = $row["tag2"];
        $this->tag3 = $row["tag3"];
        $this->venueName = $row["venueName"];
        $this->pic = $row["pic"];
        $this->likes = $row["likes"];
        $this->userID = $row["userID"];
        $this->postDate = $row["postDate"];
    }

    //  search in a post
    function search($keywords){
        // select all query
        $query = "SELECT * FROM POSTS WHERE tag1 LIKE ? OR tag2 LIKE ? OR tag3 LIKE ?";

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

    //  like a post
    function likeAPost(){

        $this->readOne();
        $this->likes = $this->likes + 1;

        // update query
        $query = "UPDATE POSTS SET  likes = :likes WHERE postID = :postID";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind new values
        $stmt->bindParam(':postID', $this->postID);
        $stmt->bindParam(':likes', $this->likes);

        // execute the query
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    function getUserPosts(){
        // query to read single record
        $query = "SELECT * FROM POSTS WHERE userID = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of user to be updated
        $stmt->bindParam(1, $this->userID);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function notVisitedPlaces(){
        // query to read single record
        $query = "SELECT VENUES.venueName, VENUES.details, VENUES.contact FROM POSTS ,VENUES  WHERE POSTS.userID = ? AND POSTS.venueName <> VENUES.venueName";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // bind id of user to be updated
        $stmt->bindParam(1, $this->userID);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function visitedPlaces(){
        // query to read single record
        $query = "SELECT VENUES.venueName, VENUES.details, VENUES.contact FROM POSTS ,VENUES  WHERE POSTS.userID = ? AND POSTS.venueName = VENUES.venueName";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // bind id of user to be updated
        $stmt->bindParam(1, $this->userID);

        // execute query
        $stmt->execute();

        return $stmt;
    }


    function venuePosts($venueName){
        $query = "SELECT USERS.userName,POSTS.postID,POSTS.content,POSTS.likes,POSTS.tag1,POSTS.tag2,POSTS.tag3,POSTS.postingDate FROM USERS, POSTS ,VENUES  
                  WHERE VENUES.venueName = ? AND POSTS.venueName = VENUES.venueName 
                                             AND POSTS.userID = USERS.userID";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // bind id of user to be updated
        $stmt->bindParam(1, $venueName);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}