<?php
function feed() {
    // simple wrapper to return posts using the procedural model
    require_once __DIR__ . "/../models/post.php";
    $posts = fetch_post();
    return $posts;
}

function comment(){
    require_once "app/models/post.php";
    $post_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
   

}


?>


