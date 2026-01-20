<?php 

function create_user( $username, $password){
    require_once "app/models/base.php";
    $db = db_chain();
    $query = $db -> prepare("INSERT INTO user (username , password) VALUES (?,?)");
    $query->execute(array($username , $password));

}

function user_exits( $username){
    require_once "app/models/base.php";
    $db = db_chain();
    $query = $db -> prepare("SELECT * FROM user WHERE username = ?");
    $query->execute(array($username));
    $user =  $query->fetch();

    if( $user ){
        return true;
    }else{
        return false;
    }

}

function fetch_user( $username){
    require_once "app/models/base.php";
    $db = db_chain();
    $query = $db -> prepare("SELECT * FROM user WHERE username = ?");
    $query->execute(array($username));
    $user = $query->fetch();

   return $user;

}

?>