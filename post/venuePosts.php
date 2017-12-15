<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/post.php';
include_once '../objects/reply.php';
include_once '../objects/venue.php';


function myFunction($venueName)
{
// get database connection
    $database = new Database();
    $db = $database->getConnection();

    $reply = new Reply($db);

    $venue = new Venue($db);
    $venue->venueName = $venueName;
    $venue->readOne();
    $venue_item = array($venue->venueName,$venue->details,$venue->contact);

    $post = new Post($db);
    $stmt = $post->venuePosts($venueName);
    $num = $stmt->rowCount();
    $postNum = $num;

// posts array
    $posts_arr = array();
// check if more than 0 record found
    if ($num > 0) {
        // retrieve our table contents
        while ($num != 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $post_item = array($row['userName'],$row['postID'],$row['content'],$row['likes'],
                $row['tag1'],$row['tag2'],$row['tag3'],$row['postingDate']);
            array_push($posts_arr, $post_item);
            $num = $num - 1;
        }
    } else {
        array_push($posts_arr, 0);
    }

    $replies_arr = array();

    for($i = 0; $i < $postNum; $i++){
        $reply->postID = $posts_arr[$i][1];
        $stmt = $reply->allRepliesForAPost();
        $num = $stmt->rowCount();
        if ($num > 0) {
            while ($num != 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $reply_item = array($posts_arr[$i][1],$row['userName'],$row['content'],$row['replyDate']);
                array_push($replies_arr, $reply_item);
                $num = $num - 1;
            }
        } else {
            array_push($replies_arr, 0);
        }
    }

    $major_arr = array($venue_item,$posts_arr,$replies_arr);
    return $major_arr;
/*    for($i = 0; $i < $postNum; $i++) {
        echo "post content: ".$posts_arr[$i][0]." ".$posts_arr[$i][1]." ".$posts_arr[$i][2];
    }

    for($i = 0; $i < count($replies_arr); $i++) {
        echo "reply content: ".$replies_arr[$i][0]." ".$replies_arr[$i][1]." ".$replies_arr[$i][2];
    }*/

}
