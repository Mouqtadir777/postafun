<?php
function fetch_post(){
    // return all posts with author username, newest first
    require_once __DIR__ . "/base.php";
    $db = db_chain();
    $query = $db->prepare(
        "SELECT p.*, u.username FROM post p JOIN user u ON p.author = u.id WHERE p.deleted = 0 ORDER BY p.created_at DESC"
    );
    $query->execute();
    $posts = $query->fetchAll();

    return $posts;
}

function add_post(){
    require_once "app/models/user.php";
    session_start();
    $username = $_SESSION["user_info"]["username"];
    $user=fetch_user($username);
    $user_id=$user['id'];
    $filePath="";
    require_once "app/models/base.php";
    $db = db_chain();
    if(isset($_FILES['banner'])){
        $file = $_FILES['banner'];
        if($file['error'] === UPLOAD_ERR_OK){
            $targetDir = "stockage/post/";
            // destination on filesystem
            $RetargetDir = __DIR__ . "/../../stockage/post/";
            $RefilePath = $RetargetDir . basename($file['name']);
            $filePath = $targetDir . basename($file['name']);
            move_uploaded_file($file['tmp_name'], $RefilePath);
        }
    }
    if(isset($_POST['content']) && isset($_POST['title'])){
        $slug = create_slug($_POST['title']);
        try{
            if($filePath){
                $query=$db->prepare("INSERT INTO post (title, content, banner, author, slug) VALUES (?,?,?,?,?)");
                $add=$query->execute([$_POST['title'], $_POST['content'], $filePath,$user_id, $slug]);
                
            }else{
                $query=$db->prepare("INSERT INTO post (title,content,author, slug) VALUES (?,?,?,?)");
                $add=$query->execute([$_POST['title'],$_POST['content'],$user_id,$slug]);
                
            }
        }catch(Exception $e){
            echo "Erreur lors de la creation de post".$e." ";
        }
    }
}

function create_slug($title){
    $slug=str_replace(" ", "-", $title);
    return $slug;
}

function fetch_user_post(){
    require_once __DIR__ . "/base.php";
    $db = db_chain();
    require_once __DIR__ . "/user.php";
    session_start();
    $username = $_SESSION["user_info"]["username"];
    $user=fetch_user($username);
    $user_id=$user['id'];

    $query = $db->prepare("SELECT * FROM post WHERE author = ? AND deleted = 0 ORDER BY created_at DESC");
    $query->execute(array($user_id));
    $posts = $query->fetchAll();

    return $posts;
}
 function like($post_id, $user_id) {
    require_once "app/models/base.php";
    $db =db_chain();
    $query = $db ->prepare("INSERT IGNORE INTO likes (post_id, user_id) VALUES (?, ?)") ;
    $query ->execute([$post_id, $user_id]);
    $react= $query ->fetchAll();
  
}

function show_post($post_id){
    require_once "app/models/base.php";
    $db = db_chain();
    $query =$db ->prepare("SELECT * FROM post WHERE id=?");
    $query->execute([$post_id]);
    $post = $query->fetch();

    return $post;

}
?>