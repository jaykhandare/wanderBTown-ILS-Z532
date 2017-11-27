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

    }

    //  delete a post
    function delete(){

    }

    //  update a post
    function update(){

    }

    //  read posts
    function read(){

    }
    //  read a post
    function readOne(){

    }

    //  search in a post
    function search($keywords){

    }

    //  like a post
    function likeAPost(){

    }

}