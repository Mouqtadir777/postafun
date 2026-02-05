<?php 

function comment($post_id , $user_id, $content){
    require_once "app/models/base.php";
    $db = db_chain();
    $query = $db ->prepare("INSERT INTO comment (post, author, content) VALUES (?, ?, ?)");
    $query ->execute([$post_id, $user_id, $content]);

    
}

function fetch_comment($post_id){
    require_once "app/models/base.php";
    $db = db_chain();
    $query = $db ->prepare("SELECT c.*, u.username FROM comment c JOIN user u ON c.author = u.id WHERE c.deleted = 0 AND post = ? ORDER BY c.created_at DESC"
    );
    $query ->execute([$post_id]);
    $comment = $query ->fetchAll();

    return $comment;
}



?>