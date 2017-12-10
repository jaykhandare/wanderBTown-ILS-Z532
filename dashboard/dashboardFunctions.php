<?php
// include database and object files
include_once '/home/jkhandar/PhpstormProjects/wanderBTown_test/wanderBTown-ILS-Z532/config/database.php';
include_once '/home/jkhandar/PhpstormProjects/wanderBTown_test/wanderBTown-ILS-Z532/objects/user.php';
include_once '/home/jkhandar/PhpstormProjects/wanderBTown_test/wanderBTown-ILS-Z532/objects/post.php';
include_once '/home/jkhandar/PhpstormProjects/wanderBTown_test/wanderBTown-ILS-Z532/objects/reply.php';
include_once '/home/jkhandar/PhpstormProjects/wanderBTown_test/wanderBTown-ILS-Z532/post/read.php';
// get database connection
global $posts_arr;
$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$post = new Post($db);
$reply = new Reply($db);

function getUserPosts(){
    global $posts_arr;
    return $posts_arr;
}
function getUserDash($username)
{
    global $user, $posts_arr;
    $user->username = $username;
    // query to read single record
    $query = "SELECT * FROM USERS WHERE username = ? LIMIT 0,1";

    // prepare query statement
    $stmt = $user->conn->prepare($query);

    // bind id of user to be updated
    $stmt->bindParam(1, $user->username);

    // execute query
    $stmt->execute();

    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set values to object properties
    $user->firstName = $row['firstName'];
    $user->lastName = $row['lastName'];
    $user->username = $row['username'];
    $user->email = $row['email'];
    $user->joiningDate = $row['joiningDate'];

//    return json_encode($user);
    /*    $query = "SELECT * FROM POSTS_TAGS";

        // prepare query statement
        $stmt = $post->conn->prepare($query);

        // execute query
        $stmt = $stmt->execute();

        $num = $stmt->rowCount();

    // posts array
        $posts_arr["records"]=array();
    // check if more than 0 record found
        if($num>0){
            // retrieve our table contents
            while ($num!=0){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $post_item=array($row['postID'], $row['content'], $row['userID'], $row['tag1'], $row['tag2'],
                    $row['tag3'], $row['venue'], $row['postDate'], $row['pic1'], $row['pic2'], $row['pic3'], $row['likes']);
                array_push($posts_arr["records"], $post_item);
                $num = $num - 1;
            }
        }
        else{
            array_push($posts_arr["records"], json_encode(
                array("message" => "No records found.")
            ));
        }*/

    return json_encode($user);
}