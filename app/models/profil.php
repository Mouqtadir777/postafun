<?php 

function  create_profil($user, $avatar, $born_date, $first_name, $last_name){
    require_once "app/models/base.php"; 
    $db = db_chain();
    $query = $db ->prepare("INSERT INTO profil(user, avatar, born_date, first_name, last_name) VALUES(?,?,?,?,?)");
    $query ->execute(array($user, $avatar, $born_date, $first_name, $last_name));

}
 ## Recupérer les imformations du profil a partir du "user"
function fetch_profil($user){
    require_once "app/models/base.php";
    $db =db_chain();
    $query = $db -> prepare("SELECT  first_name,last_name, avatar FROM profil WHERE user= ?");
    $query -> execute(array($user));
    $profil = $query ->fetch();

    return $profil;



}

?>