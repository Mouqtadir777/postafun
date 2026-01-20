<?php 

function  create_profil($user, $avatar, $born_date, $first_name, $last_name){
    require_once "app/models/base.php"; 
    $db = db_chain();
    $query = $db ->prepare("INSERT INTO profil(user, avatar, born_date, first_name, last_name) VALUES(?,?,?,?,?)");
    $query ->execute(array($user, $avatar, $born_date, $first_name, $last_name));

}

?>