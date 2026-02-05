<?php 
$route = $_SERVER["REQUEST_URI"];

$route = explode("?", $route)[0];

if($route === "/"){
    require_once "app/views/home.php";
    require_once "app/controllers/Postcontroller.php";
}
elseif($route === "/inscription"){
    require_once "app/views/inscription.php";
}
elseif($route === "/connexion"){
    require_once "app/views/connexion.php";
}elseif($route === "/logout"){
    require "app/controllers/auth.php";
    logout();   
}elseif($route === "/profil"){
    require_once "app/views/show_profil.php";
}elseif($route === "/post"){
    require_once "app/views/post.php";
}
else{
    echo "404 Vous etes perdu :(";
}
?>
