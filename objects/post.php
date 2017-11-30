<?php
class Post
{
    // database connection
    private $conn;

    // object properties
    public $postID;
    public $content;
    public $userID;
    public $tag1;
    public $tag2;
    public $tag3;
    public $venue;
    public $pic1;
    public $pic2;
    public $pic3;
    public $postDate;
    public $likes;


    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //  create a post
    function create(){

        $content = $this->content;
        $tag1 = $this->tag1;
        $tag2 = $this->tag2;
        $tag3 = $this->tag3;
        $venue = $this->venue;
        $pic1 = $this->pic1;
        $pic2 = $this->pic2;
        $pic3 = $this->pic3;
        $likes = $this->likes;
        $userID = $this->userID;

        try {
            $sql_add_post = "INSERT INTO POSTS_TAGS (postID,content,userID,tag1,tag2,tag3,venue,pic1,pic2,pic3,likes,postDate) VALUES (NULL,'$content','$userID','$tag1','$tag2','$tag3','$venue','$pic1','$pic2','$pic3','$likes', CURRENT_TIMESTAMP )";
            $this->conn->exec($sql_add_post);
            return true;
        } catch (PDOException $e) {
            return false;
        }

    }

    //  delete a post
    function delete(){
        // delete query
        $query = "DELETE FROM POSTS_TAGS WHERE postID = ?";

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
        $query = "UPDATE POSTS_TAGS SET content = :content, tag1 = :tag1, tag2 = :tag2, tag3 = :tag3, venue = :venue, pic1 = :pic1, pic2 = :pic2, pic3 = :pic3
                  WHERE postID = :postID";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind new values
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':tag1', $this->tag1);
        $stmt->bindParam(':tag2', $this->tag2);
        $stmt->bindParam(':tag3', $this->tag3);
        $stmt->bindParam(':venue', $this->venue);
        $stmt->bindParam(':pic1', $this->pic1);
        $stmt->bindParam(':pic2', $this->pic2);
        $stmt->bindParam(':pic3', $this->pic3);
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
        $query = "SELECT * FROM POSTS_TAGS";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;

    }
    //  read a post
    function readOne(){

        // query to read single record
        $query = "SELECT * FROM POSTS_TAGS WHERE postID = ? LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of user to be updated
        $stmt->bindParam(1, $this->postID);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

//        $this->joiningDate = $row['joiningDate'];

        // set post property values
        $this->content = $row["content"];
        $this->tag1 = $row["tag1"];
        $this->tag2 = $row["tag2"];
        $this->tag3 = $row["tag3"];
        $this->venue = $row["venue"];
        $this->pic1 = $row["pic1"];
        $this->pic2 = $row["pic2"];
        $this->pic3 = $row["pic3"];
        $this->likes = $row["likes"];
        $this->userID = $row["userID"];
        $this->postDate = $row["postDate"];
    }

    //  search in a post
    function search($keywords){
        // select all query
        $query = "SELECT * FROM POSTS_TAGS WHERE tag1 LIKE ? OR tag2 LIKE ? OR tag3 LIKE ?";

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

    }

}